@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <h4>Dettagli piatto</h4>
                    </div>

                    <div class="card-body">
                        <div class="dish-infos">
                            <p><strong>Nome Piatto:</strong> {{$dish->name}}</p>
                            <p><strong>Nome Ristorante:</strong> {{$dish->restaurant->name}}</p>
                            <p><strong>Ingredienti:</strong> {{$dish->ingredients}}</p>
                            <p><strong>Descrizione:</strong> {{$dish->description? $dish->description : "/" }}</p>
                            <p><strong>Prezzo:</strong> {{$dish->unit_price}} €</p>
                            <p><strong>Visibilità</strong>: {{$dish->visible == 0 ? "Non Visibile" : "Visibile"}}</p>
                        </div>
                        <div>
                            @if($dish->img_cover)
                                <img src="{{asset("storage/".$restaurant->img_cover)}}" alt="{{$dish->name}}" class="w-50">
                            @else
                                <p>Nessuna immagine caricata</p>
                            @endif
                        </div>
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
