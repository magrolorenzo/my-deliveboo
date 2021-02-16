@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">I miei ristoranti</div>

                    @if(count($restaurants) > 0)
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @foreach ($restaurants as $restaurant)
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
                            @endforeach
                        </div>
                    @endif
                </div>
                <div>
                    <a class="btn btn-primary mt-3" href="{{route('admin.restaurants.create')}}">
                        Crea Ristorante
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
