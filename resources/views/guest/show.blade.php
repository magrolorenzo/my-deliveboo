@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
    <script src="{{ asset('js/show_restaurant.js') }}" defer></script>
@endsection

@section('content')
    <div id="app">

        {{-- Sezione con info del ristorante --}}
        <section class="info-section" style="background-image: url({{ asset('storage/'.$restaurant->img_cover) }}); background-position: center; background-size: cover">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="info-container">

                            {{-- Sezione di sinistra con info ristorante --}}
                            <div class="restaurant-info p-5">
                                <h1 id="restaurant-id" class="text-capitalize" hidden>{{ $restaurant->id }}</h1>

                                {{-- Nome Ristorante --}}
                                <h1 id="restaurant-name" class="text-capitalize">{{ $restaurant->name }}</h1>

                                <p class="address"><span><i class="fas fa-map-marker-alt restaurant-icon"></i></span> Indirizzo: {{ $restaurant->address}}</p>

                                {{-- Lista categorie ristorante --}}
                                <p class="info-res">
                                    <span><i class="fas fa-utensils restaurant-icon"></i></span> Categorie:
                                    @foreach ($restaurant->categories as $category)
                                        <span class="badge badge-info">{{ $category->name }}</span>
                                    @endforeach
                                </p>

                                <p><span><i class="fas fa-shipping-fast restaurant-icon"></i></span> Consegna gratuita</p>

                            </div>

                            {{-- Sezione di destra con immagine ristorante --}}
                            {{-- <div class="info-container-right rounded">
                                <img src="{{ asset("storage/".$restaurant->img_cover) }}" class="rounded">
                            </div> --}}
                        </div> {{-- Chiusura info container --}}
                    </div> {{-- Chiusura col-12 --}}
                </div> {{-- Chiusura row --}}
            </div> {{-- Chiusura Container --}}
        </section> {{-- Chiusura info sextion --}}

        {{-- Sezione menu e carrello--}}
        <section class="dishes-section">
            <div class="container">
                <div class="row">
                    {{-- Titolo --}}
                    <div class="col-12 col-lg-8">
                        <div class="menu-title mt-2">
                            <h3>
                                Lista dei piatti
                            </h3>
                        </div>

                        {{-- Contenitore lista piatti del menù --}}
                        <div class="container-fluid p-0">
                            <div class="row">
                                {{-- Card piatto --}}
                                <div class="col-12 col-md-6" v-if="dish.visible" v-for="dish in dishes">
                                    <div class="dish-card my-2 p-2" :class="getCartQuantity(dish.id) != 0 ? 'addedToCart' : ''">
                                        {{-- Info piatto --}}
                                        <div class="dish-info">
                                            <div class="info" @click="dishInfo(dish)">
                                                <h5 class="card-title capitalize">@{{ dish.name }}</h5>
                                                <i class="fas fa-info-circle"></i>
                                                <p class="card-text">@{{ dish.unit_price }} €</p>
                                            </div>

                                            <div class="quantity">
                                                <a class="btn btn-primary-alt" @click="decrease(dish.id)">-</a>
                                                <span>@{{ getCartQuantity(dish.id) }}</span>
                                                <a class="btn btn-primary-alt" @click="add(dish)">+</a>
                                            </div>
                                        </div>

                                        {{-- Immagine piatto --}}
                                        <div v-if="dish.img_cover"  class="dish-img">
                                            <img :src="'../storage/' + dish.img_cover" class="card-img-top" />
                                        </div>
                                    </div>
                                </div>{{-- Chiusura col-6 -> Card Piatti --}}
                            </div>
                        </div>{{-- Chiusura row -> Card Piatti --}}
                    </div>{{-- Chiusura col-8 -> Piatti --}}



                    {{-- Carrello --}}
                    <div id="cart" class="col-12 col-lg-4 cart py-3">
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
                                    <strong>Totale</strong>
                                    {{-- <strong>
                                        <p class="mb-0">(IVA inclusa)</p>
                                    </strong> --}}
                                </div>
                                <span><strong>@{{ cart.subtotal }} €</strong></span>
                            </li>
                        </ul>

                        {{-- Bottoni per checkout e per svotare carrello  --}}
                        <div class="buttons-group" v-if="cart.subtotal != 0">
                            <a href="{{ route('guest.checkout', ['id'=>$restaurant->id]) }}" class="btn btn-primary-brand" >
                                Vai alla cassa
                            </a>
                            <button type="button" class="btn btn-danger ml-2" name="button" @click="empty"><i class="fas fa-trash-alt"></i></button>
                        </div>

                    </div> {{-- Chiusura col-4 -> Carrello --}}
                </div>{{-- Fine row --}}
            </div>{{-- Fine container --}}
        </section>

        <div class="selected-dish-info" v-if="dishSelected">
            <div class="card-dish-selected">
                <div class="header">
                    <h5 class="text-uppercase m-0">@{{ thisSelectedDish.name }}</h5>
                    <div class="close-dish-info" @click="closeDishInfo">
                        <i class="fas fa-times"></i>
                    </div>
                </div>

                <div class="body p-4">
                    <div class="dish-img" v-if="thisSelectedDish.img_cover">
                        <img :src="'../storage/' + thisSelectedDish.img_cover" :alt="thisSelectedDish.name">
                    </div>

                    <div class="dish-description">
                        <p>Descrizione: @{{ thisSelectedDish.description ? thisSelectedDish.description : 'Descrizione non disponibile' }}</p>
                        <p>Ingredienti: @{{ thisSelectedDish.ingredients ? thisSelectedDish.ingredients : 'Ingredienti non disponibili' }}</p>
                        <p>Prezzo: @{{ thisSelectedDish.unit_price }}€</p>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
