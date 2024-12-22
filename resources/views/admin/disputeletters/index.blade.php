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
                        <a class="btn btn-sm btn-outline-success float-end" href="{{ route('dispute-letters.create') }}">Add Template</a>
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
                                        <td>{{ $disputeletter?->name}} 
                                        </td>
                                        <td>{{ Str::limit($disputeletter->description, 100, '...') }}</td>
                                        <td> {{ \Carbon\Carbon::parse($disputeletter?->created_at)->isoFormat('Do MMMM YYYY') }}</td>
                                       
                                        <td>
                                            <a href="{{ route('dispute-letters.edit', $disputeletter?->slug) }}"><i
                                                    class="ri-pencil-fill"></i></a>
                                            <form method="POST" action="{{ route('dispute-letters.destroy', $disputeletter?->slug) }}"
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

    </section>
@endsection
