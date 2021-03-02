<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Restaurant;

class OrderController extends Controller
{
    public function index($id)
    {
        $orders = Order::all();
        $restaurants = Restaurant::where('user_id', $id)->get();

        return response()->json([
            'success' => true,
            'results' => [
                'ordini' => $orders,
                'ristoranti' => $restaurants
            ]
        ]);
    }
}
