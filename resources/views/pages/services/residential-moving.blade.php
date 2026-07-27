@extends('layouts.master')

@section('title', 'Best Residential Moving Companies | Home & Apartment')
@section('meta_description', 'Compare the best residential moving companies and home relocators. Get free quotes for stress-free house, condo, and apartment moving.')

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
            "name": "Residential Moving Services",
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
    "serviceType": "Residential Moving Services",
    "provider": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    },
    "areaServed": {
        "@@type": "Country",
        "name": "US"
    },
    "name": "Residential Moving Services",
    "description": "Professional residential moving services for single-family homes, townhouses, apartments, condos, and senior downsizing transitions."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "What is the difference between released value protection and full value protection?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Released Value Protection is a basic cargo insurance included at no additional cost in standard residential moving contracts, which pays a maximum of $0.60 per pound per item if damaged. Full Value Protection (FVP) holds the carrier liable for the replacement value of lost or damaged items, requiring them to repair, replace, or issue cash settlements. FVP represents a paid upgrade but is highly recommended for household relocations."
            }
        },
        {
            "@@type": "Question",
            "name": "What should I pack in my 'First Night Essentials' box?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Your first-night essentials box should contain items you will need immediately upon arrival before unpacking. This includes basic toiletries, prescription medications, phone chargers, a change of clothes, clean towels, bed linens, toilet paper, paper cups and plates, basic tools (like a screwdriver or utility knife), and important personal documents."
            }
        },
        {
            "@@type": "Question",
            "name": "How far in advance should I notify utility companies when moving houses?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "We recommend notifying utility companies (electricity, gas, water, internet) at least 2 to 3 weeks before your moving day. Schedule services at your current home to stop the day after your move, and schedule services at your new residence to start the day before you arrive, ensuring you have light and heat immediately."
            }
        },
        {
            "@@type": "Question",
            "name": "Are moving companies allowed to transport hazardous household items?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "No. Federal and state transport safety regulations prohibit moving companies from carrying hazardous materials. This includes propane tanks, gasoline, motor oil, fire extinguishers, paints, aerosol cans, ammunition, fertilizers, and chemical cleaning supplies. These must be disposed of or transported in your personal vehicle."
            }
        },
        {
            "@@type": "Question",
            "name": "How do you coordinate senior citizen downsizing and moving?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Senior transitions are coordinated with specialized care. We assign a dedicated move planner who works patiently with the senior and their family to sort and label items for keeping, donation, or storage. At the new home, movers unpack and arrange furniture and items to match their preferred layout, minimizing confusion and stress."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/residential-moving.css') }}" rel="stylesheet">
    <style>
        .residential-badge {
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
<section class="residential-hero" style="border-bottom: 4px solid #e11d48;">
    <div class="container text-center py-5">
        <nav class="breadcrumb-nav mb-4 d-inline-block">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item text-white opacity-50" aria-current="page">Services</li>
                <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Residential Moving</li>
            </ol>
        </nav>
        <h1 class="display-3 fw-900 text-white mb-3">Compare the Best Residential Moving Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Compare customer reviews, ratings, and free moving estimates from the best household and residential movers near you.</p>
    </div>
</section>

<!-- 1. Overview Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="residential-badge mb-3"><i class="fas fa-house-chimney me-1"></i> Household Relocations</span>
                <h2 class="fw-800 text-primary mb-4">Making Your Next House Move Stress-Free</h2>
                <p class="text-body mb-4">Your home is filled with more than just furniture—it contains your personal history, family memories, and most cherished belongings. At <strong>Move Smooth</strong>, we treat every residential relocation with the care, respect, and professionalism it deserves. Our vetted network of <strong>residential movers</strong> handles everything from packing fragile family heirlooms to loading large furniture, ensuring a seamless transition to your new home.</p>
                <p class="text-body mb-4">We cater to all forms of household moving, whether you are relocating from a multi-story family estate, a city townhouse, or a high-rise apartment. Our certified home movers provide clear upfront quotes, flexible scheduling, and dedicated moving coordinators to manage every detail of your move, making the transition as smooth as possible.</p>
                
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Cost Calculator <i class="fas fa-calculator ms-2"></i></a>
                </div>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-briefcase text-accent me-2"></i> Relocating a Corporate Office?</h5>
                    <p class="mb-0 small text-muted">If you are moving a business, office desks, or modular workstations, visit our commercial services. <a href="{{ route('front.service.commercial') }}" class="fw-bold text-primary text-decoration-none">Explore Commercial Moving <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card bg-light-peach border-0 text-center p-5">
                    <div class="icon-box mx-auto mb-4">
                        <i class="fas fa-people-carry-box"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Full-Service Home Moves</h3>
                    <p class="text-body small mb-4">From packing your delicate kitchen cabinets to loading, transport, unloading, and setting up furniture in your new home, our team does the heavy lifting so you can relax.</p>
                    <a href="{{ route('front.movers') }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold"><i class="fas fa-search me-2"></i> Search Certified Movers</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Directory Section -->
<section class="section-padding bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="residential-badge mb-3"><i class="fas fa-list me-1"></i> Mover Directory</span>
            <h2 class="fw-800 text-primary">Compare the Best Residential Moving Companies</h2>
            <p class="text-body col-lg-8 mx-auto">Browse through verified household moving companies, check their licensing details, and read customer reviews. Get free estimates.</p>
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

<!-- Deep Dive Content Block: Room-by-room preparation guides & checklist -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-800 text-primary mb-4 text-center">Room-by-Room Preparation Checklist</h3>
                <p class="lh-lg text-secondary mb-4">Packing up an entire home is a task best handled methodically. Preparing rooms in a logical sequence ensures items are packed securely and prevents last-minute stress on moving day. Use this checklist to organize your packing plan:</p>
                
                <h4 class="fw-bold text-dark mb-3">Residential Preparation Steps</h4>
                
                <ul class="lh-lg text-secondary mb-4">
                    <li><strong>1. The Kitchen (Start 5 Days Before):</strong> Kitchens contain many fragile glass and ceramic items. Wrap plates and glasses individually in clean packing paper and pack them vertically in double-walled dish pack boxes. Clearly label these boxes as 'Fragile - Kitchen'. Defrost your refrigerator 24 hours before moving day.</li>
                    <li><strong>2. The Living Room (Start 3 Days Before):</strong> Wrap television screens and monitors in protective blankets. Disassemble sectional sofas and place all connection screws and brackets in a sealed bag taped to the furniture frame. Secure audio equipment cables with cable ties.</li>
                    <li><strong>3. Bedrooms & Closets (Start 2 Days Before):</strong> Pack out-of-season clothes in standard boxes and transfer hanging clothes directly into wardrobe boxes. Wrap mattresses in plastic mattress bags to protect them from dirt and dust during transit. Disassemble bed frames and bundle slats together.</li>
                    <li><strong>4. Garage & Storage (Start 7 Days Before):</strong> Garages and storage areas contain heavy, irregularly shaped items. Drizzle fuel and oil from lawnmowers and weed eaters, and dispose of aerosol cans, paints, and propane tanks, as carriers are legally prohibited from transporting hazardous materials.</li>
                </ul>

                <h4 class="fw-bold text-dark mb-3">Understanding Released Value vs. Full Value Protection (FVP)</h4>
                <p class="lh-lg text-secondary mb-4">When hiring residential movers, you must choose your liability protection level. Standard moving quotes include **Released Value Protection** at no extra charge, which limits liability to $0.60 per pound per item. Under this option, if a 50-pound flat-screen television is damaged, the carrier is only liable for $30 (50 lbs x $0.60), regardless of its actual value. **Full Value Protection (FVP)** holds the carrier liable for the replacement value of lost or damaged items, requiring them to repair, replace, or issue cash settlements. FVP represents a paid upgrade but is highly recommended for household relocations.</p>
            </div>
        </div>
    </div>
</section>

<!-- 2. House Moving Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="residential-badge mb-3"><i class="fas fa-home me-1"></i> Family Homes</span>
                <h2 class="fw-800 text-primary mb-4">Single-Family House Moving</h2>
                <p class="text-body mb-3">Moving a full household requires structured planning and safety equipment. Our residential moving crews arrive fully prepared with large moving trucks, premium protective blankets, heavy-duty cargo straps, and dollies to load your entire home safely.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Estate Logistics:</strong> We bring appropriate truck sizes (ranging from 16-foot box trucks to 26-foot moving vans) to fit your cargo, planning multiple loads if needed.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Home Asset Protection:</strong> Our crews use floor runners to protect wood floors, banister pads, and door jamb protectors to prevent property damage.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Furniture Setup:</strong> Movers handle the disassembly and reassembly of large bedroom sets, dining tables, and desks at no extra charge.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-route text-accent me-2"></i> Relocating Out of State?</h5>
                    <p class="mb-0 small text-muted">If you are crossing state borders, you will need a long-distance logistics setup instead of local. <a href="{{ route('front.service.long') }}" class="fw-bold text-primary text-decoration-none">Explore Long Distance Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Household Authority</h3>
                    <p class="text-body text-secondary lh-lg">Our experienced moving crews have relocated thousands of households, managing complex transitions for estates, multi-story residences, and townhouses with ease.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Includes customized labeling and organized item placement at destination.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Apartment & Condo Moving Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="residential-badge mb-3"><i class="fas fa-building me-1"></i> Mid-Rise & Condos</span>
                <h2 class="fw-800 text-primary mb-4">Apartment & Condo Relocations</h2>
                <p class="text-body mb-3">Apartment moves often involve specific rules—freight elevator reservations, loading dock hours, property damage insurance, and long corridors. Our team is fully trained to manage high-rise and garden-style apartment moves seamlessly while complying with all building policies.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Stairs & Elevators:</strong> We coordinate loading through service elevators or stairwells, matching rates to the accessibility factors of your building.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>COI Issuance:</strong> Building managers often require a Certificate of Insurance (COI) before allowing access. We coordinate with carriers to issue these quickly.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Parking Logistics:</strong> We coordinate municipal permits or loading dock reservations to ensure a parking spot for the moving truck.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-warehouse text-accent me-2"></i> Need Temporary Storage?</h5>
                    <p class="mb-0 small text-muted">We offer secure, climate-controlled storage vaults for any gap between your lease dates. <a href="{{ route('front.service.storage') }}" class="fw-bold text-primary text-decoration-none">Explore Storage Units <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="premium-card p-5 bg-white">
                    <div class="icon-box mb-4">
                        <i class="fas fa-circle-check"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Apartment Navigators</h3>
                    <p class="text-body text-secondary lh-lg">We protect your security deposit. Our crews wrap door jambs, use floor runners, and navigate narrow stairwells to prevent building damage.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-hotel text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Compliant with all major building certificate of insurance (COI) guidelines.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Senior Moving Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="residential-badge mb-3"><i class="fas fa-heart me-1"></i> Gentle Care Transitions</span>
                <h2 class="fw-800 text-primary mb-4">Compassionate Senior Moving</h2>
                <p class="text-body mb-3">Transitioning to a retirement community, assisted living home, or downsizing can be an emotional journey. We provide gentle, compassionate senior moving services designed to reduce stress and make the transition as comforting as possible.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Respectful Move Planners:</strong> We assign coordinators who listen to your preferences, helping organize items for keeping, donation, or recycling.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Downsizing Assistance:</strong> We help sort and organize archives, clothing, and housewares, making downsizing manageable.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Complete Settling:</strong> Packers unpack and arrange items in your new home exactly as you prefer, helping you settle in quickly.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-face-smile text-accent me-2"></i> Want to Know Our Story?</h5>
                    <p class="mb-0 small text-muted">Read about our national mission, trust values, and company history. <a href="{{ route('front.about') }}" class="fw-bold text-primary text-decoration-none">About Move Smooth <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-handshake-angle"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Patient Relocations</h3>
                    <p class="text-body text-secondary lh-lg">Our team treats senior family members with the utmost respect, working at their pace, helping with heavy downsizes, and handling all family keepsakes with absolute care.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Every mover is background-checked and fully insured for trust and safety.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Home Packing & Protection Section -->
<section class="section-padding bg-light-peach border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="residential-badge mb-3"><i class="fas fa-box-open me-1"></i> Protective Packaging</span>
            <h2 class="fw-800 text-primary">Packing & Home Protection Services</h2>
            <p class="text-body col-lg-8 mx-auto">Skip the stress of cardboard and tape. Our customizable packing options ensure everything from fragile glassware to robust TVs is completely insulated.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-boxes-packing"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Full Household Packing</h3>
                    <p class="text-body small text-muted">We arrive with double-walled boxes, bubble wrap, packing paper, and tape. We pack your entire house, room by room, with efficiency.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-couch"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Furniture Wrap Protection</h3>
                    <p class="text-body small text-muted">Clean, thick fabric moving blankets wrapped and strapped onto all furniture items before they exit your home to prevent scratches.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-wine-glass"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Fragile-Only Packing</h3>
                    <p class="text-body small text-muted">Specialized padding and boxing for delicate China sets, crystal glass, fine art, flat-screen TVs, and sentimental heirlooms.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('front.service.packing') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Explore All Packing Options <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- 6. Our Home Moving Process Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="residential-badge mb-3"><i class="fas fa-list-check me-1"></i> Structured Operations</span>
            <h2 class="fw-800 text-primary">Our Residential Moving Process</h2>
            <p class="text-body col-lg-8 mx-auto">From the initial quote to the final box unpacked, we follow a proven process to guarantee a perfect residential move.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card p-4 text-center">
                    <div class="icon-box mx-auto mb-3">1</div>
                    <h3 class="h5 fw-800 text-primary mb-3">Custom Quote & Plan</h3>
                    <p class="text-body small text-muted">We provide a clear, flat-rate or hourly estimate based on your home size, items, and distance. No hidden fees.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card p-4 text-center">
                    <div class="icon-box mx-auto mb-3">2</div>
                    <h3 class="h5 fw-800 text-primary mb-3">Professional Packing</h3>
                    <p class="text-body small text-muted">Our team wraps your furniture in protective blankets and carefully boxes your items to prevent any shifting during transport.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card p-4 text-center">
                    <div class="icon-box mx-auto mb-3">3</div>
                    <h3 class="h5 fw-800 text-primary mb-3">Safe Delivery & Setup</h3>
                    <p class="text-body small text-muted">We unload and place all boxes and furniture exactly where you want them, reassembling beds and tables so you can relax.</p>
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
                                What is residential moving?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Residential moving refers to the relocation of households and individuals from one private residence to another. This includes single-family homes, apartments, townhouses, and condos. It focuses heavily on personal belongings and fragile home goods.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How do you charge for residential moving?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Local residential moves are typically billed on an hourly basis, determined by the size of the crew and number of trucks. Long-distance residential moves are billed based on the mileage between locations and the overall volume or weight of the items being moved.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Do you provide senior moving services?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes, we offer specialized senior moving assistance. Our team is trained to handle down-sizing and moving senior citizens with extra care, patience, and compassion, helping arrange items in the new home exactly as they prefer.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Are packing services included in a residential move?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                While a standard residential move includes loading, transporting, and unloading your pre-packed boxes, you can easily upgrade to our full-service packing and unpacking. We will bring all the boxes, wrap, tape, and completely pack your house for you.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                How do you protect furniture during a home move?
                            </button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                We wrap all wood, metal, and upholstered furniture in clean, thick fabric moving blankets before it leaves your house. This protection stays on the furniture until it is safely placed in your new home, ensuring zero scratches or dust.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                Do you offer storage options for residential moves?
                            </button>
                        </h3>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes, we offer secure, climate-controlled storage solutions. If your new home isn't ready yet, we can store your household items in our private warehouse and deliver them to your door whenever you are ready.
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
        <h2 class="fw-800 text-white mb-3">Ready to Make Your Home Move Easy?</h2>
        <p class="lead opacity-75 mb-4 col-lg-7 mx-auto text-white">Get your free, no-obligation moving quote in minutes. Our residential moving experts are ready to help plan your perfect home transition.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 shadow fw-bold text-white">Get Your Free Quote <i class="fas fa-truck-moving ms-2"></i></a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Calculate Moving Cost <i class="fas fa-calculator ms-2"></i></a>
        </div>
    </div>
</section>
@endsection
