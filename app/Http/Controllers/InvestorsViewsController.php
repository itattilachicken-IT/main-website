<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestorsViewsController extends Controller
{
    //
    public function home()
    {
          return view('investors.views.home');
    }
    public function myInvestments()
    {
          return view('investors.views.my-investments');
    }
     public function handbook()
    {
          return view('investors.views.handbook');
    }
     public function directors()
    {
          return view('investors.views.directors');
    }
    public function pressReleases()
    {
          return view('investors.views.press-releases');
    }
     public function eventsAndPresentations()
    {
          return view('investors.views.events-and-presentations');
    }
    public function secFilings()
    {
          return view('investors.views.sec-filings');
    }
        public function annualReports()
    {
          return view('investors.views.annual-reports');
    }
       public function settings()
    {
          return view('investors.views.settings');
    }
}
