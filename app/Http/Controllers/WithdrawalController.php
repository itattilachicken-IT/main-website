<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\WithdrawalRequest;
use PDF;
use Mail;
use App\Mail\WithdrawalSubmitted;
use Illuminate\Support\Facades\Storage;

class WithdrawalController extends Controller
{
    // Show the withdrawal form
    public function showForm()
    {
        return view('withdrawal.form');
    }

    // Fetch investor + investments + primary bank account by ID number
    public function getInvestorData($id_number)
    {
        $investor = Investor::where('id_number', $id_number)
            ->with(['investments', 'bankAccounts'])
            ->first();

        if (!$investor) {
            return response()->json(['error' => 'Investor not found'], 404);
        }

        // Get primary bank account (first one)
        $bank = $investor->bankAccounts->first();

        return response()->json([
            'investor' => [
                'id' => $investor->id,
                'full_name' => $investor->full_name,
                'phone' => $investor->phone,
                'email' => $investor->email,
            ],
            'bank_account' => $bank,
            'investments' => $investor->investments
        ]);
    }

    // Check pending withdrawal
    public function checkPending($id_number)
    {
        $investor = Investor::where('id_number', $id_number)->first();
        if(!$investor){
            return response()->json(['pending' => false]);
        }

        $pending = WithdrawalRequest::where('investor_id', $investor->id)
                    ->where('approval_status', 'Pending')
                    ->exists();

        return response()->json(['pending' => $pending]);
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'investor_id' => 'required|exists:investors,id',
            'investment_id' => 'required|exists:investments,id',
            'type_of_withdrawal' => 'required|in:Full,Partial',
            'amount_requested' => 'required|numeric|min:1',
            'reason' => 'nullable|string',
            'preferred_payment_date' => 'nullable|date',
            'bank_name' => 'required|string',
            'branch' => 'nullable|string',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'swift_code' => 'nullable|string',
            'bank_address' => 'nullable|string',
            'signature_data' => 'required|string',
        ]);

        // Check pending withdrawal
        $pending = WithdrawalRequest::where('investor_id', $validated['investor_id'])
                    ->where('approval_status', 'Pending')
                    ->exists();

        if($pending){
            return redirect()->back()->with('error', 'You already have a pending withdrawal request. Please wait until it is processed.');
        }

        // Process signature Base64
        $image = str_replace('data:image/png;base64,', '', $validated['signature_data']);
        $image = str_replace(' ', '+', $image);
        $fileName = 'signature_' . time() . '.png';
        Storage::disk('public')->put('signatures/' . $fileName, base64_decode($image));
        $validated['signature_path'] = 'signatures/' . $fileName;

        // Save withdrawal request
        $withdrawal = WithdrawalRequest::create($validated);

        // Generate PDF
        $investor = Investor::find($validated['investor_id']);
        $investorName = preg_replace('/[^A-Za-z0-9]/', '_', $investor->full_name);
        $pdfFileName = 'withdrawal_request_'.$investorName.'_'.$withdrawal->id.'.pdf';

        $pdf = PDF::loadView('withdrawal.pdf', compact('withdrawal'));

        // Send Emails
        Mail::to($investor->email)->send(new WithdrawalSubmitted($withdrawal, $pdf));
        Mail::to('investment@attilachicken.com')->send(new WithdrawalSubmitted($withdrawal, $pdf));

        // Store PDF temporarily
        Storage::disk('public')->put('pdfs/'.$pdfFileName, $pdf->output());

        // Redirect back with success message and PDF download trigger
        return redirect()->back()->with([
            'success' => 'Withdrawal request submitted successfully. You will receive a confirmation email shortly.',
            'pdf_file' => asset('storage/pdfs/'.$pdfFileName)
        ]);
    }
}
