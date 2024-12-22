<?php

namespace App\Livewire;

use App\enum\BureauAddressNameEnum;
use App\enum\BureauStatusEnum;
use App\Models\BureauAddress;
use App\Models\Client;
use App\Models\DisputeLetters;
use App\Models\Item;
use Livewire\Component;

class ClientLetter extends Component
{
   public $formVisible = true;
   public $stepOne = true;
   public $stepTwo = false;
   public $stepThree = false;
   public $clientId;
   // public $itemlists = [];

   public $master_Equifax_original = false;
   public $master_Experian_original = false;
   public $master_TransUnion_original = false;

   public $master_Equifax_collections = false;
   public $master_Experian_collections = false;
   public $master_TransUnion_collections = false;

   // Selected child checkboxes
   public $selectedItemOtherDetailsEqFax = [];
   public $selectedItemOtherDetailsExprian = [];
   public $selectedItemOtherDetailsTrans = [];
   public $selectedItemCollDetailsEqFax = [];
   public $selectedItemCollDetailsExprian = [];
   public $selectedItemCollDetailsTrans = [];
   public $innerUse;
   public $openModal = false;
   public $class;
   public $address_selected_equifax, $dispute_letter_selected_equifax, $address_selected_experion, $dispute_letter_selected_experion, $address_selected_transunion, $dispute_letter_selected_transunion;

   public function render()
   {
      return view('livewire.client-letter', [
         'itemlists' => $this->fetchItemsWithDetails(),
         'addresss' => BureauAddress::all()->groupBy("name"),
         'templates' => DisputeLetters::get()
         //       BureauAddress::all()
         //  ->groupBy('name');
      ]);
   }

   public function mount()
   {
      $this->innerUse = $this->fetchItemsWithDetails();
      foreach (['original', 'collection'] as $type) {
         foreach (
            [
               \App\enum\BureauAddressNameEnum::EQUIFAX,
               \App\enum\BureauAddressNameEnum::EXPERIAN,
               \App\enum\BureauAddressNameEnum::TRANSUNION,
            ] as $bureau
         ) {
            $this->toggleMaster($type, $bureau);
         }
      }
   }


   private function fetchItemsWithDetails()
   {
      return Item::with(['itemDetails' => function ($query) {
         $query->where('bureau_status', BureauStatusEnum::NEGATIVE);
      }])
         ->where('client_id', $this->clientId)
         ->orderBy('id', 'DESC')
         ->get();
   }


