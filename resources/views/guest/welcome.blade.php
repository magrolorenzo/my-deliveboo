@extends('layouts.app')
@section('page-title', 'Welcome Page')

@section('script')
    <script src="{{ asset('js/homepage.js') }}" defer></script>
@endsection

@section('content')
    <div id="welcome-blade">

        <div id="app">

            {{-- Container categorie --}}
            <div class="container mb-4 mt-4">

                <div class="categories-wrapper d-flex flex-wrap ">
                    {{-- Bottoni categorie --}}
                    <div v-for="(category,index) in categories" class="btn ml-1" :class="selectedCategories.includes(category.id)? 'btn-warning' : 'btn-primary'" @click="selectedCategory(category.id)"  >
                        <span>@{{category.name}}</span>
                    </div>
                    {{-- Bottone per svuotare i filtri applicati --}}
                    <div class="btn btn-warning ml-1" @click="clearCategories()">
                        Rimuovi filtri
                    </div>
                </div>                

            </div>

            <div class="container mb-4 mt-4">
                <div class="row">
                    <div class="d-flex flex-wrap justify-content-start col-lg-12">

                        {{-- Card ristorante --}}
                        <div v-for="(restaurant,index) in restaurants" class="card bg-light  ml-3 mb-3 restaurant-card" >

                            {{-- Cover image --}}
                            <div v-if="restaurant.img_cover"  class="cover-container ">
                                <img :src="url_base + restaurant.img_cover" :title="restaurant.id + ' - ' + restaurant.name" class="card-img-top img-fluid" />
                            </div>
                            {{-- Se non ha alcuna Cover image, visualizza card header --}}
                            <div  v-else class="card-header">
                                <span>Immagine non presente</span>
                            </div>
                            {{-- Card body con Info ristorante --}}
                            <div class="card-body">
                                <h5 class="card-title">@{{ restaurant.name }}</h5>
                                <p class="card-text">
                                    <strong>Indirizzo:</strong> @{{ restaurant.address }}
                                </p>
                                <p class="card-text">
                                    <strong>P.IVA:</strong> @{{restaurant.piva }}
                                </p>
                                <p class="card-text">
                                    <strong>Categorie:</strong> <span v-for="category in restaurant.categories" class="badge badge-info ml-1"> @{{category.name}}</span>
                                </p>

                                {{-- Bottone per show ristorante --}}
                                <div>
                                    <a :href="'/show/'+restaurant.slug" class="btn btn-success">
                                        Visualizza
                                    </a>
                                </div>
                            </div> {{-- Chiusura Card Body --}}
                        </div> {{-- Chiusura Card --}}
                    </div> {{-- Chiusura col--}}
                </div> {{-- Chiusura row --}}
            </div> {{-- Chiusura container --}}
        </div> {{-- Fine app Vue --}}
    </div> {{-- Fine sezione --}}
@endsection
