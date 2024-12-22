@extends('admin.layout.main')
@section('title', 'Edit Dispute Letters | ')
@section('stylecss')
@endsection
@section('content')
<section class="section dashboard">

  

    <div class="row">
        <!-- Main Content Area -->
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Report Source</h5>
                    <form action="{{ route('dispute-letters.update', $disputeletter->slug) }}" method="POST" enctype="multipart/form-data"
                        id="disputeletter-create">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="inputText" class="col-form-label"> Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" value="{{$disputeletter->name}}" name="name" class="form-control">
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <label for="description" class="col-form-label">Description</label>
                                <input type="text" value="{{$disputeletter->description}}" name="description" class="form-control">
                                @error('description')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-12 mt-5">
                                <textarea id="summernote" name="body" class="form-control" cols="30" rows="10">{{$disputeletter->body}}</textarea>
                                @error('body')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary float-end m-2"  id="submitBtn">Submit Form</button>
                                <a href="{{ route('dispute-letters.index') }}" class="btn btn-danger float-end m-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Area -->
        <div class="col-4">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Contact Variables
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li class="accordion-item" data-value="contact_full_name">Contact Full Name</li>
                                <li class="accordion-item" data-value="contact_first_name">Contact First Name</li>
                                <li class="accordion-item" data-value="contact_last_name">Contact Last Name</li>
                                <li class="accordion-item" data-value="contact_dob_name">Contact DOB</li>
                                <li class="accordion-item" data-value="contact_ssn">Contact SSN</li>
                                <li class="accordion-item" data-value="contact_res_complete_address">Contact Residential Address Complete
                                </li>
                                <li class="accordion-item" data-value="contact_street_address">Contact Street Address</li>
                                <li class="accordion-item" data-value="contact_city">Contact City</li>
                                <li class="accordion-item" data-value="contact_state">Contact State</li>
                                <li class="accordion-item" data-value="contact_zipcode">Contact Zipcode</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Recipient Variables
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li class="accordion-item" data-value="current_date">Current Date(MM-DD-YYYY)</li>
                                <li class="accordion-item" data-value="recipient_item_list">Recipient Item List</li>
                                <li class="accordion-item" data-value="recirecipient_item_list_with_instruction">Recipient Item List With
                                    Instruction</li>
                                <li class="accordion-item" data-value="recipient_res_address">Recipient Residential Address
                                    Complete</li>
                                <li class="accordion-item" data-value="recipient_street_address">Recipient Street Address</li>
                                <li class="accordion-item" data-value="recipient_city">Recipient City</li>
                                <li class="accordion-item" data-value="recipient_state">Recipient State</li>
                                <li class="accordion-item" data-value="recipient_zipcode">Recipient Zipcode</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Hi [First Name],\n\nWe hope this email finds you well. We wanted to remind you about your upcoming appointment on [Date] at [Time]. If you need to reschedule, please let us know.\n\nBest regards,\n[Your Name]\n[Company Name]',
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
    });





    document.addEventListener('DOMContentLoaded', function() {
        function handleFormSubmission() {
            const submitBtn = document.getElementById('submitBtn');
            const form = document.querySelector('#disputeletter-create');
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
                        swal("Error creating TEMPLATE. Please try again.", "", "error");
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
                            const inputElement = document.querySelector(`[value="{{$disputeletter->key}}" name="${key}"]`);
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
        const form = document.querySelector('#disputeletter-create');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            handleFormSubmission();
        });


        const summernote = $('#summernote');
        let lastRange = null;

        summernote.on('summernote.keyup summernote.mouseup', function() {
            lastRange = summernote.summernote('createRange');
        });

        summernote.on('summernote.blur', function() {
            lastRange = summernote.summernote('createRange');
        });

        const accordionItems = document.querySelectorAll(".accordion-item");
        accordionItems.forEach(item => {
            item.addEventListener("click", () => {
                const value = item.getAttribute("data-value");
                if (lastRange) {
                    summernote.summernote('focus');
                    lastRange = summernote.summernote('createRange');
                    lastRange.pasteHTML(value);
                } else {
                    summernote.summernote('focus');
                    summernote.summernote('insertText', value);
                }
                //here do the summernote focus turn off off
                summernote.summernote('blur');
                console.log("Inserted Value:", value);
            });
        });
    });
</script>
@endsection