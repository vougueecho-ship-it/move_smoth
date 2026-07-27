@extends('layouts.master')

@section('title', 'Best Long Distance Movers | Compare Interstate Movers | Move Smooth')
@section('meta_description', 'Compare the best long distance moving companies and cross country movers. Get licensed out-of-state moving quotes and check interstate costs.')

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
            "name": "Long Distance Moving Services",
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
    "@@type": "Service",
    "serviceType": "Long Distance Moving Services",
    "provider": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    },
    "areaServed": {
        "@@type": "Country",
        "name": "US"
    },
    "name": "Long Distance Moving Services",
    "description": "Professional cross-country, interstate, and state-to-state moving solutions provided by licensed and FMCSA-verified carriers."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "How is the cost of a long-distance move calculated?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Long-distance and interstate moves are calculated using three primary variables: the total shipment weight (measured at certified government truck scales), the distance between the pickup and delivery addresses, and additional tariff-rate charges for services like professional packing, custom crating, or storage."
            }
        },
        {
            "@@type": "Question",
            "name": "What is the difference between a moving carrier and a moving broker?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "A moving carrier is the actual company that owns the trucks, employs the crew, and directly transports your belongings. A moving broker does not own trucks or transport cargo; instead, they sell your moving job to a third-party carrier. Brokers are legally required to identify themselves as such in all advertising. Move Smooth prioritizes verifying licensed carriers to ensure clear lines of liability."
            }
        },
        {
            "@@type": "Question",
            "name": "What is a shuttle fee in long-distance moving?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "A shuttle fee is charged when a large 53-foot semi-tractor-trailer cannot safely navigate to your home due to narrow winding streets, low-hanging trees, weight-restricted bridges, or local parking restrictions. The movers must park the large truck nearby, rent a smaller 16-foot box truck (the shuttle), transfer your goods, and drive them to your residence. This extra labor and truck rental represent the shuttle fee."
            }
        },
        {
            "@@type": "Question",
            "name": "How does cargo load consolidation (LTL) work?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Consolidation, or Less-Than-Truckload (LTL) moving, involves loading shipments from multiple customers into a single 53-foot transport trailer. This splits transit expenses (fuel, driver salary) among multiple clients, making long-distance relocations highly affordable. Shipments are kept separate using wood partitions or heavy-duty nets, and routed through regional terminals."
            }
        },
        {
            "@@type": "Question",
            "name": "How are moving trucks weighed to verify shipment weight?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Interstate carriers must weigh their vehicle at a certified CAT scale before picking up your shipment (tare weight) with a full fuel tank. After loading your household goods, they weigh the truck again (gross weight). The difference between the gross weight and tare weight represents the net weight of your cargo, which is used to calculate the final shipping rate."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/long-distance-moving.css') }}" rel="stylesheet">
    <style>
        .long-badge {
            background: rgba(225, 29, 72, 0.1);
            color: #e11d48;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 100px;
            display: inline-block;
        }
        .cta-box-inline {
            background: #f8fafc;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            border-radius: 0 12px 12px 0;
            margin: 30px 0;
        }
        .icon-box {
            width: 80px;
            height: 80px;
            background: #eff6ff;
            color: #3b82f6;
            font-size: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .premium-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(0,0,0,0.05);
            border-color: #3b82f6;
        }
        .bg-light-peach {
            background-color: #fffaf8;
        }
    </style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="long-distance-hero" style="border-bottom: 4px solid #e11d48;">
    <div class="container text-center py-5">
        <nav class="breadcrumb-nav mb-4 d-inline-block">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item text-white opacity-50" aria-current="page">Services</li>
                <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Long Distance</li>
            </ol>
        </nav>
        <h1 class="display-3 fw-900 text-white mb-3">Compare the Best Long Distance Moving Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Compare pricing, reviews, and credentials from the best long-distance and cross-country moving companies near you.</p>
    </div>
</section>

<!-- Trust Bar -->
<section class="py-4 border-bottom bg-white">
    <div class="container">
        <div class="row text-center g-3 justify-content-center">
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-shield-halved text-accent fs-4"></i>
                    <span class="fw-bold text-primary small">FMCSA Registered & Verified</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-globe-americas text-accent fs-4"></i>
                    <span class="fw-bold text-primary small">Nationwide 50-State Network</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-file-signature text-accent fs-4"></i>
                    <span class="fw-bold text-primary small">Binding Written Estimates</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 1. Interstate Moving Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="long-badge mb-3"><i class="fas fa-route me-1"></i> Crossing State Lines</span>
                <h2 class="fw-800 text-primary mb-4">Interstate Moving Done Right</h2>
                <p class="text-body mb-4">Crossing state borders is an intricate logistics project. Unlike a local move, which is completed in a single afternoon, an out-of-state relocation requires compliance with federal guidelines, interstate transportation permits, weight restrictions, and precise scheduling. At <strong>Move Smooth</strong>, we connect you with professional long-distance movers who possess the licensing, equipment, and experience needed to transport your belongings safely from state to state.</p>
                <p class="text-body mb-4">Every interstate relocation is managed by a professional move coordinator who serves as your single point of contact. From compiling a detailed digital inventory of your furniture to tracking your shipment on its journey across state lines, we ensure you stay informed. Vetted carriers in our directory offer clear tariff-rate schedules, helping you budget with confidence.</p>
                
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Cost Calculator <i class="fas fa-calculator ms-2"></i></a>
                </div>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-compass text-accent me-2"></i> Moving Within the Same State?</h5>
                    <p class="mb-0 small text-muted">If you are moving within a short distance in the same state, local services are much cheaper and are billed on an hourly basis. <a href="{{ route('front.service.local') }}" class="fw-bold text-primary text-decoration-none">Explore Local Moving Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card bg-light-peach border-0 text-center p-5">
                    <div class="icon-box mx-auto mb-4">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">FMCSA Compliant</h3>
                    <p class="text-body small mb-4">All interstate movers in our network hold active operating authorities with the Federal Motor Carrier Safety Administration, keeping your valuables secure and protected by federal regulations.</p>
                    <a href="{{ route('front.movers') }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold"><i class="fas fa-search me-2"></i> Search Vetted Mover Directory</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Directory Section -->
<section class="section-padding bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="long-badge mb-3"><i class="fas fa-list me-1"></i> Mover Directory</span>
            <h2 class="fw-800 text-primary">Compare the Best Long Distance Moving Companies</h2>
            <p class="text-body col-lg-8 mx-auto">Check ratings, verified reviews, and licensing for the best interstate carriers. Request free written estimates instantly.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
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
                        <p class="text-muted mb-0">No moving companies available in the directory at this time.</p>
                    </div>
                    @endforelse
                </div>

                @if($companies->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {!! $companies->links() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Deep Dive Content Block: Cost factors & Weight calculation -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-800 text-primary mb-4 text-center">How Long-Distance Moving Costs Are Calculated</h3>
                <p class="lh-lg text-secondary mb-4">If you are preparing for a long-distance relocation, it is essential to know that out-of-state pricing differs significantly from local hourly rates. Local movers charge by the hour, whereas long-distance carriers price moves based on shipment weight and travel distance. This model ensures that transit costs are standardized and easily auditable.</p>
                
                <h4 class="fw-bold text-dark mb-3">The Certified Weighing Process (CAT Scales)</h4>
                <p class="lh-lg text-secondary mb-4">To determine the weight of your household goods, long-distance carriers are legally required to weigh their trucks at certified truck scales (such as CAT scales) at a truck stop. The weighing process involves two steps:</p>
                <ol class="lh-lg text-secondary mb-4">
                    <li><strong>Tare Weight:</strong> The empty moving truck is weighed with a full tank of fuel and all protective equipment (blankets, dollies) before loading your cargo.</li>
                    <li><strong>Gross Weight:</strong> After loading your household goods, the driver returns to the certified scale to weigh the truck again.</li>
                    <li><strong>Net Weight:</strong> The tare weight is subtracted from the gross weight to determine the net weight of your belongings, which serves as the basis for your shipping invoice.</li>
                </ol>
                <p class="lh-lg text-secondary mb-4">Customers have the right to accompany the driver to the scale to witness the weighing process, or request a re-weigh if they suspect an error.</p>

                <h4 class="fw-bold text-dark mb-3">Understanding the Broker vs. Carrier Distinction</h4>
                <p class="lh-lg text-secondary mb-4">When researching long-distance moving companies, you will encounter two types of businesses: **brokers** and **carriers**.</p>
                <p class="lh-lg text-secondary mb-4">A **Moving Carrier** is the actual company that owns the trucks, employs the crew, and directly handles and transports your belongings. They are responsible for safety compliance, claims for damages, and transit schedules. A **Moving Broker** does not own trucks or transport cargo; instead, they sell your moving job to a third-party carrier. While brokers can help find competitive rates, they do not have direct control over transit schedules or crew training. Move Smooth prioritizes verifying licensed carriers to ensure clear lines of liability.</p>
            </div>
        </div>
    </div>
</section>

<!-- 2. Cross Country Moving Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="long-badge mb-3"><i class="fas fa-globe me-1"></i> Coast-to-Coast Logistics</span>
                <h2 class="fw-800 text-primary mb-4">Cross Country Relocation Experts</h2>
                <p class="text-body mb-3">Moving thousands of miles across the country requires heavy-duty logistics and robust transport systems. Coast-to-coast moves are major undertakings that require crossing multiple state lines, driving through varying weather conditions, and navigating commercial weigh stations. Move Smooth connects you with long-haul professionals who maintain fleets of modern semi-trucks equipped with GPS tracking systems.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>State Weigh Station Compliance:</strong> All interstate commercial trucks must stop at state DOT weigh stations. Vetted carriers ensure their driver logs, cargo weight, and vehicle safety records are fully compliant to avoid transit delays.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Shuttle Truck Fees:</strong> If your destination home is in a congested historic area or narrow street where a 53-foot tractor-trailer cannot park, movers must transfer your cargo to a smaller 16-foot box truck (shuttle) to complete delivery. Our move coordinators plan for this upfront to avoid surprise charges.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Clear Transit Windows:</strong> Delivery schedules for long-distance moves depend on distance and routing. Vetted carriers provide clear delivery windows and coordinates dates to align with your schedule.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-building text-accent me-2"></i> Relocating Your Office?</h5>
                    <p class="mb-0 small text-muted">We coordinate nationwide office and commercial moves with specialized handling and minimal downtime. <a href="{{ route('front.service.commercial') }}" class="fw-bold text-primary text-decoration-none">Explore Commercial Moving <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Coast-to-Coast Coverage</h3>
                    <p class="text-body text-secondary lh-lg">Our robust network covers thousands of routes including major state corridors, enabling seamless moving logistics between any zip codes in America.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-check-double text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Includes free standard basic valuation coverage up to federal standards.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Packing & Storage Section -->
<section class="section-padding bg-light-peach border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="long-badge mb-3"><i class="fas fa-boxes-packing me-1"></i> Secure Packaging & Holding</span>
            <h2 class="fw-800 text-primary">Packing & Storage for Long-Distance Moves</h2>
            <p class="text-body col-lg-8 mx-auto">Long journeys mean extra vibrations and potential movements in the truck. We offer heavy-duty packing supplies and secure climate-controlled Storage-in-Transit (SIT) options to handle any delays.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Custom Wood Crating</h3>
                    <p class="text-body small text-muted">We build robust, custom-sized wooden crates for high-value antiques, grandfather clocks, oil paintings, glass table tops, and fragile electronics to ensure maximum protection.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Storage-in-Transit (SIT)</h3>
                    <p class="text-body small text-muted">If your closing date is delayed or your new house isn't ready, our secure, climate-controlled warehouses will store your items safely and deliver them when you are ready.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-shield"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Double-Walled Packing</h3>
                    <p class="text-body small text-muted">We use heavy-duty double-walled moving boxes, double layers of bubble wrap, and specialized padding for high-mileage trips to prevent crushing.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ route('front.service.packing') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Explore Packing Services <i class="fas fa-box-open ms-2"></i></a>
            <a href="{{ route('front.service.storage') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Explore Storage Solutions <i class="fas fa-warehouse ms-2"></i></a>
        </div>
    </div>
</section>

<!-- 4. Dedicated Trucks Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="long-badge mb-3"><i class="fas fa-truck me-1"></i> Exclusive Transport Option</span>
                <h2 class="fw-800 text-primary mb-4">Dedicated Exclusive Trucks</h2>
                <p class="text-body mb-3">With our dedicated truck option, your belongings are the only items loaded onto the semi-trailer. This offers a highly secure, fast service that bypasses consolidated hubs, ensuring direct transit to your destination.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Zero Consolidated Cargo:</strong> No mixing with other families' items, eliminating the risk of lost or mixed-up inventory.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Express Delivery Times:</strong> Direct transport from pickup to delivery without intermediate terminal delays.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Reduced Risk:</strong> Minimal handling (loaded once, unloaded once) reduces the risk of accidental transit damage.</span>
                    </li>
                </ul>

                <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Request Dedicated Truck Quote <i class="fas fa-truck-moving ms-2"></i></a>
            </div>
            
            <div class="col-lg-6">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-truck-ramp-box"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Dedicated vs Consolidated</h3>
                    <p class="text-body text-secondary lh-lg">If you are working with a tight budget and flexible dates, you can choose consolidated load sharing (LTL) where you only pay for the exact volume your items occupy in the truck, sharing fuel costs with other clients.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-scale-balanced text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Your moving coordinator will help calculate the best cost-to-speed ratio.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Delivery Tracking Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="long-badge mb-3"><i class="fas fa-location-crosshairs me-1"></i> Location Portal</span>
                <h2 class="fw-800 text-primary mb-4">Real-Time Delivery Tracking</h2>
                <p class="text-body mb-4">Never wonder where your household goods are located. All cross-country and long-distance trucks are equipped with advanced GPS tracking systems, providing peace of mind during their multi-state journey.</p>
                <p class="text-body mb-4">You will receive automatic text and email notifications at crucial transit milestones—such as state border crossings, weigh station check-ins, and the final delivery ETA confirmation.</p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('front.calculator') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">Plan Your Tracked Move <i class="fas fa-map-pin ms-2"></i></a>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-white">
                    <div class="icon-box mb-4">
                        <i class="fas fa-satellite-dish"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Live Transit Portal</h3>
                    <p class="text-body text-secondary lh-lg">Our online transit dashboard displays the live location of the moving vehicle on an interactive map. Access is provided via secure login once loading is completed.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-circle-check text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Backup communication protocols with truck drivers remain active 24/7.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Safety & Insurance Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="long-badge mb-3"><i class="fas fa-user-shield me-1"></i> Cargo Protection Policies</span>
                <h2 class="fw-800 text-primary mb-4">Comprehensive Safety & Insurance</h2>
                <p class="text-body mb-4">We prioritize transit safety above everything else. All cross-country partners follow federal safety regulations, utilizing protective cargo straps, heavy-duty logistics padding, and multi-checkpoint inspections.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Released Value Protection:</strong> Standard federal coverage of $0.60 per pound per item is included at no extra charge.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Full Value Protection (FVP):</strong> Optional premium upgrade that covers full repair or replacement value of any damaged items.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Vetted Crew Background Checks:</strong> Every driver and helper is fully vetted, drug-tested, and trained.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-shield text-accent me-2"></i> Want to Know More About Us?</h5>
                    <p class="mb-0 small text-muted">Read about our history, strict vetting protocols, and national mission. <a href="{{ route('front.about') }}" class="fw-bold text-primary text-decoration-none">About Move Smooth <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card bg-light-peach border-0 text-center p-5">
                    <div class="icon-box mx-auto mb-4">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Zero-Liability Policy</h3>
                    <p class="text-body small mb-0">We hold active commercial policies spanning $2 Million in general liability, cargo insurance, and active workers' compensation protection for complete peace of mind.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. FAQ Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <h2 class="text-center fw-800 text-primary mb-5">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How much does a long-distance move cost?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Long-distance moves are typically priced based on the weight (or volume) of your shipment and the exact mileage. An average 2-bedroom interstate move ranges from $3,000 to $6,500. Factors like custom crating, Storage-in-Transit, and specialty items affect the final rate. Request a free quote from Move Smooth for a binding estimate.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How long does a long-distance move take?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Delivery timelines depend on the distance. Moves under 1,000 miles typically take 3 to 7 business days, while coast-to-coast moves of 2,000+ miles can take between 7 to 14 business days. Dedicated trucks offer faster direct transport when required.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What is a binding estimate vs. a non-binding estimate?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                A binding estimate guarantees the total cost of your move based on the items listed in your inventory. A non-binding estimate is an approximation that may change based on actual weight. Move Smooth recommends binding or not-to-exceed estimates for peace of mind.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Can I track my shipment during a long-distance move?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes! Move Smooth provides real-time GPS tracking for all long-distance moves. You can monitor your shipment's location through our online portal and receive automatic notifications at key milestones including pickup, in-transit, and delivery.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                What items cannot be shipped on a long-distance move?
                            </button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Federal regulations prohibit the transport of hazardous materials including flammable liquids, explosives, corrosives, and perishable foods. Items like propane tanks, ammunition, paint, and cleaning chemicals must be disposed of before your move. Your move coordinator will provide a full list of prohibited items.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                Do you offer storage during a long-distance move?
                            </button>
                        </h3>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Absolutely. If there's a gap between your move-out and move-in dates, we offer secure, climate-controlled storage-in-transit. Your belongings stay loaded in secure containers at our facilities and are delivered when your new home is ready.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="section-padding bg-gradient-primary text-white text-center" style="background: linear-gradient(135deg, #1e3a8a 0%, #0d1b2a 100%); padding: 80px 0;">
    <div class="container text-white">
        <h2 class="fw-800 text-white mb-3">Planning a Long-Distance Move?</h2>
        <p class="lead opacity-75 mb-4 col-lg-7 mx-auto text-white">Get your free, customized moving estimate today. Our long-distance specialists will plan every detail so you don't have to.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 shadow fw-bold text-white">Get Your Free Quote <i class="fas fa-truck-moving ms-2"></i></a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Calculate Moving Cost <i class="fas fa-calculator ms-2"></i></a>
        </div>
    </div>
</section>
@endsection
