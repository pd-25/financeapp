<div class="card">
    <div class="card-body">

        <div class="d-flex align-items-center mb-3 justify-content-between">
            <h5 class="card-title">Client Letters</h5>
            
            
            @if (Session::has('msg'))
                <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
            <a href="javascript:void(0)" wire:click="toggleForm">
                <u> <span id="add-hide-btn">{{ $formVisible ? 'Hide Letter Form' : 'Add Letter Form' }}</span></u>
            </a>
        </div>

        @if ($formVisible)
            <div id="container" class="container mt-5">
                <div class="progress px-1" style="height: 3px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <div class="step-container d-flex justify-content-between">
                    <div class="step-circle">1</div>
                    <div class="step-circle">2</div>
                    <div class="step-circle">3</div>
                </div>

                <form id="multi-step-form">
                    @if ($stepOne)
                        <div class="step step-1">
                            <!-- Step 1 form fields here -->
                            <h3>Step 1</h3>
                            <div class="mb-3">
                                <div class="container my-5">
                                    <table class="table table-bordered align-middle mt-4">
                                        {{-- <tr>
                                    <th>Original Creditors</th>
                                    <th>Equifax <input type="checkbox" @checked($master_Equifax_original) wire:click="toggleMaster('original', 'Equifax')"></th>
                                    <th>Experian <input type="checkbox" @checked($master_Experian_original) wire:click="toggleMaster('original', 'Experian')"></th>
                                    <th>TransUnion <input type="checkbox" @checked($master_TransUnion_original) wire:click="toggleMaster('original', 'TransUnion')"></th>
                                </tr>

                                @foreach ($itemlists->where('item_type', '!=', \App\enum\ItemTypeEnum::COLLECTION) as $itemother)
                                <tr>
                                    <td>{{ $itemother->itemDetails->first()->item_name }}
                                        -{{ $itemother->itemDetails->first()->account_no }}</td>
                                    @foreach ($itemother->itemDetails as $itemotherDetail)
                                    @if ($itemotherDetail->bureau_name == \App\enum\BureauAddressNameEnum::EQUIFAX)
                                        <td>
                                            <input type="checkbox" wire:model="selectedItemOtherDetailsEqFax" value="{{ $itemotherDetail->id }}" 
                                            wire:click="toggleChild('original', '{{ $itemotherDetail->bureau_name }}')">

                                        </td>
                                    @endif
                                    @if ($itemotherDetail->bureau_name == \App\enum\BureauAddressNameEnum::EXPERIAN)
                                    <td>
                                        <input type="checkbox" wire:model="selectedItemOtherDetailsExprian" value="{{ $itemotherDetail->id }}" 
                                        wire:click="toggleChild('original', '{{ $itemotherDetail->bureau_name }}')">

                                    </td>
                                    @endif
                                    @if ($itemotherDetail->bureau_name == \App\enum\BureauAddressNameEnum::TRANSUNION)
                                    <td>
                                        <input type="checkbox" wire:model="selectedItemOtherDetailsTrans" value="{{ $itemotherDetail->id }}" 
                                        wire:click="toggleChild('original', '{{ $itemotherDetail->bureau_name }}')">
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach --}}

                                        <tr>
                                            <th>Original Creditors</th>
                                            <th>
                                                Equifax
                                                <input type="checkbox" @checked($master_Equifax_original)
                                                    wire:click="toggleMaster('original', 'Equifax')">
                                            </th>
                                            <th>
                                                Experian
                                                <input type="checkbox" @checked($master_Experian_original)
                                                    wire:click="toggleMaster('original', 'Experian')">
                                            </th>
                                            <th>
                                                TransUnion
                                                <input type="checkbox" @checked($master_TransUnion_original)
                                                    wire:click="toggleMaster('original', 'Transunion')">
                                            </th>
                                        </tr>

                                @foreach ($itemlists->where('item_type', '!=', \App\enum\ItemTypeEnum::COLLECTION) as $itemother)
                                    <tr>
                                    <td>{{ $itemother->itemDetails->first()->item_name }} - {{ $itemother->itemDetails->first()->account_no }}</td>
                                    <td>
                                            @if ($itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)->first())
                                            <input type="checkbox" 
                                            wire:model="selectedItemOtherDetailsEqFax" 
                                            value="{{ $itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)->first()->id }}">
                                            {{-- @dump($itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)->first()->id) --}}
                                            
                                            
                                        @endif
                                    </td>
                                    <td>
                                        @if ($itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)->first())
                                            <input type="checkbox" 
                                            wire:model="selectedItemOtherDetailsExprian" 
                                            value="{{ $itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)->first()->id }}">
                                            
                                            {{-- @dump($itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)->first()->id) --}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)->first())
                                        <input type="checkbox" 
                                        wire:model="selectedItemOtherDetailsTrans" 
                                        value="{{ $itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)->first()->id }}">
                                        
                                        {{-- @dump($itemother->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)->first()->id) --}}
                                    @endif
                                    </td>
                                    
                                    </tr>
                                @endforeach
                                


                                <tr>
                                    <th>Collections</th>
                                    <th>Equifax <input type="checkbox" @checked($master_Equifax_collections)
                                        wire:click="toggleMaster('collection', 'Equifax')"></th>
                                    <th>Experian <input type="checkbox" @checked($master_Experian_collections)
                                        wire:click="toggleMaster('collection', 'Experian')"></th>
                                    <th>TransUnion <input type="checkbox" @checked($master_TransUnion_collections)
                                        wire:click="toggleMaster('collection', 'Transunion')" ></th>
                                </tr>

                                @foreach ($itemlists->where('item_type', \App\enum\ItemTypeEnum::COLLECTION) as $itemColl)
                                            <tr>
                                                <td>{{ $itemColl->itemDetails->first()->item_name }}
                                                    -{{ $itemColl->itemDetails->first()->account_no }}</td>

                                                <td>
                                                    @if ($itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)->first())
                                                        <input type="checkbox" 
                                                        wire:model="selectedItemCollDetailsEqFax" 
                                                        value="{{ $itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)->first()->id }}">
                                                        
                                                        {{-- @dump($itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EQUIFAX)->first()->id) --}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)->first())
                                                        <input type="checkbox" 
                                                        wire:model="selectedItemCollDetailsExprian" 
                                                        value="{{ $itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)->first()->id }}">
                                                        
                                                        {{-- @dump($itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::EXPERIAN)->first()->id) --}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)->first())
                                                        <input type="checkbox" 
                                                        wire:model="selectedItemCollDetailsTrans" 
                                                        value="{{ $itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)->first()->id }}">
                                                        
                                                        {{-- @dump($itemColl->itemDetails->where('bureau_name', \App\enum\BureauAddressNameEnum::TRANSUNION)->first()->id) --}}
                                                        
                                                    @endif
                                                </td>
                                                {{-- @foreach ($itemColl->itemDetails as $itemCollDetail)
                                                    @if ($itemCollDetail->bureau_name == \App\enum\BureauAddressNameEnum::EQUIFAX)
                                                        <td><input type="checkbox"
                                                                wire:model="selectedItemCollDetails.{{ $itemCollDetail->id }}.{{ $itemCollDetail->bureau_name }}"
                                                                wire:click="toggleChild('original', '{{ $itemCollDetail->bureau_name }}')">
                                                        </td>
                                                    @endif
                                                    @if ($itemCollDetail->bureau_name == \App\enum\BureauAddressNameEnum::EXPERIAN)
                                                        <td><input type="checkbox"
                                                                wire:model="selectedItemCollDetails.{{ $itemCollDetail->id }}.{{ $itemCollDetail->bureau_name }}"
                                                                wire:click="toggleChild('original', '{{ $itemCollDetail->bureau_name }}')">
                                                        </td>
                                                    @endif
                                                    @if ($itemCollDetail->bureau_name == \App\enum\BureauAddressNameEnum::TRANSUNION)
                                                        <td><input type="checkbox"
                                                                wire:model="selectedItemCollDetails.{{ $itemCollDetail->id }}.{{ $itemCollDetail->bureau_name }}"
                                                                wire:click="toggleChild('original', '{{ $itemCollDetail->bureau_name }}')">
                                                        </td>
                                                    @endif
                                                @endforeach --}}
                                            </tr>
                                        @endforeach

                                    </table>



                                </div>
                            </div>
                            <button type="button" class="btn btn-primary next-step"
                                wire:click="goToStepTwo">Next</button>
                        </div>
                    @endif
                    @if ($stepTwo)
                        <div class="step step-2">
                            <!-- Step 2 form fields here -->
                            <h3>Step 2</h3>
                            <div class="mb-3">
                                <table class="table table-bordered align-middle mt-4">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Bureau </th>
                                            <th>Address </th>
                                            <th>Template </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($addresss as $bureaK=>$bureau)
                                        @if ($bureaK == \App\enum\BureauAddressNameEnum::EQUIFAX)
                                        
                                        <tr>
                                            {{-- @dd($selectedItemCollDetailsEqFax, count($selectedItemCollDetailsEqFax), $selectedItemOtherDetailsEqFax, count($selectedItemOtherDetailsEqFax)) --}}
                                            <td>{{$bureaK}}- {{count($selectedItemOtherDetailsEqFax)+count($selectedItemCollDetailsEqFax)}}</td>
                                            <td class="table-dropdown">
                                                <select class="form-control" wire:model="address_selected_equifax">
                                                   <option>--select--</option>
                                                    @forelse ($bureau as $adddres)
                                                    <option value="{{$adddres->id}}">{{$adddres->address}}</option>
                                                    @empty
                                                    <option disabled>not found</option>
                                                    @endforelse
                                                    
                                                </select></td>
                                            <td class="table-dropdown">
                                                <select class="form-control" wire:model="dispute_letter_selected_equifax">
                                                  <option>--select--</option>
                                                    @forelse ($templates as $template)
                                                       <option value="{{$template->id}}">{{$template->name}}</option>
                                                   @empty
                                                       <option disabled>not found</option>
                                                   @endforelse
                                                </select></td>

                                        </tr>
                                        @endif

                                        @if ($bureaK == \App\enum\BureauAddressNameEnum::EXPERIAN)
                                        <tr>
                                            {{-- @dd($selectedItemCollDetailsExprian, count($selectedItemCollDetailsExprian), $selectedItemOtherDetailsExprian, count($selectedItemOtherDetailsExprian)) --}}
                                            <td>{{$bureaK}}- {{count($selectedItemOtherDetailsExprian)+count($selectedItemCollDetailsExprian)}}</td>
                                            <td class="table-dropdown">
                                                <select class="form-control" wire:model="address_selected_experion">
                                                   <option>--select--</option>
                                                    @forelse ($bureau as $adddresE)
                                                    <option value="{{$adddresE->id}}">{{$adddresE->address}}</option>
                                                    @empty
                                                    <option disabled>not found</option>
                                                    @endforelse
                                                    
                                                </select></td>
                                            <td class="table-dropdown">
                                                <select class="form-control" wire:model="dispute_letter_selected_experion">
                                                  <option>--select--</option>
                                                    @forelse ($templates as $templateE)
                                                       <option value="{{$templateE->id}}">{{$templateE->name}}</option>
                                                   @empty
                                                       <option disabled>not found</option>
                                                   @endforelse
                                                </select></td>

                                        </tr>
                                        @endif
                                        @if ($bureaK == \App\enum\BureauAddressNameEnum::TRANSUNION)
                                        <tr>
                                            {{-- @dd($selectedItemCollDetailsEqFax, count($selectedItemCollDetailsEqFax), $selectedItemOtherDetailsEqFax, count($selectedItemOtherDetailsEqFax)) --}}
                                            <td>{{$bureaK}}- {{count($selectedItemOtherDetailsTrans)+count($selectedItemCollDetailsTrans)}}</td>
                                            <td class="table-dropdown">
                                                <select class="form-control" wire:model="address_selected_transunion">
                                                   <option>--select--</option>
                                                    @forelse ($bureau as $adddresT)
                                                    <option value="{{$adddresT->id}}">{{$adddresT->address}}</option>
                                                    @empty
                                                    <option disabled>not found</option>
                                                    @endforelse
                                                    
                                                </select></td>
                                            <td class="table-dropdown">
                                                <select class="form-control" wire:model="dispute_letter_selected_transunion">
                                                  <option>--select--</option>
                                                    @forelse ($templates as $templateT)
                                                       <option value="{{$templateT->id}}">{{$templateT->name}}</option>
                                                   @empty
                                                       <option disabled>not found</option>
                                                   @endforelse
                                                </select></td>

                                        </tr>
                                        @endif
                                       
                                    @endforeach
                                        

                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary prev-step"
                                wire:click="backToStepOne">Previous</button>
                            <button type="button" class="btn btn-primary next-step"
                                wire:click="goToStepThree">Next</button>
                        </div>
                    @endif



                    @if ($stepThree)
                        <div class="step step-3">
                            <!-- Step 3 form fields here -->
                            <h3>Step 3</h3>
                            <div class="mb-3">
                                <table class="table table-bordered align-middle mt-4">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Recipient </th>
                                            <th>Preview/Edit </th>
                                            <th>Include ID Docs </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($addresss as $bureaK=>$bureau)
                                        @if ($bureaK == \App\enum\BureauAddressNameEnum::EQUIFAX)
                                        
                                        <tr>
                                            {{-- @dd($selectedItemCollDetailsEqFax, count($selectedItemCollDetailsEqFax), $selectedItemOtherDetailsEqFax, count($selectedItemOtherDetailsEqFax)) --}}
                                            <td>{{$bureaK}}- {{count($selectedItemOtherDetailsEqFax)+count($selectedItemCollDetailsEqFax)}}</td>
                                            <td class="table-dropdown">
                                                <a href="javascript:void(0)" wire:click="previewTemplate('{{\App\enum\BureauAddressNameEnum::EQUIFAX}}')">preview/edit</a>
                                            <td>
                                                <input type="checkbox" wire:model="equfax_include_id" id="">
                                                </td>

                                        </tr>
                                        @endif

                                        @if ($bureaK == \App\enum\BureauAddressNameEnum::EXPERIAN)
                                        <tr>
                                            {{-- @dd($selectedItemCollDetailsExprian, count($selectedItemCollDetailsExprian), $selectedItemOtherDetailsExprian, count($selectedItemOtherDetailsExprian)) --}}
                                            <td>{{$bureaK}}- {{count($selectedItemOtherDetailsExprian)+count($selectedItemCollDetailsExprian)}}</td>
                                            <td>
                                                <a href="javascript:void(0)">preview/edit</a>
                                            <td>
                                                <input type="checkbox" wire:model="experion_include_id" id="">
                                            </td>

                                        </tr>
                                        @endif
                                        @if ($bureaK == \App\enum\BureauAddressNameEnum::TRANSUNION)
                                        <tr>
                                            {{-- @dd($selectedItemCollDetailsEqFax, count($selectedItemCollDetailsEqFax), $selectedItemOtherDetailsEqFax, count($selectedItemOtherDetailsEqFax)) --}}
                                            <td>{{$bureaK}}- {{count($selectedItemOtherDetailsTrans)+count($selectedItemCollDetailsTrans)}}</td>
                                            <td >
                                                <a href="javascript:void(0)">preview/edit</a></td>
                                            <td>  <input type="checkbox" wire:model="transunion_include_id" id=""></td>

                                        </tr>
                                        @endif
                                       
                                    @endforeach
                                        

                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary prev-step"
                                wire:click="backToStepTwo">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    @endif
                </form>
            </div>
        @endif
    </div>
   @if ($openModal)
   <div class="modal fade {{$class}}" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Working on this</h5>
          <button type="button" wire:click="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
   @endif
    
</div>
