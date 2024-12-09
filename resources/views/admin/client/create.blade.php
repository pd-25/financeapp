@extends('admin.layout.main')
@section('title', 'Create Client | ')
@section('content')
    <section class="section dashboard">

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Client</h5>
                        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data"
                            id="client-create">
                            @method('POST')
                            @csrf

                            {{--  --}}
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control">
                                    @error('first_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control">
                                    @error('middle_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control">
                                    @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control">
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">DOB</label>
                                    <input type="date" name="dop" class="form-control">
                                    @error('dop')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">SSN</label>
                                    <input type="text" name="ssn" class="form-control">
                                    @error('ssn')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="inputText" class="col-sm-1 col-form-label">Receive Email
                                        Notification</label>
                                    <input type="checkbox" name="is_notify_email" value="1">
                                    @error('is_notify_email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Phone Number (Mobile)</label>
                                    <input type="number" name="phone" class="form-control">
                                    @error('phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Phone Number (Home)</label>
                                    <input type="number" name="phone_home" class="form-control">
                                    @error('phone_home')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Phone Number (Work)</label>
                                    <input type="number" name="phone_work" class="form-control">
                                    @error('phone_work')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="inputText" class="col-sm-4 col-form-label">Current Address</label>
                                    <input type="text" id="current_address" name="current_address" class="form-control">
                                    @error('current_address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">City</label>
                                    <input type="text" id="city" name="city" class="form-control">
                                    @error('city')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">State</label>
                                    <input type="text" id="state" name="state" class="form-control">
                                    @error('state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Zipcode</label>
                                    <input type="number" id="zipcode" name="zipcode" class="form-control">
                                    @error('zipcode')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="inputText" class="col-sm-1 col-form-label">Billing Address</label>
                                    <input id="same-billing-check" type="checkbox"
                                        onchange='handleChange(this);'><span>Same as Current Address</span>
                                </div>
                                <div class="col-sm-12">
                                    <label for="inputText" class="col-sm-4 col-form-label">Current Address</label>
                                    <input type="text" id="billing_address" name="billing_address"
                                        class="form-control">
                                    @error('billing_address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">City</label>
                                    <input type="text" id="billing_city" name="billing_city" class="form-control">
                                    @error('billing_city')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">State</label>
                                    <input type="text" id="billing_state" name="billing_state" class="form-control">
                                    @error('billing_state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-4 col-form-label">Zipcode</label>
                                    <input type="number" id="billing_zipcode" name="billing_zipcode"
                                        class="form-control">
                                    @error('billing_zipcode')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{--  --}}


                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-sm btn-primary float-end m-2"
                                        id="submitBtn">Submit Form</button>
                                    <a href="{{ route('clients.index') }}" type="submit"
                                        class="btn btn-sm btn-danger float-end m-2">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handleFormSubmission() {
                const submitBtn = document.getElementById('submitBtn');
                const form = document.querySelector('#client-create');
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
                                    window.location.href = data.toUrl;
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
            const form = document.querySelector('#client-create');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmission();
            });


        });

        function handleChange(checkbox) {
            if (checkbox.checked == true) {
                document.getElementById('billing_address').value = document.getElementById('current_address').value;
                document.getElementById('billing_city').value = document.getElementById('city').value;
                document.getElementById('billing_state').value = document.getElementById('state').value;
                document.getElementById('billing_zipcode').value = document.getElementById('zipcode').value;
            } else {
                document.getElementById('billing_address').value = '';
                document.getElementById('billing_city').value = '';
                document.getElementById('billing_state').value = '';
                document.getElementById('billing_zipcode').value = '';
            }
        }
    </script>
@endsection
