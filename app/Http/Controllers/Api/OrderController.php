<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderItem::all();
        /* $restaurant = OrderItem::where('restaurant_id', $id)->get(); */

        return response()->json([
            'success' => true,
            'results' => $orders
        ]);
    }
}
