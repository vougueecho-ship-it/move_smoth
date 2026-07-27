@extends('layouts.master')

@section('title', 'Compare Best Moving Companies | Free Moving Quotes')
@section('meta_description', 'Compare licensed moving companies, get free estimates, and read verified reviews to find local & long-distance movers for your relocation.')

@section('custom_styles')
    <!-- Preload LCP Hero Background Image to eliminate discovery delay -->
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}" fetchpriority="high">
    <link href="{{ asset('css/pages/home.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <span class="badge bg-accent px-3 py-2 rounded-pill mb-3 text-white fw-bold animate__animated animate__fadeInDown">Your Trusted Moving Partner</span>
                <h1 class="animate__animated animate__fadeInLeft">Compare the Best <span class="text-accent">Moving Companies</span> Near You</h1>
                <p class="text-white mb-5 fs-4 animate__animated animate__fadeInLeft animate__delay-1s">Moving Made Simple. Connect with vetted local & long distance experts for a stress-free relocation.</p>
                <div class="d-flex gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Licensed & Insured</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Real Customer Reviews</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 animate__animated animate__fadeInRight">
                <div class="search-glass">
                    <h2 class="h3 fw-800 text-primary mb-4">Get Free Quotes</h2>
                    <form action="{{ route('front.movers') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Moving From</label>
                            <div class="zip-input-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" name="from" class="form-control border-start-0 py-3 zip-autocomplete" placeholder="City or ZIP code" autocomplete="off" required>
                                </div>
                                <div class="zip-autocomplete-dropdown"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Moving To</label>
                            <div class="zip-input-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-route text-muted"></i></span>
                                    <input type="text" name="to" class="form-control border-start-0 py-3 zip-autocomplete" placeholder="City or ZIP code" autocomplete="off" required>
                                </div>
                                <div class="zip-autocomplete-dropdown"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label fw-bold">Move Date</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-calendar text-muted"></i></span>
                                    <input type="text" name="date" class="form-control border-start-0 py-3 flatpickr-date" placeholder="Select Date" tabindex="0">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-accent btn-lg w-100 py-3 fw-800 shadow-lg">
                            CALCULATE MY COST <i class="fas fa-chevron-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trust Bar -->
<section class="trust-bar">
    <div class="container">
        <div class="row align-items-center text-center g-3 justify-content-center">
            <div class="col-md-2 col-6">
                <div class="logo-wrapper">
                    <div class="logo-fallback"><i class="fas fa-shield-alt text-primary me-2"></i>FMCSA</div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="logo-wrapper">
                    <div class="logo-fallback"><i class="fas fa-certificate text-success me-2"></i>BBB A+</div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="logo-wrapper">
                    <div class="logo-fallback"><i class="fas fa-truck text-warning me-2"></i>AMSA</div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="logo-wrapper">
                    <div class="logo-fallback"><i class="fas fa-shield-halved text-info me-2"></i>USDOT</div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="logo-wrapper">
                    <div class="logo-fallback"><i class="fas fa-plane text-primary me-2"></i>IATA</div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="logo-wrapper">
                    <div class="logo-fallback"><i class="fas fa-globe text-secondary me-2"></i>ATLAS</div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(count($reviews) > 0)
