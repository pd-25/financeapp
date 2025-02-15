@extends('admin.layout.main')
@section('title', 'Clients | ')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">All Clients</h5>
                        @if (Session::has('msg'))
                            <p id="flash-message" class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                        {{-- <a class="btn btn-sm btn-outline-success float-end" href="{{ route('clients.create') }}">Add Clients</a> --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <form action="{{ route('clients.index') }}" method="GET" class="d-flex" style="width: 50%;">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search by name, email, or phone" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-outline-primary me-2">Search</button>
                                @if (request('search'))
                                    <a href="{{ route('clients.index') }}" class="btn btn-outline-danger"> Clear</a>
                                @endif
                            </form>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('clients.create') }}">Add Clients</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email/Phone</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startIndex = ($clients->currentPage() - 1) * $clients->perPage() + 1;
                                @endphp
                                @foreach ($clients as $client)
                                    <tr>
                                        <th scope="row">{{ $startIndex++ }}</th>
                                        <td>
                                            <a href="{{route('clients.edit',$client?->slug)}}">{{ $client?->first_name.' '.$client?->last_name }}
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" style="height: 19px;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                                  </svg>

                                                  
                                            </a>
                                        </td>
                                        <td>{{ $client?->email }} <br><span>{{ $client?->phone }}</span></td>
                                        <td> {{ \Carbon\Carbon::parse($client?->created_at)->isoFormat('Do MMMM YYYY') }}</td>
                                     
                                        <td>
                                            <a href="{{ route('clients.edit', $client?->slug) }}"><i
                                                    class="ri-pencil-fill"></i></a>
                                            <form method="POST" action="{{ route('clients.destroy', $client?->slug) }}"
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
                        {{ $clients->links() }}
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
