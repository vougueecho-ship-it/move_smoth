@extends('layouts.master')

@section('title', 'Simple & Transparent Pricing | MoveSmooth')

@section('schema_breadcrumb')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
        },
        {
            "@@type": "ListItem",
            "position": 2,
            "name": "Pricing Plans",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebPage",
    "@@id": "{{ url()->current() }}#webpage",
    "url": "{{ url()->current() }}",
    "name": "Simple & Transparent Pricing | MoveSmooth",
    "description": "Join the fastest growing network of verified moving companies. Simple plans and transparent pricing for local and long distance moving operators.",
    "isPartOf": {
        "@@type": "WebSite",
        "@@id": "{{ url('/') }}#website"
    }
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "How do leads work on MoveSmooth?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Customers can request quotes directly from your profile. Professional and Enterprise plans get these leads instantly via email and their dashboard."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/pricing.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="pricing-hero">
    <div class="container">
        <h1>Transparent Plans for Every Mover</h1>
        <p class="lead text-muted">Join the fastest growing network of verified moving companies.</p>
    </div>
</section>

<div class="container pricing-grid">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="pricing-card">
                <h3 class="fw-bold mb-4">Basic</h3>
                <div class="price">$0<span>/mo</span></div>
                <p class="text-muted">Perfect for small local moving companies getting started.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Basic Company Profile</li>
                    <li><i class="fas fa-check-circle"></i> List in 1 City</li>
                    <li><i class="fas fa-check-circle"></i> Standard Lead Capture</li>
                    <li><i class="fas fa-check-circle"></i> Customer Reviews</li>
                </ul>
                <a href="{{ route('register.company') }}" class="btn-pricing btn-outline-primary">Get Started</a>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="pricing-card featured">
                <div class="featured-badge">MOST POPULAR</div>
                <h3 class="fw-bold mb-4">Professional</h3>
                <div class="price">$49<span>/mo</span></div>
                <p class="text-muted">For growing companies that want more visibility and leads.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Verified Badge</li>
                    <li><i class="fas fa-check-circle"></i> List in 5 Cities</li>
                    <li><i class="fas fa-check-circle"></i> Priority Search Results</li>
                    <li><i class="fas fa-check-circle"></i> Direct Quote Requests</li>
                    <li><i class="fas fa-check-circle"></i> Analytics Dashboard</li>
                </ul>
                <a href="{{ route('register.company') }}" class="btn-pricing btn-primary">Choose Pro</a>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="pricing-card">
                <h3 class="fw-bold mb-4">Enterprise</h3>
                <div class="price">$99<span>/mo</span></div>
                <p class="text-muted">Full exposure across your entire state with advanced tools.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> All Pro Features</li>
                    <li><i class="fas fa-check-circle"></i> Statewide Coverage</li>
                    <li><i class="fas fa-check-circle"></i> Featured Mover Status</li>
                    <li><i class="fas fa-check-circle"></i> API Access</li>
                    <li><i class="fas fa-check-circle"></i> 24/7 Priority Support</li>
                </ul>
                <a href="{{ route('register.company') }}" class="btn-pricing btn-outline-primary">Go Enterprise</a>
            </div>
        </div>
    </div>
</div>

<section class="faq-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-800">Frequently Asked Questions</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="pricingFaq">
                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How do leads work on MoveSmooth?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                            <div class="accordion-body">
                                Customers can request quotes directly from your profile. Professional and Enterprise plans get these leads instantly via email and their dashboard.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
