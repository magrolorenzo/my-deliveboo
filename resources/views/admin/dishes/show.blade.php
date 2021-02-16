@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h2>Dettagli piatto</h2>
                    </div>

                    <div class="card-body">
                        <p>Nome Piatto: {{$dish->name}}</p>
                        <p>Nome Ristorante: {{$dish->restaurant->name}}</p>

                        <p>Ingredienti</p>
                        <p>{{$dish->ingredients}}</p>

                        <p>Descrizione</p>
                        <p>{{$dish->description}}</p>
                        <p>Prezzo: {{$dish->unit_price}} €</p>
                        {{-- <div >
                            <img src="" alt="">
                        </div> --}}
                        <p>Visibilità: {{$dish->visible == 0 ? "Non Visibile" : "Visibile"}}</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">
                        🠔 Indietro
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
