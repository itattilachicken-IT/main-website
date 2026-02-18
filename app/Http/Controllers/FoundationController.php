<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoundationController extends Controller
{
    public function index()
    {
        // This will show your informational page
        return view('foundation.index');
    }
}
