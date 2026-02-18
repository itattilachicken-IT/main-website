<?php

namespace App\Modules\EventInvitations\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'event_id',
        'guest_name',
        'guest_email',
        'guest_mobile',
        'token',
        'status',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array', // Automatically casts JSON <-> array
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
