@extends('layouts.app')

@section('title', 'Our Franchise Network | Attila Chicken')

@section('styles')
<style>
    /* General Card Styles */
    .franchise-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 15px;
    }
    .franchise-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }
    .franchise-card .card-title {
        font-weight: 700;
        font-size: 1.5rem;
    }
    .franchise-card .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    /* Button Styles */
    .btn-learn {
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s;
    }
    .btn-learn:hover { filter: brightness(90%); }

    /* Brand colors */
    .fastfood-card { border: 3px solid #fe0000; }
    .butchery-card { border: 3px solid #ffc600; }
    .fastfood-btn { background-color: #fe0000; color: #fff; }
    .butchery-btn { background-color: #ffc600; color: #000; }

    /* Benefits Section */
    .benefits-section { margin-top: 4rem; }
    .benefits-section h3 { text-align: center; margin-bottom: 2rem; color: #fe0000; }
    .benefits-heading { font-size: 1.4rem; font-weight: 700; margin-top: 2rem; color: #fe0000; }
    .butchery-heading { color: #ffc600; }
    .benefits-list { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 2rem; }
    .benefit-icon { margin-right: 0.5rem; }

    /* Standout Section */
    .standout-section { margin-top: 4rem; }
    .standout-section h3 { text-align: center; margin-bottom: 2rem; color: #fe0000; }
    .standout-section h5 { color: #000; margin-top: 1.5rem; font-weight: 700; }
    .standout-section p { margin-bottom: 1rem; }

    /* Metrics Section */
    .metrics-section { margin-top: 4rem; text-align: center; }
    .metric { display: inline-block; margin: 1.5rem; }
    .metric h4 { font-size: 2rem; font-weight: 700; color: #fe0000; }
    .metric p { font-size: 1rem; }

    /* Flowchart Section */
    .flowchart-section { margin-top: 4rem; }
    .flowchart-container { overflow-x: auto; padding: 1rem; background: #f8f9fa; border-radius: 15px; }

    /* CTA Section */
    .cta-section { margin-top: 4rem; text-align: center; padding: 2rem; background: #fe0000; color: #fff; border-radius: 15px; }
    .cta-section a { color: #fff; text-decoration: none; }
    .cta-section a:hover { text-decoration: underline; }

    /* Responsive */
    @media (max-width: 767px) {
        .franchise-card .card-title { font-size: 1.3rem; }
        .franchise-card .card-icon { font-size: 2.5rem; }
        .metric { display: block; margin: 1rem auto; }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5" style="color: #fe0000;">Explore Our Franchise Network</h1>
    <p class="text-center mb-5 lead">
        Partner with <strong>Attila Chicken</strong> through two profitable franchise models: <strong>Fast-Food Outlets</strong> and <strong>Butchery Operations</strong>. Each model delivers farm-fresh poultry while maximizing returns and ensuring sustainability.
    </p>

    {{-- Franchise Cards --}}
    <div class="row g-5 justify-content-center">
        {{-- Fast-Food Card --}}
        <div class="col-md-5">
            <div class="card franchise-card fastfood-card h-100 shadow-sm d-flex flex-column">
                <div class="flex-grow-1 text-center p-4">
                    <div class="card-icon text-danger">🍔</div>
                    <h5 class="card-title" style="color: #fe0000;">Fast-Food Franchise</h5>
                    <p class="card-text">
                        Operate quick-service restaurants, takeaways, kiosks, and drive-thru outlets delivering farm-fresh poultry meals directly to communities.
                    </p>
                </div>
                <!--<div class="text-center p-3">
                    <a href="{{ route('franchise.fastfood') }}" class="btn btn-learn fastfood-btn px-4 py-2">Learn More</a>
                </div>-->
            </div>
        </div>

        {{-- Butchery Card --}}
        <div class="col-md-5">
            <div class="card franchise-card butchery-card h-100 shadow-sm d-flex flex-column">
                <div class="flex-grow-1 text-center p-4">
                    <div class="card-icon text-warning">🐔</div>
                    <h5 class="card-title" style="color: #ffc600;">Butchery Franchise</h5>
                    <p class="card-text">
                        Run fresh poultry outlets through full-service butchery, collection points, and route distribution to serve households, restaurants, schools, and markets efficiently.
                    </p>
                </div>
                <!--<div class="text-center p-3">
                    <a href="{{ route('franchise.butchery') }}" class="btn btn-learn butchery-btn px-4 py-2">Learn More</a>
                </div>-->
            </div>
        </div>
    </div>

    {{-- Benefits Section --}}
    <div class="benefits-section">
        <h3>Key Benefits of Our Franchise Models</h3>

        {{-- Fast-Food Benefits --}}
        <h4 class="benefits-heading"><span class="benefit-icon">🍔</span>Fast-Food Franchise</h4>
        <ul class="benefits-list">
            <li>Farm-to-table freshness with direct sourcing</li>
            <li>Signature recipes & exclusive supply chain access</li>
            <li>Comprehensive training in food prep and service</li>
            <li>Marketing & brand support including campaigns and materials</li>
            <li>Operational manuals for hygiene, consistency, and sustainability</li>
            <li>Continuous menu innovation and competitive edge</li>
        </ul>

        {{-- Butchery Benefits --}}
        <h4 class="benefits-heading butchery-heading"><span class="benefit-icon">🐔</span>Butchery Franchise</h4>
        <ul class="benefits-list">
            <li>Direct farm supply ensures freshness and quality</li>
            <li>Multiple outlet formats for different investment levels</li>
            <li>Training in poultry handling, processing & customer service</li>
            <li>Marketing support and promotional materials for local engagement</li>
            <li>Operational guidance for route planning, deliveries, and inventory management</li>
            <li>Support for hygiene and sustainability standards across outlets</li>
        </ul>
    </div>

   <div class="standout-section">
    <h3>How Attila Stands Out</h3>

    <ul>
        <li>
            <strong>Farm-to-Table Quality:</strong>
            Sourced directly from Attila’s farms, ensuring full traceability, freshness, and premium quality.
        </li>

        <li>
            <strong>Sustainability & Responsibility:</strong>
            Eco-friendly packaging, responsible waste management, and energy-efficient operations across all outlets.
        </li>

        <li>
            <strong>Training & Franchise Support:</strong>
            Comprehensive training covering operations, customer service, food safety, and business management.
        </li>

        <li>
            <strong>Innovation & Menu Excellence:</strong>
            Continuous recipe development by our R&D team to stay competitive and delight customers.
        </li>

        <li>
            <strong>Community Impact:</strong>
            Creating local jobs, supporting suppliers, and building strong community connections.
        </li>
    </ul>
</div>


   <style>
    .metrics-section {
        text-align: center;
        padding: 40px 0;
    }

    .metrics-wrapper {
        display: flex;
        justify-content: center;
        gap: 60px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .metric {
        text-align: center;
        animation: fadeUp 0.8s ease both;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        transition: transform 0.3s ease;
    }

    .metric:hover {
        transform: scale(1.05);
    }

    .metric h4 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .metric p {
        margin-top: 5px;
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.8;
    }

    /* Fade + slide animation */
    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Delay each item for a smooth staggered reveal */
    .metric:nth-child(1) { animation-delay: 0.1s; }
    .metric:nth-child(2) { animation-delay: 0.3s; }
    .metric:nth-child(3) { animation-delay: 0.5s; }
    .metric:nth-child(4) { animation-delay: 0.7s; }
</style>

<div class="metrics-section">
    <h3>Key Numbers</h3>

    <div class="metrics-wrapper">
        <div class="metric">
            <h4>1</h4>
            <p>Operational Outlets</p>
        </div>
        <div class="metric">
            <h4>100+</h4>
            <p>Meals Served Monthly</p>
        </div>
        <div class="metric">
            <h4>1</h4>
            <p>Satisfied Franchisees</p>
        </div>
        <div class="metric">
            <h4>5km</h4>
            <p>Average Delivery Coverage</p>
        </div>
    </div>
</div>

<style>
.flowchart-section {
    width: 100%;
    padding: 50px 20px;
}

.flowchart-section h3 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 50px;
    text-align: center;
    color: #fe0000;
}

.flowchart-section h4 {
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

.flowchart-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    overflow-x: auto;
}

.mermaid {
    width: 100%;
    max-width: 1200px; 
    transform-origin: top center;
}

/* Zoom scales */
.mermaid.fastfood { zoom: 1.4; }
.mermaid.butchery { zoom: 1.6; }

/* Responsive zooming */
@media(max-width: 1200px) { .mermaid.butchery { zoom: 1.3; } }
@media(max-width: 992px)  { .mermaid.butchery { zoom: 1.1; } }
@media(max-width: 768px)  { .mermaid.fastfood, .mermaid.butchery { zoom: 1.0; } }
@media(max-width: 576px)  { .mermaid.fastfood, .mermaid.butchery { zoom: 0.85; } }
</style>

<div class="flowchart-section">

    <h3>Operational Flowcharts</h3>

    <!-- Fast-Food Flowchart -->
    <div class="mb-5">
        <h4 style="color:#ffc600;">Fast-Food Franchise</h4>
        <div class="flowchart-wrapper">
            <div class="mermaid fastfood">
%%{init: {"theme":"default","themeVariables":{"fontSize":"22px"}}}%%
flowchart TD
    style FF fill:#fe0000,stroke:#000,stroke-width:2px,color:#fff
    style SUP fill:#ffc600,stroke:#000,stroke-width:2px
    style KITCHEN fill:#ffc600,stroke:#000,stroke-width:2px
    style DELIVERY fill:#f1f1f1,stroke:#000,stroke-width:2px
    style DINING fill:#f1f1f1,stroke:#000,stroke-width:2px
    style CUSTOMER fill:#f1f1f1,stroke:#000,stroke-width:2px

    FF[🍔 Fast-Food Franchise] --> SUP[🏭 Farm Supply]
    SUP --> KITCHEN[🍳 Kitchen / Outlet Prep]
    KITCHEN --> DELIVERY[🚚 Delivery / Takeaway]
    KITCHEN --> DINING[🍽️ Dine-In Customers]
    DELIVERY --> CUSTOMER[👨‍👩‍👧‍👦 Customer]
    DINING --> CUSTOMER
            </div>
        </div>
    </div>

    <!-- Butchery Flowchart (Vertical, Short Multi-Line Labels) -->
    <div class="mb-5">
        <h4 style="color:#fe0000;">Butchery Franchise</h4>
   <div class="flowchart-wrapper">
    <div class="mermaid butchery">
%%{init: {"theme":"default","themeVariables":{"fontSize":"36px"}}}%%
flowchart TD
    %% Class definitions
    classDef central fill:#ffc600,stroke:#000,stroke-width:6px,font-size:40px,padding:50px;
    classDef franchise fill:#fe0000,stroke:#000,stroke-width:6px,font-size:40px,padding:50px;
    classDef channel fill:#ffc600,stroke:#000,stroke-width:5px,font-size:32px,padding:40px;
    classDef customer fill:#f1f1f1,stroke:#000,stroke-width:4px,font-size:28px,padding:30px;

    %% Level 1 & 2
    CENTRAL["❄️ Attila Stores / Coldrooms"]:::central --> FRANCHISE["🐔 Franchise Butchery Point"]:::franchise

    %% Level 3 (Channels)
    FRANCHISE --> FULL["🍗 Full-Service\nOutlet"]:::channel
    FRANCHISE --> CP["🏪 Collection / Pick-Up"]:::channel
    FRANCHISE --> RD["🚚 Route Distribution"]:::channel

    %% Level 4 (Customers)
    FULL --> CUSTOMER1["👨‍👩‍👧‍👦 On-site Customers"]:::customer
    CP --> CUSTOMER2["💻 Online Orders / Pick-Up"]:::customer
    RD --> CUSTOMER3["🏠 Home Delivery"]:::customer
    </div>
</div>

    </div>

</div>

<script type="module">
import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
mermaid.initialize({ startOnLoad: true, theme: 'default', flowchart: { curve: 'basis' } });
</script>



    {{-- CTA Section --}}
    <div class="cta-section mt-5">
        <h3>Ready to Join Attila Chicken?</h3>
        <p>Become a franchise partner and bring farm-fresh poultry to your community.</p>
        <a href="{{ route('home') }}" class="btn btn-learn fastfood-btn px-4 py-2 mt-2">Apply Now</a>
    </div>
</div>
@endsection
