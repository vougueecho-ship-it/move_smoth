@extends('layouts.master')

@section('title', 'Best Local Moving Companies | Compare Local Movers | Move Smooth')
@section('meta_description', 'Compare the best local moving companies near you. Get free estimates, hourly rate guides, and read verified reviews for home and apartment moves.')

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
            "name": "Local Moving Services",
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
    "serviceType": "Local Moving Services",
    "provider": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    },
    "areaServed": {
        "@@type": "Country",
        "name": "US"
    },
    "name": "Local Moving Services",
    "description": "Professional, licensed, and affordable local moving services for residential homes, apartments, and commercial offices."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "How much do local moving companies charge per hour?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Local moving companies typically charge hourly rates ranging from $100 to $200 per hour for a standard crew of two movers and a truck. Adding more crew members increases the hourly rate (e.g., $150 to $250 for three movers) but reduces the overall time required to complete the move. Rates vary depending on location, peak demand seasons, and specialized equipment requirements."
            }
        },
        {
            "@@type": "Question",
            "name": "What is the California Double Drive Time law?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Under California Public Utilities Commission regulations (specifically Max Tariff 4), moving companies are legally required to double the actual driving time between the origin address and the destination address. This ensures that customers are only billed for actual transit times rather than the crew's return trip to their warehouse."
            }
        },
        {
            "@@type": "Question",
            "name": "What is a Certificate of Insurance (COI) and do I need one for an apartment move?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "A Certificate of Insurance (COI) is a document issued by an insurance company verifying that a moving provider carries active general liability, cargo, and workers' compensation coverage. Many high-rise apartments, luxury condominiums, and commercial buildings require movers to submit a COI naming the property management company as an additional insured before allowing access to loading docks and elevators."
            }
        },
        {
            "@@type": "Question",
            "name": "How long does a typical local move take?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "A typical studio or one-bedroom apartment move takes approximately 3 to 5 hours with two movers. A two-bedroom home or apartment takes about 5 to 7 hours with three movers. Larger three-to-four-bedroom homes generally require 8 to 12 hours or multiple days depending on the volume of cargo, packing requirements, and distance between locations."
            }
        },
        {
            "@@type": "Question",
            "name": "Are packing boxes and tape included in local moving quotes?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Generally, basic protection materials like furniture blankets, shrink wrap, and tape are included in standard hourly quotes. However, specialty boxes (wardrobes, dish packs, book boxes) and bubble wrap represent additional supply costs unless you choose a full-service, all-inclusive packing package."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/local-moving.css') }}" rel="stylesheet">
    <style>
        .local-badge {
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
<section class="local-hero" style="border-bottom: 4px solid #e11d48;">
    <div class="container text-center py-5">
        <nav class="breadcrumb-nav mb-4 d-inline-block">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item text-white opacity-50" aria-current="page">Services</li>
                <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Local Moving</li>
            </ol>
        </nav>
        <h1 class="display-3 fw-900 text-white mb-3">Compare the Best Local Moving Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Compare pricing, reviews, and credentials from the best local moving companies near you. Find the perfect local mover in minutes.</p>
    </div>
</section>

<!-- 1. Overview Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="local-badge mb-3"><i class="fas fa-compass me-1"></i> Intrastate & Same-City Relocation</span>
                <h2 class="fw-800 text-primary mb-4">Compare Licensed Local Movers in Your Area</h2>
                <p class="text-body mb-4">Moving across town might seem like a simple project, but the physical labor of packing, loading heavy appliances, and navigating local traffic can turn it into an exhausting task. At <strong>Move Smooth</strong>, we connect you with verified local moving companies specializing in making your same-city transition as seamless as possible. Whether you are moving down the block or to a neighboring city within a 100-mile radius, our local partner network ensures your belongings are transported safely and efficiently.</p>
                <p class="text-body mb-4">Local moving services operate under a distinct pricing structure compared to cross-country relocations. Local moves are billed on an hourly rate basis, which covers the cost of a professional crew, a fully equipped moving truck, and basic protection supplies. This hourly model gives you complete control over your budget—you can choose a full-service package where the movers pack every item, or opt to pack yourself and hire our crews exclusively for the heavy loading and transportation.</p>
                
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Cost Calculator <i class="fas fa-calculator ms-2"></i></a>
                </div>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-search-location text-accent me-2"></i> Browse Verified Companies</h5>
                    <p class="mb-0 small text-muted">You can also search our pre-screened directory of professional movers near you to compare ratings and read customer reviews. <a href="{{ route('front.movers') }}" class="fw-bold text-primary text-decoration-none">Browse Local Mover Directory <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card bg-light-peach border-0 text-center p-5">
                    <div class="icon-box mx-auto mb-4">
                        <i class="fas fa-truck-fast"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Same-Day Availability</h3>
                    <p class="text-body small mb-4">Need to relocate immediately? We coordinate same-day and next-day local moving services when schedules allow. Contact us as early as possible to secure last-minute slots!</p>
                    <a href="tel:+14065059198" class="btn btn-primary w-100 py-3 rounded-pill fw-bold"><i class="fas fa-phone-alt me-2"></i> Call +1 (406) 505-9198</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Directory Section -->
<section class="section-padding bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="local-badge mb-3"><i class="fas fa-list me-1"></i> Mover Directory</span>
            <h2 class="fw-800 text-primary">Compare the Best Local Moving Companies</h2>
            <p class="text-body col-lg-8 mx-auto">Browse ratings, read verified customer reviews, and find active operating licenses for the best local movers. Request free moving quotes instantly.</p>
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

<!-- Deep Dive Content Block: Rates & Regulation -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-800 text-primary mb-4 text-center">Understanding Hourly Rate Structures & Costs</h3>
                <p class="lh-lg text-secondary mb-4">Before hiring local movers, it is vital to understand how hourly pricing is calculated. Unlike long-distance moving, which relies on total shipment weight, local moving invoices are dictated by time. The hourly clock begins when the crew arrives at your origin address and stops when they complete the final offloading and furniture reassembly at your destination.</p>
                
                <h4 class="fw-bold text-dark mb-3">Average Local Moving Hourly Rates</h4>
                <p class="lh-lg text-secondary mb-4">The number of movers you require depends on the size of your home and the complexity of the inventory. Below is an outline of standard hourly rates and average durations:</p>
                
                <table class="table table-bordered bg-white my-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Home Size</th>
                            <th>Recommended Crew</th>
                            <th>Hourly Rate Range</th>
                            <th>Estimated Duration</th>
                            <th>Total Cost Range</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Studio Apartment</td>
                            <td>2 Movers + 1 Truck</td>
                            <td>$90 - $130 / hr</td>
                            <td>3 - 5 Hours</td>
                            <td>$350 - $650</td>
                        </tr>
                        <tr>
                            <td>1-2 Bedroom Apartment</td>
                            <td>3 Movers + 1 Truck</td>
                            <td>$130 - $170 / hr</td>
                            <td>5 - 7 Hours</td>
                            <td>$700 - $1,200</td>
                        </tr>
                        <tr>
                            <td>3-4 Bedroom House</td>
                            <td>4 Movers + 1 Truck</td>
                            <td>$180 - $240 / hr</td>
                            <td>8 - 10 Hours</td>
                            <td>$1,500 - $2,400</td>
                        </tr>
                        <tr>
                            <td>5+ Bedroom Estate</td>
                            <td>5+ Movers + 2 Trucks</td>
                            <td>$250+ / hr</td>
                            <td>10+ Hours</td>
                            <td>$3,000+</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="fw-bold text-dark mb-3"> drive-Time and Travel Fees</h4>
                <p class="lh-lg text-secondary mb-4">In addition to the basic hourly rate, most local movers bill a standard travel fee. This is usually a flat charge equivalent to one hour of labor, which covers the fuel and payroll expenses for the crew to drive from their warehouse to your home, and back at the end of the day. In states like California, the Public Utilities Commission mandates a **Double Drive Time (DDT)** regulation. Under this law, movers bill for the actual driving time between your origin and destination, and then double it, eliminating travel charges for driving to and from the warehouse.</p>
            </div>
        </div>
    </div>
</section>

<!-- 2. Apartment Moving Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="local-badge mb-3"><i class="fas fa-building me-1"></i> Navigating Building Regulations</span>
                <h2 class="fw-800 text-primary mb-4">Apartment & Condo Moving Specialists</h2>
                <p class="text-body mb-3">Apartment relocations present a unique set of challenges that standard house moves do not face. Navigating narrow corridors, reserving service elevators, scheduling strict loading dock windows, and complying with Homeowners Association (HOA) rules require experienced crews. Our verified local partners are highly trained in handling multi-story buildings, protecting building assets, and ensuring a fast, smooth transition.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Certificate of Insurance (COI):</strong> Most luxury high-rises and managed apartment complexes require movers to present a COI verifying liability and workers' compensation coverage before they can set foot on the property. We connect you with fully insured agencies that provide custom COIs at no extra charge.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Property Protection:</strong> High-density complexes require care. Our crews utilize doorframe padding, masonite floor sheets to protect hardwood floors, and thick blankets to line elevator walls, preventing property damage and protecting your security deposit.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Elevator Coordination:</strong> Relocating via stairs can significantly slow down a move and increase hourly costs. Our teams coordinate with your building manager to optimize loading schedules during your reserved service elevator window.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-warehouse text-accent me-2"></i> Need Temporary Storage?</h5>
                    <p class="mb-0 small text-muted">If your new apartment lease starts later, we coordinate secure, climate-controlled storage solutions to store your items temporarily. <a href="{{ route('front.service.storage') }}" class="fw-bold text-primary text-decoration-none">Explore Storage Units <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-building-user"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">High-Rise Relocation Protocol</h3>
                    <p class="text-body text-secondary lh-lg">From studio apartments to luxury penthouses, our movers understand the rules of condominium associations. We ensure compliance with strict loading zone policies, noise ordinances, and elevator restrictions to avoid HOA fines.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Fully compliant with building safety guidelines and regional commercial insurance regulations.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. House Moving Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="local-badge mb-3"><i class="fas fa-house me-1"></i> Single-Family Residence Logistics</span>
                <h2 class="fw-800 text-primary mb-4">Full-Service House Relocations</h2>
                <p class="text-body mb-3">Moving a single-family home involves dealing with a larger volume of inventory spread across multiple floors, garages, attics, and outdoor patios. Move Smooth connects you with professional crews equipped with the heavy-duty gear required to handle large estates. We bring appropriate truck sizes (ranging from 16-foot box trucks to 26-foot moving vans), appliance dollies, protective runners, and toolkits for assembly.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Heavy Object Handling:</strong> Moving gun safes, pool tables, pianos, and heavy solid wood furniture requires special training. Vetted crews bring specialized harnesses and ramps to handle heavy items without injury or wall damage.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Disassembly and Assembly:</strong> Standard hourly local moving services include taking apart large furniture (like bed frames, dining tables, and sectional couches) at your old home, and reassembling them exactly where you want them in your new residence.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Systematic Loading:</strong> Loading a 26-foot truck requires strategic stacking to prevent crushing and shifting. Heavy furniture is loaded at the bottom, secured with ratchet straps, and cushioned with thick moving blankets.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-route text-accent me-2"></i> Moving Across State Lines?</h5>
                    <p class="mb-0 small text-muted">If you are relocating out of state, hourly local services do not apply. You will require specialized long-distance logistics and interstate authorities. <a href="{{ route('front.service.long') }}" class="fw-bold text-primary text-decoration-none">Explore Long Distance Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="premium-card p-5 bg-white">
                    <div class="icon-box mb-4">
                        <i class="fas fa-home-user"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Estate and Large Residence Care</h3>
                    <p class="text-body text-secondary lh-lg">From packing delicate display cases to transporting lawnmowers, our vetted teams treat your personal belongings with the utmost care. We work around narrow residential driveways and organize room-by-room offloading.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-people-carry-box text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Includes customized placement, mattress box bags, and professional protection of high-value furniture.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Packing Services Section -->
<section class="section-padding bg-light-peach border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="local-badge mb-3"><i class="fas fa-box-open me-1"></i> Supplies & Boxing Services</span>
            <h2 class="fw-800 text-primary">Customizable Packing Solutions</h2>
            <p class="text-body col-lg-8 mx-auto">Don't want to pack a single box? Packing is often the most time-consuming part of a move. We offer flexible packing services to fit your schedule and budget. Choose a package below to add to your local move.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-boxes-packing"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Full Packing Service</h3>
                    <p class="text-body small text-muted">Our professional packers arrive a day before or on moving day with heavy-duty boxes, bubble wrap, packing paper, and tape. We pack everything in your home, from kitchen drawers to closets, with efficiency and care.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Partial Packing</h3>
                    <p class="text-body small text-muted">Want to handle most of the packing yourself to save money? We step in to pack designated rooms, such as the kitchen (delicate china and glassware) or garage, leaving the rest to you.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Fragile-Only Packing</h3>
                    <p class="text-body small text-muted">We provide custom crating and wrapping for high-value artwork, mirrors, electronic server racks, flat-screen TVs, and heirlooms, utilizing double-walled boxes and bubble wrap.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('front.service.packing') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Explore All Packing Options <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- 5. Loading & Unloading Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="local-badge mb-3"><i class="fas fa-people-carry me-1"></i> Labor-Only Services</span>
            <h2 class="fw-800 text-primary">Loading & Unloading Assistance</h2>
            <p class="text-body col-lg-8 mx-auto">Already rented a moving truck, trailer, or storage container? Hire our experienced local moving crews to handle the heavy lifting for you, saving you from back strain and cargo shifting.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card p-4 text-center">
                    <div class="icon-box mx-auto mb-3">
                        <i class="fas fa-truck-ramp-box"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Expert Loading</h3>
                    <p class="text-body small text-muted">Loading a rental truck or container is like playing a game of Tetris. Our loaders pack your items securely, maximizing space and securing the load with straps to prevent shifting during transit.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card p-4 text-center">
                    <div class="icon-box mx-auto mb-3">
                        <i class="fas fa-people-carry"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Safe Unloading</h3>
                    <p class="text-body small text-muted">We unload your moving truck or storage container, carrying all items and boxes directly into their designated rooms at your new home, and placing them exactly where you specify.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card p-4 text-center">
                    <div class="icon-box mx-auto mb-3">
                        <i class="fas fa-couch"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Furniture Setup</h3>
                    <p class="text-body small text-muted">Need help putting together bed frames, desks, or dining tables? Our crew brings the necessary tools to handle complex furniture assembly, saving you hours of frustration.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('front.calculator') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">Hire Heavy-Lifting Helpers <i class="fas fa-hand-holding-hand ms-2"></i></a>
        </div>
    </div>
</section>

<!-- 6. Why Choose Us Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="local-badge mb-3"><i class="fas fa-star me-1"></i> The Move Smooth Quality Standard</span>
            <h2 class="fw-800 text-primary">Why Compare Local Movers with Move Smooth?</h2>
            <p class="text-body col-lg-8 mx-auto">We verify regulatory credentials and customer ratings to ensure you work only with the most reliable local moving companies in your area.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">No Hidden Fees</h3>
                    <p class="text-body small text-muted">Surprise charges for stairs, long carries, or fuel can ruin a moving day. The companies we recommend offer transparent hourly pricing and upfront, detailed estimates.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Licensed & Insured</h3>
                    <p class="text-body small text-muted">Every local partner is thoroughly vetted, licensed by state authorities, and backed by robust cargo and liability coverage to protect your move.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">On-Time Arrival</h3>
                    <p class="text-body small text-muted">We respect your time. Our moving crews arrive promptly on schedule, fully equipped, and ready to get straight to work to complete your relocation on time.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-body">Want to learn more about our company values and satisfied customer stories? <a href="{{ route('front.about') }}" class="fw-bold text-accent text-decoration-none">Learn More About Move Smooth <i class="fas fa-arrow-right ms-1"></i></a></p>
        </div>
    </div>
</section>

<!-- 7. FAQ Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <h2 class="text-center fw-800 text-primary mb-5">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How much does a local move cost?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Local moves are typically charged by the hour. For a 2-bedroom home, you can expect to pay between $130 and $180 per hour depending on the crew size, distance, and complexity. Move Smooth provides free, no-obligation estimates so you know your costs upfront before moving day.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How far in advance should I book a local move?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                We recommend booking at least 2 to 4 weeks in advance, especially during peak season (May through September) and at month-end. However, Move Smooth also offers same-day and next-day availability when schedules permit.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Do you provide packing materials for local moves?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes! We provide high-quality moving boxes, bubble wrap, packing paper, tape, and furniture blankets. You can add full or partial packing services to your local move for an additional fee, or purchase supplies separately.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Are my belongings insured during a local move?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Absolutely. Every local move with Move Smooth includes basic valuation coverage at no extra charge. We also offer full-value protection plans that cover repair or replacement of any item damaged during transit. Ask your move coordinator about upgrade options.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Can you move specialty items like pianos or hot tubs?
                            </button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes, we specialize in moving heavy and delicate items including pianos, pool tables, safes, hot tubs, and large appliances. These items require specialized equipment and trained technicians, so be sure to mention them when requesting your quote.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                What is included in a standard local move?
                            </button>
                        </h3>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                A standard local move from Move Smooth includes a dedicated moving truck, a team of professional movers, furniture blankets and padding, basic disassembly and reassembly, and floor protection at both locations. Packing services and specialty item handling can be added as extras.
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
        <h2 class="fw-800 text-white mb-3">Ready to Plan Your Local Move?</h2>
        <p class="lead opacity-75 mb-4 col-lg-7 mx-auto text-white">Get your free, no-obligation moving quote in minutes. Our local moving experts are standing by to help plan your perfect same-city relocation.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 shadow fw-bold text-white">Get Your Free Quote <i class="fas fa-truck-moving ms-2"></i></a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Calculate Moving Cost <i class="fas fa-calculator ms-2"></i></a>
        </div>
    </div>
</section>
@endsection
