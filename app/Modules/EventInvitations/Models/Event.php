<?php

namespace App\Modules\EventInvitations\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'venue', 'start_date', 'end_date', 'banner_url', 'description'];
    protected $casts = ['start_date' => 'datetime', 'end_date' => 'datetime'];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
