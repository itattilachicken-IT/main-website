<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InvestorsViewsController extends Controller
{
    //
    public function home()
    {
          if (!session()->has('investor_id')) {
            return redirect()->route('investor.login.form');
        }
        $code = session('investor_code');

        // Investor info
        $investor = DB::table('onboarding_investors')
            ->where('investor_code', $code)
            ->first();

        // Payment schedule
        $payments = DB::table('investor_payments')
            ->where('investor_code', $code)
            ->orderBy('placement_date')
            ->get();

        return view('investors.views.home', compact('investor', 'payments'));
         
    }
    

    public function admin()
    {
        $investors = DB::table('onboarding_investors')
        ->orderBy('created_at', 'desc')
        ->get();
           
        return view('investors.views.admin.admin-dashboard', compact('investors'));
    }

     public function dashboard()
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
        // Get investor first
        $investor = DB::table('onboarding_investors')
                        ->where('id', $id)
                        ->first();

        if ($investor) {

            // Delete related investor payments
            DB::table('investor_payments')
                ->where('investor_code', $investor->investor_code)
                ->delete();

            // Delete investor
            DB::table('onboarding_investors')
                ->where('id', $id)
                ->delete();
        }

        return redirect()
            ->back()
            ->with('success', 'Investor and payment records deleted successfully');
    }
    
     public function events()
    {
         $events = DB::table('fieldevents')
                ->orderBy('event_date', 'desc')
                ->get();

            $presentations = DB::table('presentations')
                ->orderBy('presentation_date', 'desc')
                ->get();

          return view('investors.views.admin.events', compact('events', 'presentations'));
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
        // Check if investor is logged in
        if (!session()->has('investor_code')) {
            return redirect()->route('investors.login.form');
        }

        $code = session('investor_code');

        // Fetch investor info
        $investor = DB::table('onboarding_investors')
            ->where('investor_code', $code)
            ->first();
        // Fetch all payments grouped by investment package
        $payments = DB::table('investor_payments')
            ->where('investor_code', $code)
            ->orderBy('placement_date')
            ->get();

        return view('investors.views.my-investments', compact('investor', 'payments'));
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

    // Pull events from database (table: fieldevents)
    $events = DB::table('fieldevents')
        ->orderBy('event_date', 'desc')
        ->get()
        ->map(function($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'date' => \Carbon\Carbon::parse($event->event_date)->format('jS F Y'),
                'time' => $event->event_time,
                'description' => $event->description,
                'link' => $event->link,
                'link_text' => $event->link_text ?? 'View Event'
            ];
        });

    // Pull presentations from database (table: presentations)
        $presentations = DB::table('presentations')
            ->orderBy('presentation_date', 'desc')
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'title' => $p->title,
                    'presentation_date' => $p->presentation_date,
                    'date' => \Carbon\Carbon::parse($p->presentation_date)->format('jS F Y'),

                    // SEND FILENAMES ONLY
                    'image' => $p->image,
                    'pdf_file' => $p->pdf_file
                ];
            });

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
        session()->flush();              // Clear session data
        session()->invalidate();         // Invalidate session
        session()->regenerateToken();    // New CSRF token

        return redirect()->route('home');
    }
}
