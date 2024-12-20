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
    public $clientId;
    public  $equifax_bureau_status, $equifax_item_name, $equifax_item_type, $equifax_account_no, $equifax_open_date, $equifax_status, $equifax_instruction_id;
    public  $experian_bureau_status, $experian_item_name, $experian_item_type, $experian_account_no, $experian_open_date, $experian_status, $experian_instruction_id;
    public  $transunion_bureau_status, $transunion_item_name, $transunion_item_type, $transunion_account_no, $transunion_open_date, $transunion_status, $transunion_instruction_id;
    public function render()
    {
        $data['instructions'] = Instruction::orderBy('id', 'DESC')->get();
        return view('livewire.client-item', $data);
    }

    public function toggleForm()
    {
        $this->formVisible = !$this->formVisible;
    }

    public function save()
    {
        return DB::transaction(function () {
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
            $this->validate([
                'equifax_bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
                'equifax_item_name' => 'required|string|max:255',
                'equifax_item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
                'equifax_account_no' => 'required',
                'equifax_open_date' => 'required|date',
                'equifax_status' => 'required',
                'equifax_instruction_id' => 'required|exists:instructions,id',
    
                'experian_bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
                'experian_item_name' => 'required|string|max:255',
                'experian_item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
                'experian_account_no' => 'required',
                'experian_open_date' => 'required|date',
                'experian_status' => 'required',
                'experian_instruction_id' => 'required|exists:instructions,id',
    
                'transunion_bureau_status' => 'required|in:' . implode(',', BureauStatusEnum::values()),
                'transunion_item_name' => 'required|string|max:255',
                'transunion_item_type' => 'required|in:' . implode(',', ItemTypeEnum::values()),
                'transunion_account_no' => 'required',
                'transunion_open_date' => 'required|date',
                'transunion_status' => 'required',
                'transunion_instruction_id' => 'required|exists:instructions,id',
            ]);

            // List of bureaus and their respective prefix
            $bureaus = [
                'equifax',
                'experian',
                'transunion',
            ];
            $item = Item::create(['name' => 'Random Name ' . uniqid(), 'client_id' => $this->clientId]);

            // Save data for each bureau dynamically
            foreach ($bureaus as $bureau) {
                ItemDetail::create([
                    'bureau_name' => $bureau,
                    'bureau_status' => $this->{$bureau . '_bureau_status'},
                    'item_name' => $this->{$bureau . '_item_name'},
                    'item_type' => $this->{$bureau . '_item_type'},
                    'account_no' => $this->{$bureau . '_account_no'},
                    'open_date' => $this->{$bureau . '_open_date'},
                    'status' => $this->{$bureau . '_status'},
                    'instruction_id' => $this->{$bureau . '_instruction_id'},
                    'item_id' => $item->id
                ]);
            }

            // Reset form fields
            $this->resetForm();
            $this->toggleForm();
            
            // Display success message
            session()->flash('msg', 'Client items saved successfully.');
        });
    }


    public function syncItemName($index)
    {
        if (isset($this->form['equifax'][$index]['item_name'])) {

            $this->form['experian'][0]['item_name'] = $this->form['equifax'][$index]['item_name'];
        }
    }
    private function resetForm()
    {
        $this->equifax_bureau_status = $this->equifax_item_name = $this->equifax_item_type = $this->equifax_account_no = $this->equifax_open_date = $this->equifax_status = $this->equifax_instruction_id = '';
        $this->experian_bureau_status = $this->experian_item_name = $this->experian_item_type = $this->experian_account_no = $this->experian_open_date = $this->experian_status = $this->experian_instruction_id = '';
        $this->transunion_bureau_status = $this->transunion_item_name = $this->transunion_item_type = $this->transunion_account_no = $this->transunion_open_date = $this->transunion_status = $this->transunion_instruction_id = '';
    }
}
