<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use Illuminate\Support\Str;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $restaurant = Restaurant::where('user_id', $user_id)->first();
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();
        $data = [
            'dishes' => $dishes
        ];
        return view('admin.dishes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required|max:30',
            'ingredients' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:1000',
            'unit_price' => 'required|numeric|between:00.01,999.99',
            'img_cover' => 'nullable|image|max:512',
            'visible' => 'required|boolean'
        ]);

        $form_data = $request->all();

        $user_id = Auth::user()->id;
        $restaurant = Restaurant::where('user_id', $user_id)->first();

        $new_dish = new Dish(); // nuovo obj dish

        $new_dish->fill($form_data);
        $new_dish->restaurant_id = $restaurant->id;
        // dd($new_dish);

        $slug = Str::slug($new_dish->name);
        $slug_base = $slug;

        // verifico che lo slug non esista nel database
        $dish_exist = Dish::where('slug', $slug)->first();
        $contatore = 1;

        // entro nel ciclo while se ho trovato un post con lo stesso $slug
        while($dish_exist) {
            // genero un nuovo slug aggiungendo il contatore alla fine
            $slug = $slug_base . '-' . $contatore;
            $contatore++;
            $dish_exist = Dish::where('slug', $slug)->first();
        }
        // quando esco dal while sono sicuro che lo slug non esiste nel db
        // assegno lo slug al post
        $new_dish->slug = $slug;

        $new_dish->save();

        return redirect()->route('admin.dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $dish = Dish::where('slug', $slug)->first();

        if(!$dish) {
            abort(404);
        }
        $data = [
            'dish' => $dish
        ];
        return view('admin.dishes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $dish = Dish::where('slug', $slug)->first();
        if(!$dish) {
            abort(404);
        }
        $data = [
            'dish' => $dish
        ];
        return view('admin.dishes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $request -> validate([
            'name' => 'required|max:30',
            'ingredients' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:1000',
            'unit_price' => 'required|numeric|between:00.01,999.99',
            'img_cover' => 'nullable|image|max:512',
            'visible' => 'required|boolean'
        ]);

        $form_data = $request->all();

        if($form_data["name"] != $dish->name){
            // Ricreo slug
            $slug = Str::slug($form_data["name"]);
            $slug_base = $slug;

            // verifico che lo slug non esista nel database
            $dish_exist = Dish::where('slug', $slug)->first();
            $contatore = 1;

            // entro nel ciclo while se ho trovato un post con lo stesso $slug
            while($dish_exist) {
                // genero un nuovo slug aggiungendo il contatore alla fine
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $dish_exist = Dish::where('slug', $slug)->first();
            }
            $dish->slug = $slug;
        }

        $dish->update($form_data);
        return redirect()->route("admin.dishes.index");
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
