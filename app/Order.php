<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['restaurant_id', 'amount'];

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }

    public function order_items() {
        return $this->hasMany('App\OrderItem');
    }

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
}
