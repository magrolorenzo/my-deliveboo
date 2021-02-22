@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
<script src="{{ asset('js/homepage.js') }}" defer></script>
@endsection

@section('content')
<div id="app">

        {{-- Navbar con search bar --}}
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container d-flex justify-content-center">
                <div class="input-group w-50">
                    <input type="text" class="form-control" placeholder="Ristoranti, tipi di cucina...">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav> --}}

        <div class="container mb-4">
            <div class="row">
                <div class="d-flex flex-wrap">
                    <div v-for="(category,index) in categories" class="btn ml-2" :class="selectedCategories.includes(category.id)? 'btn-warning' : 'btn-primary'" @click="selectedCategory(category.id)"  >
                        <span>@{{category.name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="container">
            <div class="row">
                <div class="d-flex flex-wrap col-lg-12">
                    <div class="card " v-for="(restaurant,index) in restaurants">
                        {{-- Info ristorante --}}
                        <div class="card-body">
                            <h5>@{{ restaurant.id }} - @{{ restaurant.name }}</h5>
                            <p class="card-text">
                                <strong>Indirizzo:</strong> @{{ restaurant.address }}
                            </p>
                            <p class="card-text">
                                <strong>P.IVA:</strong> @{{restaurant.piva }}
                            </p>
                            <p class="card-text">
                                <strong>Categorie:</strong> <span v-for="category in restaurant.categories"> @{{category.name}}</span>
                            </p>
                        </div>

                        {{-- Immagine cover ristorante --}}
                        <div class="cover-container">
                            {{-- <img :src="url_base + restaurant.img_cover" alt="" class="card-img-top" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection