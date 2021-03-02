<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

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

    public function show(){
        $userRestaurants = Auth::user()->restaurants;

        $data = [
            // 'dishes' => $dishes
            'userRestaurants' => $userRestaurants
        ];



        return view('admin.orders.show', $data);
    }
}
