<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Order;

class OrderController extends Controller
{
    public function index(){
        $userRestaurants = Auth::user()->restaurants;

        $data = [
            // 'dishes' => $dishes
            'userRestaurants' => $userRestaurants
        ];



        return view('admin.orders.index', $data);
    }

    public function show($id){
        $thisOrder = Order::where('id', $id)->first();
        // dd($thisOrder->order_items);

        $data = [
            // 'dishes' => $dishes
            'orderDetails' => $thisOrder
        ];



        return view('admin.orders.show', $data);
    }
}
