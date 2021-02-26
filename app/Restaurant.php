<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/* il model era scritto al plurale */
class Restaurant extends Model
{
    protected $fillable = ['name', 'address', 'piva', 'slug', 'img_cover'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }
}
