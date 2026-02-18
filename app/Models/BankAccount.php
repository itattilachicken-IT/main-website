<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $table = 'bank_accounts'; // optional, Laravel infers this

    protected $fillable = [
        'investor_id',
        'bank_name',
        'bank_address',
        'account_name',
        'account_number',
        'swift_code',
        'branch_name',
    ];

    /**
     * Each bank account belongs to one investor
     */
    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
