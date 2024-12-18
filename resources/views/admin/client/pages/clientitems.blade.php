@extends('admin.client.edit')
@section('clientcontent')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Client Items</h5>
            <form id="dataForm" method="POST" action="">
                <div class="row">
                    <!-- Equifax Section -->
                    <div class="col-4">
                        <div class="d-flex align-items-center mb-3">
                            <!-- Title and Image Side by Side -->
                            <h6 class="mb-0"><b>Equifax</b></h6>
                            <img src="{{ asset('assets/equfax.png') }}" alt="Equifax Logo" class="ms-3"
                                style="width: 100px; height: 60px; object-fit: cover;">
                        </div>
                        <select name="type" class="form-control">
                            <option value="">--select--</option>
                            <option value="">Negative</option>
                            <option value="">Deleted</option>
                            <option value="">Not reported</option>
                            <option value="">do not process</option>
                        </select>
                        <div class="mb-3">
                            <label class="form-label">Item Name:</label>
                            <input type="text" class="form-control" id="itemNameEquifax" placeholder="Enter item name">
                            <div class="form-check">
                                {{-- <input class="form-check-input" type="checkbox" id="sameItemNameEquifax">
                                <label class="form-check-label" for="sameItemNameEquifax">Same Item Name</label> --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Item Type:</label>
                            <select class="form-select" id="itemTypeEquifax">
                                <option selected>--Please select item type--</option>
                                @foreach (\App\enum\ItemTypeEnum::values() as $itemF)
                                <option value="{{$itemF}}">{{$itemF}}</option>
                                @endforeach
                            </select>
                            <div class="form-check">
                                {{-- <input class="form-check-input" type="checkbox" id="sameItemTypeEquifax">
                                <label class="form-check-label" for="sameItemTypeEquifax">Same Item Type</label> --}}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Account Number:</label>
                            <input type="text" class="form-control" id="accountNumber"
                                placeholder="Enter account number">
                            <div class="form-check">
                                {{-- <input class="form-check-input" type="checkbox" id="sameItemNameEquifax">
                                    <label class="form-check-label" for="sameItemNameEquifax">Same Item Name</label> --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Open Date:</label>
                            <input type="text" class="form-control" id="dateLastPayment"
                                placeholder="Enter date of last payment">
                            <div class="form-check">
                                {{-- <input class="form-check-input" type="checkbox" id="sameItemNameEquifax">
                                    <label class="form-check-label" for="sameItemNameEquifax">Same Item Name</label> --}}
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status:</label>
                            <select class="form-control" id="status">
                                <option value="">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="form-check">
                                {{-- <input class="form-check-input" type="checkbox" id="sameItemNameEquifax">
                                <label class="form-check-label" for="sameItemNameEquifax">Same Item Name</label> --}}
                            </div>
                        </div>


                        <!-- Internal Notes -->
                        <div class="mb-3">
                            <label class="form-label">Internal Notes:</label>
                            <textarea class="form-control" id="internalNotes" rows="3" placeholder="Enter internal notes"></textarea>
                            <div class="form-check">
                                {{-- <input class="form-check-input" type="checkbox" id="sameItemNameEquifax">
                                <label class="form-check-label" for="sameItemNameEquifax">Same Item Name</label> --}}
                            </div>
                        </div>

                        <!-- Add more fields with checkboxes as needed -->
                    </div>

                    <!-- Experian Section -->
                    <div class="col-4">
                        <div class="d-flex align-items-center mb-3">
                            <h6><b>Experian</b></h6>
                            <img src="{{ asset('assets/experian.png') }}" alt="Equifax Logo"
                                style="width: 100px; height: 60px; object-fit: cover;">
                        </div>


                        <select name="" class="form-control">
                            <option value="">--select--</option>
                            <option value="">Negative</option>
                            <option value="">Deleted</option>
                            <option value="">Not reported</option>
                            <option value="">do not process</option>
                        </select>
                        <div class="mb-3">
                            <label class="form-label">Item Name:</label>
                            <input type="text" class="form-control" id="itemNameExperian" placeholder="Enter item name">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemNameExperian">
                                <label class="form-check-label" for="sameItemNameExperian">Same Item Name</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Item Type:</label>
                            <select class="form-select" id="itemTypeExperian">
                                <option selected>--Please select item type--</option>
                                @foreach (\App\enum\ItemTypeEnum::values() as $itemS)
                                <option value="{{$itemS}}">{{$itemS}}</option>
                                @endforeach
                            </select>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeExperian">
                                <label class="form-check-label" for="sameItemTypeExperian">Same Item Type</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Number:</label>
                            <input type="text" class="form-control" id="accountNumber"
                                placeholder="Enter account number">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Open Date:</label>
                            <input type="text" class="form-control" id="dateLastPayment"
                                placeholder="Enter date of last payment">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status:</label>
                            <select class="form-control" id="status">
                                <option value="">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>


                        <!-- Internal Notes -->
                        <div class="mb-3">
                            <label class="form-label">Internal Notes:</label>
                            <textarea class="form-control" id="internalNotes" rows="3" placeholder="Enter internal notes"></textarea>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>
                        <!-- Add more fields with checkboxes as needed -->
                    </div>

                    <!-- TransUnion Section -->
                    <div class="col-4">
                        <div class="d-flex align-items-center mb-3">
                            <h6><b>TransUnion</b></h6>
                            <img src="{{ asset('assets/transunion.png') }}" alt="Equifax Logo"
                                style="width: 195px; height: 60px; object-fit: cover;">
                        </div>

                        <div class="d-flex">
                            <select name="" class="form-control">
                                <option value="">--select--</option>
                                <option value="">Negative</option>
                                <option value="">Deleted</option>
                                <option value="">Not reported</option>
                                <option value="">do not process</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Item Name:</label>
                            <input type="text" class="form-control" id="itemNameTransUnion"
                                placeholder="Enter item name">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemNameTransUnion">
                                <label class="form-check-label" for="sameItemNameTransUnion">Same Item Name</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Item Type:</label>
                            <select class="form-select" id="itemTypeTransUnion">
                                <option selected>--Please select item type--</option>
                                @foreach (\App\enum\ItemTypeEnum::values() as $itemT)
                                <option value="{{$itemT}}">{{$itemT}}</option>
                                @endforeach
                            </select>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Number:</label>
                            <input type="text" class="form-control" id="accountNumber"
                                placeholder="Enter account number">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Open Date:</label>
                            <input type="text" class="form-control" id="dateLastPayment"
                                placeholder="Enter date of last payment">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status:</label>
                            <select class="form-control" id="status">
                                <option value="">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>


                        <!-- Internal Notes -->
                        <div class="mb-3">
                            <label class="form-label">Internal Notes:</label>
                            <textarea class="form-control" id="internalNotes" rows="3" placeholder="Enter internal notes"></textarea>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameItemTypeTransUnion">
                                <label class="form-check-label" for="sameItemTypeTransUnion">Same Item Type</label>
                            </div>
                        </div>
                        <!-- Add more fields with checkboxes as needed -->
                    </div>
                </div>

                <!-- Buttons -->
                <div class="form-group row mt-3">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-success" id="submitBtn">Save and Add New</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
       

        // document.addEventListener('DOMContentLoaded', function() {
        //     function handleFormSubmission() {
        //         const submitBtn = document.getElementById('submitBtn');
        //         const form = document.querySelector('#client-documents-store');
        //         const formData = new FormData(form);
        //         submitBtn.innerHTML =
        //             '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        //         submitBtn.disabled = true;
        //         const formAction = form.action;

        //         fetch(formAction, {
        //                 method: "POST",
        //                 headers: {
        //                     "X-CSRF-TOKEN": "{{ csrf_token() }}",
        //                     "Accept": "application/json"
        //                 },
        //                 body: formData
        //             })
        //             .then(response => {
        //                 if (!response.ok) {
        //                     return response.json().then(data => {
        //                         throw data;
        //                     });
        //                 }
        //                 return response.json(); // Handle success response
        //             })
        //             .then(data => {
        //                 if (data.status === 'success') {
        //                     swal(data.msg, "", "success")
        //                         .then(() => {
        //                             // window.location.href = data.toUrl;
        //                             submitBtn.innerHTML = 'Submit';
        //                             submitBtn.disabled = false;
        //                         });
        //                 } else {
        //                     swal("Error creating expenditure. Please try again.", "", "error");
        //                     submitBtn.innerHTML = 'Submit';
        //                     submitBtn.disabled = false;
        //                 }
        //             })
        //             .catch(error => {
        //                 if (error.errors) {
        //                     // Clear previous error messages before adding new ones
        //                     document.querySelectorAll('.text-danger').forEach(element => {
        //                         element.remove();
        //                     });

        //                     // Display validation errors next to the respective fields
        //                     for (const [key, messages] of Object.entries(error.errors)) {
        //                         const inputElement = document.querySelector(`[name="${key}"]`);
        //                         if (inputElement) {
        //                             // Only create and append new error messages if they don't exist already
        //                             let errorElement = inputElement.parentElement.querySelector('.text-danger');
        //                             if (!errorElement) {
        //                                 errorElement = document.createElement('span');
        //                                 errorElement.classList.add('text-danger');
        //                                 inputElement.parentElement.appendChild(errorElement);
        //                             }

        //                             errorElement.innerHTML = `<strong>${messages.join(' ')}</strong>`;
        //                         }
        //                     }
        //                 } else {
        //                     swal("Some error occurred. Please try again.", "", "error");
        //                 }

        //                 // Re-enable the submit button
        //                 submitBtn.innerHTML = 'Submit';
        //                 submitBtn.disabled = false;
        //             });
        //     }

        //     // Attach the submit handler to the form submit
        //     const form = document.querySelector('#client-documents-store');
        //     form.addEventListener('submit', function(event) {
        //         event.preventDefault();
        //         handleFormSubmission();
        //     });
        // })
    </script>
@endsection
