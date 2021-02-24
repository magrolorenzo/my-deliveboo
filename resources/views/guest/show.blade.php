@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
<script src="{{ asset('js/show_restaurant.js') }}" defer></script>
@endsection

@section('content')
<div id="app">
    <div class="info-section">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="info-container">

                        <div class="info-container-left">
                            <h1 id="restaurant-id" class="text-capitalize" hidden>{{ $restaurant->id }}</h1>
                            <h1 id="restaurant-name" class="text-capitalize">{{ $restaurant->name }}</h1>
                            <h5 class="info-res">
                                <span><i class="fas fa-utensils"></i></span> Categoria:
                                @foreach ($restaurant->categories as $category)
                                {{ $category->name }}
                                @endforeach
                            </h5>
                            <h5> <span><i class="fas fa-shipping-fast"></i></span> Consegna gratuita</h5>

                            <h5>{{ $restaurant->category }}</h5>
                            <h5 class="address"> <span><i class="fas fa-map-marker-alt"></i></span> Indirizzo: {{ $restaurant->address}}</h5>
                        </div>

                        <div class="info-container-right">
                            <img src="{{asset("storage/".$restaurant->img_cover)}}" alt="">

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="dishes-section">

        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="menu-title">
                        <h1 class="text-uppercase">Menù</h1>

                    </div>
                    <div class="dish-container">

                        <div class="card" style="width: 18rem;" v-if="dish.visible" v-for="dish in dishes">
                            <img class="card-img-top-show" :src="'../storage/' + dish.img_cover" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">@{{ dish.name }}</h5>
                                <p class="card-text">@{{ dish.ingredients }}</p>
                                <p class="card-text">@{{ dish.description }}</p>
                                <h5 class="card-text">@{{ dish.unit_price }}</h5>
                                <a id="chart-button" class="btn btn-primary" @click="decrease(dish.id)">-</a>
                                <a id="chart-button" class="btn btn-primary" @click="add(dish)">+</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-3">

                    <!-- Card -->
                    <div class="card mb-3">
                        <div class="card-body">

                            <h5 class="mb-3">carrello</h5>

                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0" v-for="cartItem in cart.contents">
                                    @{{ cartItem.name }}
                                    <a class="btn btn-primary" @click="decrease(cartItem.id)">-</a>
                                    <span>x@{{ cartItem.quantity }}</span>
                                    <a class="btn btn-primary" @click="add(cartItem)">+</a>
                                    <span>@{{ cartItem.unit_price }} €</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Totale</strong>
                                        <strong>
                                            <p class="mb-0">(IVA inclusa)</p>
                                        </strong>
                                    </div>
                                    <span><strong>@{{ cart.subtotal }} €</strong></span>
                                </li>
                            </ul>
                            
                            <div class="buttons-container" v-if="cart.subtotal != 0 ">
                                <a href="{{route('guest.checkout', ['id'=>$restaurant->id])}}" class="btn btn-primary" >
                                    Ordina e Paga
                                </a>
                                <button type="button" class="btn btn-primary" name="button" @click="empty">Svuota</button>
                            </div>

                        </div>
                    </div>
                    <!-- Card -->

                </div>
            </div>
        </div>
    </div>

    <div class="container">

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
    {{-- @php
        echo json_encode($restaurant);
    @endphp --}}
</div>

@endsection
