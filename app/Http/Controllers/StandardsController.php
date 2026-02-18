<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StandardsController extends Controller
{
    public function animalWelfare() {
        return view('standards.animal-welfare');
    }

    public function foodSafety() {
        return view('standards.food-safety');
    }

    public function humanePractices() {
        return view('standards.humane-practices');
    }

    public function qualityStandards() {
        return view('standards.quality-standards');
    }

    public function sustainability() {
        return view('standards.sustainability');
    }

    public function nutrition() {
        return view('standards.nutrition');
    }
}
