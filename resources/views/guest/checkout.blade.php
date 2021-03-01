@extends('layouts.app')
@section('page-title', 'Checkout Page')

@section('script')
    <script src="{{ asset('js/payment.js') }}" defer></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
@endsection

@section('content')
    <div id="app">

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


                        <!-- Carrello -->
                        <div class="form-row">

                            {{-- Card Carrello --}}
                            <div class="card border-info mt-2 mb-2 col-12 col-md-5 p-0">

                                <div class="card-header  text-white bg-info">
                                    <h4>Riepilogo Carrello:</h4>
                                </div>

                                <div class="card-body">
                                    <h5>Ristorante:</h5>
                                    <p>
                                        <input type="text" name="restaurant_id" class="form-control d-none" v-model="currentRestaurantId">
                                        {{$restaurant->name}} - #<span  id="restaurant-id">{{$restaurant->id}}</span>
                                    </p>
                                        
                                    {{-- <h6>
                                        <strong>Ristorante: </strong>{{$restaurant->name}} - #<span id="restaurant-id">{{$restaurant->id}}</span>
                                    </h6> --}}

                                    <!-- Elementi nel carrello -->
                                    <div class="cart-items-wrapper">

                                        <div v-for="cartItem in cart.contents" class="row text-center align-items-center mt-1 mb-1 ">
                                            {{-- Nome piatto --}}
                                            <div class="col-4 p-0">
                                                <span>
                                                    @{{ cartItem.name }}
                                                </span>
                                            </div>
                                            {{-- Tasto - --}}
                                            <div class="col-1 p-0">
                                                <a class="btn btn-sm btn-danger" @click="decrease(cartItem.id)"><i class="fas fa-minus"></i></a>
                                            </div>
                                            {{-- Quantità selezionata --}}
                                            <div class="col-3 p-0">
                                                <span>
                                                    <strong>
                                                        x @{{ cartItem.quantity }}
                                                    </strong>
                                                </span>
                                            </div>
                                            {{-- Tasto + --}}
                                            <div class="col-1 p-0">
                                                <a class="btn btn-sm btn-success" @click="add(cartItem)"><i class="fas fa-plus"></i></a>
                                            </div>
                                            <div class="col-3 p-0">
                                                <span>@{{ cartItem.unit_price }} €</span>
                                            </div>
                                        </div>

                                        <!-- Totale -->
                                        <div class="row mt-2 text-center">
                                            <div class="col-4 p-0">
                                                <strong>Totale</strong>
                                                <strong>
                                                    <p class="mb-0">(IVA inclusa)</p>
                                                </strong>
                                            </div>

                                            <div class="col-3 offset-5 p-0">
                                                <span><strong>@{{ cart.subtotal }} €</strong></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


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
                        </div>

                        <div class="d-none">
                            <!-- Hidden inputs  -->
                            {{-- JSON Carrello --}}
                            <input type="text" name="currentCart" class="form-control" v-model="JSONCart" readonly hidden>
                            {{-- Braintree Token --}}
                            <span id="token" hidden >{{$token}}</span>
                            {{-- Braintree Nonce --}}
                            <input id="nonce" name="payment_method_nonce" type="hidden" readonly />
                        </div>

                        <!-- BTN di submit del form -->
                        <div class="text-center mt-3 mb-2">
                            <button class="btn btn-primary" type="button" @click="checkInput">
                                Verifica
                            </button>
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
