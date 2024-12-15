@extends('admin.layout.main')
@section('title', 'Edit Client | ')
@section('content')
<style>
    /* Subtle shadow on hover and active */
.nav-link.shadow-hover {
    transition: box-shadow 0.3s ease, background-color 0.3s ease;
}

.nav-link.shadow-hover:hover, 
.nav-link.shadow-hover.active {
    background-color: #a5a9af; /* Light gray background */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    color: #007bff !important; /* Primary color for text */
    border-radius: 5px;
}

</style>
    <section class="section dashboard">

        <div class="row">
            <div class="col-lg-12">
                <nav class="nav nav-pills nav-justified mb-4 p-2 rounded shadow-sm" style="background-color: #f8f9fa;">
                    <a class="nav-link {{Route::is('clients.edit') ? 'active' : ''}} text-uppercase fw-bold shadow-hover" 
                       aria-current="page" href="{{route('clients.edit', $client?->slug)}}">
                        <i class="bi bi-house-door-fill me-1"></i> Home
                    </a>
                    <a class="nav-link {{Route::is('client-items.index') ? 'active' : ''}} text-uppercase fw-bold shadow-hover" 
                       href="{{route('client-items.index', $client?->id)}}">
                        <i class="bi bi-box-seam me-1"></i> Items
                    </a>
                    <a class="nav-link text-uppercase fw-bold shadow-hover" href="#">
                        <i class="bi bi-envelope-fill me-1"></i> Letter
                    </a>
                    <a class="nav-link {{Route::is('client-documents.index') ? 'active' : ''}} text-uppercase fw-bold shadow-hover" 
                       href="{{route('client-documents.index', $client?->id)}}">
                        <i class="bi bi-file-earmark-text-fill me-1"></i> Documents
                    </a>
                </nav>
                @yield('clientcontent')
            </div>
        </div>
    </section>
@endsection
