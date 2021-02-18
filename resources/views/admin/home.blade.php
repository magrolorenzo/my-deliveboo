@extends('layouts.dashboard')

@section('content')
    <div class="container ">

        <h1>
            I miei Ristoranti
        </h1>

        <div class="row">
            <div class="col-md-12 d-md-flex justify-content-between flex-wrap">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if(count($restaurants) > 0)
                    @foreach ($restaurants as $restaurant)

                        <div class="card mt-3 mw-30">
                            <div class="card-header">{{$restaurant->id}} - {{$restaurant->name}}</div>
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <div class="restaurant-infos">
                                        <p><strong>ID Ristorante:</strong> {{$restaurant->id}}</p>
                                        <p><strong>Nome Ristorante:</strong> {{$restaurant->name}}</p>
                                        <p><strong>Indirizzo:</strong> {{$restaurant->address}}</p>
                                        <p><strong>P.IVA:</strong> {{$restaurant->piva}}</p>
                                    </div>
                                    {{-- Se è presente un'immagine di copertina del ristorante visualizzala --}}
                                    @if($restaurant->img_cover)
                                        <div class="d-inline-block">
                                            <img src="{{asset("storage/".$restaurant->img_cover)}}" alt="" class="w-50">
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a class="btn btn-warning mt-3" href="{{route('admin.restaurants.edit', ['restaurant' => $restaurant->slug])}}">
                                        Modifica Ristorante
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Bottone per creare un nuovo ristorante --}}
            <div>
                <a class="btn btn-primary mt-3" href="{{route('admin.restaurants.create')}}">Crea Ristorante</a>
            </div>

        </div>
    </div>
@endsection
