<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InvestorsViewsController extends Controller
{
    //
    public function home()
    {
          return view('investors.views.home');
    }
    
    public function admin()
    {
        $investors = DB::table('onboarding_investors')
        ->orderBy('created_at', 'desc')
        ->get();
           
        return view('investors.views.admin.admin-dashboard', compact('investors'));
    }

        public function edit($id)
    {
        $investor = DB::table('onboarding_investors')
            ->where('id',$id)
            ->first();

        return view('investors.views.admin.edit-investor',compact('investor'));
    }
    public function update(Request $request,$id)
    {
        DB::table('onboarding_investors')
            ->where('id',$id)
            ->update([

                'investor_code' => $request->investor_code,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'investment_package' => $request->investment_package,
                'number_of_birds' => $request->number_of_birds,
                'total_investment' => $request->total_investment,
                'updated_at' => now()

            ]);

          return redirect()
            ->route('investors.admin.admin-dashboard')
            ->with('success', 'Investor updated successfully');
    }
    public function destroy($id)
    {
        DB::table('onboarding_investors')
            ->where('id',$id)
            ->delete();

        return redirect()
            ->back()
            ->with('success','Investor deleted successfully');
    }
    
     public function events()
    {
          return view('investors.views.admin.events');
    }
    public function files()
    {
          return view('investors.views.admin.files');
    }
    public function reports()
    {
          return view('investors.views.admin.reports');
    }
     public function accountsettings()
    {
          return view('investors.views.admin.accountsettings');
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
        $releases = [
            [
                'date' => '2026-02-15',
                'title' => 'Attila Chicken Expands Production Capacity',
                'slug' => 'expansion-announcement',
                'content' => 'Attila Chicken has announced a major expansion of its production facilities to meet growing market demand. The new facility will create 500 new jobs and increase production capacity by 40%.'
            ],
            [
                'date' => '2026-01-20',
                'title' => 'Record Q4 Results Announced',
                'slug' => 'q4-results',
                'content' => 'Record sales and profitability achieved in Q4 2025. Revenue increased by 35% year-over-year with improved margins across all product categories.'
            ],
            [
                'date' => '2025-12-10',
                'title' => 'Sustainability Initiative Launched',
                'slug' => 'sustainability-initiative',
                'content' => 'Attila Chicken launches comprehensive sustainability program focusing on reducing carbon emissions and supporting local farming communities.'
            ],
        ];
        
        return view('investors.views.press-releases', compact('releases'));
    }
    public function eventsAndPresentations()
    {
        $events = [
            [
                'title' => 'Investor Conference 2026',
                'date' => '2026-03-15',
                'time' => '9:00 AM - 5:00 PM',
                'description' => 'Join us for our annual investor conference featuring presentations from our leadership team and Q&A sessions.',
                'link' => '#',
                'link_text' => 'Register Now'
            ],
            [
                'title' => 'Q1 Earnings Call',
                'date' => '2026-02-28',
                'time' => '2:00 PM GMT',
                'description' => 'Listen to our Q1 earnings presentation and participate in the Q&A session with our CFO.',
                'link' => '#',
                'link_text' => 'Join Call'
            ],
            [
                'title' => 'Annual Shareholder Meeting',
                'date' => '2026-04-10',
                'time' => '10:00 AM - 12:00 PM',
                'description' => 'Annual shareholder meeting to review company performance and vote on key matters.',
                'link' => '#',
                'link_text' => 'View Details'
            ],
        ];

        $presentations = [
            [
                'title' => 'Company Overview Presentation',
                'date' => '2025-12-01',
                'image' => asset('images/presentation1.jpg'),
                'download_link' => '#'
            ],
            [
                'title' => '2025 Corporate Strategy',
                'date' => '2025-11-15',
                'image' => asset('images/presentation2.jpg'),
                'download_link' => '#'
            ],
            [
                'title' => 'Investor Relations Overview',
                'date' => '2025-10-20',
                'image' => asset('images/presentation3.jpg'),
                'download_link' => '#'
            ],
        ];

        return view('investors.views.events-and-presentations', compact('events', 'presentations'));
    }
    public function secFilings()
    {
          return view('investors.views.sec-filings');
    }
        public function annualReports()
    {
        $annualreports = [
            [
                'title' => '2025 Annual Report',
                'date' => 'Published: 2026-01-31',
                'image' => asset('images/annual-report-2025.jpg'),
                'download_link' => '#'
            ],
            [
                'title' => '2024 Annual Report',
                'date' => 'Published: 2025-02-15',
                'image' => asset('images/annual-report-2024.jpg'),
                'download_link' => '#'
            ],
            [
                'title' => '2023 Annual Report',
                'date' => 'Published: 2024-02-20',
                'image' => asset('images/annual-report-2023.jpg'),
                'download_link' => '#'
            ],
            [
                'title' => '2022 Annual Report',
                'date' => 'Published: 2023-03-10',
                'image' => asset('images/annual-report-2022.jpg'),
                'download_link' => '#'
            ],
        ];

        return view('investors.views.annual-reports', compact('annualreports'));
    }
       public function settings()
    {
          return view('investors.views.settings');
    }
     public function logout()
    {
          return redirect()->route('home');
    }
}
