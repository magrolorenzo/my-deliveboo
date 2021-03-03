<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Restaurant;
use App\User;

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

    public function getUserOrders($user_id)
    {
        $user = User::find($user_id);
        $userRestaurants = $user->restaurants;
        // $userOrders = Auth::user()->restaurants;
        // dd($userRestaurants);

        $userOrders = [];

        foreach ($userRestaurants as $restaurant) {
            $currentOrders = $restaurant->orders;
            if (count($currentOrders) != 0) {
                array_push($userOrders, $currentOrders);
            }
        }

        return response()->json([
            'success' => true,
            'results' => [
                'userRestaurant' => $userRestaurants
            ]
        ]);
    }
}
