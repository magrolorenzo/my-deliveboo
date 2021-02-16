@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    @if(count($restaurants) > 0)
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @foreach ($restaurants as $restaurant)
                                <p>{{$restaurant->name}}</p>
                                <p>{{$restaurant->address}}</p>
                                <p>{{$restaurant->piva}}</p>
                                <p>
                                    <a class="btn btn-warning" href="{{route('admin.restaurants.edit', ['restaurant' => $restaurant->slug])}}">
                                        Modifica Ristorante
                                    </a>
                                </p>
                            @endforeach
                        </div>
                    @else
                        <div>
                            <a class="btn btn-primary" href="{{route('admin.restaurants.create')}}">
                                Crea Ristorante
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
