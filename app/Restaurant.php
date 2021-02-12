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
}
