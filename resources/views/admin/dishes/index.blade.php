@extends('layouts.dashboard')

@section('content')
    <!-- titolo pagina -->
    <div class="title my-2">
        <h1>
            I miei piatti
        </h1>
    </div>

    <!-- tabella piatti -->
    <table class="table">
        <!-- intestazione -->
        <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Ristorante</th>
                <th scope="col">Prezzo unitario</th>
                <th scope="col">Visibile</th>
                <th scope="col" class="btn-column">Modifica</th>
            </tr>
        </thead>

        <!-- righe -->
        <tbody>
            @foreach ($restaurants as $restaurant)
                @foreach ($restaurant->dishes as $dish)
                    <tr>
                        <th scope="row">{{ $dish->id }}</th>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->restaurant->id }} - {{ $dish->restaurant->name }}</td>
                        <td>{{ $dish->unit_price }} €</td>
                        <td>{{ $dish->visible == 0 ? "Non Visibile" : "Visibile" }}</td>
                        <td>
                            <a href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}" class="btn btn-outline-info">
                                Dettagli
                            </a>
                            <a href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}" class="btn btn-outline-dark">
                                Modifica
                            </a>
                            <form action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="button" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- btn aggiungi 1 piatto -->
    <div>
        <a href="{{ route('admin.dishes.create') }}" class="btn btn-success">
            Aggiungi un piatto
        </a>
    </div>
@endsection
