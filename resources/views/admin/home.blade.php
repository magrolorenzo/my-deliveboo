@extends('layouts.dashboard')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12 d-md-flex justify-content-between flex-wrap">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="title my-2">
                    <h1>
                        I miei Ristoranti
                    </h1>
                </div>

                @if(count($restaurants) > 0)
                    @foreach ($restaurants as $restaurant)
                        <div class="card restaurant-dashboard-card w-100 justify-content-between my-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $restaurant->id }} - {{ $restaurant->name }}</h5>
                                <p class="card-text">Indirizzo: {{ $restaurant->address }}</p>
                                <p class="card-text">P. IVA: {{ $restaurant->piva }}</p>
                                <a class="btn btn-secondary d-none d-md-inline-block" href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}">
                                    Modifica
                                </a>
                            </div>

                            <!-- img di copertirna -->
                            <div class="restaurant-img-container">
                                @if($restaurant->img_cover)
                                    <img class="restaurant-img" src="{{ asset("storage/".$restaurant->img_cover) }}" alt="">
                                @else
                                    <img class="restaurant-img" src="{{ asset("storage/images/img-not-found.png") }}" alt="">                                    
                                @endif
                            </div>

                        </div>
                    @endforeach
                @endif

                {{-- Bottone per creare un nuovo ristorante --}}
                <div class="d-none d-md-block">
                    <a class="btn btn-secondary mt-3" href="{{ route('admin.restaurants.create') }}">Crea nuovo ristorante</a>
                </div>

            </div>
        </div>
    </div>
@endsection
