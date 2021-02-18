@extends('layouts.app')

@section('page-title', 'pagina prova')

@section('script')

<script src="{{ asset('js/homepage.js') }}" defer></script>

@endsection


@section('content')
<div id="app">
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
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img :src="url_base + dishes[0].img_cover" alt="" class="card-img-top" />
                    <div class="card-body">
                        <h1>{{ dishes[0].name }}</h1>
                        <p class="card-text">
                            {{ dishes[0].ingredients }}
                        </p>
                        <p class="card-text">
                            {{ dishes[0].description }}
                        </p>
                        <p class="card-text">{{ dishes[0].unit_price }} €</p>
                        <p class="card-text">
                            {{ dishes[0].visible }}
                        </p>
                        <a href="" class="btn btn-outline-success btn-sm">Read More</a>
                        <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection