<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingInvestor extends Model
{
    protected $table = 'onboarding_investors';

    protected $fillable = [
        'investor_code',
        'full_name',
        'email',
        'phone',
        'password',
        'investment_package',
        'number_of_birds',
        'feeds_bags',
        'cost_of_feeds',
        'insurance',
        'total_investment',
        'total_package_cost',
        'bank_name',
        'bank_address',
        'account_name',
        'account_number',
        'swift_code',
        'branch_name',
        'contract_file',
        'status'
    ];

    protected $hidden = ['password'];
}
