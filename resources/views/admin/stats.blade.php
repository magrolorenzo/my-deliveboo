@extends('layouts.dashboard')

@section('script')
<script src="{{ asset('js/stats.js') }}" defer></script>

@endsection

@section('content')
<div id="app">
    <div class="container ">
        <div class="row">
            <div class="col-md-12 d-md-flex justify-content-between flex-wrap">
                <input type="hidden" id="user-id" value="{{Auth::User()->id}}" />
                <select @change="changeRestaurant($event)" name="" id="selectRestaurant">
                    <option :value="restaurant.id" v-for="restaurant in restaurants">@{{restaurant.name}}</option>

                </select>
                <canvas id="myChart" width="400" height="400"></canvas>
                <canvas id="myNewChart" width="400" height="400"></canvas>


            </div>
        </div>
    </div>

</div>
@endsection