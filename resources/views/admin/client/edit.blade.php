@extends('admin.layout.main')
@section('title', 'Edit Client | ')
@section('content')
    <section class="section dashboard">

        <div class="row">
            <div class="col-lg-12">
                <nav class="nav nav-pills nav-justified mb-2">
                    <a class="nav-link {{Route::is('clients.edit') ? 'active' : ''}}" aria-current="page" href="{{route('clients.edit', $client?->slug)}}">Home</a>
                    <a class="nav-link {{Route::is('client-items.index') ? 'active' : ''}}" href="{{route('client-items.index', $client?->id)}}">Items</a>
                    <a class="nav-link" href="#">Letter</a>
                    <a class="nav-link {{Route::is('client-documents.index') ? 'active' : ''}}" href="{{route('client-documents.index', $client?->id)}}">Documents</a>
                </nav>
               @yield('clientcontent')
            </div>
        </div>
        </div>
    </section>
@endsection

