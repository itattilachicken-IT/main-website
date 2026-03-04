<?php

namespace App\Http\Controllers;

use App\Models\OnboardingInvestor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OnboardingInvestorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'investor_code' => 'required|unique:onboarding_investors',
            'full_name' => 'required',
            'email' => 'required|email|unique:onboarding_investors',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        // Upload contract
        $contractPath = null;
        if ($request->hasFile('contract_file')) {
            $contractPath = $request->file('contract_file')
                ->store('contracts', 'public');
        }

        OnboardingInvestor::create([
            'investor_code' => $request->investor_code,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),

            'investment_package' => $request->investment_package,
            'number_of_birds' => $request->number_of_birds,
            'feeds_bags' => $request->feeds_bags,
            'cost_of_feeds' => $request->cost_of_feeds,
            'insurance' => $request->insurance,
            'total_investment' => $request->total_investment,
            'total_package_cost' => $request->total_package_cost,

            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'swift_code' => $request->swift_code,
            'branch_name' => $request->branch_name,

            'contract_file' => $contractPath,
            'status' => 'Active'
        ]);

        return redirect()->back()->with('success', 'Investor Created Successfully');
    }
}
