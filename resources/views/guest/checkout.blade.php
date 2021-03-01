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
            <div class="col-12">

                <div class="errors-list mt-4 mb-4" v-if="errors.length">
                    <p class="alert alert-danger m-0" v-for="error in errors">@{{error}}</p>
                </div>

                <!-- Inizio form -> pagamento -->
                <form name="checkoutform" method="post" id="payment-form" action="{{route("guest.pay")}}">
                    @csrf

                    <h2>Inserisci i tuoi dati</h2>
                    <!-- Nome -->
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" value="prova" name="customer_name" class="form-control" maxlength="30" placeholder="Inserisci il tuo Nome" value="{{old('customer_name')}}" required>
                        @error('customer_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Cognome -->
                    <div class="form-group">
                        <label>Cognome</label>
                        <input type="text" value="prova" name="customer_surname" class="form-control" maxlength="30" placeholder="Inserisci il tuo Cognome" value="{{old('customer_surname')}}" required>
                        @error('customer_surname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" value="prova" name="customer_email" class="form-control" placeholder="Inserisci la tua e-mail" value="{{old('customer_email')}}" required>
                        @error('customer_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Indirizzo di spedizione -->
                    <div class="form-group">
                        <label>Indirizzo di consegna</label>
                        <input type="text" value="prova" name="delivery_address" class="form-control" placeholder="Inserisci l'indirizzo di consegna" value="{{old('delivery_address')}}" required>
                        @error('delivery_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Carrello -->
                    <div class="card-body">
                        <h5>Ristorante:</h5>
                        <p>
                            <input type="text" name="restaurant_id" class="form-control d-none" v-model="currentRestaurantId">
                            {{$restaurant->name}} - #<span id="restaurant-id">{{$restaurant->id}}</span>
                        </p>

                        <!-- Elementi nel carrello -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0" v-for="cartItem in cart.contents">
                                @{{ cartItem.name }}
                                <a class="btn btn-sm btn-primary" @click="decrease(cartItem.id)">-</a>
                                <span>x@{{ cartItem.quantity }}</span>
                                <a class="btn btn-sm btn-primary" @click="add(cartItem)">+</a>
                                <span>@{{ cartItem.unit_price }} €</span>
                            </li>
                            <!-- Totale -->
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
                    </div>

                    <!-- Hidden input -> Carrello JSON -->
                    <input type="text" name="currentCart" class="form-control" v-model="JSONCart">

                    <!-- Braintree section -->
                    <section>
                        <label for="amount">
                            <span class="input-label">Amount</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" :value="cart.subtotal" readonly>
                            </div>

                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </label>
                    </section>

                    <span id="token" hidden>{{$token}}</span>
                    <input id="nonce" name="payment_method_nonce" type="hidden" />

                    <!-- BTN di submit del form -->
                    <button class="btn btn-primary" type="button" @click="priceCheck">
                        Verifica
                    </button>
                    <button class="button" type="submit">
                        <span>Paga e ordina</span>
                    </button>

                </form>
            </div><!-- END col-12 -->
        </div><!-- END row -->
    </div><!-- END container -->
</div>
<!-- <script src="{{ asset('js/validation.js') }}" defer></script> -->
@endsection