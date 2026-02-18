<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    // Keep all fields temporarily to migrate investment data
    protected $fillable = [
        // Personal info
        'full_name',
        'id_number',
        'kra_pin',
        'phone',
        'email',
        'postal_address',

        
    ];

    // Relationships

    // An investor can have many investments (after migration)
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    // An investor can have many withdrawal requests
    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
    
    public function bankAccounts()
{
    return $this->hasMany(BankAccount::class);
}

// Optional helper for primary account
public function primaryBankAccount()
{
    return $this->hasOne(BankAccount::class)->where('is_primary', true);
}

    
}
