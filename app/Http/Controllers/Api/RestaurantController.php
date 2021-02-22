<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();

        // Ad ogni obj ristorante aggiungo array di categorie associate
        foreach ($restaurants as $this_restaurant) {
            $categories = [];
            $categories = $this_restaurant->categories;
            $this_restaurant->categories = $categories;
        };

        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function filtered($id)
    {
        // Richiamo solo ristoranti con categoria specificata nel parametro
        // Funzione wherehas permette di risalire alle categorie dei Ristoranti
        // Per usare un parametro usare use($parametro), in questo caso id
        $restaurants = Restaurant::whereHas('categories', function($query) use($id) {
            $query->where('id', $id);
        })->get();

        // Ad ogni obj ristorante aggiungo array di categorie associate
        foreach ($restaurants as $this_restaurant) {
            $categories = [];
            $categories = $this_restaurant->categories;
            $this_restaurant->categories = $categories;
        };

        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }
}
