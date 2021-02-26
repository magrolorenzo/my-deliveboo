<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $restaurants = Restaurant::where('user_id', $user_id)->get();
        $data = [
            'restaurants' => $restaurants
        ];
        return view('admin.home', $data);
    }

    public function stats()
    {
        return view('admin.stats');
    }
}
