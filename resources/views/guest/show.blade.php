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
            <div class="col-12">
                <div class="info-container">

                    <div class="info-container-left">
                        <h1 class="text-capitalize">{{ $restaurant->name }}</h1>
                        <h2 class="address">{{ $restaurant->address}}</h2>
                    </div>
                    <div class="info-container-right">
                        <img src="https://picsum.photos/400/400?random=1" alt="">
                        <!-- {{asset("storage/".$restaurant->img_cover)}} -->
                    </div>


                </div>
                <div class="dish-container">
                    @foreach ($restaurant->dishes as $dish)
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="https://picsum.photos/100/100?random=1" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $dish->name }}</h5>
                            <p class="card-text">{{ $dish->ingredients }}</p>
                            <p class="card-text">{{ $dish->description }}</p>
                            <h5 class="card-text"> {{ $dish->unit_price }}</h5>
                            <a href="#" class="btn btn-primary">Aggiungi al carrello</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>

@endsection