<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;

class InvestorController extends Controller
{

    public function login()
    {
          return view('investors.login');
    }

    public function store(Request $request)
    {
    DB::insert("
        INSERT INTO onboarding_investors (
            investor_code,
            full_name,
            email,
            phone,
            password,
            investment_package,
            number_of_birds,
            feeds_bags,
            cost_of_feeds,
            insurance,
            total_investment,
            total_package_cost,
            bank_name,
            bank_address,
            account_name,
            account_number,
            swift_code,
            branch_name,
            contract_file,
            created_at,
            updated_at
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ", [

        $request->investor_code,
        $request->full_name,
        $request->email,
        $request->phone,
        Hash::make($request->password),

        $request->investment_package,
        $request->number_of_birds,
        $request->feeds_bags,
        $request->cost_of_feeds,
        $request->insurance,
        $request->total_investment,
        $request->total_package_cost,

        $request->bank_name,
        $request->bank_address,
        $request->account_name,
        $request->account_number,
        $request->swift_code,
        $request->branch_name,

        $this->uploadContract($request)

    ]);



    /* ---------------------------------
       SAVE PAYMENT SCHEDULE
    ----------------------------------*/

    if($request->placement_date){

        foreach($request->placement_date as $index => $date){

            DB::insert("
                INSERT INTO investor_payments
                (investor_code, placement_date, payment_date, rate, amount, status)
                VALUES (?, ?, ?, ?, ?, ?)
            ", [

                $request->investor_code,
                $date,
                $request->payment_date[$index],
                $request->rate[$index],
                $request->amount[$index],
                $request->status[$index]

            ]);

        }

    }


    return redirect()->back()->with('success','Investor created successfully');



    }


    private function uploadContract($request)
        {

            if($request->hasFile('contract_file')){

                $file = $request->file('contract_file');

                $filename = time().'_'.$file->getClientOriginalName();

                $path = public_path('contracts');

                // Create folder if it doesn't exist
                if(!File::exists($path)){
                    File::makeDirectory($path, 0755, true);
                }

                $file->move($path, $filename);

                return $filename;
            }

            return null;
        }
    

    
}