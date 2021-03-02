@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="card w-75 mb-4">

            <div class="card-header text-white bg-dark">
                <h4>Dettagli piatto: {{$dish->name}}</h4>
            </div>

            <div class="card-body d-flex justify-content-between">
                <div class="dish-infos">
                    <p><strong>ID Piatto:</strong> {{$dish->id}}</p>
                    <p><strong>Nome Piatto:</strong> {{$dish->name}}</p>
                    <p><strong>Nome Ristorante:</strong> {{$dish->restaurant->name}}</p>
                    <p><strong>Ingredienti:</strong> {{$dish->ingredients}}</p>
                    <p><strong>Descrizione:</strong> {{$dish->description? $dish->description : "/" }}</p>
                    <p><strong>Prezzo:</strong> {{$dish->unit_price}} €</p>
                    <p><strong>Visibilità</strong>: {{$dish->visible == 0 ? "Non Visibile" : "Visibile"}}</p>
                    <a href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}" class="btn btn-warning">
                        Modifica
                    </a>
                </div>
                <div class="dish-cover-container">
                    @if($dish->img_cover)
                        <img class="" src="{{asset("storage/".$dish->img_cover)}}" alt="{{$dish->name}}">
                    @else
                        <img class="" src="{{ asset("/images/img-not-found.png") }}" alt="img not found">
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
@endsection
