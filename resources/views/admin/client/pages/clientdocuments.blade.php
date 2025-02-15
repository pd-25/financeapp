@extends('admin.client.edit')
@section('clientcontent')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"> {{$client?->first_name . ' '.$client?->middle_name.' '.$client?->last_name."'s"}} Documents</h5>
            @if (Session::has('msg'))
                <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
            <button class="btn btn-sm btn-outline-success float-end" data-bs-toggle="modal"
                            data-bs-target="#addDocumentModal">Add Document</button>
                        {{-- </div> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Document</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startIndex = ($clientdocuments->currentPage() - 1) * $clientdocuments->perPage() + 1;
                                @endphp
                                @foreach ($clientdocuments as $clientdocument)
                                    <tr>
                                        <th scope="row">{{ $startIndex++ }}</th>
                                        <td>{{ $clientdocument?->name }}
                                        </td>
                                        <td><a href="{{asset('storage'. $clientdocument?->doc)}}" target="_blank" rel="noopener noreferrer">Preview</a></td>
                                        <td> {{ \Carbon\Carbon::parse($clientdocument?->created_at)->isoFormat('Do MMMM YYYY') }}
                                        </td>

                                        <td>
                                            {{-- <a href="{{ route('instructions.edit', $clientdocument?->slug) }}"><i
                                                    class="ri-pencil-fill"></i></a> --}}
                                                    <button 
                                                    class="btn btn-primary edit-report-source-btn" 
                                                    data-name="{{$clientdocument?->name }}" 
                                                    data-instruction="{{$clientdocument?->instruction}}" 
                                                    data-slug="{{$clientdocument?->slug}}" 
                                                    data-toggle="modal" 
                                                    data-target="#editInstructionModal">
                                                    Edit
                                                </button>
                                                    </a>
                                            <form method="POST"
                                                action="{{ route('client-documents.destroy', $clientdocument?->slug) }}"
                                                class="d-inline-block pl-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-icon show_confirm"
                                                    data-toggle="tooltip" title='Delete'>

                                                    <i class="ri-delete-bin-2-fill"></i>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                        {{ $clientdocuments->links() }}

        </div>


    </div>
    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('client-documents.store', $client->slug) }}" method="POST" enctype="multipart/form-data"
                id="client-documents-store">
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
<div class="modal fade" id="editInstructionModal" tabindex="-1" role="dialog" aria-labelledby="editReportSourceLabel" aria-hidden="true">
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
                                    window.location.href = data.toUrl;
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
