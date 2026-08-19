@extends('layouts.master')

@section('title', ($stateModel->meta_title ?? 'Trusted Moving Company in ' . $stateName . ' | Move Smooth'))
@section('meta_description', ($stateModel->meta_description ?? 'Compare and book the top-rated moving companies in ' . $stateName . '. Read verified reviews and get free quotes from licensed movers in ' . $stateName . ' today.'))

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
            "name": "Movers",
            "item": "{{ route('front.movers') }}"
        },
        {
            "@@type": "ListItem",
            "position": 3,
            "name": "{{ $stateName }} Movers",
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
    "@@type": "ItemPage",
    "mainEntity": {
        "@@type": "MovingCompany",
        "name": "Move Smooth {{ $stateName }}",
        "description": "Compare and book the top-rated moving companies in {{ $stateName }}.",
        "url": "{{ url()->current() }}",
        "address": {
            "@@type": "PostalAddress",
            "addressRegion": "{{ $stateModel->code }}",
            "addressCountry": "US"
        },
        "areaServed": {
            "@@type": "AdministrativeArea",
            "name": "{{ $stateName }}"
        }
    }
}
</script>
@if($companies->count() > 0)
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "ItemList",
    "name": "Top Movers in {{ $stateName }}",
    "numberOfItems": {{ $companies->count() }},
    "itemListElement": [
        @foreach($companies as $index => $company)
        {
            "@@type": "ListItem",
            "position": {{ $index + 1 }},
            "item": {
                "@@type": "MovingCompany",
                "name": "{{ $company->name }}",
                "url": "{{ route('front.company.profile', $company->slug) }}"
                @if($company->reviews_count > 0)
                ,"aggregateRating": {
                    "@@type": "AggregateRating",
                    "ratingValue": "{{ number_format($company->reviews_avg_rating, 1) }}",
                    "reviewCount": "{{ $company->reviews_count }}"
                }
                @endif
            }
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        @if(\Illuminate\Support\Facades\Schema::hasTable('state_faqs') && $stateModel->faqs->count() > 0)
            @foreach($stateModel->faqs as $index => $faq)
            {
                "@@type": "Question",
                "name": "{{ str_replace('"', '\"', $faq->question) }}",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "{{ str_replace('"', '\"', strip_tags($faq->answer)) }}"
                }
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        @else
            {
                "@@type": "Question",
                "name": "How much does a moving company cost in {{ $stateName }}?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Local moves in {{ $stateName }} typically cost between $400 and $1,500 depending on home size. Long-distance moves range from $2,500 to $6,000+ based on weight and mileage."
                }
            },
            {
                "@@type": "Question",
                "name": "Are moving companies in {{ $stateName }} licensed?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Yes. All movers listed on Move Smooth hold active operating authorities registered with USDOT and FMCSA."
                }
            },
            {
                "@@type": "Question",
                "name": "How do I get a moving estimate in {{ $stateName }}?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Use our free Moving Cost Calculator at the top of this page. Enter origin and destination, select move size, and get an instant estimate."
                }
            }
        @endif
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/state_movers.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- ====================== HERO WITH MULTI-STEP CALCULATOR ====================== --}}
@php
    $stateCodeLower = strtolower($stateModel->code);
    $stateImagePath = "images/states/{$stateCodeLower}.jpg";
    $hasStateImage = file_exists(public_path($stateImagePath)) || file_exists(base_path('public_html/' . $stateImagePath));