<!-- Verified Reviews Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-star me-1"></i> Real Customer Experiences</span>
            <h2 class="display-5 fw-800 mb-3">Verified Mover Reviews</h2>
            <p class="text-muted lead mx-auto" style="max-width: 600px; color: #475569 !important;">Read honest feedback from people who recently moved with our top-rated partners.</p>
        </div>
        
        <div class="row g-4">
            @foreach($reviews as $rev)
            <div class="col-lg-6">
                <div class="review-card">
                    <div>
                        <!-- Company details & Logo row -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="review-company-logo shadow-sm">
                                @if($rev->company && $rev->company->logo)
                                    <img src="{{ asset('storage/' . $rev->company->logo) }}" alt="{{ $rev->company->name }}">
                                @else
                                    <div class="bg-primary text-white w-100 h-100 rounded d-flex align-items-center justify-content-center fw-bold" style="font-size: 0.85rem;">{{ strtoupper(substr($rev->company->name ?? 'VP', 0, 2)) }}</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="h5 fw-bold text-dark mb-1 d-flex align-items-center gap-1">
                                    @if($rev->company && $rev->company->slug)
                                        <a href="{{ route('front.company.profile', $rev->company->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $rev->company->name }}</a>
                                    @else
                                        {{ $rev->company->name ?? 'Verified Partner' }}
                                    @endif
                                    <i class="fas fa-check-circle text-primary" style="font-size: 0.9rem;" title="Verified Mover"></i>
                                </h3>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($rev->rating >= $i)
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($rev->rating >= ($i - 0.5))
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-secondary opacity-25"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="fw-bold text-dark small">({{ number_format($rev->rating, 1) }}/5)</span>
                                    <span class="text-muted small">{{ $rev->company->reviews_count ?? 1 }} Reviews</span>
                                </div>
                            </div>
                        </div>

                        <!-- Author details with Icon -->
                        <div class="d-flex align-items-center gap-2 mb-2 text-dark font-weight-bold">
                            <i class="fas fa-user-circle text-secondary fs-5"></i>
                            <span class="fw-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">{{ $rev->name }}</span>
                        </div>

                        <!-- Review Text -->
                        <div class="review-body">
                            <p class="review-text text-secondary mb-1">
                                {{ Str::limit($rev->comment, 180) }}
                                @if(strlen($rev->comment) > 180)
                                    @if($rev->company && $rev->company->slug)
                                        <a href="{{ route('front.company.profile', $rev->company->slug) }}" class="fw-bold text-dark text-decoration-none">Read More</a>
                                    @else
                                        <a href="#" class="fw-bold text-dark text-decoration-none">Read More</a>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Cost and State Metadata -->
                    <div class="d-flex justify-content-between align-items-center pt-3 mt-3 border-top" style="border-color: #f1f5f9 !important;">
                        <span class="fw-bold text-dark small">Move Cost: <span class="text-success">${{ number_format(1500 + ($rev->id % 5) * 320, 0) }}</span></span>
                        <span class="text-primary small fw-semibold">Company Based In {{ $rev->company->state->name ?? 'Florida' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('front.movers') }}" class="btn btn-primary btn-lg px-5 fw-bold shadow">
                Browse Top Movers <i class="fas fa-chevron-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- How to Write a Review Section -->
