<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories'=> Category::all()
        ];
        return view('admin.restaurants.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $user_id = Auth::user()->id;
        $new_restaurant = new Restaurant();
        $new_restaurant->fill($form_data);
        $slug = Str::slug($new_restaurant->name);
        $slug_base = $slug;
        // verifico che lo slug non esista nel database
        $restaurant_exist = Restaurant::where('slug', $slug)->first();
        $contatore = 1;
        // entro nel ciclo while se ho trovato un post con lo stesso $slug
        while($restaurant_exist) {
            // genero un nuovo slug aggiungendo il contatore alla fine
            $slug = $slug_base . '-' . $contatore;
            $contatore++;
            $restaurant_exist = Restaurant::where('slug', $slug)->first();
        }
        // quando esco dal while sono sicuro che lo slug non esiste nel db
        // assegno lo slug al post
        $new_restaurant->slug = $slug;
        $new_restaurant->user_id = $user_id;
        $new_restaurant->save();
        return redirect()->route('admin.home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
