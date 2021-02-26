<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['customer_name', 'restaurant_id', 'customer_surname', 'customer_email', 'delivery_address'];

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }

    public function order_items() {
        return $this->hasMany('App\OrderItem');
    }
}