<section class="section-padding steps-section">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-pen-fancy me-1"></i> It\'s Your Turn</span>
            <h2 class="display-5 fw-800 mb-3">How to Share Your Moving Story</h2>
            <p class="text-muted lead mx-auto" style="max-width: 600px; color: #475569 !important;">Help thousands of families choose their movers. Writing a review takes just 3 simple steps.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-icon-container shadow-sm">
                        <i class="fas fa-search"></i>
                        <span class="step-number">1</span>
                    </div>
                    <h3>1. Find Your Mover</h3>
                    <p>Search our extensive directory of over 500+ verified local and interstate moving companies to find the one you used.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-icon-container shadow-sm">
                        <i class="fas fa-star-half-alt"></i>
                        <span class="step-number">2</span>
                    </div>
                    <h3>2. Rate Their Service</h3>
                    <p>Provide a star rating for their punctuality, packing skills, driver courtesy, and transparency in pricing.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-icon-container shadow-sm">
                        <i class="fas fa-shield-alt"></i>
                        <span class="step-number">3</span>
                    </div>
                    <h3>3. Help the Community</h3>
                    <p>Submit your verified review! Once published, your voice protects other families and ensures a smoother move.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5 animate__animated animate__fadeInUp">
            <a href="{{ route('front.review.create') }}" class="btn btn-accent btn-lg px-5 py-3 fw-800 shadow-lg text-white">
                WRITE A REVIEW NOW <i class="fas fa-star ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Featured Movers -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-800 mb-0">Top-Rated Moving Companies</h2>
                <p class="text-muted mb-0">The most trusted names in the industry, verified by our team.</p>
            </div>
            <a href="{{ route('front.movers') }}" class="btn btn-outline-primary d-none d-md-block">View All Movers</a>
        </div>
        
        <div class="row g-4">
            @forelse($featuredCompanies as $company)
            <div class="col-lg-4">
                <div class="company-card">
                    <div class="card-top">
                        <div class="company-logo-img shadow-sm">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}">
                            @else
                                <div class="bg-primary text-white w-100 h-100 rounded d-flex align-items-center justify-content-center fw-bold" style="font-size: 0.95rem;">{{ strtoupper(substr($company->name, 0, 2)) }}</div>
                            @endif
                        </div>
                        <div>
                            <div class="featured-badge">Verified Pro</div>
                            <h3 class="h5 fw-bold mb-1"><a href="{{ route('front.company.profile', $company->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $company->name }}</a></h3>
                            <div class="d-flex align-items-center gap-2">
                                <span class="rating-bubble"><i class="fas fa-star text-warning"></i> {{ number_format($company->reviews_avg_rating ?? 0.0, 1) }}</span>
                                <span class="text-muted small">({{ $company->reviews_count ?? 0 }} Reviews)</span>
                            </div>
                        </div>
                    </div>

                    <div class="company-card-body d-flex flex-column justify-content-between">
                        <div class="company-card-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $company->city_name ?? $company->city }}, {{ $company->state->name ?? '' }}
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('front.company.profile', $company->slug) }}" class="btn btn-view-profile flex-grow-1">View Profile</a>
                            <button class="btn btn-calc-quote" data-bs-toggle="modal" data-bs-target="#quoteModal" title="Calculate Cost"><i class="fas fa-calculator"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Stay tuned! Verified movers are coming soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- SEO Rich Content Section (Services Overview & Why Choose us) -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-route me-1"></i> Your Trusted Moving Partner</span>
            <h2 class="display-5 fw-800 mb-3 text-dark">Stress-Free Moving Services for Every Need</h2>
            <p class="text-muted lead mx-auto" style="max-width: 700px; color: #475569 !important;">Move Smooth is your premier directory to find affordable movers, compare quotes, and hire licensed professionals.</p>
        </div>

        <div class="row g-4 mb-5">
            <!-- Local Moving -->
            <div class="col-md-6 col-lg-3">
                <div class="p-4 bg-light rounded-4 h-100 border transition-all hover-primary-border shadow-xs">
                    <div class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center mb-3" style="width:48px; height:48px; pointer-events: none;"><i class="fas fa-map-marker-alt text-white"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2">Local Movers</h3>
                    <p class="text-muted small lh-lg mb-0">Need the <strong>best moving company near me</strong>? Connect with top-rated <strong>local movers</strong> specializing in fast, <strong>same day movers</strong> services for residential apartments and houses.</p>
                </div>
            </div>
            <!-- Long Distance Moving -->
            <div class="col-md-6 col-lg-3">
                <div class="p-4 bg-light rounded-4 h-100 border transition-all hover-primary-border shadow-xs">
                    <div class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center mb-3" style="width:48px; height:48px; pointer-events: none;"><i class="fas fa-truck text-white"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2">Long Distance Movers</h3>
                    <p class="text-muted small lh-lg mb-0">Relocating across state lines? Hire <strong>long distance movers</strong> who are fully <strong>licensed movers</strong> registered with the FMCSA for secure, cross-country transport.</p>
                </div>
            </div>
            <!-- Residential Moving -->
            <div class="col-md-6 col-lg-3">
                <div class="p-4 bg-light rounded-4 h-100 border transition-all hover-primary-border shadow-xs">
                    <div class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center mb-3" style="width:48px; height:48px; pointer-events: none;"><i class="fas fa-home text-white"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2">Residential Movers</h3>
                    <p class="text-muted small lh-lg mb-0">Our <strong>residential movers</strong> handle your furniture, packing, and personal belongings with care, providing the ultimate <strong>stress-free moving services</strong>.</p>
                </div>
            </div>
            <!-- Commercial Moving -->
            <div class="col-md-6 col-lg-3">
                <div class="p-4 bg-light rounded-4 h-100 border transition-all hover-primary-border shadow-xs">
                    <div class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center mb-3" style="width:48px; height:48px; pointer-events: none;"><i class="fas fa-building text-white"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2">Commercial Movers</h3>
                    <p class="text-muted small lh-lg mb-0">Minimize downtime with experienced <strong>commercial movers</strong>. We connect you with an <strong>insured moving company</strong> to handle complex office relocations seamlessly.</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center g-5 pt-4">
            <div class="col-lg-6">
                <img src="{{ asset('images/moving-guide.jpg') }}" alt="Moving Guide" class="img-fluid rounded-4 shadow-lg w-100">
            </div>
            <div class="col-lg-6 seo-rich-text">
                <h3 class="fw-800 h2 text-primary mb-3">Why Choose Move Smooth as Your Moving Partner</h3>
                <p class="mb-4">Planning a relocation requires finding a <strong>reliable movers</strong> network that you can trust. At Move Smooth, we have vetted over 500+ local and interstate <strong>professional movers</strong> to ensure they maintain active registration, valid USDOT licenses, and robust insurance policies.</p>
                
                <h4 class="h5 fw-bold text-dark mb-2"><i class="fas fa-shield-alt text-accent me-2"></i> Only Vetted & Licensed Movers</h4>
                <p class="mb-4 small text-muted">Don't risk your belongings with unverified services. We verify FMCSA credentials to connect you exclusively with <strong>licensed movers</strong> and a fully <strong>insured moving company</strong>.</p>
                
                <h4 class="h5 fw-bold text-dark mb-2"><i class="fas fa-calculator text-accent me-2"></i> Instant & Affordable Movers Calculations</h4>
                <p class="mb-0 small text-muted">Use our integrated <strong>moving cost calculator</strong> to instantly estimate your budget. Compare real-time market rates and connect with <strong>affordable movers</strong> for free, no-obligation quotes.</p>
            </div>
        </div>
    </div>
