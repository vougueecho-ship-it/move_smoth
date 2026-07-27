@extends('layouts.master')

@section('title', 'Verified Moving Companies Directory | Local & Long Distance Movers | Move Smooth')
@section('meta_description', 'Browse our comprehensive moving directory to find fully licensed, top-rated moving companies by state and city. Read verified customer reviews and get free quotes.')

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
            "name": "Movers Directory",
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
    "name": "Verified Moving Companies Directory | Move Smooth",
    "description": "Browse our comprehensive moving directory to find fully licensed, top-rated moving companies by state and city. Read verified customer reviews and get free quotes."
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/movers_directory.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- Hero Header Section --}}
<section class="directory-hero">
    <div class="container text-center text-lg-start">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <nav class="breadcrumb-directory justify-content-center">
                    <a href="{{ route('front.home') }}">Home</a>
                    <i class="fas fa-chevron-right sep"></i>
                    <span class="current">Movers Directory</span>
                </nav>
                <h1 class="display-4 fw-900 text-white mb-3">Coverage Directory by State & City</h1>
                <p class="lead mx-auto mb-0">
                    Find professional, highly-rated, and fully verified local and interstate moving companies operating in your area. Select a state below to explore licensed movers.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Alphabetical Navigation Index --}}
<div class="container">
    <div class="state-index-nav">
        <div class="index-title text-center text-md-start"><i class="fas fa-filter me-1"></i> Quick State Index</div>
        @php
            $availableLetters = $states->map(fn($s) => strtoupper(substr($s->name, 0, 1)))->unique()->toArray();
            $alphabet = range('A', 'Z');
        @endphp
        <div class="index-letters justify-content-center justify-content-md-start">
            @foreach($alphabet as $letter)
                @if(in_array($letter, $availableLetters))
                    <a href="#state-group-{{ $letter }}" class="letter-btn">{{ $letter }}</a>
                @else
                    <span class="letter-btn disabled">{{ $letter }}</span>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- Directory Section --}}
<section class="directory-section bg-white">
    <div class="container">
        @php
            $currentLetter = '';
        @endphp

        @forelse($states as $state)
            @php
                $firstLetter = strtoupper(substr($state->name, 0, 1));
            @endphp

            @if($firstLetter !== $currentLetter)
                @php
                    $currentLetter = $firstLetter;
                @endphp
                <div id="state-group-{{ $currentLetter }}" class="group-anchor" style="scroll-margin-top: 40px;"></div>
            @endif

            <div class="state-group-card animate__animated animate__fadeIn">
                <div class="state-header-row">
                    <div class="state-title-wrap">
                        <div class="state-graphic-badge">{{ $state->code }}</div>
                        <div>
                            <h3>{{ $state->name }}</h3>
                        </div>
                    </div>
                    <div class="state-meta-info">
                        <span class="movers-count-tag">
                            <i class="fas fa-truck-moving"></i> {{ $state->companies_count }} Verified Movers
                        </span>
                        <a href="{{ route('front.state.movers', $state->slug ?: \Illuminate\Support\Str::slug($state->name)) }}" class="view-state-btn">
                            View All State Movers <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="cities-directory-grid">
                    @if(isset($cities[$state->id]) && $cities[$state->id]->count() > 0)
                        @foreach($cities[$state->id] as $city)
                            <a href="{{ route('front.city.movers', ['state' => strtolower($state->code), 'city' => $city->content->slug]) }}" class="city-link-card">
                                <span class="city-name-txt">{{ $city->name }}</span>
                                <i class="fas fa-chevron-right city-arrow-icon"></i>
                            </a>
                        @endforeach
                    @else
                        <div class="col-12 py-2">
                            <p class="text-muted small mb-0"><i class="fas fa-info-circle me-1"></i> No cities currently configured for this state. Check back soon!</p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <div class="display-1 text-muted mb-4"><i class="fas fa-map-marked-alt"></i></div>
                <h3 class="fw-800 text-muted">No Active Directory Coverage</h3>
                <p class="text-muted">There are no active coverage states configured in the system. Go to the admin dashboard to set states active!</p>
            </div>
        @endforelse
    </div>
</section>

{{-- Premium SEO Copywriting Section --}}
<section class="directory-seo-content bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="seo-rich-copy">
                    <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-shield-halved me-1"></i> Consumer Protection Guide</span>
                    <h2>How to Choose a Top-Rated Professional Moving Company</h2>
                    <p class="lead">
                        Relocating your home or office is a major lifecycle event. Finding a reliable, trustworthy moving partner makes all the difference. Our goal at Move Smooth is to simplify your selection process by providing you with fully vetted, licensed, and highly recommended interstate and local moving companies across the United States.
                    </p>
                    
                    <div class="row g-4 my-4">
                        <div class="col-md-4">
                            <div class="icon-box-feature">
                                <div class="feature-icon-container">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <h4 class="feature-title">Verify USDOT Registration</h4>
                                <p class="feature-desc">All interstate moving companies must register with the Federal Motor Carrier Safety Administration (FMCSA) and hold an active USDOT number. Never hire an unverified mover.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="icon-box-feature">
                                <div class="feature-icon-container blue">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h4 class="feature-title">Get Binding Estimates</h4>
                                <p class="feature-desc">Always request a binding or binding-not-to-exceed written quote. This protects you from unexpected surcharges and holds the moving company accountable to their pricing structure.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="icon-box-feature">
                                <div class="feature-icon-container">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h4 class="feature-title">Review Insurance Coverage</h4>
                                <p class="feature-desc">Understand the difference between released value protection (minimal default insurance) and full-value protection. Ensure your valuable goods are adequately insured.</p>
                            </div>
                        </div>
                    </div>

                    <h3>Federal Licensing and Consumer Rights</h3>
                    <p>
                        Interstate movers are heavily regulated by the United States Department of Transportation (DOT). When moving across state lines, professional movers are legally obligated to provide you with the FMCSA publication: <em>"Your Rights and Responsibilities When You Move."</em> This document outlines dispute resolution pathways, claims processes for damaged items, and rules governing pickup and delivery windows. 
                    </p>
                    <p>
                        For in-state, local moves, regulations are governed by individual state utility commissions or departments of consumer affairs. Each active state page in our directory provides detailed local consumer protection guidelines to ensure you remain fully informed throughout your short-distance or intra-state move.
                    </p>

                    <h3>Average Moving Costs & Cost Calculators</h3>
                    <p>
                        Estimating moving costs accurately requires assessing three core parameters: **total weight of goods** (or volume in cubic feet), **distance between locations**, and **ancillary services** (packing, storage, custom wood crating, or hoisting).
                    </p>
                    <ul>
                        <li><strong>Local Moves (Under 50 Miles):</strong> Typically calculated on an hourly basis. A standard 2-bedroom home requiring 3 professional movers usually averages between $100 to $180 per hour depending on labor rates in your specific city.</li>
                        <li><strong>Long Distance Moves (Over 100 Miles):</strong> Priced based on shipment weight and mileage. A cross-country relocation for a 3-bedroom home can range between $3,500 and $8,500 depending on specialty add-ons.</li>
                    </ul>
                    <p>
                        To get an instant, customized price range for your upcoming relocation, utilize our interactive <strong><a href="{{ route('front.calculator') }}">Moving Cost Calculator</a></strong>. It models real-time labor averages, packing costs, and mileage tariffs to give you an accurate binding estimate in seconds.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
