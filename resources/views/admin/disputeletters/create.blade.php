@extends('admin.layout.main')
@section('title', 'Create Dispute Letters | ')
@section('stylecss')
@endsection
@section('content')
    <section class="section dashboard">



        <div class="row">
            <!-- Main Content Area -->
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Template</h5>
                        <form action="{{ route('dispute-letters.store') }}" method="POST" enctype="multipart/form-data"
                            id="disputeletter-create">
                            @method('POST')
                            @csrf

                            <div class="row mb-3">
                                {{-- <div class="col-sm-12">
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
                                    <label for="description" class="col-form-label">Description</label>
                                    <input type="text" name="description" class="form-control">
                                    @error('description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}

                                <div class="col-sm-12 mt-5">
                                    <textarea id="summernote" name="body" class="form-control" cols="30" rows="10"></textarea>
                                    @error('body')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary float-end m-2" id="submitBtn">Submit
                                        Form</button>
                                    <a href="{{ route('dispute-letters.index') }}"
                                        class="btn btn-danger float-end m-2">Cancel</a>
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
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    @forelse (config('dispute_letters.contact') as $kC => $contactLater)
                                        <li class="accordion-item" data-value="{{ $contactLater }}">
                                            {{ str_replace('_', ' ', $kC) }}
                                        </li>
                                    @empty
                                        <li>No items found.</li>
                                    @endforelse
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
                                    @forelse (config('dispute_letters.recipient') as $kR => $receipnttLater)
                                        {{-- @dump($kR,$receipnttLater) --}}
                                        <li class="accordion-item" data-value="{{ $receipnttLater }}">
                                            <span class="text-uppercase">{{ str_replace('_', ' ', $kR) }}</span>
                                        </li>
                                    @empty
                                        <li>No items found.</li>
                                    @endforelse
                                    {{-- <li class="accordion-item" data-value="current_date">Current Date(MM-DD-YYYY)</li>
                                    <li class="accordion-item" data-value="recipient_item_list">Recipient Item List</li>
                                    <li class="accordion-item" data-value="recirecipient_item_list_with_instruction">
                                        Recipient Item List With
                                        Instruction</li>
                                    <li class="accordion-item" data-value="recipient_res_address">Recipient Residential
                                        Address
                                        Complete</li>
                                    <li class="accordion-item" data-value="recipient_street_address">Recipient Street
                                        Address</li>
                                    <li class="accordion-item" data-value="recipient_city">Recipient City</li>
                                    <li class="accordion-item" data-value="recipient_state">Recipient State</li>
                                    <li class="accordion-item" data-value="recipient_zipcode">Recipient Zipcode</li> --}}
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
                    ['font', ['fontname', 'fontsize', 'bold', 'underline', 'clear']],
                    // ['fontsize', ['fontsize']],
                    // ['font', ['bold', 'underline', 'clear']],
                    
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
            const form = document.querySelector('#disputeletter-create');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmission();
            });

            const summernote = $('#summernote');
            let lastRange = null;

            // Save the range when user interacts with summernote
            summernote.on('summernote.keyup summernote.mouseup', function() {
                lastRange = summernote.summernote('createRange');
            });

            summernote.on('summernote.blur', function() {
                lastRange = summernote.summernote('createRange');
            });

            // Handle click on accordion items
            const accordionItems = document.querySelectorAll(".accordion-item");
            accordionItems.forEach(item => {
                item.addEventListener("click", () => {
                    const value = item.getAttribute("data-value");

                    // Ensure summernote regains focus
                    summernote.summernote('focus');

                    if (lastRange) {
                        // Restore range and insert at cursor position
                        summernote.summernote('restoreRange');
                        summernote.summernote('insertText', value);

                        // Move the cursor to the end of the inserted text
                        setTimeout(() => {
                            lastRange = summernote.summernote('createRange');
                            lastRange.collapse(false);
                            summernote.summernote('focus');
                        }, 10);
                    } else {
                        // If no range is found, just insert at the end
                        summernote.summernote('insertText', value);
                    }

                    console.log("Inserted Value:", value);
                });
            });


            // Prevent summernote from keeping focus when clicking other fields
            document.addEventListener("click", (event) => {
                // if (!event.target.closest('.note-editor') && !event.target.closest('.accordion-item')) {
                if (event.target.closest('input[name="name"]') && event.target.closest('input[name="description"]')) {
                    summernote.summernote('destroy'); // Temporarily destroy summernote
                    setTimeout(() => {
                        summernote.summernote({
                            height: 300
                        }); // Reinitialize it
                    }, 100);
                }
            });



            // const summernote = $('#summernote');
            // let lastRange = null;

            // summernote.on('summernote.keyup summernote.mouseup', function() {
            //     lastRange = summernote.summernote('createRange');
            // });

            // summernote.on('summernote.blur', function() {
            //     lastRange = summernote.summernote('createRange');
            // });

            // const accordionItems = document.querySelectorAll(".accordion-item");
            // accordionItems.forEach(item => {
            //     item.addEventListener("click", () => {
            //         const value = item.getAttribute("data-value");
            //         if (lastRange) {
            //             summernote.summernote('focus');
            //             lastRange = summernote.summernote('createRange');
            //             lastRange.pasteHTML(value);
            //         } else {
            //             summernote.summernote('focus');
            //             summernote.summernote('insertText', value);
            //         }

            //         console.log("Inserted Value:", value);
            //     });
            // });
        });
    </script>
@endsection