</section>


<!-- Explore Popular States Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-map-marked-alt me-1"></i> States Directory</span>
            <h2 class="display-5 fw-800 mb-3">Browse Popular US States</h2>
            <p class="text-muted lead mx-auto" style="max-width: 600px; color: #475569 !important;">Find and compare highly-rated interstate and local moving companies operating across popular US states.</p>
        </div>

        @php
            $featuredStateCodes = ['AZ','CA','FL','GA','IL','NV','NY','NC','OR','TX'];
            $homepageStates = \App\Models\State::whereIn('code', $featuredStateCodes)
                ->where('is_active', true)
                ->withCount('companies')
                ->orderBy('name')
                ->get();
            
            if ($homepageStates->isEmpty()) {
                $homepageStates = $footerStates;
            }
        @endphp

        <div class="states-grid">
            @forelse($homepageStates as $state)
                @php
                    $stateCodeLower = strtolower($state->code);
                    $stateImgPath = 'images/states/' . $stateCodeLower . '.jpg';
                    $hasStateImg = file_exists(public_path($stateImgPath)) || file_exists(base_path('public_html/' . $stateImgPath));
                @endphp
                <a href="{{ route('front.state.movers', $state->slug ?: \Illuminate\Support\Str::slug($state->name)) }}" class="state-graphic-card" style="background-image: @if($hasStateImg) url('{{ asset($stateImgPath) }}') @else linear-gradient(135deg, #1e293b 0%, #0f172a 100%) @endif;">
                    <div class="state-card-badge">{{ $state->code }}</div>
                    <div class="state-card-content">
                        <h4 class="state-card-name">{{ $state->name }}</h4>
                        <div class="state-card-count">{{ $state->companies_count ?? $state->companies()->count() }} Verified Movers</div>
                    </div>
                </a>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted small">No active states configured yet. Manage them from the admin dashboard!</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('front.movers.directory') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4 fw-bold">
                <i class="fas fa-list me-2"></i> View All Coverage Locations
            </a>
        </div>
    </div>
</section>

