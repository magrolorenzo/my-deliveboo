@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
    <script src="{{ asset('js/homepage.js') }}" defer></script>
@endsection

@section('content')
    <div id="app">

        {{-- Navbar con search bar --}}
        <nav class="navbar navbar-expand-md navbar-light bg-light">
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
        </nav>
        <div class="container">
            <div class="row">
                <div class="d-flex  flex-wrap">
                    <div @click="selectedCategory(category.id)" class="card col-lg-4" v-for="(category,index) in categories">
                        <p>@{{category.name}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="d-flex  flex-wrap">
                    <div class="card col-lg-4" v-for="(restaurant,index) in restaurants">
                        <p>@{{restaurant.name}}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Container con carte --}}
        <div class="container">

            <div class="row">

                <div class="d-flex flex-wrap">

                    <div class="card col-lg-4" v-for="(dish,index) in dishes">

                        <img :src="url_base + dishes[index].img_cover" alt="" class="card-img-top" />

                        <div class="card-body">
                            <h1>@{{ dishes[index].id }} - @{{ dishes[index].name }}</h1>
                            <p class="card-text">
                                @{{ dishes[index].ingredients }}
                            </p>
                            <p class="card-text">
                                @{{ dishes[index].description }}
                            </p>
                            <p class="card-text">
                                @{{ dishes[index].unit_price }} €
                            </p>
                            <p class="card-text">
                                @{{ dishes[index].visible }}
                            </p>
                            <a href="" class="btn btn-outline-success btn-sm">Read More</a>
                            <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                        </div>

                    </div>

                </div>{{-- Chiusura Column --}}

            </div>{{-- Chiusura Row --}}

        </div> {{-- Chiusura container --}}

    </div>

@endsection
