<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'investment_package',
        'contract_number',
        'initial_investment_date',
        'total_amount_invested',
    ];

    // Relationships

    // Each investment belongs to one investor
    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    // Each investment can have multiple withdrawal requests
    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
}
