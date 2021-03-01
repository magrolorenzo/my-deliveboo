@extends('layouts.dashboard')

@section('content')

    <div class="table-container ">


        <!-- titolo pagina -->
        <div class="title my-2">
            <h1>
                I miei piatti
            </h1>
        </div>

        <!-- tabella piatti -->
        <table class="table table-sm table-bordered table-hover text-center ">
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
                            <th scope="row"  class="align-middle">{{ $dish->id }}</th>
                            <td  class="align-middle">{{ $dish->name }}</td>
                            <td  class="align-middle">{{ $dish->restaurant->id }} - {{ $dish->restaurant->name }}</td>
                            <td  class="align-middle">{{ $dish->unit_price }} €</td>
                            <td  class="align-middle">{{ $dish->visible == 0 ? "NO" : "SI" }}</td>
                            <td>
                                <a href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}" class="btn btn-info">
                                    Dettagli
                                </a>
                                <a href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}" class="btn btn-warning">
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
                Aggiungi un piatto <i class="fas fa-plus"></i>
            </a>
        </div>

    </div>

@endsection
