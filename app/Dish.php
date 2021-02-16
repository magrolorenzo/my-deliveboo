<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable=['name', 'restaurant_id', 'ingredients', 'description', 'unit_price', 'visible', 'slug', 'img_cover'];

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }
}
