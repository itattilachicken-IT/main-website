<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Investor;

class InvestorController extends Controller
{

    public function login()
    {
          return view('investors.login');
    }


public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Try to find as investor first
    $investor = DB::table('onboarding_investors')
        ->where('email', $request->email)
        ->first();

    if ($investor && Hash::check($request->password, $investor->password)) {
        // Save investor info in session
        session([
            'user_type' => 'investor',
            'investor_id' => $investor->id,
            'investor_name' => $investor->full_name,
            'investor_code' => $investor->investor_code
        ]);

        // Redirect to investor dashboard
        return redirect()->route('investors.dashboard');
    }

    // If not investor, try admin
    $admin = DB::table('admin')
        ->where('email', $request->email)
        ->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        // Save admin info in session
        session([
            'user_type' => 'admin',
            'admin_id' => $admin->id,
            'admin_name' => $admin->first_name . ' ' . $admin->last_name,
            'admin_email' => $admin->email
        ]);

        // Redirect to admin dashboard
        return redirect()->route('investors.admin-dashboard');
    }

    // Invalid credentials for both
    return back()->withErrors([
        'email' => 'Invalid email or password'
    ])->withInput();
}

    public function store(Request $request)
    {
        $request->validate([
            'investor_code' => 'required|string|max:100',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'password' => 'required|string|min:6',
            'contract_file' => 'nullable|file|max:10240',
            'placement_date' => 'nullable',
            'payment_date' => 'nullable',
            'rate' => 'nullable',
            'amount' => 'nullable',
            'status' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $contractFileName = $this->uploadContract($request);

            DB::insert(
                "INSERT INTO onboarding_investors (
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
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())",
                [
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
                    $contractFileName,
                ]
            );

            $placementDates = $request->input('placement_date', []);
            $paymentDates = $request->input('payment_date', []);
            $rates = $request->input('rate', []);
            $amounts = $request->input('amount', []);
            $statuses = $request->input('status', []);

            if (!is_array($placementDates)) {
                $placementDates = [$placementDates];
            }
            if (!is_array($paymentDates)) {
                $paymentDates = [$paymentDates];
            }
            if (!is_array($rates)) {
                $rates = [$rates];
            }
            if (!is_array($amounts)) {
                $amounts = [$amounts];
            }
            if (!is_array($statuses)) {
                $statuses = [$statuses];
            }

            foreach ($placementDates as $index => $date) {
                if (empty($date)) {
                    continue;
                }

                $paymentDate = $paymentDates[$index] ?? null;
                $rate = $rates[$index] ?? null;
                $amount = $amounts[$index] ?? null;
                $status = $statuses[$index] ?? null;

                if (empty($paymentDate) && empty($rate) && empty($amount) && empty($status)) {
                    continue;
                }

                DB::insert(
                    "INSERT INTO investor_payments
                    (investor_code, placement_date, payment_date, rate, amount, status)
                    VALUES (?, ?, ?, ?, ?, ?)",
                    [
                        $request->investor_code,
                        $date,
                        $paymentDate,
                        $rate,
                        $amount,
                        $status,
                    ]
                );
            }

            DB::commit();

            return redirect()->back()->with('success', 'Investor created successfully');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error('Investor creation failed', ['exception' => $exception]);
            return redirect()->back()->with('error', 'Failed to create investor. Please try again.');
        }
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

        public function updatePaymentStatus(Request $request, $id)
        {
            $request->validate([
                'status' => 'required|in:Paid,Upcoming',
            ]);

            DB::table('investor_payments')
                ->where('id', $id)
                ->update(['status' => $request->status]);

            return response()->json(['success' => true]);
        }

        private function ensurePresentationFolder()
        {
            $path = public_path('contracts/presentations');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            return $path;
        }
        public function storeEvent(Request $request)
        {
            $request->validate([
                'title' => 'required',
                'date' => 'required|date'
            ]);

            DB::table('fieldevents')->insert([
                'title' => $request->title,
                'event_date' => $request->date,
                'event_time' => $request->time,
                'link' => $request->link,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return back()->with('success', 'Event saved successfully');
        }

        public function storePresentation(Request $request)
        {
            $request->validate([
                'title' => 'required',
                'date' => 'required|date',
                'image' => 'nullable|image',
                'download_link' => 'required|mimes:pdf'
            ]);

            // Ensure folder exists
            $path = $this->ensurePresentationFolder();

            // 📷 Save Image
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('contracts/presentations'), $imageName);
            }

            // 📄 Save PDF
            $pdfName = null;
            if ($request->hasFile('download_link')) {
                $pdf = $request->file('download_link');
                $pdfName = time().'_'.$pdf->getClientOriginalName();
                $pdf->move($path, $pdfName);
            }

            DB::table('presentations')->insert([
                'title' => $request->title,
                'presentation_date' => $request->date,
                'image' => $imageName,
                'pdf_file' => $pdfName,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return back()->with('success', 'Presentation saved successfully');
        }


            

    
}