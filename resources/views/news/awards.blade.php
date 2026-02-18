@extends('layouts.app')

@section('title', 'FAQs | Our Farm')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">❓ Frequently Asked Questions</h1>

    <p class="lead">
        We value your curiosity. This FAQ section addresses the most common questions 
        about our poultry farming operations, food safety, and commitment to quality.
    </p>

    <hr class="my-4">

    <h2>Top Questions</h2>
    <div class="accordion" id="faqAccordion">

        <!-- Q1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    Do you use antibiotics in your chicken?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    No. We are committed to <strong>antibiotic-free farming</strong>. 
                    Our chickens are raised with natural health practices and carefully managed environments.
                </div>
            </div>
        </div>

        <!-- Q2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    How do you ensure food safety?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Our farm follows <strong>strict safety protocols</strong> during housing, feeding, and processing. 
                    Regular audits and quality checks guarantee consumer safety.
                </div>
            </div>
        </div>

        <!-- Q3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    Is your poultry farming sustainable?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes. We use eco-friendly feed, reduce water waste, and recycle resources 
                    to ensure our farms remain sustainable for future generations.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
