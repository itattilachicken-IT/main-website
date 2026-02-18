<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAudit extends Model
{
    protected $fillable = ['order_id', 'admin_id', 'action', 'notes'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
