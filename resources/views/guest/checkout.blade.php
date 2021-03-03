@extends('layouts.app')
@section('page-title', 'Checkout Page')

@section('script')
    <script src="{{ asset('js/payment.js') }}" defer></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
@endsection

@section('content')
    <div id="app" v-cloak>

        <div class="container mt-5">

            <div class="row">

                <div class="col-12 mb-5 ">

                    <h2>Inserisci i tuoi dati</h2>

                    <div class="errors-list mt-4 mb-4" v-if="errors.length">
                        <p class="alert alert-danger m-0" v-for="error in errors">@{{error}}</p>
                    </div>

                    <!-- Inizio form -> pagamento -->
                    <form name="checkoutform" method="post" id="payment-form" action="{{route("guest.pay")}}" >
                        @csrf

                        <div class="form-row">
                            <!-- Nome -->
                            <div class="form-group col">
                                <label>
                                    Nome
                                </label>
                                <input type="text" value="Marco" name="customer_name" class="form-control" maxlength="30" placeholder="Inserisci il tuo Nome" value="{{old('customer_name')}}" required>
                                @error('customer_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Cognome -->
                            <div class="form-group col">
                                <label>
                                    Cognome
                                </label>
                                <input type="text" value="Rossi" name="customer_surname" class="form-control" maxlength="30" placeholder="Inserisci il tuo Cognome" value="{{old('customer_surname')}}" required>
                                @error('customer_surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label>
                                E-mail
                            </label>
                            <input type="text" value="marco.rossi@guest.com" name="customer_email" class="form-control" placeholder="Inserisci la tua e-mail" value="{{old('customer_email')}}" required>
                            @error('customer_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Indirizzo di spedizione -->
                        <div class="form-group">
                            <label>
                                Indirizzo di consegna
                            </label>
                            <input type="text" value="Via Delle Nazioni 20, Roma" name="delivery_address" class="form-control" placeholder="Inserisci l'indirizzo di consegna" value="{{old('delivery_address')}}" required>
                            @error('delivery_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Carrello e Barintree row -->
                        <div class="form-row">

                            {{-- Carrello Marco --}}
                            <div id="cart" class="cart py-3  mt-2 mb-2 col-12 col-md-5">
                                <h5>
                                    {{$restaurant->name}} - #<span  id="restaurant-id">{{$restaurant->id}}</span>
                                </h5>

                                {{-- Lista elementi del carrello --}}
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0" v-for="cartItem in cart.contents">
                                        {{-- Quantità con pulsanti aggiungi/togli --}}
                                        <div class="quantity">
                                            <a class="btn btn-primary-alt" @click="decrease(cartItem.id)"><i class="fas fa-minus"></i></a>
                                            <span>@{{ cartItem.quantity }}</span>
                                            <a class="btn btn-primary-alt" @click="add(cartItem)"><i class="fas fa-plus"></i></a>
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
                                        </div>
                                        <span><strong>@{{ cart.subtotal }} €</strong></span>
                                    </li>
                                </ul>

                            </div> {{-- Chiusura col-4 -> Carrello --}}

                            <!-- Braintree section -->
                            <div class="col d-flex justify-content-center">
                                <section >
                                    <label for="amount">
                                        <div class="input-wrapper amount-wrapper">
                                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" :value="cart.subtotal" readonly hidden>
                                        </div>
                                        <div class="bt-drop-in-wrapper">
                                            <div id="bt-dropin"></div>
                                        </div>
                                    </label>
                                </section>
                            </div>
                        </div> {{-- Chiusura form-row --}}

                        <div class="d-none">
                            <!-- Hidden inputs  -->
                            {{-- ID ristorante --}}
                            <input type="text" name="restaurant_id" class="form-control d-none" v-model="currentRestaurantId">
                            {{-- JSON Carrello --}}
                            <input type="text" name="currentCart" class="form-control" v-model="JSONCart" readonly hidden>
                            {{-- Braintree Token --}}
                            <span id="token" hidden >{{$token}}</span>
                            {{-- Braintree Nonce --}}
                            <input id="nonce" name="payment_method_nonce" type="hidden" readonly />
                        </div>

                        <!-- BTN di submit del form -->
                        <div class="text-center mt-3 mb-2">
                            <button class="btn btn-success" type="submit">
                                <span>Paga e ordina</span>
                            </button>
                        </div>

                    </form>
                </div><!-- END col-12 -->
            </div><!-- END row -->
        </div><!-- END container -->
    </div>
@endsection
