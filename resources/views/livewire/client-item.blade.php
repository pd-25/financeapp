<div>
    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center mb-3 justify-content-between">
                <h5 class="card-title">Client Items</h5>
                @if (Session::has('msg'))
                    <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
                @endif
                <a href="javascript:void(0)" wire:click="toggleForm">
                    <u> <span id="add-hide-btn">{{ $formVisible ? 'Hide Item Form' : 'Add Item Form' }}</span></u>
                </a>
            </div>

            @if ($formVisible)
                <form wire:submit.prevent="save" id="dataForm">
                    <div class="row">
                        <div class="col-10">
                            <div class="mb-3">
                                <label class="form-label">Item Type:</label>
                                <select class="form-select" id="equfax-item_type" wire:model="item_type">
                                    <option selected>--Please select item type--</option>
                                    @foreach (\App\enum\ItemTypeEnum::values() as $itemF)
                                        <option value="{{ $itemF }}">{{ $itemF }}</option>
                                    @endforeach
                                </select>
                                @error('item_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Equifax Section -->
                        <div class="col-4">
                            <div class="d-flex align-items-center mb-3">
                                <!-- Title and Image Side by Side -->
                                <h6 class="mb-0"><b>Equifax</b></h6>
                                <img src="{{ asset('assets/equfax.png') }}" alt="Equifax Logo" class="ms-3"
                                    style="width: 100px; height: 60px; object-fit: cover;">
                            </div>

                            <!-- Bureau Status -->
                            <div class="mb-3">
                                <label class="form-label">Bureau Status:</label>
                                <select wire:model="Equifax_bureau_status" class="form-control" wire:change="syncBureauStatus">
                                    <option value="">--select--</option>
                                    @foreach (\App\enum\BureauStatusEnum::values() as $bureau)
                                        <option value="{{ $bureau }}">{{ $bureau }}</option>
                                    @endforeach

                                </select>
                                @error('Equifax_bureau_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Name -->
                            <div class="mb-3">
                                <label class="form-label">Item Name:</label>
                                <input type="text" class="form-control" id="equfax-item_name"
                                    placeholder="Enter item name" wire:model="Equifax_item_name"
                                    wire:keyup="syncItemName">
                                @error('Equifax_item_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Type -->
                            {{-- <div class="mb-3">
                                <label class="form-label">Item Type:</label>
                                <select class="form-select" id="equfax-item_type" wire:model="Equifax_item_type">
                                    <option selected>--Please select item type--</option>
                                    @foreach (\App\enum\ItemTypeEnum::values() as $itemF)
                                        <option value="{{ $itemF }}">{{ $itemF }}</option>
                                    @endforeach
                                </select>
                                @error('Equifax_item_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            <!-- Account Number -->
                            <div class="mb-3">
                                <label class="form-label">Account Number:</label>
                                <input type="text" class="form-control" id="equfax-account_no"
                                    placeholder="Enter account number" wire:model="Equifax_account_no" wire:keyup="syncAccountNo">
                                @error('Equifax_account_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Open Date -->
                            <div class="mb-3">
                                <label class="form-label">Open Date:</label>
                                <input type="date" class="form-control" id="equfax-open_date"
                                    placeholder="Enter date of last payment" wire:model="Equifax_open_date" wire:change="syncOpenDate">
                                @error('Equifax_open_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status:</label>
                                <select class="form-control" id="equfax-status" wire:model="Equifax_status" wire:change="syncStatus">
                                    <option value="">Select status</option>
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>
                                @error('Equifax_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Instructions -->
                            <div class="mb-3">
                                <label class="form-label">Instructions:</label>
                                <select id="internalNotes" wire:model="Equifax_instruction_id" class="form-control" wire:change="syncInstruction">
                                    <option value="">--select--</option>
                                    @forelse ($instructions as $instructionE)
                                        <option value="{{ $instructionE->id }}">{{ $instructionE->name }}</option>
                                    @empty
                                        <option value="" disabled>no instruction</option>
                                    @endforelse
                                </select>
                                @error('Equifax_instruction_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <!-- Experian Section -->
                        <div class="col-4">
                            <div class="d-flex align-items-center mb-3">
                                <h6><b>Experian</b></h6>
                                <img src="{{ asset('assets/experian.png') }}" alt="Experian Logo"
                                    style="width: 100px; height: 60px; object-fit: cover;">
                            </div>

                            <!-- Bureau Status -->
                            <div class="mb-3">
                                <label class="form-label">Bureau Status:</label>
                                <select wire:model="Experian_bureau_status" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach (\App\enum\BureauStatusEnum::values() as $bureau)
                                        <option value="{{ $bureau }}">{{ $bureau }}</option>
                                    @endforeach
                                </select>
                                @error('Experian_bureau_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Name -->
                            <div class="mb-3">
                                <label class="form-label">Item Name:</label>
                                <input type="text" class="form-control" id="experian-item_name"
                                    placeholder="Enter item name" wire:model="Experian_item_name">
                                @error('Experian_item_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Type -->
                            {{-- <div class="mb-3">
                                <label class="form-label">Item Type:</label>
                                <select class="form-select" id="Experian-item_type" wire:model="Experian_item_type">
                                    <option value="">--Please select item type--</option>
                                    @foreach (\App\enum\ItemTypeEnum::values() as $itemS)
                                        <option value="{{ $itemS }}">{{ $itemS }}</option>
                                    @endforeach
                                </select>
                                @error('Experian_item_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            <!-- Account Number -->
                            <div class="mb-3">
                                <label class="form-label">Account Number:</label>
                                <input type="text" class="form-control" id="Experian-account_no"
                                    placeholder="Enter account number" wire:model="Experian_account_no">
                                @error('Experian_account_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Open Date -->
                            <div class="mb-3">
                                <label class="form-label">Open Date:</label>
                                <input type="date" class="form-control" id="Experian-open_date"
                                    wire:model="Experian_open_date">
                                @error('Experian_open_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status:</label>
                                <select class="form-control" id="Experian-status" wire:model="Experian_status">
                                    <option value="">Select status</option>
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>
                                @error('Experian_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Instructions -->
                            <div class="mb-3">
                                <label class="form-label">Instructions:</label>
                                <select id="internalNotes" wire:model="Experian_instruction_id" class="form-control">
                                    <option value="">--select--</option>
                                    @forelse ($instructions as $instructionEP)
                                        <option value="{{ $instructionEP->id }}">{{ $instructionEP->name }}</option>
                                    @empty
                                        <option value="" disabled>no instruction</option>
                                    @endforelse
                                </select>
                                @error('Experian_instruction_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <!-- TransUnion Section -->
                        <div class="col-4">
                            <div class="d-flex align-items-center mb-3">
                                <h6><b>TransUnion</b></h6>
                                <img src="{{ asset('assets/transunion.png') }}" alt="TransUnion Logo"
                                    style="width: 195px; height: 60px; object-fit: cover;">
                            </div>

                            <!-- Bureau Status -->
                            <div class="mb-3">
                                <label class="form-label">Bureau Status:</label>
                                <select wire:model="Transunion_bureau_status" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach (\App\enum\BureauStatusEnum::values() as $bureau)
                                        <option value="{{ $bureau }}">{{ $bureau }}</option>
                                    @endforeach
                                </select>
                                @error('Transunion_bureau_status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Item Name -->
                            <div class="mb-3">
                                <label class="form-label">Item Name:</label>
                                <input type="text" class="form-control" id="transunion-item_name"
                                    placeholder="Enter item name" wire:model="Transunion_item_name">
                                @error('Transunion_item_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Item Type -->
                            {{-- <div class="mb-3">
                                <label class="form-label">Item Type:</label>
                                <select class="form-select" id="transunion-item_name" wire:model="Transunion_item_type">
                                    <option selected>--Please select item type--</option>
                                    @foreach (\App\enum\ItemTypeEnum::values() as $itemT)
                                        <option value="{{ $itemT }}">{{ $itemT }}</option>
                                    @endforeach
                                </select>
                                @error('Transunion_item_type')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Account Number -->
                            <div class="mb-3">
                                <label class="form-label">Account Number:</label>
                                <input type="text" class="form-control" id="transunion-account_no"
                                    placeholder="Enter account number" wire:model="Transunion_account_no">
                                @error('Transunion_account_no')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Open Date -->
                            <div class="mb-3">
                                <label class="form-label">Open Date:</label>
                                <input type="date" class="form-control" id="transunion-open_date"
                                    placeholder="Enter date of last payment" wire:model="Transunion_open_date">
                                @error('Transunion_open_date')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status:</label>
                                <select class="form-control" id="transunion-status" wire:model="Transunion_status">
                                    <option value="">Select status</option>
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>
                                @error('Transunion_status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instructions -->
                            <div class="mb-3">
                                <label class="form-label">Instructions:</label>
                                <select id="internalNotes" wire:model="Transunion_instruction_id"
                                    class="form-control">
                                    <option value="">--select--</option>
                                    @forelse ($instructions as $instructionT)
                                        <option value="{{ $instructionT->id }}">{{ $instructionT->name }}</option>
                                    @empty
                                        <option value="" disabled>no instruction</option>
                                    @endforelse
                                </select>
                                @error('Transunion_instruction_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="form-group row mt-3">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-success" id="submitBtn">Save and Add New</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 justify-content-between">
                        <h5 class="card-title">Items List</h5>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemlists as $key => $itemlist)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <a href="javascript:void(0)" wire:click="editItem('{{ $itemlist->slug }}')">
                                            {{ $itemlist?->itemDetails?->first()->item_name }}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                style="height: 19px;" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                            </svg>
                                        </a><br>
                                        <b>AC No. </b>{{ $itemlist?->itemDetails?->first()->account_no }} <br>
                                        {{ \Carbon\Carbon::parse($itemlist?->created_at)->isoFormat('Do MMMM YYYY') }}

                                    </td>

                                    {{-- <td> --}}
                                    {{-- <div class="d-flex align-items-center mb-3"> --}}
                                    @foreach ($itemlist->itemDetails as $detail)
                                        @if ($detail->bureau_name == \App\enum\BureauAddressNameEnum::EQUIFAX)
                                            <td>
                                                <img src="{{ asset('assets/equfax.png') }}" alt="Equifax Logo"
                                                    class="ms-3"
                                                    style="width: 100px; height: 60px; object-fit: cover;">
                                                    <button wire:click="editItem('{{ $itemlist->slug }}')" class="{{getBaruaeStatus($detail->bureau_status)}}">{{$detail->bureau_status}}</button>
                                            </td>
                                        @elseif ($detail->bureau_name == \App\enum\BureauAddressNameEnum::EXPERIAN)
                                            <td><img src="{{ asset('assets/experian.png') }}" alt="Experian Logo"
                                                    class="ms-3"
                                                    style="width: 100px; height: 60px; object-fit: cover;">
                                                    <button wire:click="editItem('{{ $itemlist->slug }}')" class="{{getBaruaeStatus($detail->bureau_status)}}">{{$detail->bureau_status}}</button>
                                                </td>
                                                    
                                        @elseif ($detail->bureau_name == \App\enum\BureauAddressNameEnum::TRANSUNION)
                                            <td> <img src="{{ asset('assets/transunion.png') }}"
                                                    alt="TransUnion Logo" class="ms-3"
                                                    style="width: 200px; height: 60px; object-fit: cover;">
                                                    <button wire:click="editItem('{{ $itemlist->slug }}')" class="{{getBaruaeStatus($detail->bureau_status)}}">{{$detail->bureau_status}}</button>
                                                </td>
                                        @endif
                                    @endforeach

                                    {{-- </div> --}}
                                    {{-- </td> --}}

                                    <td>
                                        <a href="javascript:void(0)"
                                            wire:click="editItem('{{ $itemlist->slug }}')"><i
                                                class="ri-pencil-fill"></i></a>
                                        {{-- <form method="POST" action="{{ route('clients.destroy', $itemlist?->slug) }}"
                                            class="d-inline-block pl-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-icon show_confirm"
                                                data-toggle="tooltip" title='Delete'>
        
                                                <i class="ri-delete-bin-2-fill"></i>
        
                                            </button>
                                        </form> --}}
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
{{-- <script>
    document.addEventListener('livewire:load', function () {
        const equfaxItemName = document.querySelector("#equfax-item_name");
        const experianItemName = document.querySelector("#experian-item_name");

        if (equfaxItemName && experianItemName) {
            equfaxItemName.addEventListener("input", function() {
                experianItemName.value = this.value;
            });
        }

        const equfaxItemType = document.querySelector("#equfax-item_type");
        const experianItemType = document.querySelector("#experian-item_type");

        if (equfaxItemType && experianItemType) {
            equfaxItemType.addEventListener("change", function() {
                experianItemType.value = this.value;
            });
        }

        const equfaxAccountNo = document.querySelector("#equfax-account_no");
        const experianAccountNo = document.querySelector("#experian-account_no");

        if (equfaxAccountNo && experianAccountNo) {
            equfaxAccountNo.addEventListener("input", function() {
                experianAccountNo.value = this.value;
            });
        }

        const equfaxOpenDate = document.querySelector("#equfax-open_date");
        const experianOpenDate = document.querySelector("#experian-open_date");

        if (equfaxOpenDate && experianOpenDate) {
            equfaxOpenDate.addEventListener("input", function() {
                experianOpenDate.value = this.value;
            });
        }

        const equfaxStatus = document.querySelector("#equfax-status");
        const experianStatus = document.querySelector("#experian-status");

        if (equfaxStatus && experianStatus) {
            equfaxStatus.addEventListener("change", function() {
                experianStatus.value = this.value;
            });
        }
    });

    // Reattach event listeners on Livewire updates
    document.addEventListener('livewire:update', function () {
        // Repeat the above logic to ensure listeners are re-attached after DOM updates
    });
</script> --}}
