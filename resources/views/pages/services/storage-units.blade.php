@extends('layouts.master')

@section('title', 'Best Moving and Storage Companies | Compare Storage')
@section('meta_description', 'Compare the best moving and storage companies near you. Get quotes for climate-controlled units, warehouse storage, and secure self-storage.')

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
            "name": "Storage Solutions",
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
    "serviceType": "Storage Solutions",
    "provider": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    },
    "areaServed": {
        "@@type": "Country",
        "name": "US"
    },
    "name": "Storage Solutions",
    "description": "Secure, climate-controlled storage units, self-storage facilities, and full-service warehouse storage options for household and commercial items."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "What is the ideal temperature and humidity for climate-controlled storage?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "True climate-controlled storage facilities maintain temperatures consistently between 55°F and 80°F (12°C to 26°C) and keep relative humidity levels below 55%. This range is critical for preventing wood from expanding and cracking, leather from drying out, electronics from corroding, and paper archives from developing mold or mildew."
            }
        },
        {
            "@@type": "Question",
            "name": "How does self-storage differ from full-service warehouse storage?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Self-storage allows customers to lease a specific room, transport their items, and retain the key for manual access. Full-service warehouse storage involves moving crews wrapping and loading your items into secure, large wooden storage vaults (typically 7'x5'x7' or 245 cubic feet). These vaults are sealed and stored inside a secure commercial warehouse, with access scheduled in advance. Vault storage is highly secure and minimizes handling during long-distance moves."
            }
        },
        {
            "@@type": "Question",
            "name": "What storage unit size do I need for a 2-bedroom home?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "A standard 2-bedroom home typically requires a 10'x10' storage unit (100 square feet) or a 10'x15' unit (150 square feet). If you have large appliances or bulky furniture, the 10'x15' is recommended. If your boxes are stacked efficiently, a 10'x10' can hold a moderate amount of household inventory."
            }
        },
        {
            "@@type": "Question",
            "name": "What items are prohibited from being stored in a storage facility?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Prohibited items include perishable foods, living plants, pets, explosives, ammunition, pressurized canisters, gas-powered vehicles (unless drained of fuel), hazardous chemicals, radioactive materials, and stolen property. These regulations protect the safety of the facility and prevent pest infestations."
            }
        },
        {
            "@@type": "Question",
            "name": "Can I purchase insurance coverage for items kept in storage?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes. Most storage facilities and moving carriers require customers to hold basic insurance. You can check if your home or renters insurance policy covers off-premises storage, or purchase a separate storage-specific policy directly from our verified partners to cover losses from fire, theft, or natural disasters."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/storage-units.css') }}" rel="stylesheet">
    <style>
        .storage-badge {
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
        .storage-feature {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        .storage-icon {
            font-size: 2rem;
            color: #3b82f6;
            background: #eff6ff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="service-hero" style="border-bottom: 4px solid #e11d48;">
    <div class="container text-center py-5">
        <nav class="breadcrumb-nav mb-4 d-inline-block">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item text-white opacity-50" aria-current="page">Services</li>
                <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Storage</li>
            </ol>
        </nav>
        <h1 class="display-3 fw-900 text-white mb-3">Compare the Best Moving & Storage Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Compare rates, locations, and services from the best moving companies offering climate-controlled storage solutions.</p>
    </div>
</section>

<!-- 1. Overview Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="storage-badge mb-3"><i class="fas fa-warehouse me-1"></i> Space Management</span>
                <h2 class="fw-800 text-primary mb-4">Vetted Storage Solutions for Every Need</h2>
                <p class="text-body mb-4">Relocating your home or office often requires flexible storage arrangements. Whether you are dealing with a delayed lease start, downsizing your residence, staging a home for sale, or storing commercial inventory, finding a secure space is essential. At <strong>Move Smooth</strong>, we connect you with top-rated, fully monitored <strong>storage units</strong> and facilities across the country. Our partners offer customizable plans that safeguard your belongings, giving you peace of mind.</p>
                <p class="text-body mb-4">Our storage network provides two main options: **self-storage facilities** and **full-service warehouse storage vaults**. Self-storage gives you a private room with personal key access, ideal for frequent visits. Vault storage is a full-service option where professional movers load your belongings into large wooden vaults at a secured commercial warehouse, which is ideal for long-distance relocations where items are kept safe until delivery.</p>
                
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Get a Storage Quote <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Cost Calculator <i class="fas fa-calculator ms-2"></i></a>
                </div>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-people-carry-box text-accent me-2"></i> Need Moving Assistance?</h5>
                    <p class="mb-0 small text-muted">We coordinate professional packing and moving services with all storage rentals. <a href="{{ route('front.service.local') }}" class="fw-bold text-primary text-decoration-none">Explore Local Moving <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="card bg-primary text-white p-5 rounded-4 border-0 shadow-lg">
                    <h3 class="fw-800 text-white mb-4">Request Storage</h3>
                    <form action="{{ route('front.quote.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-white small">Storage Duration</label>
                            <select name="storage_duration" class="form-select border-0 py-3">
                                <option>Short Term (1-3 months)</option>
                                <option>Long Term (3+ months)</option>
                                <option>Monthly Auto-Renew</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-white small">Estimated Unit Size</label>
                            <select name="storage_size" class="form-select border-0 py-3">
                                <option>Small (5'x5' - 5'x10')</option>
                                <option>Medium (10'x10' - 10'x15')</option>
                                <option>Large (10'x20'+)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-accent btn-lg w-100 fw-800 rounded-pill py-3 text-white">CHECK AVAILABILITY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Directory Section -->
<section class="section-padding bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="storage-badge mb-3"><i class="fas fa-list me-1"></i> Mover Directory</span>
            <h2 class="fw-800 text-primary">Compare the Best Moving & Storage Companies</h2>
            <p class="text-body col-lg-8 mx-auto">Find verified movers providing self-storage coordination and warehouse vault storage. Compare reviews and ratings.</p>
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

<!-- Deep Dive Content Block: Storage Size Guide & Climate Control Science -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-800 text-primary mb-4 text-center">Standard Storage Unit Sizing Chart</h3>
                <p class="lh-lg text-secondary mb-4">Choosing the correct storage unit size is key to avoiding overpaying for unused space, while ensuring your items fit safely. Packing a unit requires planning for accessibility, ventilation, and safety. Below is a guide to standard unit sizes and what they can hold:</p>
                
                <table class="table table-bordered bg-white my-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Unit Size</th>
                            <th>Square Footage</th>
                            <th>Equivalent Space</th>
                            <th>What It Holds</th>
                            <th>Average Cost Range</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5' x 5'</td>
                            <td>25 sq ft</td>
                            <td>Small Walk-in Closet</td>
                            <td>Luggage, seasonal decorations, business documents, small boxes, golf clubs.</td>
                            <td>$40 - $80 / mo</td>
                        </tr>
                        <tr>
                            <td>5' x 10'</td>
                            <td>50 sq ft</td>
                            <td>Standard Walk-in Closet</td>
                            <td>Studio apartment furniture: twin mattress, dining chairs, bicycle, small drawers, 15 boxes.</td>
                            <td>$60 - $110 / mo</td>
                        </tr>
                        <tr>
                            <td>10' x 10'</td>
                            <td>100 sq ft</td>
                            <td>Half of a 1-Car Garage</td>
                            <td>1-2 Bedroom home: queen mattress, sofa, major appliances, dining table, boxes.</td>
                            <td>$100 - $180 / mo</td>
                        </tr>
                        <tr>
                            <td>10' x 15'</td>
                            <td>150 sq ft</td>
                            <td>Three-Quarters of 1-Car Garage</td>
                            <td>2-3 Bedroom home: king mattress, multiple sofas, large appliances, musical instruments.</td>
                            <td>$140 - $240 / mo</td>
                        </tr>
                        <tr>
                            <td>10' x 20'</td>
                            <td>200 sq ft</td>
                            <td>Standard 1-Car Garage</td>
                            <td>3-4 Bedroom home: full living room set, multiple beds, lawnmowers, refrigerators, or a vehicle.</td>
                            <td>$180 - $320 / mo</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="fw-bold text-dark mb-3">The Science of Climate-Controlled Storage</h4>
                <p class="lh-lg text-secondary mb-4">Standard storage units are susceptible to seasonal weather changes. Extreme summer heat or winter cold can lead to warping, wood cracking, and mold growth. **Climate-controlled storage** prevents these issues by maintaining temperatures between 55°F and 80°F and keeping relative humidity levels below 55%.</p>
                <p class="lh-lg text-secondary mb-4">This protection is essential for wood and leather furniture, musical instruments, fine art, physical files, and electronics. Our partners use modern HVAC systems to maintain clean, climate-controlled environments year-round.</p>
            </div>
        </div>
    </div>
</section>

<!-- 2. Self-Storage vs Warehouse Vaults Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="storage-badge mb-3"><i class="fas fa-scale-balanced me-1"></i> Storage Model Comparison</span>
                <h2 class="fw-800 text-primary mb-4">Self-Storage vs. Full-Service Warehouse Vaults</h2>
                <p class="text-body mb-3">Understanding the difference between storage options helps you select the best fit for your budget and schedule. Both options offer security but operate under different access models:</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Self-Storage Facilities:</strong> You lease a private room and use your own padlock. This model gives you 24/7 keycard access, making it ideal if you need to retrieve items frequently.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Full-Service Warehouse Vaults:</strong> Movers pack your items into wooden vaults (245 cubic feet) at a secured warehouse. Vaults are sealed and stacked using forklifts, minimizing handling. Access is scheduled in advance. This option is highly secure and ideal for long-term storage or state-to-state moves.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Asset Protection:</strong> Both systems are protected by pest control, fire suppression, and secure gates to ensure your cargo remains safe.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-box-open text-accent me-2"></i> Professional Packing Help</h5>
                    <p class="mb-0 small text-muted">We offer professional packing and crating services to protect your items while in storage. <a href="{{ route('front.service.packing') }}" class="fw-bold text-primary text-decoration-none">Explore Packing Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-5">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Warehouse Vault Security</h3>
                    <p class="text-body text-secondary lh-lg">Vault storage provides high security by keeping your items sealed and stacked in a warehouse. This limits physical access and protects items from dust and light exposure.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Vetted commercial storage facilities meeting high insurance safety standards.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Key Storage Features -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <h2 class="display-5 fw-bold mb-4">Space for Every Situation</h2>
                <p class="lh-lg text-muted mb-5">Whether you're downsizing, staging your home, or waiting for your new keys, our storage partners provide the perfect space. Our facilities are equipped with the latest security technology and climate controls to ensure your items remain in pristine condition.</p>
                
                <div class="storage-feature animate__animated animate__fadeInLeft">
                    <div class="storage-icon"><i class="fas fa-thermometer-half"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Climate Controlled</h5>
                        <p class="small text-muted mb-0">Constant temperature and humidity monitoring to protect wood, leather, and electronics from damage.</p>
                    </div>
                </div>
                
                <div class="storage-feature animate__animated animate__fadeInLeft animate__delay-1s">
                    <div class="storage-icon" style="background:#fefce8; color:#ca8a04;"><i class="fas fa-video"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">24/7 Surveillance</h5>
                        <p class="small text-muted mb-0">High-definition monitoring, gated access, and on-site security personnel for safety.</p>
                    </div>
                </div>
                
                <div class="storage-feature animate__animated animate__fadeInLeft animate__delay-2s">
                    <div class="storage-icon" style="background:#eff6ff; color:#2563eb;"><i class="fas fa-truck-loading"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Pickup & Delivery</h5>
                        <p class="small text-muted mb-0">We can pick up your items, wrap them for storage, and deliver them when your new home is ready.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card p-5 bg-white">
                    <div class="icon-box mb-4">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Facility Safety Standards</h3>
                    <p class="text-body text-secondary lh-lg">Vetted facilities in our network feature advanced fire suppression systems, active pest control, cylinder door locks, and backup generator power to maintain climate settings during outages.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-circle-check text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">All partner storage options are fully licensed, insured, and verified.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Storage Packing Tips -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="storage-badge mb-3"><i class="fas fa-circle-info me-1"></i> Storage Preparation</span>
            <h2 class="fw-800 text-primary">How to Pack Your Storage Unit</h2>
            <p class="text-body col-lg-8 mx-auto">Proper packing prevents damage and makes retrieving items easier. Follow these tips from our professional packers:</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-pallet"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Use Wooden Pallets</h3>
                    <p class="text-body small text-muted">Keep your cardboard boxes off the concrete floor by using wooden pallets. This prevents moisture from seeping into boxes from the concrete.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-arrow-down-up-lock"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Leave an Access Aisle</h3>
                    <p class="text-body small text-muted">Do not pack your unit solid. Leave a clear walkway down the middle of the unit so you can access items at the back without unloading everything.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-shield-cat"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Wrap furniture securely</h3>
                    <p class="text-body small text-muted">Wrap wooden and upholstered furniture in breathable fabric moving blankets rather than plastic wrap, which can trap condensation and cause mold.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. FAQ Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <h2 class="text-center fw-800 text-primary mb-5">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                What is climate-controlled storage and why do I need it?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Climate-controlled storage units maintain a consistent temperature (between 55°F and 80°F) and humidity level year-round. This is essential for protecting sensitive belongings such as wooden and leather furniture, musical instruments, fine art, documents, and electronics from warping, cracking, or developing mold.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How secure are your storage facilities?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Our storage facilities are equipped with state-of-the-art security systems. This includes 24/7 high-definition video surveillance, gated access with personalized entry codes, fully fenced perimeters, well-lit hallways, and on-site security personnel to ensure maximum safety.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Do you offer short-term and long-term storage?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Yes! We offer flexible monthly rental options for both short-term needs (such as during a brief transition or home staging) and long-term storage. You can upgrade, downgrade, or cancel your storage agreement with simple month-to-month auto-renewals.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Do you provide pickup and delivery services for storage?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Absolutely. Our full-service storage partners can arrive at your doorstep, carefully pack and load your belongings, transport them to our secure warehouse facility, and deliver them back to your new location whenever you are ready.
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
        <h2 class="fw-800 text-white mb-3">Need Secure Storage Space?</h2>
        <p class="lead opacity-75 mb-4 col-lg-7 mx-auto text-white">Get your free, no-obligation storage estimate in minutes. Our storage experts are standing by to help coordinate your space requirements.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 shadow fw-bold text-white">Get a Storage Estimate <i class="fas fa-warehouse ms-2"></i></a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Calculate Moving Cost <i class="fas fa-calculator ms-2"></i></a>
        </div>
    </div>
</section>
@endsection
