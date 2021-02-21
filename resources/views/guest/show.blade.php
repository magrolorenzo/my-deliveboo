@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
<script src="{{ asset('js/homepage.js') }}" defer></script>
@endsection

@section('content')
<div id="app">

    {{-- Navbar con search bar --}}
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container d-flex justify-content-center">
            <div class="input-group w-50">
                <input type="text" class="form-control" placeholder="Ristoranti, tipi di cucina...">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <h1>Pagina show ristorante</h1>
        </div>
    </div>

</div>

@endsection