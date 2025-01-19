@extends('admin.client.edit')
@section('clientcontent')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Client Information</h5>
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                        type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Basic Info</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">Monitoring Info</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <form action="{{ route('clients.update', $client->slug) }}" method="POST"
                            enctype="multipart/form-data" id="client-create">
                            @method('PUT')
                            @csrf

                            {{--  --}}
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ $client->first_name }}">
                                    @error('first_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control"
                                        value="{{ $client->middle_name }}">
                                    @error('middle_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ $client->last_name }}">
                                    @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" value="{{ $client->email }}">
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">DOB </label>
                                    <input type="date" name="dob" class="form-control" value="{{ $client->dob }}">
                                    @error('dob')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">SSN</label>
                                    <input type="text" name="ssn" class="form-control" value="{{ $client->ssn }}"
                                        oninput="formatPhoneNumber(this, 'ssn')">
                                    @error('ssn')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="inputText" class="col-sm-3 col-form-label">Receive Email
                                        Notification</label>
                                    <input type="checkbox" name="is_notify_email" value="1"
                                        {{ $client->is_notify_email == 1 ? 'checked' : '' }}>
                                    @error('is_notify_email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Phone Number
                                        (Mobile)</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ $client->phone }}" oninput="formatPhoneNumber(this)">
                                    @error('phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Phone Number
                                        (Home)</label>
                                    <input type="text" name="phone_home" class="form-control"
                                        value="{{ $client->phone_home }}" oninput="formatPhoneNumber(this, 'mobile')">
                                    @error('phone_home')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Phone Number
                                        (Work)</label>
                                    <input type="text" name="phone_work" class="form-control"
                                        value="{{ $client->phone_work }}" oninput="formatPhoneNumber(this, 'mobile')">
                                    @error('phone_work')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label for="inputText" class="col-sm-5 col-form-label">Current
                                        Address</label>
                                    <input type="text" name="current_address" class="form-control"
                                        value="{{ $client->current_address }}">
                                    @error('current_address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">City</label>
                                    <input type="text" name="city" class="form-control"
                                        value="{{ $client->city }}">
                                    @error('city')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">State</label>
                                    <select id="state" name="state" class="form-control">
                                        <option value="">--select state--</option>
                                        @foreach (config('states') as $key => $statList)
                                            <option value="{{ $statList }}"
                                                {{ $client->state == $statList ? 'selected' : '' }}>{{ $statList }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Zipcode</label>
                                    <input type="number" name="zipcode" class="form-control"
                                        value="{{ $client->zipcode }}">
                                    @error('zipcode')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                {{-- <div class="col-sm-12">
                                <label for="inputText" class="col-sm-5 col-form-label">Current
                                    Address</label>
                                <input type="text" name="billing_address" class="form-control"
                                    value="{{ $client->billing_address }}">
                                @error('billing_address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label for="inputText" class="col-sm-5 col-form-label">City</label>
                                <input type="text" name="billing_city" class="form-control"
                                    value="{{ $client->billing_city }}">
                                @error('billing_city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label for="inputText" class="col-sm-5 col-form-label">State</label>
                                <input type="text" name="billing_state" class="form-control"
                                    value="{{ $client->billing_state }}">
                                @error('billing_state')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label for="inputText" class="col-sm-5 col-form-label">Zipcode</label>
                                <input type="number" name="billing_zipcode" class="form-control"
                                    value="{{ $client->billing_zipcode }}">
                                @error('billing_zipcode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                                {{--  --}}


                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-sm btn-primary float-end m-2"
                                            id="submitBtn">Submit Form</button>
                                        <a href="{{ route('clients.index') }}" type="submit"
                                            class="btn btn-sm btn-danger float-end m-2">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <form action="{{ route('monitoring-infos.store') }}" method="POST" id="monitoring-info">
                            @method('POST')
                            @csrf

                            {{--  --}}
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-7 col-form-label">Monitoring Site <span
                                            class="text-danger">*</span></label>
                                    <select name="report_source_id" class="form-control">
                                        <option value="">--select site--</option>
                                        @forelse ($reportSources as $reportSource)
                                            <option
                                                {{ $reportSource->id == $client?->monitoringinfo?->report_source_id ? 'selected' : '' }}
                                                value="{{ $reportSource->id }}">{{ $reportSource->name }}</option>
                                        @empty
                                            <option value="">Not found</option>
                                        @endforelse

                                    </select>
                                    @error('report_source_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ $client?->monitoringinfo?->username }}">
                                    @error('username')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="password" class="form-control"
                                        value="{{ $client?->monitoringinfo?->password }}">
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputText" class="col-sm-5 col-form-label">Seurity Word<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="security_word" class="form-control"
                                        value="{{ $client?->monitoringinfo?->security_word }}">
                                    @error('security_word')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                {{--  --}}


                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-sm btn-primary float-end m-2"
                                            id="monitoringsubmitBtn">Submit Form</button>
                                        <a href="{{ route('clients.index') }}" type="submit"
                                            class="btn btn-sm btn-danger float-end m-2">Cancel</a>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>
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
            const form = document.querySelector('#client-create');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmission();
            });


            const formMonitoring = document.querySelector('#monitoring-info');
            formMonitoring.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmissionMonitoring();
            });

            function handleFormSubmissionMonitoring() {
                const submitBtn = document.getElementById('monitoringsubmitBtn');
                const form = document.querySelector('#monitoring-info');
                const formData = new FormData(form);
                const clientId = window.location.pathname.split('/')[3]; // Assuming the client_id is at segment 3
                formData.append('client_id', clientId);
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



        })
    </script>
@endsection
