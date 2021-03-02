@extends('layouts.dashboard')

@section('content')

    <div class="table-container ">
        <!-- titolo pagina -->
        <div class="title my-2">
            <h1>
                Dettagli ordine
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
                    <th scope="col">Nome piatto</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Quantità</th>
                </tr>
            </thead>

            <!-- righe -->
            <tbody>
                @foreach ($orderDetails->order_items as $item)
                    <tr>
                        <th scope="row"  class="align-middle">{{ $item->id }}</th>
                        <td  class="align-middle">{{ $item->dish_name }}</td>
                        <td  class="align-middle">{{ $item->unit_price }}€</td>
                        <td  class="align-middle">{{ $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.orders') }}" class="btn btn-primary">
                🠔 Indietro
            </a>
        </div>
    </div>

@endsection
