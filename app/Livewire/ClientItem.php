<?php

namespace App\Livewire;

use App\enum\BureauStatusEnum;
use App\enum\ItemTypeEnum;
use App\Models\Instruction;
use App\Models\Item;
use App\Models\ItemDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClientItem extends Component
{
    public $formVisible = false;
    public $itemlists = [];
    public $clientId, $itemId, $item_type;
    public  $Equifax_bureau_status, $Equifax_item_name, $Equifax_account_no, $Equifax_open_date, $Equifax_status, $Equifax_instruction_id;
    public  $Experian_bureau_status, $Experian_item_name, $Experian_account_no, $Experian_open_date, $Experian_status, $Experian_instruction_id;
    public  $Transunion_bureau_status, $Transunion_item_name, $Transunion_account_no, $Transunion_open_date, $Transunion_status, $Transunion_instruction_id;
    public function render()
    {
        $data['instructions'] = Instruction::orderBy('id', 'DESC')->get();
        return view('livewire.client-item', $data);
    }

    public function mount()
    {
        $this->itemlists = $this->fetchItemsWithDetails();
    }

    private function fetchItemsWithDetails()
    {
        return Item::with('itemDetails')->where('client_id', $this->clientId)->orderBy('id', 'DESC')->get();
    }

    public function toggleForm()
    {
        $this->formVisible = !$this->formVisible;
    }

    public function editItem($itemSlug)
    {
        $item = $this->getItem($itemSlug);

        // Ensure item exists
        if (!$item) {
            session()->flash('error', 'Item not found.');
            return;
        }

        // Assign the item and its details to the component's properties
        $this->clientId = $item->client_id; // Set the client ID if needed
        $this->formVisible = true; // Open the form for editing
        $this->item_type = $item->item_type;

        // Populate form fields for each bureau dynamically
        $bureaus = ['Equifax', 'Experian', 'Transunion'];
        foreach ($bureaus as $bureau) {
            $detail = $item->itemDetails->firstWhere('bureau_name', $bureau);

            if ($detail) {
                $this->{$bureau . '_bureau_status'} = $detail->bureau_status;
                $this->{$bureau . '_item_name'} = $detail->item_name;
                // $this->{$bureau . '_item_type'} = $detail->item_type;
                $this->{$bureau . '_account_no'} = $detail->account_no;
                $this->{$bureau . '_open_date'} = $detail->open_date;
                $this->{$bureau . '_status'} = $detail->status;
                $this->{$bureau . '_instruction_id'} = $detail->instruction_id;
            } else {
                // Reset fields for the bureau if no details are found
                $this->{$bureau . '_bureau_status'} = null;
                $this->{$bureau . '_item_name'} = null;
                // $this->{$bureau . '_item_type'} = null;
                $this->{$bureau . '_account_no'} = null;
                $this->{$bureau . '_open_date'} = null;
                $this->{$bureau . '_status'} = null;
                $this->{$bureau . '_instruction_id'} = null;
            }
        }

        if (!$this->formVisible) {
            $this->formVisible = true;
        }
        $this->itemId = $item->id;
    }


    private function getItem($itemSlug)
    {
        return Item::with('itemDetails')->where('slug', $itemSlug)->first();
    }

    public function save()
    {
        return DB::transaction(function () {

            $this->validate([

                'item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),

                'Equifax_bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
                'Equifax_item_name' => 'required|string|max:255',
                // 'Equifax_item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
                'Equifax_account_no' => 'required',
                'Equifax_open_date' => 'required|date',
                'Equifax_status' => 'required',
                'Equifax_instruction_id' => 'required|exists:instructions,id',

                'Experian_bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
                'Experian_item_name' => 'required|string|max:255',
                // 'Experian_item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
                'Experian_account_no' => 'required',
                'Experian_open_date' => 'required|date',
                'Experian_status' => 'required',
                'Experian_instruction_id' => 'required|exists:instructions,id',

                'Transunion_bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
                'Transunion_item_name' => 'required|string|max:255',
                // 'Transunion_item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
                'Transunion_account_no' => 'required',
                'Transunion_open_date' => 'required|date',
                'Transunion_status' => 'required',
                'Transunion_instruction_id' => 'required|exists:instructions,id',
            ]);

            // List of bureaus and their respective prefix
            $bureaus = [
                'Equifax',
                'Experian',
                'Transunion',
            ];

            if (isset($this->itemId)) {
                $item = Item::find($this->itemId);

                if (!$item) {
                    session()->flash('error', 'Item not found.');
                    return;
                }

                // Update existing item details
                foreach ($bureaus as $bureau) {
                    $detail = $item->itemDetails->firstWhere('bureau_name', $bureau);

                    if ($detail) {
                        $detail->update([
                            'bureau_status' => $this->{$bureau . '_bureau_status'},
                            'item_name' => $this->{$bureau . '_item_name'},
                            // 'item_type' => $this->{$bureau . '_item_type'},
                            'account_no' => $this->{$bureau . '_account_no'},
                            'open_date' => $this->{$bureau . '_open_date'},
                            'status' => $this->{$bureau . '_status'},
                            'instruction_id' => $this->{$bureau . '_instruction_id'},
                        ]);
                    }
                }
                session()->flash('msg', 'Client items updated successfully.');
            } else {

                $item = Item::create(['name' => 'Random Name ' . uniqid(), 'client_id' => $this->clientId, 'item_type' => $this->item_type]);

                // Save data for each bureau dynamically
                foreach ($bureaus as $bureau) {
                    ItemDetail::create([
                        'bureau_name' => $bureau,
                        'bureau_status' => $this->{$bureau . '_bureau_status'},
                        'item_name' => $this->{$bureau . '_item_name'},
                        // 'item_type' => $this->{$bureau . '_item_type'},
                        'account_no' => $this->{$bureau . '_account_no'},
                        'open_date' => $this->{$bureau . '_open_date'},
                        'status' => $this->{$bureau . '_status'},
                        'instruction_id' => $this->{$bureau . '_instruction_id'},
                        'item_id' => $item->id
                    ]);
                }
                session()->flash('msg', 'Client items saved successfully.');
            }

            // Reset form fields
            $this->resetForm();
            $this->toggleForm();
            $this->itemlists = $this->fetchItemsWithDetails();
            // Display success message


        });
    }

    private function resetForm()
    {
        $this->Equifax_bureau_status = $this->equifax_item_name = $this->item_type = $this->equifax_account_no = $this->equifax_open_date = $this->equifax_status = $this->equifax_instruction_id = '';
        $this->Experian_bureau_status = $this->experian_item_name = $this->item_type = $this->experian_account_no = $this->experian_open_date = $this->experian_status = $this->experian_instruction_id = '';
        $this->Transunion_bureau_status = $this->transunion_item_name = $this->item_type = $this->transunion_account_no = $this->transunion_open_date = $this->transunion_status = $this->transunion_instruction_id = '';
    }

    public function syncBureauStatus()
    {
        if (!$this->itemId) {
            $this->Experian_bureau_status = $this->Transunion_bureau_status = $this->Equifax_bureau_status;
        }
    }

    public function syncItemName()
    {
        if (!$this->itemId) {
            $this->Experian_item_name = $this->Transunion_item_name = $this->Equifax_item_name;
        }
    }

    public function syncAccountNo()
    {
        if (!$this->itemId) {
            $this->Transunion_account_no = $this->Experian_account_no = $this->Equifax_account_no;
        }
    }

    public function syncOpenDate()
    {
        if (!$this->itemId) {
            $this->Transunion_open_date = $this->Experian_open_date = $this->Equifax_open_date;
        }
    }

    public function syncStatus()
    {
        if (!$this->itemId) {
            $this->Transunion_status = $this->Experian_status = $this->Equifax_status;
        }
    }

    public function syncInstruction()
    {
        if (!$this->itemId) {
            $this->Transunion_instruction_id = $this->Experian_instruction_id = $this->Equifax_instruction_id;
        }
    }



    // Define common fields for validation
    // $commonValidationFields = [
    //     'bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
    //     'item_name' => 'required|string|max:255',
    //     'item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
    //     'account_no' => 'required',
    //     'open_date' => 'required|date',
    //     'status' => 'required',
    //     'instruction_id' => 'required|exists:instructions,id',
    // ];

    // // Define validation rules for all bureaus
    // $this->validate([
    //     'equifax_' . key($commonValidationFields) => $commonValidationFields,
    //     'experian_' . key($commonValidationFields) => $commonValidationFields,
    //     'transunion_' . key($commonValidationFields) => $commonValidationFields,
    // ]);
}