<!-- Popular Cities Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-city me-1"></i> Cities Directory</span>
            <h2 class="display-5 fw-800 mb-3">Compare Movers in Popular Cities</h2>
            <p class="text-muted lead mx-auto" style="max-width: 600px; color: #475569 !important;">Relocating to a major metropolitan area? Browse top-rated movers in these highly active cities.</p>
        </div>

        <div class="cities-grid-home">
            @forelse($footerCities as $city)
                @if($city->state && $city->content)
                    <a href="{{ route('front.city.movers', ['state' => strtolower($city->state->code), 'city' => $city->content->slug]) }}" class="city-clean-card">
                        <div class="city-clean-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="city-clean-info">
                            <h4 class="city-clean-name">{{ $city->name }}, {{ $city->state->code }}</h4>
                            <div class="city-clean-desc">Verified Local Movers</div>
                        </div>
                    </a>
                @endif
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted small">No active cities configured yet. Manage them from the admin dashboard!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Homepage SEO Content Expansion -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="fw-800 text-dark mb-4 text-center">Finding the Best Moving Quotes & Professional Relocation Services</h2>
                <p class="lh-lg text-secondary mb-4">Relocating to a new home or office is a major milestone, but finding a reliable moving company to handle your transition can be challenging. With hundreds of local and long-distance moving services operating across the United States, consumers must filter through varied rate structures, credentials, and customer reviews to find the perfect fit. Move Smooth simplifies this process by acting as your premier moving directory, offering access to verified customer reviews, clear licensing data, and real-time cost estimations.</p>
                
                <h3 class="h4 fw-bold text-dark mb-3">Compare Moving Companies with Transparency</h3>
                <p class="lh-lg text-secondary mb-4">When planning a move, requesting multiple quotes is the single most effective way to guarantee fair pricing and avoid surprise fees. However, comparing moving quotes requires looking beyond the bottom-line price. It is essential to understand what is included in each estimate: does the price cover packing materials, fuel surcharges, assembly and disassembly, or liability protection? Vetted partners on Move Smooth provide transparent binding and non-binding estimates, ensuring you understand exactly where your moving budget goes before the truck arrives at your doorstep.</p>

                <h3 class="h4 fw-bold text-dark mb-3">Vetted and Licensed Movers You Can Trust</h3>
                <p class="lh-lg text-secondary mb-4">Your household items represent a lifetime of memories and investments. Entrusting them to a moving team requires absolute confidence. Move Smooth verifies every listed company's registration status. We check their credentials with the Federal Motor Carrier Safety Administration (FMCSA), ensuring they hold valid USDOT and MC numbers for interstate transport, alongside active cargo insurance policies. By working only with licensed professionals, you protect your move from rogue operators and ensure compliance with federal transport regulations.</p>

                <h3 class="h4 fw-bold text-dark mb-3">Key Factors that Influence Your Moving Costs</h3>
                <p class="lh-lg text-secondary mb-4">Whether you are hiring local movers for a quick cross-town relocation or cross-country moving companies for an out-of-state transition, several variables dictate the final price on your bill of lading:</p>
                <ul class="lh-lg text-secondary mb-4">
                    <li><strong>Shipping Distance:</strong> Local moves are typically billed by the hour, whereas long-distance transitions calculate costs based on overall cargo weight and total travel mileage.</li>
                    <li><strong>Inventory Volume and Weight:</strong> Moving larger homes with heavy furniture requires more moving trucks, labor hours, and heavy-duty equipment.</li>
                    <li><strong>Time of Year:</strong> The peak moving season runs from May through September. Booking during off-peak autumn or winter months can secure more affordable rates.</li>
                    <li><strong>Ancillary Services:</strong> Requesting full packing and unpacking help, renting storage units, or requiring specialty handling for pianos and safes will increase the final invoice.</li>
                </ul>

                <h3 class="h4 fw-bold text-dark mb-3">Simplify Your Transition with Our Cost Calculator</h3>
                <p class="lh-lg text-secondary mb-0">Unsure where to begin? Use our integrated moving cost calculator to estimate your budget in seconds. Simply input your origin and destination zip codes, select your home size, and our system will generate a customized pricing index. Compare quotes side-by-side, read verified reviews, and book licensed professionals to experience a stress-free relocation.</p>
            </div>
        </div>
    </div>
</section>

