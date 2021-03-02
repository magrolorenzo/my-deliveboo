@extends('layouts.dashboard')

@section('content')

    <div class="table-container ">
        <!-- titolo pagina -->
        <div class="title my-2">
            <h1>
                Tutti gli ordini
            </h1>
        </div>

        {{-- <!-- select Ristoranti dell'utente -->
        <h2>Filtra i tuoi ristoranti</h2>
        <select name="restaurant_id">
            <option value="">Tutti i ristoranti</option>
            @foreach ($userRestaurants as $restaurant)
                <option value="{{$restaurant->id}}">
                    {{$restaurant->id}} - {{$restaurant->name}}
                </option>
            @endforeach
        </select> --}}

        <!-- tabella piatti -->
        <h2>I tuoi ordini</h2>
        <table class="table table-sm table-bordered table-hover text-center">
            <!-- intestazione -->
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ristorante</th>
                    <th scope="col">Totale</th>
                    <th scope="col">Modifica</th>
                </tr>
            </thead>

            <!-- righe -->
            <tbody>
                @foreach ($userRestaurants as $restaurant)
                    @foreach ($restaurant->orders as $order)
                        <tr>
                            <th scope="row"  class="align-middle">{{ $order->id }}</th>
                            <td  class="align-middle">{{ $order->created_at }}</td>
                            <td  class="align-middle">{{ $order->restaurant->id }} - {{ $order->restaurant->name }}</td>
                            <td  class="align-middle">{{ $order->amount }} €</td>
                            <td>
                                <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="btn btn-info">
                                    Dettagli
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
