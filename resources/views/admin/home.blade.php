@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if(count($restaurants) > 0)
                    @foreach ($restaurants as $restaurant)
                        <div class="card mt-3">
                            <div class="card-header">{{$restaurant->name}}</div>

                            <div class="card-body">

                                <div class="d-inline-block">
                                    <p>Nome Ristorante: {{$restaurant->name}}</p>
                                    <p>Indirizzo: {{$restaurant->address}}</p>
                                    <p>P.IVA: {{$restaurant->piva}}</p>
                                    <div class="d-inline-block">
                                        <img src="{{asset("storage/".$restaurant->img_cover)}}" alt="" class="w-50">
                                    </div>
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
                <div>
                    <a class="btn btn-primary mt-3" href="{{route('admin.restaurants.create')}}">
                        Crea Ristorante
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
