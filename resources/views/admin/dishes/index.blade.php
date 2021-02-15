@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="{{ route('admin.dishes.create') }}" class="btn btn-success">
                Aggiungi un piatto
            </a>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ingredienti</th>
                        <th scope="col">Prezzo unitario</th>
                        <th scope="col">Visibile</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Modifica</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <th scope="row">{{ $dish->id }}</th>
                            <td>{{ $dish->name }}</td>
                            <td>{{ $dish->ingredients }}</td>
                            <td>{{ $dish->unit_price }}</td>
                            <td>{{ $dish->visible }}</td>
                            <td>{{ $dish->description }}</td>
                            <td class="w-25">
                                <a href="#" class="btn btn-outline-info">
                                    Vedi
                                    {{-- {{ route('admin.dish.show', ['dish' => $dish -> id]) }} --}}
                                </a>
                                <a href="#" class="btn btn-outline-dark">
                                    Modifica
                                    {{-- {{ route('admin.dishs.edit', ['dish' => $dish -> id]) }} --}}
                                </a>
                                <form class="d-none" action="#" method="post">
                                    {{-- {{ route('admin.dishs.destroy', ['dish' => $dish -> id]) }} --}}
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" name="button" class="btn btn-outline-danger">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
