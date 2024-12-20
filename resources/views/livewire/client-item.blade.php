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
                        <select wire:model="equifax_bureau_status" class="form-control">
                            <option value="">--select--</option>
                            @foreach (\App\enum\BureauStatusEnum::values() as $bureau)
                                <option value="{{ $bureau }}">{{ $bureau }}</option>
                            @endforeach
                            
                        </select>
                        @error('equifax_bureau_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" id="equfax-item_name" placeholder="Enter item name"
                            wire:model="equifax_item_name" wire:keyup="syncItemName(0)">
                        @error('equifax_item_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Type -->
                    <div class="mb-3">
                        <label class="form-label">Item Type:</label>
                        <select class="form-select" id="equfax-item_type" wire:model="equifax_item_type">
                            <option selected>--Please select item type--</option>
                            @foreach (\App\enum\ItemTypeEnum::values() as $itemF)
                                <option value="{{ $itemF }}">{{ $itemF }}</option>
                            @endforeach
                        </select>
                        @error('equifax_item_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-3">
                        <label class="form-label">Account Number:</label>
                        <input type="text" class="form-control" id="equfax-account_no"
                            placeholder="Enter account number" wire:model="equifax_account_no">
                        @error('equifax_account_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Open Date -->
                    <div class="mb-3">
                        <label class="form-label">Open Date:</label>
                        <input type="date" class="form-control" id="equfax-open_date"
                            placeholder="Enter date of last payment" wire:model="equifax_open_date">
                        @error('equifax_open_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-control" id="equfax-status" wire:model="equifax_status">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('equifax_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Internal Notes -->
                    <div class="mb-3">
                        <label class="form-label">Internal Notes:</label>
                        <select id="internalNotes" wire:model="equifax_instruction_id" class="form-control">
                            <option value="">--select--</option>
                            @forelse ($instructions as $instructionE)
                                <option value="{{ $instructionE->id }}">{{ $instructionE->name }}</option>
                            @empty
                                <option value="" disabled>no instruction</option>
                            @endforelse
                        </select>
                        @error('equifax_instruction_id')
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
                        <select wire:model="experian_bureau_status" class="form-control">
                            <option value="">--select--</option>
                            @foreach (\App\enum\BureauStatusEnum::values() as $bureau)
                            <option value="{{ $bureau }}">{{ $bureau }}</option>
                        @endforeach
                        </select>
                        @error('experian_bureau_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" id="experian-item_name" placeholder="Enter item name"
                            wire:model="experian_item_name">
                        @error('experian_item_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Type -->
                    <div class="mb-3">
                        <label class="form-label">Item Type:</label>
                        <select class="form-select" id="experian-item_type" wire:model="experian_item_type">
                            <option value="">--Please select item type--</option>
                            @foreach (\App\enum\ItemTypeEnum::values() as $itemS)
                                <option value="{{ $itemS }}">{{ $itemS }}</option>
                            @endforeach
                        </select>
                        @error('experian_item_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-3">
                        <label class="form-label">Account Number:</label>
                        <input type="text" class="form-control" id="experian-account_no"
                            placeholder="Enter account number" wire:model="experian_account_no">
                        @error('experian_account_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Open Date -->
                    <div class="mb-3">
                        <label class="form-label">Open Date:</label>
                        <input type="date" class="form-control" id="experian-open_date"
                            wire:model="experian_open_date">
                        @error('experian_open_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-control" id="experian-status" wire:model="experian_status">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('experian_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Internal Notes -->
                    <div class="mb-3">
                        <label class="form-label">Internal Notes:</label>
                        <select id="internalNotes" wire:model="experian_instruction_id" class="form-control">
                            <option value="">--select--</option>
                            @forelse ($instructions as $instructionEP)
                                <option value="{{ $instructionEP->id }}">{{ $instructionEP->name }}</option>
                            @empty
                                <option value="" disabled>no instruction</option>
                            @endforelse
                        </select>
                        @error('experian_instruction_id')
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
                    <div class="d-flex">
                        <select wire:model="transunion_bureau_status" class="form-control">
                            <option value="">--select--</option>
                            @foreach (\App\enum\BureauStatusEnum::values() as $bureau)
                            <option value="{{ $bureau }}">{{ $bureau }}</option>
                        @endforeach
                        </select>
                        @error('transunion_bureau_status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" id="transunion-item_name"
                            placeholder="Enter item name" wire:model="transunion_item_name">
                        @error('transunion_item_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Item Type -->
                    <div class="mb-3">
                        <label class="form-label">Item Type:</label>
                        <select class="form-select" id="transunion-item_name"
                            wire:model="transunion_item_type">
                            <option selected>--Please select item type--</option>
                            @foreach (\App\enum\ItemTypeEnum::values() as $itemT)
                                <option value="{{ $itemT }}">{{ $itemT }}</option>
                            @endforeach
                        </select>
                        @error('transunion_item_type')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-3">
                        <label class="form-label">Account Number:</label>
                        <input type="text" class="form-control" id="transunion-account_no"
                            placeholder="Enter account number" wire:model="transunion_account_no">
                        @error('transunion_account_no')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Open Date -->
                    <div class="mb-3">
                        <label class="form-label">Open Date:</label>
                        <input type="date" class="form-control" id="transunion-open_date"
                            placeholder="Enter date of last payment" wire:model="transunion_open_date">
                        @error('transunion_open_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-control" id="transunion-status" wire:model="transunion_status">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('transunion_status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Internal Notes -->
                    <div class="mb-3">
                        <label class="form-label">Internal Notes:</label>
                        <select id="internalNotes" wire:model="transunion_instruction_id"
                            class="form-control">
                            <option value="">--select--</option>
                            @forelse ($instructions as $instructionT)
                                <option value="{{ $instructionT->id }}">{{ $instructionT->name }}</option>
                            @empty
                                <option value="" disabled>no instruction</option>
                            @endforelse
                        </select>
                        @error('transunion_instruction_id')
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