@endphp
<section class="state-hero {{ $hasStateImage ? 'has-bg-img' : '' }}" @if($hasStateImage) style="background-image: url('{{ asset($stateImagePath) }}');" @endif>
    <div class="container">
        <div class="row align-items-center g-5">
            {{-- Left: Heading --}}
            <div class="col-lg-6">
                <nav class="breadcrumb-nav">
                    <a href="{{ route('front.home') }}">Home</a>
                    <i class="fas fa-chevron-right sep"></i>
                    <a href="{{ route('front.movers') }}">Movers</a>
                    <i class="fas fa-chevron-right sep"></i>
                    <span class="current">{{ $stateName }}</span>
                </nav>

                <h1 class="display-5 fw-900 mb-3">{{ $stateModel->heading ?? 'Trusted Moving Company in ' . $stateName }}</h1>
                <p class="hero-desc mb-0">
                    Compare licensed movers, read verified reviews, and estimate your moving costs — all in one place. Serving every county across {{ $stateName }}.
                </p>

                <div class="hero-trust">
                    <div class="trust-pill"><i class="fas fa-shield-halved"></i> FMCSA Verified</div>
                    <div class="trust-pill"><i class="fas fa-star"></i> 4.8/5 Rating</div>
                    <div class="trust-pill"><i class="fas fa-truck-fast"></i> {{ $companies->total() > 0 ? $companies->total() : rand(15,35) }}+ Movers</div>
                </div>
            </div>

            {{-- Right: Multi-Step Calculator --}}
            <div class="col-lg-6">
                <div class="state-calc-card" id="stateCalcCard">
                    <div class="calc-header">
                        <div class="calc-header-icon"><i class="fas fa-calculator"></i></div>
                        <div>
                            <h4>Moving Cost Calculator</h4>
                            <p>Get your free instant estimate</p>
                        </div>
                    </div>
                    <div class="calc-body">
                        {{-- Progress Bar --}}
                        <div class="calc-progress">
                            <div class="calc-progress-step active" id="prog-1"></div>
                            <div class="calc-progress-step" id="prog-2"></div>
                            <div class="calc-progress-step" id="prog-3"></div>
                            <div class="calc-progress-step" id="prog-4"></div>
                        </div>

                        <form id="stateCalcForm" novalidate>
                            @csrf
                            <input type="hidden" name="move_size" id="sc_move_size" value="Studio / 1BR">
                            <input type="hidden" name="packing_service" id="sc_packing" value="No Packing">
                            <input type="hidden" name="storage_option" id="sc_storage" value="No Storage">

                            {{-- ====== STEP 1: Location ====== --}}
                            <div class="state-calc-step active" id="sc-step-1">
                                <div class="step-badge"><i class="fas fa-map-pin"></i> Step 1 of 4</div>
                                <div class="step-title">Where are you moving?</div>

                                <div class="calc-input-group">
                                    <label>Moving From</label>
                                    <div class="calc-input-box zip-input-wrapper" id="box-from">
                                        <i class="fas fa-location-dot"></i>
                                        <input type="text" name="zip_from" id="sc_zip_from" class="zip-autocomplete" placeholder="Enter ZIP code or city" autocomplete="off" required>
                                        <div class="zip-autocomplete-dropdown"></div>
                                    </div>
                                    <div class="validation-msg" id="err-from">Please enter your origin ZIP or city.</div>
                                </div>

                                <div class="calc-input-group">
                                    <label>Moving To</label>
                                    <div class="calc-input-box zip-input-wrapper" id="box-to">
                                        <i class="fas fa-location-crosshairs"></i>
                                        <input type="text" name="zip_to" id="sc_zip_to" class="zip-autocomplete" placeholder="Enter ZIP code or city" autocomplete="off" required>
                                        <div class="zip-autocomplete-dropdown"></div>
                                    </div>
                                    <div class="validation-msg" id="err-to">Please enter your destination ZIP or city.</div>
                                </div>

                                <button type="button" class="calc-btn-next" id="btn-step1-next" onclick="scGoTo(2)">
                                    Next: Select Move Size <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>

                            {{-- ====== STEP 2: Move Size ====== --}}
                            <div class="state-calc-step" id="sc-step-2">
                                <div class="step-badge"><i class="fas fa-box-open"></i> Step 2 of 4</div>
                                <div class="step-title">What's your move size?</div>

                                <div class="row g-2 mb-3">
                                    <div class="col-4">
                                        <div class="size-card active" onclick="scSelectSize('Studio / 1BR', this)">
                                            <div class="size-card-icon"><i class="fas fa-door-open"></i></div>
                                            <h6>Studio / 1BR</h6>
                                            <p>Apartment</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="size-card" onclick="scSelectSize('2 - 3 Bedroom', this)">
                                            <div class="size-card-icon"><i class="fas fa-house-chimney"></i></div>
                                            <h6>2-3 Bedroom</h6>
                                            <p>Family Home</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="size-card" onclick="scSelectSize('4+ Bedroom', this)">
                                            <div class="size-card-icon"><i class="fas fa-hotel"></i></div>
                                            <h6>4+ Bedroom</h6>
                                            <p>Large Estate</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button type="button" class="calc-btn-back" onclick="scGoTo(1)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                                    <button type="button" class="calc-btn-next" style="width: auto; padding: 12px 32px;" onclick="scGoTo(3)">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            {{-- ====== STEP 3: Extra Services ====== --}}
                            <div class="state-calc-step" id="sc-step-3">
                                <div class="step-badge"><i class="fas fa-hand-holding-box"></i> Step 3 of 4</div>
                                <div class="step-title">Need extra services?</div>

                                <label style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700; color: #64748b; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">Packing</label>
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <div class="opt-pill active" onclick="scSelectPacking('No Packing', this)">
                                        <h6><i class="fas fa-hand me-2 text-muted"></i>I'll Pack Myself</h6>
                                        <div class="opt-price">$0 — Free</div>
                                    </div>
                                    <div class="opt-pill" onclick="scSelectPacking('Partial Packing', this)">
                                        <h6><i class="fas fa-box-open me-2 text-muted"></i>Partial Packing</h6>
                                        <div class="opt-desc">Fragile & heavy items only</div>
                                        <div class="opt-price">+$250</div>
                                    </div>
                                    <div class="opt-pill" onclick="scSelectPacking('Full Packing', this)">
                                        <h6><i class="fas fa-boxes-stacked me-2 text-muted"></i>Full Packing</h6>
                                        <div class="opt-desc">Professional packers wrap everything</div>
                                        <div class="opt-price">+$500</div>
                                    </div>
                                </div>

                                <label style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700; color: #64748b; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">Storage</label>
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <div class="opt-pill active" id="sc-stor-1" onclick="scSelectStorage('No Storage', this)">
                                        <h6><i class="fas fa-house me-2 text-muted"></i>No Storage Needed</h6>
                                        <div class="opt-price">$0 — Free</div>
                                    </div>
                                    <div class="opt-pill" id="sc-stor-2" onclick="scSelectStorage('Storage Required', this)">
                                        <h6><i class="fas fa-warehouse me-2 text-muted"></i>Storage-in-Transit</h6>
                                        <div class="opt-desc">Climate-controlled secure storage</div>
                                        <div class="opt-price">+$300</div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button type="button" class="calc-btn-back" onclick="scGoTo(2)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                                    <button type="button" class="calc-btn-next" style="width: auto; padding: 12px 32px;" onclick="scGoTo(4)">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            {{-- ====== STEP 4: Contact Details ====== --}}
                            <div class="state-calc-step" id="sc-step-4">
                                <div class="step-badge"><i class="fas fa-user-check"></i> Step 4 of 4</div>
                                <div class="step-title">Your contact details</div>

                                <div class="calc-input-group">
                                    <label>Full Name</label>
                                    <div class="calc-input-box" id="box-name">
                                        <i class="fas fa-user"></i>
                                        <input type="text" name="name" id="sc_name" placeholder="John Doe" required>
                                    </div>
                                    <div class="validation-msg" id="err-name">Please enter your full name.</div>
                                </div>

                                <div class="calc-input-group">
                                    <label>Email Address</label>
                                    <div class="calc-input-box" id="box-email">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" name="email" id="sc_email" placeholder="john@example.com" required>
                                    </div>
                                    <div class="validation-msg" id="err-email">Please enter a valid email address.</div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="calc-input-group">
                                            <label>Phone</label>
                                            <div class="calc-input-box" id="box-phone">
                                                <i class="fas fa-phone"></i>
                                                <input type="tel" name="phone" id="sc_phone" placeholder="(555) 555-5555" required>
                                            </div>
                                            <div class="validation-msg" id="err-phone">Please enter a phone number.</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="calc-input-group">
                                            <label>Move Date</label>
                                            <div class="calc-input-box" id="box-date">
                                                <i class="fas fa-calendar"></i>
                                                <input type="text" name="move_date" id="sc_move_date" class="flatpickr-date" placeholder="Select Date" style="cursor: pointer;" required>
                                            </div>
                                            <div class="validation-msg" id="err-date">Please select a move date.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <button type="button" class="calc-btn-back" onclick="scGoTo(3)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                                    <button type="submit" class="calc-btn-next" id="sc-submit-btn" style="width: auto; padding: 12px 32px;">
                                        Get My Estimate <i class="fas fa-calculator ms-2"></i>
                                    </button>
                                </div>

                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <i class="fas fa-lock text-success" style="font-size: 0.7rem;"></i>
                                    <span class="text-muted" style="font-size: 0.68rem;">100% Free · No Obligation · SSL Encrypted</span>
                                </div>
                            </div>

                            {{-- ====== STEP 5: Success Result ====== --}}
                            <div class="state-calc-step" id="sc-step-5">
                                <div class="calc-result">
                                    <div class="check-icon"><i class="fas fa-check-circle"></i></div>
                                    <div class="result-price" id="sc-result-price">$0 – $0</div>
                                    <div class="result-sub mb-3" id="sc-result-sub">Estimated moving cost range</div>

                                    <table class="summary-table">
                                        <tr><td>From</td><td id="sc-sum-from">—</td></tr>
                                        <tr><td>To</td><td id="sc-sum-to">—</td></tr>
                                        <tr><td>Move Size</td><td id="sc-sum-size">—</td></tr>
                                        <tr><td>Distance</td><td id="sc-sum-dist">— miles</td></tr>
                                        <tr><td>Packing</td><td id="sc-sum-pack">—</td></tr>
                                        <tr><td>Storage</td><td id="sc-sum-stor">—</td></tr>
                                    </table>
                                </div>
                                <p class="text-muted text-center mt-3" style="font-size: 0.75rem;">A Move Smooth coordinator will contact you within 24 hours with binding quotes from top-rated movers.</p>
                                <button type="button" class="calc-btn-next mt-2" onclick="scReset()"><i class="fas fa-redo me-2"></i> Calculate Another Move</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ====================== MAIN CONTENT ====================== --}}
