<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;

class DishController extends Controller
{
    public function index(){
        $dishes = Dish::all();

        return response()->json([
            'success'=> true,
            'results'=> $dishes
        ]);
    }

    public function filterDishes($id) {
        $filteredDishes = Dish::where('restaurant_id', $id)->get();

        return response()->json([
            'success'=> true,
            'results'=> $filteredDishes
        ]);
    }
}
