@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
<script src="{{ asset('js/homepage.js') }}" defer></script>
@endsection

@section('content')
<div id="app">
    <div class="info-section">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="info-container">

                        <div class="info-container-left">
                            <h1 class="text-capitalize">{{ $restaurant->name }}</h1>
                            <h5>Italiano-Pizza-Aperti fino alle 23:59-Consegna gratuita-Distanza: 1.10 km</h5>
                            <h5 class="address"> Indirizzo: {{ $restaurant->address}}</h5>
                        </div>
                        <div class="info-container-right">
                            <img src="https://picsum.photos/400/400?random=1" alt="">
                            <!-- {{asset("storage/".$restaurant->img_cover)}} -->
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="dishes-section">

        <div class="container">
            <div class="row">
                <div class="col-12">
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

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-container-top">

                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                                <h5 class="card-title">Scopri Deliveboo</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Chi siamo</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Pressroom</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Il nostro blog</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Programmazione</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Lavora con noi</h6>
                            </div>
                        </div>

                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                                <h5 class="card-title">Note legali</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Termini e condizioni</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Informativa sulla privacy</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Cookies</h6>
                            </div>
                        </div>

                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                                <h5 class="card-title">Aiuto</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Contatti</h6>
                                <h6 class="card-subtitle mb-2 text-muted">FAQ</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Tipi di cucina</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Mappa del sito</h6>

                            </div>
                        </div>

                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                                <h5 class="card-title">Scarica l'App</h5>


                            </div>
                        </div>

                    </div>

                    <div class="footer-container-bottom">
                        <small>© 2021 Deliveboo</small>
                        <div class="links">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </footer>

</div>

@endsection