<div class="container py-5">
    <div class="row g-5">
        {{-- Left Column --}}
        <div class="col-lg-10 mx-auto">

            {{-- Statewide Services --}}
            <section class="mb-5">
                <span class="section-badge"><i class="fas fa-truck-moving"></i> Statewide Services</span>
                <h2 class="fw-800 text-primary mb-3" style="font-size: 1.4rem;">Complete Moving Solutions in {{ $stateName }}</h2>
                <p class="text-muted mb-4" style="line-height: 1.85; font-size: 0.92rem;">Whether you're relocating across town or moving to a new state, <strong>Move Smooth</strong> connects you with fully vetted, FMCSA-verified moving professionals serving every county in {{ $stateName }}.</p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="svc-card">
                            <div class="svc-icon"><i class="fas fa-truck-moving"></i></div>
                            <h5 class="fw-bold text-primary mb-2" style="font-size: 0.95rem;">Local Moving</h5>
                            <p class="small text-muted mb-0" style="line-height: 1.7;">Same-day and hourly household relocation within {{ $stateName }}. Fully insured crews handle loading, transport, and unloading.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="svc-card">
                            <div class="svc-icon"><i class="fas fa-route"></i></div>
                            <h5 class="fw-bold text-primary mb-2" style="font-size: 0.95rem;">Long Distance</h5>
                            <p class="small text-muted mb-0" style="line-height: 1.7;">Licensed interstate carriers with transparent per-mile pricing and dedicated GPS-tracked fleet management.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="svc-card">
                            <div class="svc-icon"><i class="fas fa-box-open"></i></div>
                            <h5 class="fw-bold text-primary mb-2" style="font-size: 0.95rem;">Professional Packing</h5>
                            <p class="small text-muted mb-0" style="line-height: 1.7;">Double-walled boxes, custom crating for artwork, and bubble wrap protection. Save time with full-service packing.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="svc-card">
                            <div class="svc-icon"><i class="fas fa-warehouse"></i></div>
                            <h5 class="fw-bold text-primary mb-2" style="font-size: 0.95rem;">Secure Storage</h5>
                            <p class="small text-muted mb-0" style="line-height: 1.7;">Climate-controlled warehouse vaults with 24/7 surveillance. Flexible terms for short-term and long-term storage.</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Service Interlinking --}}
            <section class="mb-5 pt-4 border-top">
                <div class="interlink-box">
                    <span class="section-badge"><i class="fas fa-link"></i> Explore Services</span>
                    <p class="text-muted mb-0" style="line-height: 1.9; font-size: 0.9rem;">
                        Need local help? Visit our
                        <a href="{{ route('front.service.local') }}">Local Moving</a> page.
                        For cross-country relocations, see
                        <a href="{{ route('front.service.long') }}">Long Distance Moving</a>.
                        We also specialize in
                        <a href="{{ route('front.service.residential') }}">Residential</a>,
                        <a href="{{ route('front.service.commercial') }}">Commercial</a>, and
                        <a href="{{ route('front.service.packing') }}">Packing Services</a>.
                    </p>
                </div>
            </section>

            {{-- ====================== DYNAMIC CONTENT ABOVE ====================== --}}
            @if($stateModel->content)
            <section class="mb-5 pt-4">
                <span class="section-badge"><i class="fas fa-book-open"></i> {{ $stateName }} Moving Guide</span>
                <div class="state-rich-content text-muted mt-3" style="line-height: 1.9; font-size: 0.9rem;">
                    {!! $stateModel->content !!}
                </div>
            </section>
            @endif

            {{-- ====================== DYNAMIC BOTTOM MOVERS SUMMARY TABLE ====================== --}}
            @if($bottomMovers->count() > 0)
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-list-ol text-success"></i> Top Verified Movers</span>
                <h3 class="fw-800 text-primary mb-4" style="font-size: 1.3rem;">Top-Rated Moving Companies in {{ $stateName }}</h3>
                <div class="table-responsive">
                    <table class="cost-table">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Rating</th>
                                <th>Core Speciality</th>
                                <th>Mover Profile Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bottomMovers as $company)
                            <tr>
                                <td><strong>{{ $company->name }}</strong></td>
                                <td>
                                    <span class="text-warning">
                                        @php
                                            $ratingVal = number_format($company->reviews_avg_rating ?? 0.0, 1);
                                        @endphp
                                        &#9733; {{ $ratingVal }} / 5.0
                                    </span>
                                </td>
                                <td>{{ Str::limit($company->description ?? 'Full-Service Residential Relocations & Local Packing Helpers', 65) }}</td>
                                <td>
                                    <a href="{{ route('front.company.profile', $company->slug) }}" class="tag-good" style="text-decoration: none;">View Profile</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            @endif

            {{-- ====================== DYNAMIC TOP MOVERS CARDS ====================== --}}
            @if($topMovers->count() > 0)
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-crown text-warning"></i> Featured Movers</span>
                <h3 class="fw-800 text-primary mb-5" style="font-size: 1.3rem;">Top 3 Best Moving Companies in {{ $stateName }}</h3>
                <div class="row g-4 mb-4">
                    @foreach($topMovers as $index => $company)
                    @php
                        $badges = ['Best for Quality Moves', 'Best for Reliability', 'Best for Overall Service'];
                        $badge = $company->mover_badge ?? $badges[$index % count($badges)];
                        
                        $highlights = [
                            ['Nationwide Network', 'Customer Satisfaction Guarantee', 'Dedicated Cargo Support'],
                            ['Deep Industry Experience', 'Competitive Flat Rates', 'Safe Appliance Handling'],
                            ['Transparent Pricing Policy', 'Exceptional Client Care', 'Vetted & Bonded Crew']
                        ];
                        
                        $hl = [
                            $company->mover_heading_1 ?? $highlights[$index % count($highlights)][0],
                            $company->mover_heading_2 ?? $highlights[$index % count($highlights)][1],
                            $company->mover_heading_3 ?? $highlights[$index % count($highlights)][2]
                        ];
                        $ratingVal = number_format($company->reviews_avg_rating ?? 0.0, 1);
                    @endphp
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center d-flex flex-column align-items-center position-relative" style="border: 2px solid {{ $index === 0 ? 'var(--accent)' : '#e2e8f0' }} !important; background: #ffffff; border-radius: 20px;">
                            <div class="position-absolute top-0 start-50 translate-middle-y px-3 py-1 rounded-pill small fw-bold text-white shadow-sm" style="background: {{ $index === 0 ? 'var(--accent)' : 'var(--primary)' }}; font-size: 0.72rem; letter-spacing: 0.5px; text-transform: uppercase;">
                                {{ $badge }}
                            </div>
                            <div class="mover-logo my-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: #f0f4ff; border-radius: 16px; border: 1.5px solid #dce5f3; overflow: hidden;">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                @else
                                    <span class="fw-bold text-primary" style="font-size: 1.5rem;">{{ strtoupper(substr($company->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            <h4 class="fw-bold text-primary mb-2" style="font-size: 1rem;">{{ $company->name }}</h4>
                            <div class="text-warning mb-2" style="font-size: 1.1rem; letter-spacing: 2px;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($ratingVal >= $i)
                                        <i class="fas fa-star"></i>
                                    @elseif($ratingVal >= ($i - 0.5))
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="fw-bold text-primary mb-3" style="font-size: 0.9rem;">
                                {{ $ratingVal }} (Move Smooth Rating)
                            </div>
                            
                            <hr style="width: 100%; border-color: #e2e8f0;" class="my-2">
                            
                            <ul class="list-unstyled text-start w-100 mb-4 flex-grow-1" style="font-size: 0.82rem; color: #64748b; line-height: 2;">
                                @foreach($hl as $item)
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i> {{ $item }}</li>
                                @endforeach
                            </ul>
                            
                            <a href="#stateCalcCard" class="btn-accent w-100 text-center py-2.5" style="font-size: 0.82rem; border-radius: 50px;">Get Free Estimates</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- ====================== DYNAMIC BOTTOM MOVERS SHOWCASE CARDS ====================== --}}
            @if($bottomMovers->count() > 0)
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-list-ol text-success"></i> Detailed Mover Reviews</span>
                <h3 class="fw-800 text-primary mb-4" style="font-size: 1.3rem;">In-Depth Reviews of the Best Movers in {{ $stateName }}</h3>
                
                @foreach($bottomMovers as $index => $company)
                @php
                    $badges = ['Best for Full-service Moves', 'Best for Local Shifting', 'Best Family Mover', 'Best for Long Distance', 'Best Budget Value'];
                    $badge = $badges[$index % count($badges)];
                    
                    $ratingVal = number_format($company->reviews_avg_rating ?? 0.0, 1);
                    $reviewsCount = $company->reviews_count;
                    
                    $pros = ['Fully licensed, insured & TxDMV/CPUC registered', 'Zero hidden fees with clear hourly & weight estimates', 'Background-checked, drug-tested highly trained crews'];
                    $cons = ['Rates can be elevated during peak summer weekends', 'Requires 3-5 weeks advance reservation during peak season'];
                    
                    $cityLabel = $company->city ?? 'Los Angeles';
                @endphp
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="border: 1px solid #e2e8f0 !important; background: #ffffff; border-radius: 20px;">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <span class="badge rounded-pill px-3 py-1.5 small text-white" style="background: var(--accent); font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $badge }}
                        </span>
                    </div>
                    
                    <div class="row align-items-center g-4">
                        {{-- Left Column: Logo & Ratings --}}
                        <div class="col-md-3 text-center border-md-end border-slate">
                            <div class="mover-logo mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: #f0f4ff; border-radius: 16px; border: 1.5px solid #dce5f3; overflow: hidden;">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                @else
                                    <span class="fw-bold text-primary" style="font-size: 1.3rem;">{{ strtoupper(substr($company->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            <div class="fw-bold text-primary" style="font-size: 1.2rem;">{{ $ratingVal }}</div>
                            <div class="text-warning mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                            <div class="text-muted small">({{ $reviewsCount }} reviews)</div>
                        </div>
                        
                        {{-- Middle Column: Name & Highlights --}}
                        <div class="col-md-6">
                            <h4 class="fw-bold text-primary mb-3">{{ $company->name }}</h4>
                            <ul class="list-unstyled" style="font-size: 0.85rem; color: #475569; line-height: 1.8;">
                                <li><i class="fas fa-check text-success me-2"></i> Nationwide Vetted Coverage Area</li>
                                <li><i class="fas fa-check text-success me-2"></i> Fully Vetted Background-Checked Crew</li>
                                <li><i class="fas fa-check text-success me-2"></i> Premium Damage Cargo Protection</li>
                            </ul>
                        </div>
                        
                        {{-- Right Column: Quote Button --}}
                        <div class="col-md-3 text-center text-md-end">
                            <a href="#stateCalcCard" class="btn-accent rounded-pill px-4 py-2.5" style="font-size: 0.82rem; text-decoration: none;">Get A Quote</a>
                        </div>
                    </div>
                    
                    <hr class="my-4" style="border-color: #e2e8f0;">
                    
                    {{-- Description --}}
                    <div class="text-muted mb-4" style="line-height: 1.8; font-size: 0.88rem;">
                        {{ $company->description ?? "{$company->name} is a premier moving company operating out of {$cityLabel}, {$stateName}. Known for exceptional care, highly competitive rates, and background-checked professional crews, they specialize in seamless local relocations and long-distance intrastate shifting with a modern GPS-tracked fleet." }}
                    </div>
                    
                    {{-- Collapsible Accordions --}}
                    @if($company->mover_content)
                        {!! str_replace('__ID__', $company->id, $company->mover_content) !!}
                    @else
                    <div class="accordion" id="moverAcc-{{ $company->id }}">
                        {{-- Accordion 1: Pros & Cons --}}
                        <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm" style="border: 1px solid #e2e8f0 !important; border-radius: 10px !important;">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-primary" style="font-size: 0.82rem; padding: 12px 18px; background: #f8fafc;" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePros-{{ $company->id }}">
                                    Pros And Cons
                                </button>
                            </h5>
                            <div id="collapsePros-{{ $company->id }}" class="accordion-collapse collapse" data-bs-parent="#moverAcc-{{ $company->id }}">
                                <div class="accordion-body p-3 bg-white">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <h6 class="fw-bold text-success small mb-2"><i class="fas fa-thumbs-up me-1"></i> Pros</h6>
                                            <ul class="list-unstyled small text-muted">
                                                @foreach($pros as $pro)
                                                <li class="mb-1"><i class="fas fa-check text-success me-1"></i> {{ $pro }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-danger small mb-2"><i class="fas fa-thumbs-down me-1"></i> Cons</h6>
                                            <ul class="list-unstyled small text-muted">
                                                @foreach($cons as $con)
                                                <li class="mb-1"><i class="fas fa-times text-danger me-1"></i> {{ $con }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Accordion 2: Average Cost --}}
                        <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm" style="border: 1px solid #e2e8f0 !important; border-radius: 10px !important;">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-primary" style="font-size: 0.82rem; padding: 12px 18px; background: #f8fafc;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCost-{{ $company->id }}">
                                    Average Cost
                                </button>
                            </h5>
                            <div id="collapseCost-{{ $company->id }}" class="accordion-collapse collapse" data-bs-parent="#moverAcc-{{ $company->id }}">
                                <div class="accordion-body p-3 bg-white text-muted small" style="line-height: 1.7;">
                                    A typical local relocation in {{ $stateName }} with <strong>{{ $company->name }}</strong> generally ranges from <strong>$140 to $220 per hour</strong>, depending on the number of packers and movers required (typically a 3-man crew is standard). For long-distance relocations crossing state borders or moving city-to-city within the state, costs are calculated based on weight and total travel mileage, averaging between <strong>$1,800 and $4,500</strong> for a fully loaded family apartment. Request a free moving estimate above to secure binding written rates.
                                </div>
                            </div>
                        </div>
                        
                        {{-- Accordion 3: Qualities --}}
                        <div class="accordion-item border-0 rounded-3 overflow-hidden shadow-sm" style="border: 1px solid #e2e8f0 !important; border-radius: 10px !important;">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-primary" style="font-size: 0.82rem; padding: 12px 18px; background: #f8fafc;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQual-{{ $company->id }}">
                                    Qualities That Make It The Best Local Moving Company In {{ $stateName }}
                                </button>
                            </h5>
                            <div id="collapseQual-{{ $company->id }}" class="accordion-collapse collapse" data-bs-parent="#moverAcc-{{ $company->id }}">
                                <div class="accordion-body p-3 bg-white text-muted small" style="line-height: 1.7;">
                                    What makes <strong>{{ $company->name }}</strong> truly stand out in {{ $stateName }} is their unwavering commitment to cargo safety and complete service transparency. By employing fully-vetted, background-checked moving crews rather than casual day laborers, they ensure absolute protection for your valuable furniture. Their teams utilize premium heavy-duty packing blankets, custom wood crating for delicate artwork, and highly secure climate-controlled warehouses. Their strict 'no-hidden-fees' guarantee is backed by comprehensive transit insurance policies, making them a premier, top-rated moving provider.
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </section>
            @endif

            {{-- Mover Directory Section --}}
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-list"></i> Mover Directory</span>
                <h3 class="fw-800 text-primary mb-4" style="font-size: 1.3rem;">Best Moving Companies in {{ $stateName }}</h3>
                <p class="text-muted small mb-4">Browse ratings, read verified customer reviews, and find active operating licenses for all professional movers operating in {{ $stateName }}. Get free estimates instantly.</p>

                <div class="row">
                    @forelse($companies as $company)
                    <div class="col-lg-6 mb-4">
                        <div class="mover-directory-card h-100">
                            <div class="mover-directory-card-body">
                                <div class="mover-directory-card-logo-area">
                                    @if($company->logo_url)
                                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }} Logo">
                                    @else
                                        <div class="mover-directory-card-logo-fallback">
                                            {{ strtoupper(substr($company->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mover-directory-card-info-area">
                                    <h4 class="mover-directory-card-title">
                                        <a href="{{ route('front.company.profile', $company->slug) }}" title="{{ $company->name }}">
                                            {{ $company->name }}
                                            <img src="{{ asset('images/verified_badge.png') }}" alt="Verified" class="mover-verified-check" style="width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; display: inline-block; vertical-align: middle; margin-left: 6px;">
                                        </a>
                                    </h4>
                                    <div class="mover-directory-card-rating-row">
                                        <div class="mover-directory-card-stars">
                                            @php
                                                $stars = (float)($company->reviews_count > 0 ? ($company->reviews_avg_rating ?? 0) : 0);
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($stars >= $i)
                                                    <i class="fas fa-star"></i>
                                                @elseif($stars >= ($i - 0.5))
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="mover-directory-card-rating-num">{{ $stars > 0 ? number_format($stars, 1) : '0.0' }}/5</span>
                                        <span class="mover-directory-card-reviews">({{ $company->reviews_count }} {{ $company->reviews_count == 1 ? 'Review' : 'Reviews' }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mover-directory-card-footer">
                                <a href="{{ route('front.company.profile', $company->slug) }}" class="btn-learn">Learn More</a>
                                <a href="{{ route('front.contact-mover', $company->slug) }}" class="btn-estimate text-decoration-none">Free Estimate</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm border">
                        <i class="fas fa-truck-loading fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No moving companies available in this state's directory at this time.</p>
                    </div>
                    @endforelse
                </div>

                @if($companies->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {!! $companies->links() !!}
                </div>
                @endif
            </section>

            {{-- ====================== DYNAMIC CONTENT BELOW ====================== --}}
            @if($stateModel->content_below)
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-book-open"></i> {{ $stateName }} Relocation Guide Continued</span>
                <div class="state-rich-content text-muted mt-3" style="line-height: 1.9; font-size: 0.9rem;">
                    {!! $stateModel->content_below !!}
                </div>
            </section>
            @endif
            {{-- Major Cities Served --}}
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-city"></i> Major Cities Served</span>
                <h3 class="fw-800 text-primary mb-4" style="font-size: 1.3rem;">Explore Local Movers in {{ $stateName }}</h3>
                @if($cities->count() > 0)
                <div class="cities-grid">
                    @foreach($cities as $city)
                        @if($city->content)
                        <div class="city-card">
                            <h4>{{ $city->name }}</h4>
                            @php
                                $city_hash = crc32($city->name);
                                $min_rent = 900 + ($city_hash % 11) * 100;
                                $max_rent = $min_rent + 600 + ($city_hash % 9) * 100;
                                
                                $vibes = [
                                    "Vibrant culture, booming economy, and outstanding local moving logistics.",
                                    "Excellent schools, family-friendly neighborhoods, and top-tier moving support.",
                                    "Scenic mountain views, active outdoor lifestyle, and reliable regional movers.",
                                    "Diverse community hubs, affordable living, and highly-rated transport options.",
                                    "Growing technology sectors, rich historic charm, and seamless residential transit.",
                                    "Thriving art scenes, beautiful public spaces, and professional moving crews."
                                ];
                                $vibe = $vibes[$city_hash % count($vibes)];
                            @endphp
                            <div class="city-rent">${{ number_format($min_rent) }} – ${{ number_format($max_rent) }} / mo</div>
                            <div class="city-vibe">{{ $vibe }}</div>
                            <a href="{{ route('front.city.movers', ['state' => strtolower($stateModel->code), 'city' => $city->content->slug]) }}">
                                Find Movers in {{ $city->name }} <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
                @else
                <p class="text-muted small mb-0">City pages are coming soon for {{ $stateName }}.</p>
                @endif
            </section>

            {{-- FAQs --}}
            <section class="mb-5 pt-4 border-top">
                <span class="section-badge"><i class="fas fa-circle-question"></i> FAQ</span>
                <h3 class="fw-800 text-primary mb-4" style="font-size: 1.3rem;">Frequently Asked Questions About Moving in {{ $stateName }}</h3>
                <div class="accordion state-faq" id="stateFaqAccordion">
                    @if(\Illuminate\Support\Facades\Schema::hasTable('state_faqs') && $stateModel->faqs->count() > 0)
                        @foreach($stateModel->faqs as $index => $faq)
                        <div class="accordion-item border-0 mb-3">
                            <h4 class="accordion-header">
                                <button class="accordion-button rounded-3 {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq-dyn-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $faq->question }}
                                </button>
                            </h4>
                            <div id="sfaq-dyn-{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#stateFaqAccordion">
                                <div class="accordion-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="accordion-item border-0 mb-3">
                            <h4 class="accordion-header">
                                <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq1">
                                    How much does a moving company cost in {{ $stateName }}?
                                </button>
                            </h4>
                            <div id="sfaq1" class="accordion-collapse collapse show" data-bs-parent="#stateFaqAccordion">
                                <div class="accordion-body">
                                    Local moves in {{ $stateName }} typically cost between <strong>$400 and $1,500</strong> depending on home size and hourly labor rates. Long-distance relocations crossing state boundaries range from <strong>$2,500 to $6,000+</strong> based on total shipment weight and door-to-door mileage. Use our free calculator above for a personalized estimate.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq2">
                                    Are moving companies in {{ $stateName }} licensed and insured?
                                </button>
                            </h4>
                            <div id="sfaq2" class="accordion-collapse collapse" data-bs-parent="#stateFaqAccordion">
                                <div class="accordion-body">
                                    Yes. Every mover listed on Move Smooth must hold an active USDOT number and be registered with the Federal Motor Carrier Safety Administration (FMCSA). We verify operating authority, insurance coverage, and complaint history before listing any company.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq3">
                                    How do I get a free moving estimate in {{ $stateName }}?
                                </button>
                            </h4>
                            <div id="sfaq3" class="accordion-collapse collapse" data-bs-parent="#stateFaqAccordion">
                                <div class="accordion-body">
                                    Use the <strong>Moving Cost Calculator</strong> at the top of this page. Enter your origin and destination ZIP codes, select your move size, add optional packing or storage services, and provide your contact details. You'll receive an instant cost range estimate — completely free with no obligation.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq4">
                                    When is the cheapest time to move in {{ $stateName }}?
                                </button>
                            </h4>
                            <div id="sfaq4" class="accordion-collapse collapse" data-bs-parent="#stateFaqAccordion">
                                <div class="accordion-body">
                                    Moving during <strong>fall and winter months (October–February)</strong> is generally 20–30% cheaper than peak summer season. Mid-week moves (Tuesday–Thursday) and mid-month dates also tend to offer lower rates due to reduced demand.
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>

{{-- ====================== BOTTOM CTA ====================== --}}
<section class="state-bottom-cta text-center">
    <div class="container position-relative" style="z-index: 2;">
        <h2 class="fw-800 mb-3 display-6">Ready to Move in {{ $stateName }}?</h2>
        <p class="lead mb-4 col-lg-7 mx-auto">Compare rates, read reviews, and get your instant moving cost estimate from top-rated licensed professionals.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#stateCalcCard" class="btn btn-accent btn-lg px-5 py-3 fw-800 rounded-pill shadow-lg"><i class="fas fa-calculator me-2"></i> Estimate My Move</a>
            <a href="{{ route('front.movers') }}" class="btn btn-outline-dark btn-lg px-5 py-3 fw-800 rounded-pill">Browse All Movers</a>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script>
(function() {
    // ============================================================
    // State Page Multi-Step Calculator — Full Logic
    // ============================================================
    let currentStep = 1;
    let scMoveSize = 'Studio / 1BR';
    let scPacking = 'No Packing';
    let scStorage = 'No Storage';

    // ---------- Step Navigation ----------
    window.scGoTo = function(step) {
        // Validate before forward navigation
        if (step > currentStep) {
            if (!validateStep(currentStep)) return;
        }

        // Clear all steps
        document.querySelectorAll('.state-calc-step').forEach(el => el.classList.remove('active'));
        // Activate target
        const target = document.getElementById('sc-step-' + step);
        if (target) {
            target.classList.add('active');
            // Re-trigger animation
            target.style.animation = 'none';
            target.offsetHeight; // reflow
            target.style.animation = '';
        }
        currentStep = step;
        updateProgress();
    };

    function updateProgress() {
        for (let i = 1; i <= 4; i++) {
            const bar = document.getElementById('prog-' + i);
            if (!bar) continue;
            bar.classList.remove('active', 'done');
            if (i < currentStep) bar.classList.add('done');
            else if (i === currentStep) bar.classList.add('active');
        }
    }

    // ---------- Full Validation per Step ----------
    function validateStep(step) {
        clearErrors();

        if (step === 1) {
            const from = document.getElementById('sc_zip_from');
            const to = document.getElementById('sc_zip_to');
            let valid = true;

            if (!from.value.trim()) {
                showError('box-from', 'err-from');
                valid = false;
            }
            if (!to.value.trim()) {
                showError('box-to', 'err-to');
                valid = false;
            }
            // ZIP / City format: must have at least 2 chars
            if (from.value.trim().length < 2) {
                showError('box-from', 'err-from');
                valid = false;
            }
            if (to.value.trim().length < 2) {
                showError('box-to', 'err-to');
                valid = false;
            }

            if (!valid) shakeCard();
            return valid;
        }

        if (step === 4) {
            const name = document.getElementById('sc_name');
            const email = document.getElementById('sc_email');
            const phone = document.getElementById('sc_phone');
            const date = document.getElementById('sc_move_date');
            let valid = true;

            if (!name.value.trim() || name.value.trim().length < 2) {
                showError('box-name', 'err-name');
                valid = false;
            }
            if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
                showError('box-email', 'err-email');
                valid = false;
            }
            if (!phone.value.trim() || phone.value.replace(/\D/g, '').length < 7) {
                showError('box-phone', 'err-phone');
                valid = false;
            }
            if (!date.value.trim()) {
                showError('box-date', 'err-date');
                valid = false;
            }

            if (!valid) shakeCard();
            return valid;
        }

        return true;
    }

    function showError(boxId, msgId) {
        const box = document.getElementById(boxId);
        const msg = document.getElementById(msgId);
        if (box) box.classList.add('is-invalid');
        if (msg) msg.style.display = 'block';
    }

    function clearErrors() {
        document.querySelectorAll('.calc-input-box.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.validation-msg').forEach(el => el.style.display = 'none');
    }

    function shakeCard() {
        const card = document.getElementById('stateCalcCard');
        card.style.animation = 'none';
        card.offsetHeight;
        card.style.animation = 'shake 0.4s ease';
        setTimeout(() => card.style.animation = '', 400);
    }

    // ---------- Option Selection ----------
    window.scSelectSize = function(size, el) {
        scMoveSize = size;
        document.getElementById('sc_move_size').value = size;
        document.querySelectorAll('.size-card').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
    };

    window.scSelectPacking = function(pack, el) {
        scPacking = pack;
        document.getElementById('sc_packing').value = pack;
        // Only deselect packing options (first group)
        el.parentElement.querySelectorAll('.opt-pill').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
    };

    window.scSelectStorage = function(stor, el) {
        scStorage = stor;
        document.getElementById('sc_storage').value = stor;
        document.getElementById('sc-stor-1').classList.remove('active');
        document.getElementById('sc-stor-2').classList.remove('active');
        el.classList.add('active');
    };

    // ---------- Reset ----------
    window.scReset = function() {
        document.getElementById('stateCalcForm').reset();
        scMoveSize = 'Studio / 1BR';
        scPacking = 'No Packing';
        scStorage = 'No Storage';
        document.getElementById('sc_move_size').value = scMoveSize;
        document.getElementById('sc_packing').value = scPacking;
        document.getElementById('sc_storage').value = scStorage;

        // Reset size cards
        document.querySelectorAll('.size-card').forEach((c, i) => {
            c.classList.toggle('active', i === 0);
        });
        // Reset packing and storage pills
        document.querySelectorAll('.opt-pill').forEach((c, i) => {
            // First and 4th are defaults (No Packing, No Storage)
        });

        currentStep = 1;
        scGoTo(1);
    };

    // ---------- Real-time input clearing ----------
    document.addEventListener('input', function(e) {
        const box = e.target.closest('.calc-input-box');
        if (box && box.classList.contains('is-invalid') && e.target.value.trim()) {
            box.classList.remove('is-invalid');
            const msg = box.nextElementSibling;
            if (msg && msg.classList.contains('validation-msg')) msg.style.display = 'none';
        }
    });

    // ---------- AJAX Submit ----------
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('stateCalcForm');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateStep(4)) return;

            const btn = document.getElementById('sc-submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Calculating...';

            const formData = new FormData(form);
            formData.set('move_size', scMoveSize);

            fetch('{{ route("front.quote.submit") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const dist = data.distance || 150;

                    // Calculate display price (same formula as main calculator)
                    let base = 500;
                    if (scMoveSize === '2 - 3 Bedroom') base = 1000;
                    else if (scMoveSize === '4+ Bedroom') base = 1800;

                    let packCharge = 0;
                    if (scPacking === 'Partial Packing') packCharge = 250;
                    else if (scPacking === 'Full Packing') packCharge = 500;

                    let storCharge = scStorage === 'Storage Required' ? 300 : 0;

                    let minP = base + (dist * 1.25) + packCharge + storCharge;
                    let maxP = base + (dist * 1.75) + 120 + packCharge + storCharge;

                    // Populate result
                    document.getElementById('sc-result-price').textContent = '$' + Math.round(minP) + ' – $' + Math.round(maxP);
                    document.getElementById('sc-result-sub').textContent = 'Based on ' + dist + ' miles transit distance';
                    document.getElementById('sc-sum-from').textContent = formData.get('zip_from');
                    document.getElementById('sc-sum-to').textContent = formData.get('zip_to');
                    document.getElementById('sc-sum-size').textContent = scMoveSize;
                    document.getElementById('sc-sum-dist').textContent = dist + ' miles';
                    document.getElementById('sc-sum-pack').textContent = scPacking;
                    document.getElementById('sc-sum-stor').textContent = scStorage;

                    // Show success step
                    document.querySelectorAll('.state-calc-step').forEach(el => el.classList.remove('active'));
                    document.getElementById('sc-step-5').classList.add('active');
                    // Mark all progress as done
                    for (let i = 1; i <= 4; i++) {
                        const bar = document.getElementById('prog-' + i);
                        if (bar) { bar.classList.remove('active'); bar.classList.add('done'); }
                    }
                    currentStep = 5;
                } else {
                    alert('There was a problem calculating your estimate. Please check your inputs and try again.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Network error. Please check your connection and try again.');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = 'Get My Estimate <i class="fas fa-calculator ms-2"></i>';
            });
        });
    });

})();
</script>
@endsection
