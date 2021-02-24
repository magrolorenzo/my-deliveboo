@extends('layouts.app')
@section('page-title', 'Checkout Page')

@section('script')
    {{-- <script src="{{ asset('js/show_restaurant.js') }}" defer></script> --}}
@endsection

@section('content')
    <div id="app">

        <div class="container mt-5">
            <div class="row">

                {{-- Sezione form Cliente --}}
                <div class="col-5 shadow">
                    <h2>Inserisci qui i tuoi dati</h2>
                    <form action="" method="post">
                        @csrf

                        {{-- Nome Cliente --}}
                        <div class="form-group w-50 d-inline-block">
                            <label>Nome</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Inserisci il tuo Nome" value="{{old('customer_name')}}" required>
                        </div>

                        {{-- Cognome Cliente --}}
                        <div class="form-group w-50 d-inline-block">
                            <label>Cognome</label>
                            <input type="text" name="customer_surname" class="form-control" placeholder="Inserisci il tuo Cognome" value="{{old('customer_surname')}}" required>
                        </div>

                        {{-- e-mail Cliente --}}
                        <div class="form-group w-50 d-inline-block">
                            <label>E-mail</label>
                            <input type="text" name="customer_email" class="form-control" placeholder="Inserisci la tua e-mail" value="{{old('customer_email')}}" required>
                        </div>

                        {{-- Indirizzo di consegna --}}
                        <div class="form-group w-50 d-inline-block">
                            <label>Indirizzo di consegna</label>
                            <input type="text" name="delivery_address" class="form-control" placeholder="Inserisci l'indirizzo di consegna" value="{{old('delivery_address')}}" required>
                        </div>
                        {{-- <div class="form-group">
                            <button type="submit" class="btn btn-success">Crea Piatto</button>
                        </div> --}}
                    </form>
                </div>

                {{-- Sezione riepilogo Ordine --}}
                <div class="col-5 offset-2 shadow">
                    <h2>Riepilogo Ordine</h2>
                    <p>Inserire qui carrello con possibilità di modificare le quantità dei prodotti</p>
                </div>
            </div>

            {{-- Sezione di pagamento --}}
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 shadow">
                        <h2>Pagamento</h2>
                    </div>
                </div>
            </div>



            {{-- <footer>
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

</footer> --}}


</div>
@endsection
