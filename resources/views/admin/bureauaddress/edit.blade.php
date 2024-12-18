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
                        <h5 class="card-title">Add New Address</h5>
                        <form action="{{ route('bureau-address.update', $bureauaddress->slug) }}" method="POST" enctype="multipart/form-data"
                            id="disputeletter-create">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="name" class="col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <select name="name" class="form-control" id="name">
                                        @foreach (\App\enum\BureauAddressNameEnum::values() as $bureauName)
                                            <option value="{{ $bureauName }}"
                                                {{ $bureauaddress->name == $bureauName ? 'selected' : '' }}>
                                                {{ $bureauName }}</option>
                                        @endforeach
                                    </select>

                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <label for="address" class="col-form-label">Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{$bureauaddress->address }}">
                                    @error('address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="city" class="col-form-label">City <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{$bureauaddress->city }}">
                                    @error('city')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="state" class="col-form-label">State <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="state" class="form-control" id="state" value="{{$bureauaddress->state }}">
                                    @error('state')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="zipcode" class="col-form-label">Zip Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="zipcode" class="form-control" id="zipcode" value="{{$bureauaddress->zipcode }}">
                                    @error('zipcode')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone" class="col-form-label">Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{$bureauaddress->phone }}">
                                    @error('phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="fax" class="col-form-label">Fax</label>
                                    <input type="text" name="fax" class="form-control" id="fax" value="{{$bureauaddress->fax }}">
                                    @error('fax')
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
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#disputeletter-create');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const submitBtn = document.getElementById('submitBtn');
                const formData = new FormData(form);

                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                submitBtn.disabled = true;

                fetch(form.action, {
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
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            swal(data.msg, "", "success").then(() => {
                                window.location.href = data.toUrl;
                            });
                        } else {
                            swal("Error creating TEMPLATE. Please try again.", "", "error");
                        }
                    })
                    .catch(error => {
                        if (error.errors) {
                            document.querySelectorAll('.text-danger').forEach(element => element
                            .remove());

                            for (const [key, messages] of Object.entries(error.errors)) {
                                const inputElement = document.querySelector(`[name="${key}"]`);
                                if (inputElement) {
                                    let errorElement = inputElement.parentElement.querySelector(
                                        '.text-danger');
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
                    })
                    .finally(() => {
                        submitBtn.innerHTML = 'Submit';
                        submitBtn.disabled = false;
                    });
            });
        });
    </script>
@endsection
