<?php

namespace App\Livewire;

use App\Models\Instruction;
use Livewire\Component;

class ClientItem extends Component
{
    public $formVisible = false; 
    public $form = [
        'equifax' => [
            ['bureau_status' => '', 'item_name' => '', 'item_type' => '', 'account_no' => '', 'open_date' => '', 'status' => '', 'instruction_id' => ''],
        ],
        'experian' => [
            ['bureau_status' => '', 'item_name' => '', 'item_type' => '', 'account_no' => '', 'open_date' => '', 'status' => '', 'instruction_id' => ''],
        ],
        'transunion' => [
            ['bureau_status' => '', 'item_name' => '', 'item_type' => '', 'account_no' => '', 'open_date' => '', 'status' => '', 'instruction_id' => ''],
        ],
    ];
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
        // Validate form data
        $this->validate([
            'form.equifax.*.bureau_status' => 'required',
            'form.equifax.*.item_name' => 'required|string|max:255',
            'form.equifax.*.item_type' => 'required',
            'form.equifax.*.account_no' => 'required',
            'form.equifax.*.open_date' => 'required|date',
            'form.equifax.*.status' => 'required',
            'form.equifax.*.instruction_id' => 'required',

            'form.experian.*.bureau_status' => 'required',
            'form.experian.*.item_name' => 'required|string|max:255',
            'form.experian.*.item_type' => 'required',
            'form.experian.*.account_no' => 'required',
            'form.experian.*.open_date' => 'required|date',
            'form.experian.*.status' => 'required',
            'form.experian.*.instruction_id' => 'required',

            'form.transunion.*.bureau_status' => 'required',
            'form.transunion.*.item_name' => 'required|string|max:255',
            'form.transunion.*.item_type' => 'required',
            'form.transunion.*.account_no' => 'required',
            'form.transunion.*.open_date' => 'required|date',
            'form.transunion.*.status' => 'required',
            'form.transunion.*.instruction_id' => 'required',
        ]);

        // Loop through each bureau and save the data
        foreach ($this->form as $bureau => $items) {
            foreach ($items as $item) {
                ClientItem::create([
                    'bureau' => $bureau,
                    'bureau_status' => $item['bureau_status'],
                    'item_name' => $item['item_name'],
                    'item_type' => $item['item_type'],
                    'account_no' => $item['account_no'],
                    'open_date' => $item['open_date'],
                    'status' => $item['status'],
                    'instruction_id' => $item['instruction_id'],
                ]);
            }
        }

        // Reset form and show success message
        $this->form = [
            'equifax' => [['bureau_status' => '', 'item_name' => '', 'item_type' => '', 'account_no' => '', 'open_date' => '', 'status' => '', 'instruction_id' => '']],
            'experian' => [['bureau_status' => '', 'item_name' => '', 'item_type' => '', 'account_no' => '', 'open_date' => '', 'status' => '', 'instruction_id' => '']],
            'transunion' => [['bureau_status' => '', 'item_name' => '', 'item_type' => '', 'account_no' => '', 'open_date' => '', 'status' => '', 'instruction_id' => '']],
        ];

        session()->flash('message', 'Client items saved successfully.');
    }

    public function syncItemName($index)
    {
        if (isset($this->form['equifax'][$index]['item_name'])) {
            
            $this->form['experian'][0]['item_name'] = $this->form['equifax'][$index]['item_name'];
        }
    }
}
