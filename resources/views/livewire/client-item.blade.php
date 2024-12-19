<div class="card-body">

    <h5 class="card-title">Client Items</h5>
    <u>
        <a href="javascript:void(0)" wire:click="toggleForm">
            <span id="add-hide-btn">{{ $formVisible ? 'Hide Item Form' : 'Add Item Form' }}</span>
        </a>
    </u>
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
                        <select wire:model="form.equifax.0.bureau_status" class="form-control">
                            <option value="">--select--</option>
                            <option value="Negative">Negative</option>
                            <option value="Deleted">Deleted</option>
                            <option value="Not reported">Not reported</option>
                            <option value="do not process">Do not process</option>
                        </select>
                        @error('form.equifax.0.bureau_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" id="equfax-item_name" placeholder="Enter item name"
                            wire:model="form.equifax.0.item_name" wire:keyup="syncItemName(0)">
                        @error('form.equifax.0.item_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Type -->
                    <div class="mb-3">
                        <label class="form-label">Item Type:</label>
                        <select class="form-select" id="equfax-item_type" wire:model="form.equifax.0.item_type">
                            <option selected>--Please select item type--</option>
                            @foreach (\App\enum\ItemTypeEnum::values() as $itemF)
                                <option value="{{ $itemF }}">{{ $itemF }}</option>
                            @endforeach
                        </select>
                        @error('form.equifax.0.item_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-3">
                        <label class="form-label">Account Number:</label>
                        <input type="text" class="form-control" id="equfax-account_no"
                            placeholder="Enter account number" wire:model="form.equifax.0.account_no">
                        @error('form.equifax.0.account_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Open Date -->
                    <div class="mb-3">
                        <label class="form-label">Open Date:</label>
                        <input type="date" class="form-control" id="equfax-open_date"
                            placeholder="Enter date of last payment" wire:model="form.equifax.0.open_date">
                        @error('form.equifax.0.open_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-control" id="equfax-status" wire:model="form.equifax.0.status">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('form.equifax.0.status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Internal Notes -->
                    <div class="mb-3">
                        <label class="form-label">Internal Notes:</label>
                        <select id="internalNotes" wire:model="form.equifax.0.instruction_id" class="form-control">
                            <option value="">--select--</option>
                            @forelse ($instructions as $instructionE)
                                <option value="{{ $instructionE->id }}">{{ $instructionE->name }}</option>
                            @empty
                                <option value="" disabled>no instruction</option>
                            @endforelse
                        </select>
                        @error('form.equifax.0.instruction_id')
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
                        <select wire:model="form.experian.1.bureau_status" class="form-control">
                            <option value="">--select--</option>
                            <option value="Negative">Negative</option>
                            <option value="Deleted">Deleted</option>
                            <option value="Not reported">Not reported</option>
                            <option value="do not process">Do not process</option>
                        </select>
                        @error('form.experian.1.bureau_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" id="experian-item_name" placeholder="Enter item name"
                            wire:model="form.experian.1.item_name">
                        @error('form.experian.1.item_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Type -->
                    <div class="mb-3">
                        <label class="form-label">Item Type:</label>
                        <select class="form-select" id="experian-item_type" wire:model="form.experian.1.item_type">
                            <option value="">--Please select item type--</option>
                            @foreach (\App\enum\ItemTypeEnum::values() as $itemS)
                                <option value="{{ $itemS }}">{{ $itemS }}</option>
                            @endforeach
                        </select>
                        @error('form.experian.1.item_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-3">
                        <label class="form-label">Account Number:</label>
                        <input type="text" class="form-control" id="experian-account_no"
                            placeholder="Enter account number" wire:model="form.experian.1.account_no">
                        @error('form.experian.1.account_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Open Date -->
                    <div class="mb-3">
                        <label class="form-label">Open Date:</label>
                        <input type="date" class="form-control" id="experian-open_date"
                            wire:model="form.experian.1.open_date">
                        @error('form.experian.1.open_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-control" id="experian-status" wire:model="form.experian.1.status">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('form.experian.1.status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Internal Notes -->
                    <div class="mb-3">
                        <label class="form-label">Internal Notes:</label>
                        <select id="internalNotes" wire:model="form.experian.1.instruction_id" class="form-control">
                            <option value="">--select--</option>
                            @forelse ($instructions as $instructionEP)
                                <option value="{{ $instructionEP->id }}">{{ $instructionEP->name }}</option>
                            @empty
                                <option value="" disabled>no instruction</option>
                            @endforelse
                        </select>
                        @error('form.experian.1.instruction_id')
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
                        <select wire:model="form.transunion.2.bureau_status" class="form-control">
                            <option value="">--select--</option>
                            <option value="Negative">Negative</option>
                            <option value="Deleted">Deleted</option>
                            <option value="Not reported">Not reported</option>
                            <option value="do not process">Do not process</option>
                        </select>
                        @error('form.transunion.2.bureau_status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" id="transunion-item_name"
                            placeholder="Enter item name" wire:model="form.transunion.2.item_name">
                        @error('form.transunion.2.item_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Item Type -->
                    <div class="mb-3">
                        <label class="form-label">Item Type:</label>
                        <select class="form-select" id="transunion-item_name"
                            wire:model="form.transunion.2.item_type">
                            <option selected>--Please select item type--</option>
                            @foreach (\App\enum\ItemTypeEnum::values() as $itemT)
                                <option value="{{ $itemT }}">{{ $itemT }}</option>
                            @endforeach
                        </select>
                        @error('form.transunion.2.item_type')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-3">
                        <label class="form-label">Account Number:</label>
                        <input type="text" class="form-control" id="transunion-account_no"
                            placeholder="Enter account number" wire:model="form.transunion.2.account_no">
                        @error('form.transunion.2.account_no')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Open Date -->
                    <div class="mb-3">
                        <label class="form-label">Open Date:</label>
                        <input type="date" class="form-control" id="transunion-open_date"
                            placeholder="Enter date of last payment" wire:model="form.transunion.2.open_date">
                        @error('form.transunion.2.open_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select class="form-control" id="transunion-status" wire:model="form.transunion.2.status">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('form.transunion.2.status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Internal Notes -->
                    <div class="mb-3">
                        <label class="form-label">Internal Notes:</label>
                        <select id="internalNotes" wire:model="form.transunion.2.instruction_id"
                            class="form-control">
                            <option value="">--select--</option>
                            @forelse ($instructions as $instructionT)
                                <option value="{{ $instructionT->id }}">{{ $instructionT->name }}</option>
                            @empty
                                <option value="" disabled>no instruction</option>
                            @endforelse
                        </select>
                        @error('form.transunion.2.instruction_id')
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

