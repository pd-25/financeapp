@extends('admin.layout.main')
@section('title', 'Bureau Address | ')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">All Bureau Addresses</h5>
                        @if (Session::has('msg'))
                            <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                        <a class="btn btn-sm btn-outline-success float-end" href="{{ route('bureau-address.create') }}">Add Address</a>
                        {{-- </div> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Zipcode</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Fax</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startIndex = ($bureauaddress->currentPage() - 1) * $bureauaddress->perPage() + 1;
                                @endphp
                                @foreach ($bureauaddress as $bureauaddres)
                                    <tr>
                                        <th scope="row">{{ $startIndex++ }}</th>
                                        <td><span class="{{getBureauType($bureauaddres?->name)}}">{{$bureauaddres?->name}}</span></td>
                                        <td>{{ $bureauaddres?->address}}</td>
                                        <td>{{ $bureauaddres?->city}}</td>
                                        <td>{{ $bureauaddres?->state}}</td>
                                        <td>{{ $bureauaddres?->zipcode}}</td>
                                        <td>{{ $bureauaddres?->phone}}</td>
                                        <td>{{ $bureauaddres?->fax}}</td>
                                        <td> {{ \Carbon\Carbon::parse($bureauaddres?->created_at)->isoFormat('Do MMMM YYYY') }}</td>
                                       
                                        <td>
                                            <a href="{{ route('bureau-address.edit', $bureauaddres?->slug) }}"><i
                                                    class="ri-pencil-fill"></i></a>
                                            <form method="POST" action="{{ route('bureau-address.destroy', $bureauaddres?->slug) }}"
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
                        {{ $bureauaddress->links() }}
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
