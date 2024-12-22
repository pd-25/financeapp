@extends('admin.layout.main')
@section('title', 'Dispute Letters | ')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">All Report Source</h5>
                        @if (Session::has('msg'))
                            <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                        {{-- <a class="btn btn-sm btn-outline-success float-end" href="{{ route('report-sources.create') }}">Add Report Source</a> --}}
                        <button class="btn btn-sm btn-outline-success float-end" data-bs-toggle="modal"
                            data-bs-target="#addReportSourceModal">Add Report Source</button>
                        {{-- </div> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Login Url</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startIndex = ($reportsources->currentPage() - 1) * $reportsources->perPage() + 1;
                                @endphp
                                @foreach ($reportsources as $reportsource)
                                    <tr>
                                        <th scope="row">{{ $startIndex++ }}</th>
                                        <td>{{ $reportsource?->name }}
                                        </td>
                                        <td><a href="{{ $reportsource?->login_url }}" target="_blank"
                                                rel="noopener noreferrer">{{ $reportsource?->login_url }}</a></td>
                                        <td> {{ \Carbon\Carbon::parse($reportsource?->created_at)->isoFormat('Do MMMM YYYY') }}
                                        </td>

                                        <td>
                                            {{-- <a href="{{ route('report-sources.edit', $reportsource?->slug) }}"><i
                                                    class="ri-pencil-fill"></i></a> --}}
                                                    <button 
                                                    class="btn btn-primary edit-report-source-btn" 
                                                    data-name="{{$reportsource?->name }}" 
                                                    data-login_url="{{$reportsource?->login_url}}" 
                                                    data-slug="{{$reportsource?->slug}}" 
                                                    data-toggle="modal" 
                                                    data-target="#editReportSourceModal">
                                                    Edit
                                                </button>
                                                    </a>
                                            <form method="POST"
                                                action="{{ route('report-sources.destroy', $reportsource?->slug) }}"
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
                        {{ $reportsources->links() }}
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="modal fade" id="addReportSourceModal" tabindex="-1" aria-labelledby="addReportSourceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('report-sources.store') }}" method="POST" enctype="multipart/form-data"
                    id="report-sources-create">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addReportSourceModalLabel">Add Report Source</h5>
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
                                <label for="description" class="col-form-label">Login Url</label>
                                <input type="text" name="login_url" class="form-control">
                                @error('login_url')
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
<div class="modal fade" id="editReportSourceModal" tabindex="-1" role="dialog" aria-labelledby="editReportSourceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReportSourceLabel">Edit Report Source</h5>
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
                        <label for="login_url">Login URL</label>
                        <input type="text" name="login_url" class="form-control" required>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handleFormSubmission() {
                const submitBtn = document.getElementById('submitBtn');
                const form = document.querySelector('#report-sources-create');
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
            const form = document.querySelector('#report-sources-create');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmission();
            });

            document.querySelectorAll('.edit-report-source-btn').forEach(button => {
                button.addEventListener('click', event => {
                    const reportSourceData = button.dataset;

                    // Populate form fields
                    const formEdit = document.querySelector('#report-source-edit');
                    formEdit.querySelector('input[name="name"]').value = reportSourceData.name || '';
                    formEdit.querySelector('input[name="login_url"]').value = reportSourceData.login_url || '';
                    formEdit.action = "{{ route('report-sources.update', ':slug') }}".replace(':slug', reportSourceData.slug);

                    // Show the modal manually if it's not opening
                    $('#editReportSourceModal').modal('show');
                });
            });

            // Handle formEdit submission with AJAX
            const formEdit = document.querySelector('#report-source-edit');
            formEdit.addEventListener('submit', event => {
                event.preventDefault();

                const formData = new FormData(formEdit);

                fetch(formEdit.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        swal(data.msg, '', 'success').then(() => {
                            window.location.href = data.toUrl;
                        });
                    } else {
                        swal('Error updating report source. Please try again.', '', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    swal('An unexpected error occurred. Please try again later.', '', 'error');
                });
            });

        });
    </script>
@endsection
