<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
	
	public $table = 'orders_products';
	  public $fillable = [
        'product_id',
        'order_id',
        'title',
        'image',
        
];
    //
}
