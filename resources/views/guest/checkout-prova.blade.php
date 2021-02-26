@extends('layouts.app')
@section('page-title', 'Checkout Page')

@section('script')
    <script src="{{ asset('js/payment.js') }}" defer></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
@endsection

@section('content')
    <div id="app">
        <h1>Prova</h1>
        <div class="container mt-5">
            <div class="row">

                <form method="post" id="payment-form" action="{{route("guest.pay")}}">
                    @csrf

                    <h2>Inserisci i tuoi dati</h2>

                    {{-- Nome Cliente --}}
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" value="marco" name="customer_name" class="form-control" placeholder="Inserisci il tuo Nome" value="{{old('customer_name')}}" required>
                    </div>
                    {{-- Cognome Cliente --}}
                    <div class="form-group">
                        <label>Cognome</label>
                        <input type="text" value="marco" name="customer_surname" class="form-control" placeholder="Inserisci il tuo Cognome" value="{{old('customer_surname')}}" required>
                    </div>
                    {{-- e-mail Cliente --}}
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" value="marco" name="customer_email" class="form-control" placeholder="Inserisci la tua e-mail" value="{{old('customer_email')}}" required>
                    </div>
                    {{-- Indirizzo di consegna --}}
                    <div class="form-group">
                        <label>Indirizzo di consegna</label>
                        <input type="text" value="marco" name="delivery_address" class="form-control" placeholder="Inserisci l'indirizzo di consegna" value="{{old('delivery_address')}}" required>
                    </div>


                    {{-- Carrello --}}
                    <div class="card-body">

                        <h5>Ristorante:</h5>
                        <p>
                            <input type="text" name="restaurant_id" class="form-control d-none" v-model="currentRestaurantId">
                            {{$restaurant->name}} - #<span  id="restaurant-id">{{$restaurant->id}}</span>
                        </p>

                        {{-- Lista elementi del carrello --}}
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0" v-for="cartItem in cart.contents">
                                @{{ cartItem.name }}
                                <a class="btn btn-sm btn-primary" @click="decrease(cartItem.id)">-</a>
                                <span>x@{{ cartItem.quantity }}</span>
                                <a class="btn btn-sm btn-primary" @click="add(cartItem)">+</a>
                                <span>@{{ cartItem.unit_price }} €</span>
                            </li>
                            {{-- Totale Carrello --}}
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


                    <input type="text" name="currentCart" class="form-control d-none" v-model="JSONCart">


                    <section>
                        <label for="amount">
                            <span class="input-label">Amount</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" :value="cart.subtotal" readonly>
                            </div>
                        </label>

                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>

                    <span id="token" hidden>{{$token}}</span>
                    <input id="nonce" name="payment_method_nonce" type="hidden" />


                    <button class="button" type="submit">
                        <span>Paga e ordina</span>
                    </button>

                </form>



            </div>
        </div>
    </div>
@endsection
