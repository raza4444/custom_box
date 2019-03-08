<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
	public $table = 'payments';
    //
         public $fillable = [
        'order_id',
        'stripe_payment_id',
        'paypal_payment_id',
        'payment_type',
        'status',
        'failure_reason',
    ];
    //
}