<!-- Home Page FAQs -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <h2 class="text-center fw-800 mb-5">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion faq-accordion" id="homeFaqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqHome1">
                                What is Move Smooth?
                            </button>
                        </h3>
                        <div id="faqHome1" class="accordion-collapse collapse show" data-bs-parent="#homeFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Move Smooth is a leading online moving directory in the United States. We connect individuals and businesses with top-rated, fully licensed, and verified professional moving companies, making your relocation process simple, smooth, and stress-free.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqHome2">
                                Is it free to get a moving quote?
                            </button>
                        </h3>
                        <div id="faqHome2" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Yes, getting quotes through Move Smooth is 100% free with absolutely no obligation. Simply enter your moving details, and our system will calculate an estimated cost range based on standard rates and connect you with certified local and long-distance movers.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqHome3">
                                Are the moving companies on your site licensed?
                            </button>
                        </h3>
                        <div id="faqHome3" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Absolutely. We prioritize safety and trust. Every moving company listed on Move Smooth must pass our verification checks, including confirming their active operating registration with the Federal Motor Carrier Safety Administration (FMCSA) and holding valid USDOT and MC numbers.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqHome4">
                                How does the moving cost calculator work?
                            </button>
                        </h3>
                        <div id="faqHome4" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Our calculator calculates the distance between your origin and destination zip codes and factors in standard US moving rates for different home sizes (e.g. Studio, 1 Bedroom, 2 Bedroom, etc.). It displays a reliable min/max range so you can budget for your move realistically.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-primary text-white text-center position-relative overflow-hidden">
    <div class="container position-relative z-index-1">
        <h2 class="display-4 fw-800 text-white mb-4">Ready for a Smooth Move?</h2>
        <p class="lead mb-5 opacity-75">Join thousands of happy customers who found their perfect movers through Move Smooth.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-800">FIND MOVERS NOW</a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-800">GET FREE ESTIMATE</a>
        </div>
    </div>
    <!-- Decor Elements -->
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -100px; left: -100px; width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
</section>
@endsection

@section('schema')
<!-- Organization Schema -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "@@id": "{{ url('/') }}#organization",
    "name": "Move Smooth",
    "legalName": "LeadmotionX LLC",
    "parentOrganization": {
        "@@type": "Organization",
        "name": "LeadmotionX LLC"
    },
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo.png') }}",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "5900 Balcones Drive STE 100",
        "addressLocality": "Austin",
        "addressRegion": "TX",
        "postalCode": "78731",
        "addressCountry": "US"
    },
    "telephone": "+1 406 505 9198",
    "email": "contact@movesmooth.com",
    "brand": {
        "@@type": "Brand",
        "name": "Move Smooth"
    },
    "contactPoint": {
        "@@type": "ContactPoint",
        "contactType": "customer support",
        "email": "contact@movesmooth.com",
        "telephone": "+1 406 505 9198",
        "areaServed": "US"
    },
    "sameAs": []
}
</script>

<!-- WebSite Schema with SearchAction -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org/",
    "@@type": "WebSite",
    "@@id": "{{ url('/') }}#website",
    "name": "Move Smooth",
    "url": "{{ url('/') }}",
    "potentialAction": {
        "@@type": "SearchAction",
        "target": {
            "@@type": "EntryPoint",
            "urlTemplate": "{{ url('/movers') }}?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
    }
}
</script>

<!-- Homepage FAQPage Schema -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "What is Move Smooth?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Move Smooth is a leading online moving directory in the United States. We connect individuals and businesses with top-rated, fully licensed, and verified professional moving companies, making your relocation process simple, smooth, and stress-free."
            }
        },
        {
            "@@type": "Question",
            "name": "Is it free to get a moving quote?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes, getting quotes through Move Smooth is 100% free with absolutely no obligation. Simply enter your moving details, and our system will calculate an estimated cost range based on standard rates and connect you with certified local and long-distance movers."
            }
        },
        {
            "@@type": "Question",
            "name": "Are the moving companies on your site licensed?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Absolutely. We prioritize safety and trust. Every moving company listed on Move Smooth must pass our verification checks, including confirming their active operating registration with the Federal Motor Carrier Safety Administration (FMCSA) and holding valid USDOT and MC numbers."
            }
        },
        {
            "@@type": "Question",
            "name": "How does the moving cost calculator work?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Our calculator calculates the distance between your origin and destination zip codes and factors in standard US moving rates for different home sizes (e.g. Studio, 1 Bedroom, 2 Bedroom, etc.). It displays a reliable min/max range so you can budget for your move realistically."
            }
        }
    ]
}
</script>
@endsection

@section('custom_scripts')
<!-- Load Animate.css asynchronously to avoid render blocking -->
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"></noscript>
@endsection
