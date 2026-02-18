@extends('layouts.app')

@section('title', 'Attila Growth Plan')

@section('content')
<div class="container py-5">

    <h1 class="display-5 fw-bold mb-5 text-dark">
        Attila Growth Plan Directions
    </h1>

    @php
        $sections = [
            [
                'title' => 'Scale Production Capacity',
                'body'  => 'Upgrade farm infrastructure, expand flock capacity, and add multiple farm sites to support national growth.'
            ],
            [
                'title' => 'Expand Geographic Reach / Distribution',
                'body'  => 'Grow beyond Nairobi into additional Kenyan regions and explore regional export opportunities.'
            ],
            [
                'title' => 'Increase Product Range & Value-Added Products',
                'body'  => 'Introduce processed products, ready-to-cook lines, chilled/frozen items, and export-grade offerings.'
            ],
            [
                'title' => 'Franchise / Partner Model',
                'body'  => 'Attract entrepreneurs to open butcheries and distribution outlets under the Attila brand.'
            ],
            [
                'title' => 'Brand & Marketing Growth',
                'body'  => 'Strengthen Attila as a premium poultry brand with emphasis on quality, sustainability, and ethical production.'
            ],
            [
                'title' => 'Sustainability & Innovation',
                'body'  => 'Invest in eco-friendly housing, organic feed options, and community training programs.'
            ],
            [
                'title' => 'Financial / Investment Growth',
                'body'  => 'Raise expansion capital through structured investment packages and partnerships.'
            ],
        ];
    @endphp

    <div class="row g-4">
        @foreach ($sections as $item)
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3 d-flex align-items-center">
                        <span class="badge bg-success me-3 rounded-circle p-2"></span>
                        {{ $item['title'] }}
                    </h3>

                    <p class="text-muted mb-0">
                        {{ $item['body'] }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
