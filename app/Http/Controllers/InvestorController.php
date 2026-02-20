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
    

    
}