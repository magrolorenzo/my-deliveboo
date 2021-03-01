<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=[
        'order_id', // Chiave esterna
        'customer_name',
        'customer_surname',
        'customer_email',
        'delivery_address'
    ];

    public function order()
    {
        return $this->hasOne('App\Order');
    }
}
