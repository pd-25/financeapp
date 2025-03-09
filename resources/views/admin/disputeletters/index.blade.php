@extends('admin.layout.main')
@section('title', 'Dispute Letters | ')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">All Dispute Letter</h5>
                        @if (Session::has('msg'))
                            <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                        <a class="btn btn-sm btn-outline-success float-end" href="{{ route('dispute-letters.create') }}">Add
                            Template</a>
                        {{-- </div> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startIndex = ($disputeletters->currentPage() - 1) * $disputeletters->perPage() + 1;
                                @endphp
                                @foreach ($disputeletters as $disputeletter)
                                    <tr>
                                        <th scope="row">{{ $startIndex++ }}</th>
                                        <td>{{ $disputeletter?->name }}
                                        </td>
                                        <td>{{ Str::limit($disputeletter->description, 100, '...') }}</td>
                                        <td> {{ \Carbon\Carbon::parse($disputeletter?->created_at)->isoFormat('Do MMMM YYYY') }}
                                        </td>

                                        <td>
                                            {{-- <a href="javascript:void(0)" data-name="{{ $disputeletter?->name }}"
                                                data-description="{{ $disputeletter->description }}"
                                                data-target="#editNameModal" class="edit-dispute-letter-btn"><i
                                                    class="ri-more-2-line"></i></a> --}}
                                            <a href="javascript:void(0)" data-name="{{ $disputeletter?->name }}"
                                                data-description="{{ $disputeletter->description }}"
                                                data-slug="{{ $disputeletter?->slug }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Update letter name and description here"
                                                class="edit-dispute-letter-btn">
                                                <i class="ri-more-2-line"></i>
                                            </a>
                                            <a href="{{ route('dispute-letters.edit', $disputeletter?->slug) }}"><i
                                                    class="ri-pencil-fill"></i></a>
                                            <form method="POST"
                                                action="{{ route('dispute-letters.destroy', $disputeletter?->slug) }}"
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
                        {{ $disputeletters->links() }}
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="addInstructionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" id="dispute-letter-edit">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addInstructionModalLabel">Update Letter Info</h5>
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
                                    <label for="description" class="col-form-label">Description</label>
                                    <input name="description" class="form-control" type="text">
                                    @error('description')
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

    </section>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        document.querySelectorAll('.edit-dispute-letter-btn').forEach(button => {
            button.addEventListener('click', event => {
                const disputeLetter = event.currentTarget; // Ensure we are getting <a> element
                console.log('disputeLetter name:', disputeLetter.dataset.name);
                console.log('disputeLetter description:', disputeLetter.dataset.description);

                // Populate form fields
                const formEdit = document.querySelector('#dispute-letter-edit');
                formEdit.querySelector('input[name="name"]').value = disputeLetter.dataset.name || '';
                formEdit.querySelector('input[name="description"]').value = disputeLetter.dataset
                    .description || '';

                // Set form action dynamically
                formEdit.action = "{{ route('dispute-letters.update', ':slug') }}".replace(':slug',
                    disputeLetter.dataset.slug);

                // Show the modal
                $('#editNameModal').modal('show');
            });
        });

        const formEditD = document.querySelector('#dispute-letter-edit');
        formEditD.addEventListener('submit', event => {
            event.preventDefault();

            const formData = new FormData(formEditD);

            fetch(formEditD.action, {
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

        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });


        // document.querySelectorAll('.edit-dispute-letter-btn').forEach(button => {
        //     button.addEventListener('click', event => {
        //         const disputeLetter = event.target.dataset;
        //         console.log('disputleter', disputeLetter.name); //getting undefined
        //         console.log('disputleter', disputeLetter.description);//getting undefined


        //         // Populate form fields
        //         const formEdit = document.querySelector('#dispute-letter-edit');
        //         formEdit.querySelector('input[name="name"]').value = disputeLetter.name || '';
        //         formEdit.querySelector('input[name="description"]').value = disputeLetter
        //             .description || '';
        //         formEdit.action = "{{ route('dispute-letters.update', ':slug') }}".replace(':slug',
        //             disputeLetter.slug);

        //         // Show the modal manually if it's not opening
        //         $('#editNameModal').modal('show');
        //     });
        // });
    </script>
@endsection
