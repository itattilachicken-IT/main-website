<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'customer_name',
    'customer_phone',
    'payment_phone',
    'customer_email',
    'customer_address',
    'route_id',
    'order_type',
    'total_amount',
    'paid_amount',
    'delivery_fee',
    'balance',
    'status',
    'guest_token',
    'payment_token',
    'timed_out',
    'payment_gateway',
    'payment_method',
    'mpesa_checkout_id',
];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function audits()
    {
        return $this->hasMany(OrderAudit::class);
    }
}
