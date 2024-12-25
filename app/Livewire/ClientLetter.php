<?php

namespace App\Livewire;

use App\enum\BureauAddressNameEnum;
use App\enum\BureauStatusEnum;
use App\enum\ItemTypeEnum;
use App\Models\BureauAddress;
use App\Models\Client;
use App\Models\DisputeLetters;
use App\Models\Item;
use App\Models\Later;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ClientLetter extends Component
{
   public $formVisible = true;
   public $stepOne = true;
   public $stepTwo = false;
   public $stepThree = false;
   public $clientId;
   public $oldTemplateIId;

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
   public $class, $bureauBody, $currentModal;
   public $address_selected_equifax, $dispute_letter_selected_equifax, $address_selected_experion, $dispute_letter_selected_experion, $address_selected_transunion, $dispute_letter_selected_transunion;
   public $leterBodyEquiFax, $leterBodyExperian, $leterBodyTransunion;
   public $transunion_include_id, $experion_include_id, $equfax_include_id;

   public function render()
   {
      return view('livewire.client-letter', [
         'itemlists' => $this->fetchItemsWithDetails(),
         'addresss' => BureauAddress::all()->groupBy("name"),
         'templates' => DisputeLetters::get(),
         'laterLists' => $this->fetchLatersWithDetails()
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

   private function fetchLatersWithDetails()
   {
      return Later::with(['laterItemDetails' ])
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
               ->where('item_type', '!=', ItemTypeEnum::COLLECTION)
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


   public function previewTemplate($bureau)
   {
      $this->currentModal = $bureau;
      if ($bureau == BureauAddressNameEnum::EQUIFAX) {

         $this->bureauBody = $this->leterBodyEquiFax;
         $this->openModal = true;
         $this->dispatch('modalOpened');
         $this->class = 'show';
      }
      if ($bureau == BureauAddressNameEnum::EXPERIAN) {

         $this->bureauBody = $this->leterBodyExperian;
         $this->openModal = true;
         $this->dispatch('modalOpened');
         $this->class = 'show';
      }

      if ($bureau == BureauAddressNameEnum::TRANSUNION) {
         $this->bureauBody = $this->leterBodyTransunion;
         $this->openModal = true;
         $this->dispatch('modalOpened');
         $this->class = 'show';
      }
   }

   public function closeModal()
   {
      $this->openModal = false;
      $this->dispatch('modalClosed');
      $this->class = '';
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
      $this->makeLeterBody('Equifax');
      $this->makeLeterBody('Experian');
      $this->makeLeterBody('Transunion');

      // }
      // dd($this->address_selected_equifax, $this->dispute_letter_selected_equifax, $this->address_selected_experion, $this->dispute_letter_selected_experion, $this->address_selected_transunion, $this->dispute_letter_selected_transunion, $this->selectedItemOtherDetailsTrans);
   }
   private function makeLeterBody($bureauN)
   {
      if ($bureauN == "Equifax") {
         $disputeLtter = DisputeLetters::where('id', $this->dispute_letter_selected_equifax)->first();
         $recepAddress = BureauAddress::where('name', BureauAddressNameEnum::EQUIFAX)->first();
         $body = $disputeLtter->body;

         // dd($disputeLtter->body, strip_tags($body));
         $this->leterBodyEquiFax = $this->replaceBodyVariable($recepAddress, $body);;
      }
      if ($bureauN == "Experian") {
         $disputeLtter = DisputeLetters::where('id', $this->dispute_letter_selected_experion)->first();
         $recepAddress = BureauAddress::where('name', BureauAddressNameEnum::EXPERIAN)->first();
         $body = $disputeLtter->body;

         // dd($disputeLtter->body, strip_tags($body));
         $this->leterBodyExperian = $this->replaceBodyVariable($recepAddress, $body);;
      }

      if ($bureauN == "Transunion") {
         $disputeLtter = DisputeLetters::where('id', $this->dispute_letter_selected_transunion)->first();
         $recepAddress = BureauAddress::where('name', BureauAddressNameEnum::TRANSUNION)->first();
         $body = $disputeLtter->body;

         // dd($disputeLtter->body, strip_tags($body));
         $this->leterBodyTransunion = $this->replaceBodyVariable($recepAddress, $body);;
      }
   }

   private function replaceBodyVariable($recepAddress, $body)
   {
      $getClient = Client::where('id', $this->clientId)->first();
      $body = str_replace('contact_full_name', $getClient->first_name . ' ' . $getClient->middle_name . ' ' . $getClient->last_name, $body);
      $body = str_replace('contact_first_name', $getClient->first_name, $body);
      $body = str_replace('contact_last_name', $getClient->last_name, $body);
      $body = str_replace('contact_dob_name', $getClient->dob, $body);
      $body = str_replace('contact_ssn', $getClient->ssn, $body);
      $body = str_replace('contact_res_complete_address', $getClient->current_address, $body);
      $body = str_replace('contact_street_address', $getClient->current_address, $body);
      $body = str_replace('contact_city', $getClient->city, $body);
      $body = str_replace('contact_state', $getClient->state, $body);
      $body = str_replace('contact_zipcode', $getClient->zipcode, $body);

      $body = str_replace('current_date', date('Y-m-d'), $body);
      $body = str_replace('recipient_item_list', $getClient->first_name, $body);
      $body = str_replace('recipient_item_list_with_instruction', $getClient->last_name, $body);
      $body = str_replace('recipient_res_address', $recepAddress->address, $body);
      $body = str_replace('recipient_street_address', $recepAddress->address, $body);
      $body = str_replace('recipient_city', $recepAddress->city, $body);
      $body = str_replace('recipient_state', $recepAddress->state, $body);
      $body = str_replace('recipient_zipcode', $recepAddress->zipcode, $body);
      return $body;
   }
   public function backToStepTwo()
   {
      $this->stepTwo = true;
      $this->stepThree = false;
   }



   public function updateBody()
   {
      if ($this->currentModal == BureauAddressNameEnum::EQUIFAX) {
         $this->leterBodyEquiFax = $this->bureauBody;
      }
      if ($this->currentModal == BureauAddressNameEnum::EXPERIAN) {
         $this->leterBodyExperian = $this->bureauBody;
      }
      if ($this->currentModal == BureauAddressNameEnum::TRANSUNION) {
         $this->leterBodyTransunion = $this->bureauBody;
      }
      $this->closeModal();
   }

   public function saveLater()
   {

      foreach (BureauAddressNameEnum::values() as $key => $value) {
         $data = [];
         $laterItems = [];

         if ($value == BureauAddressNameEnum::EQUIFAX) {
            $data['bureau_name'] = BureauAddressNameEnum::EQUIFAX;
            $data['body_html'] = $this->leterBodyEquiFax;
            $data['include_docs'] = $this->equfax_include_id ?? 0;
            $laterItems['item_detail_id'] = array_merge($this->selectedItemOtherDetailsEqFax, $this->selectedItemCollDetailsEqFax);
         }
         if ($value == BureauAddressNameEnum::EXPERIAN) {
            $data['bureau_name'] = BureauAddressNameEnum::EXPERIAN;
            $data['body_html'] = $this->leterBodyExperian;
            $data['include_docs'] = $this->experion_include_id ?? 0;
            $laterItems['item_detail_id'] = array_merge($this->selectedItemOtherDetailsExprian, $this->selectedItemCollDetailsExprian);
         }
         if ($value == BureauAddressNameEnum::TRANSUNION) {
            $data['bureau_name'] = BureauAddressNameEnum::TRANSUNION;
            $data['body_html'] = $this->leterBodyTransunion;
            $data['include_docs'] = $this->transunion_include_id ?? 0;
            $laterItems['item_detail_id'] = array_merge($this->selectedItemOtherDetailsTrans, $this->selectedItemCollDetailsTrans);
         }
        

         try {
            // $data['body_html'] = mb_convert_encoding($data['body_html'], 'UTF-8', 'auto');
            // $data['body_html'] = '<html><body>' . $data['body_html'] . '</body></html>';
            $pdf = \PDF::loadHTML($data['body_html']);
            $pdfContent = $pdf->output();

            // Create a temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'pdf');
            file_put_contents($tempFile, $pdfContent);

            // Simulate file upload to call uploadImage
            $uploadedFile = new \Illuminate\Http\UploadedFile(
               $tempFile,
               time() . rand(0000, 9999) . '.pdf',
               'application/pdf',
               null,
               true
            );

            // Use uploadImage to save the PDF
            $data['body_pdf'] = $this->uploadImage($uploadedFile);

            // Remove the temporary file
            unlink($tempFile);
         } catch (\Exception $e) {
            Log::debug('PDF generation failed: ',[$e->getMessage()]);
            continue;
         }

         $data['client_id'] = $this->clientId;

         // Save to database
         $storeLater = Later::create($data);
         foreach ($laterItems['item_detail_id'] as $itemDetailId) {
            $storeLater->laterItemDetails()->create([
               'item_detail_id' => $itemDetailId,
            ]);
         }
      }
      $this->resetForm();
      $this->toggleForm();
      session()->flash('msg', 'Later saved successfully.');
      $this->fetchLatersWithDetails();
   }
   public function uploadImage($document)
   {
      $db_image = time() . rand(0000, 9999) . '.' . $document->getClientOriginalExtension();
      $document->storeAs("LaterPdf", $db_image, 'public');
      return '/LaterPdf/' . $db_image;
   }

   private function resetForm()
   {
      $this->leterBodyEquiFax = '';
      $this->equfax_include_id = '';
      $this->selectedItemOtherDetailsEqFax = '';
      $this->selectedItemCollDetailsEqFax = '';
      $this->leterBodyExperian = '';
      $this->experion_include_id = '';
      $this->selectedItemOtherDetailsExprian = '';
      $this->selectedItemCollDetailsExprian = '';
      $this->leterBodyTransunion = '';
      $this->transunion_include_id = '';
      $this->selectedItemOtherDetailsTrans = '';
      $this->selectedItemCollDetailsTrans = '';
      $this->backToStepOne();
   }

   public function deleteLater($laterslug){
      $findLater = Later::where('slug', $laterslug)->first();
      $findLater->laterItemDetails()->delete();
      $findLater->delete();
      session()->flash('msg', 'Later deleted successfully.');
      $this->fetchLatersWithDetails();
   }
}