   public function toggleMaster($type, $bureau)
   {
      if ($type === 'original') {
         if ($bureau === \App\enum\BureauAddressNameEnum::EQUIFAX) {
            $this->master_Equifax_original = !$this->master_Equifax_original;

            $equifaxIds = $this->innerUse
               ->where('item_type', '!=', \App\enum\ItemTypeEnum::COLLECTION)
               ->pluck('itemDetails')
               ->flatten()
               ->where('bureau_status', BureauStatusEnum::NEGATIVE)
               ->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)
               ->pluck('id')
               ->toArray();
            // array_shift($equifaxIds);
            $this->selectedItemOtherDetailsEqFax = $this->master_Equifax_original ? $equifaxIds : [];
         }

         if ($bureau === \App\enum\BureauAddressNameEnum::EXPERIAN) {
            $this->master_Experian_original = !$this->master_Experian_original;
            $experianIds = $this->innerUse
               ->where('item_type', '!=', \App\enum\ItemTypeEnum::COLLECTION)
               ->pluck('itemDetails')
               ->flatten()
               ->where('bureau_status', BureauStatusEnum::NEGATIVE)
               ->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)
               ->pluck('id')
               ->toArray();
            // dd($experianIds);
            // array_shift($experianIds);
            $this->selectedItemOtherDetailsExprian = $this->master_Experian_original ? $experianIds : [];
         }
         if ($bureau === \App\enum\BureauAddressNameEnum::TRANSUNION) {
            $this->master_TransUnion_original = !$this->master_TransUnion_original;

            $transUnionIds = $this->innerUse
               ->where('item_type', '!=', \App\enum\ItemTypeEnum::COLLECTION)
               ->pluck('itemDetails')
               ->flatten()
               ->where('bureau_status', BureauStatusEnum::NEGATIVE)
               ->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)
               ->pluck('id')
               ->toArray();
            // array_shift($transUnionIds);
            $this->selectedItemOtherDetailsTrans = $this->master_TransUnion_original ? $transUnionIds : [];
         }
      }
      if ($type === 'collection') {
         if ($bureau === \App\enum\BureauAddressNameEnum::EQUIFAX) {

            $this->master_Equifax_collections = !$this->master_Equifax_collections;

            $equifaxIdsC = $this->innerUse
               ->where('item_type', \App\enum\ItemTypeEnum::COLLECTION)
               ->pluck('itemDetails')
               ->flatten()
               ->where('bureau_status', BureauStatusEnum::NEGATIVE)
               ->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)
               ->pluck('id')
               ->toArray();

            // array_pop($equifaxIdsC);
            $this->selectedItemCollDetailsEqFax = $this->master_Equifax_collections ? $equifaxIdsC : [];
         }

         if ($bureau === \App\enum\BureauAddressNameEnum::EXPERIAN) {

            $this->master_Experian_collections = !$this->master_Experian_collections;

            $experiondsC = $this->innerUse
               ->where('item_type', \App\enum\ItemTypeEnum::COLLECTION)
               ->pluck('itemDetails')
               ->flatten()
               ->where('bureau_status', BureauStatusEnum::NEGATIVE)
               ->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)
               ->pluck('id')
               ->toArray();
            // array_pop($experiondsC);
            $this->selectedItemCollDetailsExprian = $this->master_Experian_collections ? $experiondsC : [];
         }

         if ($bureau === \App\enum\BureauAddressNameEnum::TRANSUNION) {

            $this->master_TransUnion_collections = !$this->master_TransUnion_collections;

            $transuIdsC = $this->innerUse
               ->where('item_type', \App\enum\ItemTypeEnum::COLLECTION)
               ->pluck('itemDetails')
               ->flatten()
               ->where('bureau_status', BureauStatusEnum::NEGATIVE)
               ->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)
               ->pluck('id')
               ->toArray();
            // array_pop($transuIdsC);
            $this->selectedItemCollDetailsTrans = $this->master_TransUnion_collections ? $transuIdsC : [];
         }
      }
   }


public function previewTemplate($bureau){
   if($bureau == BureauAddressNameEnum::EQUIFAX){
      $disputeLtter = DisputeLetters::where('id', $this->dispute_letter_selected_equifax)->first();
      $body = $disputeLtter->body;
      $getClient = Client::where('id', $this->clientId)->first();
      str_replace('contact_full_name', $getClient->first_name.' '.$getClient->middle_name.' '.$getClient->last_name, $body);
      $this->openModal = true;
      $this->class='show';
   }
}

public function closeModal(){
   $this->openModal = false; 
   $this->class='';
}




   public function toggleForm()
   {
      $this->formVisible = !$this->formVisible;
   }
   public function goToStepTwo()
   {

      $this->stepOne = false;
      $this->stepTwo = true;
   }

   public function backToStepOne()
   {
      $this->stepOne = true;
      $this->stepTwo = false;
   }

   public function goToStepThree()
   {
      $this->stepTwo = false;
      $this->stepThree = true;
      // dd($this->address_selected_equifax, $this->dispute_letter_selected_equifax, $this->address_selected_experion, $this->dispute_letter_selected_experion, $this->address_selected_transunion, $this->dispute_letter_selected_transunion, $this->selectedItemOtherDetailsTrans);
   }
   public function backToStepTwo()
   {
      $this->stepTwo = true;
      $this->stepThree = false;
   }
}
