@extends('layouts.dashboard')

@section('script')
    <script src="{{ asset('js/orders.js') }}" defer></script>
@endsection

@section('content')

    <div id="app" class="table-container ">

        <input id="user-id" type="text" value="{{ Auth::user()->id }}" hidden>

        <!-- titolo pagina -->
        <div class="title my-2">
            <h1>
                Tutti gli ordini
            </h1>
        </div>

        <!-- select Ristoranti dell'utente -->
        <h2>Filtra i tuoi ristoranti</h2>
        <select name="restaurant_id" @change="filterOrders($event)">
            <option value="">Tutti i ristoranti</option>
            <option :value="restaurant.id" v-for="restaurant in restaurants">
                @{{restaurant.id}} - @{{restaurant.name}}
            </option>
        </select>

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
                <tr v-for="order in orders" v-if="selectedRestaurantId == 0 || selectedRestaurantId == order.restaurant_id">
                    <th scope="row"  class="align-middle">@{{ order.id }}</th>
                    <td  class="align-middle">@{{ order.created_at }}</td>
                    <td  class="align-middle">@{{ order.restaurant_id }}</td>
                    <td  class="align-middle">@{{ order.amount }} €</td>
                    <td>
                        {{-- <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="btn btn-info">
                            Dettagli
                        </a> --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
