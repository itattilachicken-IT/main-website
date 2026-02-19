<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;

class InvestorController extends Controller
{

    public function index()
    {
          return view('investors.index');
    }
     public function validate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // For now we do not authenticate against the database.
        // Store a simple session value to indicate 'logged in'.
        session(['user_email' => $request->input('email')]);

        return redirect()->route('investors.landing');
    }

    
}