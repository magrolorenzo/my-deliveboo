<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function filtered($id)
    {
        $categoria = Category::find($id);
        $ristoranti_selezionati = $categoria->restaurants;
        return response()->json([
            'success' => true,
            'results' => $ristoranti_selezionati
        ]);
    }
}
