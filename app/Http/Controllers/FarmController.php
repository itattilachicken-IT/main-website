<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function breederOperations() {
        return view('farm.breeder-operations');
    }

    public function hatchery() {
        return view('farm.hatchery');
    }

    public function housing() {
        return view('farm.housing');
    }

    public function feed() {
        return view('farm.feed');
    }

    public function transportation() {
        return view('farm.transportation');
    }

    public function processingPackaging() {
        return view('farm.processing-packaging');
    }
}
