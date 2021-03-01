@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="errors-root" class="col-md-8">
                <h1>Modifica il piatto</h1>
                <div class="errors-list mt-4 mb-4" v-if="errors.length">
                    <p class="alert alert-danger m-0" v-for="error in errors">@{{error}}</p>
                </div>
                <form id="dish-form" name="dishform" action="{{ route('admin.dishes.update', ['dish' => $dish->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nome Piatto</label>
                        <input type="text" name="name" class="form-control" placeholder="Inserisci il nome del piatto" value="{{old('name', $dish->name)}}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group w-30 d-inline-block">
                        <label>I miei ristoranti</label>
                        <select name="restaurant_id">
                            <option value="">Seleziona un ristorante</option>
                            @foreach (Auth::user()->restaurants as $restaurant)
                                <option value="{{$restaurant->id}}" {{old('restaurant_id', $dish->restaurant_id) == $restaurant->id ? 'selected' : ''}}>
                                    {{$restaurant->id}} - {{$restaurant->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('restaurant_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Ingredienti</label>
                        <textarea name="ingredients" class="form-control" rows="8" cols="80" placeholder="Inserisci gli ingredienti">{{old('ingredients', $dish->ingredients)}}</textarea>
                        @error('ingredients')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="8" cols="80" placeholder="Inserisci la descrizione">{{
                            old('description', $dish->description)
                        }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Prezzo</label>
                        <input name="unit_price" type="number" min="0.01" max="999.99" step="0.01" class="form-control" placeholder="Inserisci il prezzo" required value="{{old('unit_price', $dish->unit_price)}}">
                        @error('unit_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input name="img_file" type="file" class="form-control-file">
                        @error('img_file')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <p>Seleziona la visibilità:</p>
                        <div class="form-check">
                            <input name="visible" class="form-check-input" type="radio" value="0"
                            {{ old('visible', $dish->visible) == "0" ? 'checked=checked' : '' }}>
                            <label class="form-check-label">
                                Non visibile
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="visible" class="form-check-input" type="radio" value="1"
                            {{ old('visible', $dish->visible) == "1" ? 'checked=checked' : '' }}>

                            <label class="form-check-label">
                                Visibile
                            </label>
                        </div>

                        @error('visible')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        {{-- @click="validateDish" --}}
                        <button type="submit" class="btn btn-success" @click="validateDish">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Aggiorna i dati del piatto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/validation.js') }}" defer></script>
@endsection
