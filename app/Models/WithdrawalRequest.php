<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'investment_id',
        'type_of_withdrawal',
        'amount_requested',
        'reason',
        'preferred_payment_date',
        'bank_name',
        'branch',
        'account_name',
        'account_number',
        'swift_code',
        'bank_address',
        'approval_status',
        'approved_amount',
        'comments',
        'application_received_by',
        'date_received',
        'authorized_by',
        'authorized_signature',
        'authorized_date',
        'signature_path',
    ];

    // Relationships

    // Belongs to the investor who made the request
    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    // Belongs to the investment being withdrawn
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
