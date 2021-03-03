@extends('layouts.dashboard')

@section('script')
<script src="{{ asset('js/stats.js') }}" defer></script>

@endsection

@section('content')
<div id="app">
    <div class="container">
        <div class="row">
            <select class="mt-2" @change="changeRestaurant($event)" name="" id="selectRestaurant">
                <option :value="restaurant.id" v-for="restaurant in restaurants">@{{restaurant.name}}</option>
            </select>
            <div class="col-md-12 d-md-flex justify-content-between flex-wrap">
                <input type="hidden" id="user-id" value="{{Auth::User()->id}}" />
                <div class="row">
                    <div class="col-6">
                        <canvas id="myChart" width="1000" height="1000"></canvas>



                    </div>
                    <div class="col-6">
                        <canvas id="myNewChart" width="1000" height="1000"></canvas>


                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection