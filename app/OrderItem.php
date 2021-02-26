<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['dish_id', 'dish_name', 'unit_price', 'quantity', 'order_id'];

    public function orders() {
        return $this->belongsTo('App\Order');
    }
}
