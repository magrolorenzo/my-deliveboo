@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
    <script src="{{ asset('js/show_restaurant.js') }}" defer></script>
@endsection

@section('content')
    <div id="app">

        {{-- Sezione con info del ristorante --}}
        <div class="info-section" style="background-image: url({{ asset('storage/'.$restaurant->img_cover) }}); background-position: center; background-size: cover">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="info-container">

                            {{-- Sezione di sinistra con info ristorante --}}
                            <div class="restaurant-info p-5">
                                <h1 id="restaurant-id" class="text-capitalize" hidden>{{ $restaurant->id }}</h1>

                                {{-- Nome Ristorante --}}
                                <h1 id="restaurant-name" class="text-capitalize">{{ $restaurant->name }}</h1>

                                {{-- Lista categorie ristorante --}}
                                <h5 class="info-res">
                                    <span><i class="fas fa-utensils"></i></span> Categoria:
                                    @foreach ($restaurant->categories as $category)
                                        <span class="badge badge-info">{{ $category->name }}</span>
                                    @endforeach
                                </h5>

                                <h5><span><i class="fas fa-shipping-fast"></i></span> Consegna gratuita</h5>

                                <h5 class="address"><span><i class="fas fa-map-marker-alt"></i></span> Indirizzo: {{ $restaurant->address}}</h5>
                            </div>

                            {{-- Sezione di destra con immagine ristorante --}}
                            {{-- <div class="info-container-right rounded">
                                <img src="{{ asset("storage/".$restaurant->img_cover) }}" class="rounded">
                            </div> --}}
                        </div> {{-- Chiusura info container --}}
                    </div> {{-- Chiusura col-12 --}}
                </div> {{-- Chiusura row --}}
            </div> {{-- Chiusura Container --}}
        </div> {{-- Chiusura info sextion --}}

        {{-- Sezione menu e carrello--}}
        <section class="dishes-section">
            <div class="container">
                <div class="row">
                    {{-- Piatti --}}
                    <div class="col-8">
                        <div class="menu-title">
                            <h1 class="text-uppercase">
                                Menù
                            </h1>
                        </div>

                        {{-- Contenitore lista piatti del menù --}}
                        <div class="dish-container">
                            {{-- Card piatto --}}
                            <div class="card" style="width: 18rem;" v-if="dish.visible" v-for="dish in dishes">

                                {{-- Immagine piatto --}}
                                <div v-if="dish.img_cover"  class="cover-container">
                                    <img :src="'../storage/' + dish.img_cover" class="card-img-top" />
                                </div>
                                <div  v-else class="card-header rounded">
                                    <span>Immagine non presente</span>
                                </div>

                                {{-- Info piatto --}}
                                <div class="card-body">
                                    <h5 class="card-title">@{{ dish.name }}</h5>
                                    <p class="card-text">@{{ dish.ingredients }}</p>
                                    <p class="card-text">@{{ dish.description }}</p>
                                    <h5 class="card-text">@{{ dish.unit_price }} €</h5>
                                    <a id="chart-button" class="btn btn-sm btn-primary" @click="decrease(dish.id)">-</a>
                                    <a id="chart-button" class="btn btn-sm btn-primary" @click="add(dish)">+</a>
                                </div>
                            </div>
                        </div>
                    </div>{{-- Chiusura col-9 -> Piatti --}}


                    {{-- Carrello --}}
                    <div class="col-4 cart py-3">
                        <h5>Carrello</h5>

                        {{-- Lista elementi del carrello --}}
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0" v-for="cartItem in cart.contents">
                                {{-- Quantità con pulsanti aggiungi/togli --}}
                                <div class="quantity">
                                    <a class="btn btn-primary-alt" @click="decrease(cartItem.id)">-</a>
                                    <span>@{{ cartItem.quantity }}</span>
                                    <a class="btn btn-primary-alt" @click="add(cartItem)">+</a>
                                </div>

                                {{-- Nome --}}
                                <div class="name">
                                    @{{ cartItem.name }}
                                </div>

                                {{-- Prezzo --}}
                                <div class="price">
                                    <span>@{{ cartItem.unit_price }} €</span>
                                </div>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 my-3 subtot">
                                <div>
                                    <strong>Subtotale</strong>
                                    {{-- <strong>
                                        <p class="mb-0">(IVA inclusa)</p>
                                    </strong> --}}
                                </div>
                                <span><strong>@{{ cart.subtotal }} €</strong></span>
                            </li>
                        </ul>

                        {{-- Bottoni per checkout e per svotare carrello  --}}
                        <div class="buttons-group" v-if="cart.subtotal != 0 ">
                            <a href="{{ route('guest.checkout', ['id'=>$restaurant->id]) }}" class="btn btn-primary-brand" >
                                Vai alla cassa
                            </a>
                            <button type="button" class="btn btn-danger ml-2" name="button" @click="empty"><i class="fas fa-trash-alt"></i></button>
                        </div>

                    </div> {{-- Chiusura col-4 -> Carrello --}}
                </div>{{-- Fine row --}}
            </div>{{-- Fine container --}}
        </section>

        <div class="container">

        </div>
        {{-- @php
        echo json_encode($restaurant);
    @endphp --}}
</div>

@endsection
