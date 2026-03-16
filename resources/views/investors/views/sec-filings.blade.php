<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SEC Filings — Investor Relations</title>

@vite('resources/css/app2.css')
@vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout" id="dashboardLayout">

    {{-- Sidebar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @include('partials.topbar')

        <section class="section">
            <div class="container">

                {{-- Notice --}}
                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        Select the filing type and date range you wish to view from the drop-down menus below.
                       
                    </p>
                </div>

                {{-- Filters --}}
                <form method="GET" action="{{ route('investors.sec-filings') }}">
                    <div class="card" style="margin-bottom: 30px;">
                        <div class="filters">

                            <div class="filter-group">

                                {{-- Type Filter --}}
                                <label>View
                                    <select name="type" onchange="this.form.submit()">
                                        <option value="" {{ request('type') == '' ? 'selected' : '' }}>
                                            All Filings
                                        </option>
                                        <option value="Onboarding Contracts" {{ request('type') == 'Onboarding Contracts' ? 'selected' : '' }}>
                                            Onboarding Contracts
                                        </option>
                                        <option value="Offboarding Contracts" {{ request('type') == 'Offboarding Contracts' ? 'selected' : '' }}>
                                            Offboarding Contracts
                                        </option>
                                        <option value="Payment Reports" {{ request('type') == 'Payment Reports' ? 'selected' : '' }}>
                                            Payment Reports
                                        </option>
                                        <option value="Other" {{ request('type') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </label>

                                {{-- Year Filter --}}
                                <label>Year
                                    <select name="year" onchange="this.form.submit()">
                                        <option value="" {{ request('year') == '' ? 'selected' : '' }}>
                                            Trailing 12-Months
                                        </option>
                                        @for ($y = date('Y'); $y >= 2020; $y--)
                                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </label>

                            </div>

                            <div class="ticker">
                                ATTILA: OFFICIAL
                            </div>

                        </div>
                    </div>
                </form>

                {{-- Table Card --}}
                <div class="card">

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th style="width:120px;">Form</th>
                                    <th>Description</th>
                                    <th style="width:120px;">Date</th>
                                    <th style="width:150px;">Format</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($filings as $f)

                                <tr>
                                    <td>{{ $f->type }}</td>

                                    <td>{{ $f->description ?? '—' }}</td>

                                    <td>{{ \Carbon\Carbon::parse($f->filing_date)->format('M d, Y') }}</td>

                                    <td class="format-icons">
                                        <a href="{{ asset('contracts/sec-filings/'.$f->pdf_file) }}"
                                           download="{{ $f->pdf_file }}"
                                           class="download-link">
                                            <span>PDF</span>
                                        </a>
                                    </td>
                                </tr>

                                @empty

                                <tr>
                                    <td colspan="4" style="text-align:center;">
                                        No filings available
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Pagination --}}
                <div class="pagination" style="margin-top:20px;">
                    {{ $filings->links() }}
                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>