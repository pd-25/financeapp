@extends('admin.client.edit')
@section('clientcontent')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Client Items</h5>
            <form id="dataForm" method="POST" action="">
                    <!-- Dropdown to select item type -->
                    <div id="itemTypeSection" class="mb-3">
                        <label for="itemType" class="form-label">Select Item Type</label>
                        <select class="form-select" id="itemType">
                            <option selected>--Please select item type--</option>
                            <option value="Revolving">Revolving</option>
                            <option value="Installment">Installment</option>
                            <option value="Auto Loan">Auto Loan</option>
                            <option value="Mortgage">Mortgage</option>
                            <option value="Student Loan">Student Loan</option>
                        </select>
                    </div>

                    <!-- Dynamic Form (Initially Hidden) -->
                    <div id="formDetails" class="hidden">
                        <div class="mb-3">
                            <label class="form-label">Select Credit Bureaus:</label>
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <!-- Dropdown 1 -->
                                <div>
                                    <img src="./img/equifax-logo-png-transparent.png" alt="Equifax Logo" class="me-2" style="width: 100px; height: 60px; object-fit: cover;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" id="equifax">
                                            Select Option
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="changeStatus('equifax', 'Select Option', 'secondary')">Select Option</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-red" href="#" onclick="changeStatus('equifax', 'Negative', 'danger')">Negative</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-green" href="#" onclick="changeStatus('equifax', 'Deleted', 'success')">Deleted</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-grey" href="#" onclick="changeStatus('equifax', 'Not Reported', 'secondary')">Not Reported</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Dropdown 2 -->
                                <div>
                                    <img src="./img/Experian-Logo-2016-present.png" alt="Equifax Logo" class="me-2" style="width: 100px; height: 60px; object-fit: cover;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" id="experian">
                                            Select Option
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="changeStatus('experian', 'Select Option', 'secondary')">Select Option</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-red" href="#" onclick="changeStatus('experian', 'Negative', 'danger')">Negative</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-green" href="#" onclick="changeStatus('experian', 'Deleted', 'success')">Deleted</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-grey" href="#" onclick="changeStatus('experian', 'Not Reported', 'secondary')">Not Reported</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Dropdown 3 -->
                                <div>
                                    <img src="./img/575-5758863_transunion-logo-png-transparent-png.png" alt="Equifax Logo" class="me-2" style="width: 200px; height: 60px; object-fit: cover;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" id="transunion">
                                            Select Option
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="changeStatus('transunion', 'Select Option', 'secondary')">Select Option</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-red" href="#" onclick="changeStatus('transunion', 'Negative', 'danger')">Negative</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-green" href="#" onclick="changeStatus('transunion', 'Deleted', 'success')">Deleted</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item dropdown-item-grey" href="#" onclick="changeStatus('transunion', 'Not Reported', 'secondary')">Not Reported</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other Form Fields -->
                        <!-- Item Name -->
                            <div class="form-group row">
                                <label for="itemName" class="col-sm-2 col-form-label">Item Name:</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="itemName" placeholder="Enter item name">
                                </div>
                            </div>

                            <!-- Furnisher Search -->
                            <div class="form-group row">
                                <label for="furnisherSearch" class="col-sm-2 col-form-label">Furnisher:</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="furnisherSearch" placeholder="Type here to search for the furnisher...">
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="Enter name">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Address:</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" placeholder="Enter address">
                                </div>
                            </div>

                            <!-- City and Zipcode -->
                            <div class="form-group row">
                                <label for="city" class="col-sm-2 col-form-label">City:</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" id="city" placeholder="Enter city">
                                </div>
                                <label for="zipcode" class="col-sm-2 col-form-label">Zipcode:</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode">
                                </div>
                            </div>

                            <!-- Phone and Fax -->
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" id="phone" placeholder="Enter phone">
                                </div>
                                <label for="fax" class="col-sm-2 col-form-label">FAX:</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" id="fax" placeholder="Enter fax">
                                </div>
                            </div>

                            <!-- Item Type -->
                            <div class="form-group row">
                                <label for="itemType" class="col-sm-2 col-form-label">Item Type:</label>
                                <div class="col-sm-10">
                                <select class="form-control" id="itemType">
                                    <option value="">Select item type</option>
                                    <option value="type1">Type 1</option>
                                    <option value="type2">Type 2</option>
                                </select>
                                </div>
                            </div>

                            <!-- Account Number -->
                            <div class="form-group row">
                                <label for="accountNumber" class="col-sm-2 col-form-label">Account Number:</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number">
                                </div>
                            </div>

                              <!-- High Credit -->
                        <div class="form-group row">
                            <label for="highCredit" class="col-sm-2 col-form-label">High Credit:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="highCredit" placeholder="Enter high credit">
                            </div>
                        </div>

                        <!-- Credit Limit -->
                        <div class="form-group row">
                            <label for="creditLimit" class="col-sm-2 col-form-label">Credit Limit:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="creditLimit" placeholder="Enter credit limit">
                            </div>
                        </div>

                        <!-- Payment Amount -->
                        <div class="form-group row">
                            <label for="paymentAmount" class="col-sm-2 col-form-label">Payment Amount:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="paymentAmount" placeholder="Enter payment amount">
                            </div>
                        </div>

                        <!-- Date Last Payment -->
                        <div class="form-group row">
                            <label for="dateLastPayment" class="col-sm-2 col-form-label">Date Last Payment:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="dateLastPayment" placeholder="Enter date of last payment">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status:</label>
                            <div class="col-sm-10">
                            <select class="form-control" id="status">
                                <option value="">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            </div>
                        </div>

                        <!-- Opened -->
                        <div class="form-group row">
                            <label for="opened" class="col-sm-2 col-form-label">Opened:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="opened" placeholder="Enter opened date">
                            </div>
                        </div>

                        <!-- Reported -->
                        <div class="form-group row">
                            <label for="reported" class="col-sm-2 col-form-label">Reported:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="reported" placeholder="Enter reported status">
                            </div>
                        </div>

                        <!-- Last Activity -->
                        <div class="form-group row">
                            <label for="lastActivity" class="col-sm-2 col-form-label">Last Activity:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastActivity" placeholder="Enter last activity">
                            </div>
                        </div>

                        <!-- Internal Notes -->
                        <div class="form-group row">
                            <label for="internalNotes" class="col-sm-2 col-form-label">Internal Notes:</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="internalNotes" rows="3" placeholder="Enter internal notes"></textarea>
                            </div>
                        </div>

                        <!-- Visibility Questions -->
                        <div class="form-group row">
                            <label class="col-sm-12">Do you want this note to be visible to Gretel Borras Perdigon's Partner?</label>
                            <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visibilityPartner" id="partnerYes" value="yes">
                                <label class="form-check-label" for="partnerYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visibilityPartner" id="partnerNo" value="no">
                                <label class="form-check-label" for="partnerNo">No</label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                        
                            <label class="col-sm-12">Do you want this note to be visible to Gretel Borras Perdigon's Partner?</label>
                            <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visibilityGretel" id="gretelYes" value="yes">
                                <label class="form-check-label" for="gretelYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visibilityGretel" id="gretelNo" value="no">
                                <label class="form-check-label" for="gretelNo">No</label>
                            </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-success" id="submitBtn">Save and Add New</button>
                            </div>
                        </div>
                </form>

        </div>


    </div>
    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('client-documents.store', $client->slug) }}" method="POST"
                    enctype="multipart/form-data" id="client-documents-store">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDocumentModalLabel">Add Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="inputText" class="col-form-label"> Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <label for="description" class="col-form-label">Document</label>
                                <input type="file" name="doc" class="form-control">
                                @error('doc')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-end m-2" id="submitBtn">Submit
                            Form</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editInstructionModal" tabindex="-1" role="dialog" aria-labelledby="editReportSourceLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReportSourceLabel">Edit Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="report-source-edit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="instruction">Doc</label>
                            <input type="file" name="doc" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handleFormSubmission() {
                const submitBtn = document.getElementById('submitBtn');
                const form = document.querySelector('#client-documents-store');
                const formData = new FormData(form);
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                submitBtn.disabled = true;
                const formAction = form.action;

                fetch(formAction, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw data;
                            });
                        }
                        return response.json(); // Handle success response
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            swal(data.msg, "", "success")
                                .then(() => {
                                    // window.location.href = data.toUrl;
                                    submitBtn.innerHTML = 'Submit';
                                    submitBtn.disabled = false;
                                });
                        } else {
                            swal("Error creating expenditure. Please try again.", "", "error");
                            submitBtn.innerHTML = 'Submit';
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(error => {
                        if (error.errors) {
                            // Clear previous error messages before adding new ones
                            document.querySelectorAll('.text-danger').forEach(element => {
                                element.remove();
                            });

                            // Display validation errors next to the respective fields
                            for (const [key, messages] of Object.entries(error.errors)) {
                                const inputElement = document.querySelector(`[name="${key}"]`);
                                if (inputElement) {
                                    // Only create and append new error messages if they don't exist already
                                    let errorElement = inputElement.parentElement.querySelector('.text-danger');
                                    if (!errorElement) {
                                        errorElement = document.createElement('span');
                                        errorElement.classList.add('text-danger');
                                        inputElement.parentElement.appendChild(errorElement);
                                    }

                                    errorElement.innerHTML = `<strong>${messages.join(' ')}</strong>`;
                                }
                            }
                        } else {
                            swal("Some error occurred. Please try again.", "", "error");
                        }

                        // Re-enable the submit button
                        submitBtn.innerHTML = 'Submit';
                        submitBtn.disabled = false;
                    });
            }

            // Attach the submit handler to the form submit
            const form = document.querySelector('#client-documents-store');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmission();
            });
        })
    </script>
@endsection
