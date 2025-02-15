<div>
    <div class="card">
        <div class="card-body">
    
            <div class="d-flex align-items-center mb-3 justify-content-between">
                <h5 class="card-title">{{$clientDetails?->first_name . ' '.$clientDetails?->middle_name.' '.$clientDetails?->last_name."'s"}} Letters</h5>
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
                                                <th>
                                                    <select class="form-control" wire:model="dispute_letter_selected_master" wire:change="syncTemplate">
                                                        <option value="">SELECT TEMPLATE</option>
                                                          @forelse ($templates as $template)
                                                             <option value="{{$template->id}}">{{$template->name}}</option>
                                                         @empty
                                                             <option disabled>not found</option>
                                                         @endforelse
                                                      </select></td>
                                                </th>
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
                                                      <option value="">--select--</option>
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
                                                      <option value="">--select--</option>
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
                                                      <option value="">--select--</option>
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
                                @if (Session::has('validation'))
                                    <p id="alert-msg" class="alert alert-danger">{{ Session::get('validation') }}</p>
                                @endif
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
                                                <th>Include ID Docs <input type="checkbox" wire:model="master_include_id" wire:change="syncIncludeId"></th>
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
                                                    <input type="checkbox" wire:model="equfax_include_id" id="" >
                                                    </td>
    
                                            </tr>
                                            @endif
    
                                            @if ($bureaK == \App\enum\BureauAddressNameEnum::EXPERIAN)
                                            <tr>
                                                {{-- @dd($selectedItemCollDetailsExprian, count($selectedItemCollDetailsExprian), $selectedItemOtherDetailsExprian, count($selectedItemOtherDetailsExprian)) --}}
                                                <td>{{$bureaK}}- {{count($selectedItemOtherDetailsExprian)+count($selectedItemCollDetailsExprian)}}</td>
                                                <td>
                                                    <a href="javascript:void(0)" wire:click="previewTemplate('{{\App\enum\BureauAddressNameEnum::EXPERIAN}}')">preview/edit</a>
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
                                                    <a href="javascript:void(0)" wire:click="previewTemplate('{{\App\enum\BureauAddressNameEnum::TRANSUNION}}')">preview/edit</a></td>
                                                <td>  <input type="checkbox" wire:model="transunion_include_id" id=""></td>
    
                                            </tr>
                                            @endif
                                           
                                        @endforeach
                                            
    
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-primary prev-step"
                                    wire:click="backToStepTwo">Previous</button>
                                <button type="button" class="btn btn-success" wire:click="saveLater">Submit</button>
                            </div>
                        @endif
                    </form>
                </div>
            @endif
        </div>
       @if ($openModal)
       <div class="modal fade {{$class}}" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog" style="display: block;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Preview and edit</h5>
              <button type="button" wire:click="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <div>
                <textarea id="modal-summernote" class="form-control"  cols="30" rows="10"></textarea>
             </div>
            </div>
            <div class="modal-footer">
              <button  id="save-button" type="button" class="btn btn-primary" wire:click="updateBody">Save</button>
            </div>
          </div>
        </div>
      </div>
       @endif
        
    
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 justify-content-between">
                        {{-- <h5 class="card-title">Items List</h5> --}}
                        @if (Session::has('msg'))
                            <p id="alert-msg" class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                       
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Recepient</th>
                                <th scope="col">Items</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Generated By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($laterLists as $key=>$laterList)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                       {{$laterList?->bureau_name}}
                                    </td>
                                    
                                    <td>{{ $laterList?->laterItemDetails->count()}}</td>
                                    <td> {{ \Carbon\Carbon::parse($laterList?->created_at)->isoFormat('Do MMMM YYYY') }}</td>
                                    <td>Admin</td>
                                    <td>
                                        {{-- <a href="javascript:void(0)" wire:click="editLater('{{ $laterList->slug }}')"><i
                                                class="ri-pencil-fill"></i></a> --}}
                                                <a target="_blank" href="{{asset('storage'. $laterList?->body_pdf)}}" ><i
                                                class="ri-eye-fill"></i></a>
                                                <a href="javascript:void(0)" 
                                                    onclick="if(confirm('Are you sure you want to delete this?')) @this.call('deleteLater', '{{ $laterList->slug }}')"> 
                                                    <i class="ri-delete-bin-2-fill"></i>
                                                    </a>
                                        
                                    </td>
                                </tr>
                            @endforeach
        
                        </tbody>
        
                    </table>
                    {{-- {{ $clients->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>


@script
<script>
    $wire.on('modalOpened', () => {
        setTimeout(() => {
            $('#modal-summernote').summernote({
                placeholder: 'Type your content here...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            const content = @this.get('bureauBody');
            console.log('Content:', content);
            $('#modal-summernote').summernote('code', content);
            $('#save-button').on('click', function () {
                const updatedContent = $('#modal-summernote').summernote('code');
                @this.set('bureauBody', updatedContent);
                console.log('Updated content sent to Livewire:', updatedContent);
            });

            console.log('Summernote initialized with content.');
        }, 200);
    });
    
</script>
@endscript

