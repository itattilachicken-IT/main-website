<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FranchiseController extends Controller
{
    public function fastFood()
    {
        return view('franchise.fastfood'); // create this Blade
    }

    public function butchery()
    {
        return view('franchise.butchery'); // create this Blade
    }
}
