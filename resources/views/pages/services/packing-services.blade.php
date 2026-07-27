@extends('layouts.master')

@section('title', 'Best Packing & Moving Companies | Professional Packers')
@section('meta_description', 'Compare the best professional packing and moving companies near you. Get free estimates for full packing, custom crating, and unpacking services.')

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
            "name": "Packing Services",
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
    "serviceType": "Packing Services",
    "provider": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    },
    "areaServed": {
        "@@type": "Country",
        "name": "US"
    },
    "name": "Packing Services",
    "description": "Professional packing, custom crating, unpacking, and moving supply provision services for residential and commercial relocations."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "What is the difference between CP (Carrier Packed) and PBO (Packed by Owner) boxes?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "CP (Carrier Packed) boxes are packed by professional movers, meaning the moving company assumes cargo liability for the safety of the contents. If items break due to poor packing, the carrier must repair or replace them under your valuation agreement. PBO (Packed by Owner) boxes are packed by the customer. Moving companies are not liable for damage inside PBO boxes unless the box itself shows visible, external structural damage from transit drop."
            }
        },
        {
            "@@type": "Question",
            "name": "How much does a professional packing service cost?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Professional packing services typically range from $60 to $120 per hour for a crew of two packers, plus the actual cost of materials used. For a standard 2-to-3-bedroom home, material and labor costs generally total between $800 and $1,800. Full-service flat-rate packages are also available that bundle all boxes, tape, wrap, and labor into a single guaranteed quote."
            }
        },
        {
            "@@type": "Question",
            "name": "What are the dimensions and uses of standard moving boxes?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Standard moving box categories include: Small (1.5 cu ft) for heavy items like books, files, and tools; Medium (3.0 cu ft) for clothes, pots, pans, and appliances; Large (4.5 cu ft) for lightweight bulky items like pillows, bedding, and toys; Dishpack (double-walled) for kitchen plates and glasses; and Wardrobe (equipped with a metal bar) for hanging closet clothes."
            }
        },
        {
            "@@type": "Question",
            "name": "Are movers liable for high-value items like jewelry or currency?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "No. Standard moving contracts explicitly exclude liability for items of extraordinary value such as currency, precious metals, legal documents, stocks, and high-end jewelry. Customers are legally required to carry these items personally rather than loading them onto the moving truck."
            }
        },
        {
            "@@type": "Question",
            "name": "Does a full-service unpacking package include taking away the trash?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes. A complete unpacking service includes not only unpacking all boxes and placing items onto flat surfaces or counters, but also organizing, folding, and hauling away all empty cardboard boxes, wrapping paper sheets, and bubble wrap debris for proper disposal and recycling."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/packing-services.css') }}" rel="stylesheet">
    <style>
        .packing-badge {
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
<section class="packing-hero" style="border-bottom: 4px solid #e11d48;">
    <div class="container text-center py-5">
        <nav class="breadcrumb-nav mb-4 d-inline-block">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item text-white opacity-50" aria-current="page">Services</li>
                <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Packing Services</li>
            </ol>
        </nav>
        <h1 class="display-3 fw-900 text-white mb-3">Compare the Best Packing and Moving Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Compare professional packers, full packing services, ratings, and rates from the best local and long-distance movers near you.</p>
    </div>
</section>

<!-- 1. Overview Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="packing-badge mb-3"><i class="fas fa-box-archive me-1"></i> Damage Prevention</span>
                <h2 class="fw-800 text-primary mb-4">Pack Like a Pro, Without the Stress</h2>
                <p class="text-body mb-4">Packing is easily the most time-consuming and physically demanding part of any relocation. Wrapping delicate items, sorting through storage areas, and lifting heavy boxes can turn an exciting move into a stressful chore. At <strong>Move Smooth</strong>, we coordinate professional packing services designed to safeguard your belongings during transit. By hiring a verified packing team, you ensure that every item—from fragile glassware to heavy electronics—is padded, boxed, and loaded securely.</p>
                <p class="text-body mb-4">Our network of professional packers uses only industry-grade, double-walled boxes, acid-free packing paper, and specialized padding blankets. We take the heavy burden off your shoulders, converting days of tedious wrapping into a swift, organized operation. Whether you choose full packing or partial assistance with fragile items, our partners deliver quality care.</p>
                
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Get a Packing Quote <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Cost Calculator <i class="fas fa-calculator ms-2"></i></a>
                </div>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-truck-moving text-accent me-2"></i> Ready to Book Your Move?</h5>
                    <p class="mb-0 small text-muted">We combine expert packing with standard home moves. Discover our comprehensive household services. <a href="{{ route('front.service.residential') }}" class="fw-bold text-primary text-decoration-none">Explore Residential Moving <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card bg-light-peach border-0 text-center p-5">
                    <div class="icon-box mx-auto mb-4">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Eco-Friendly Packs</h3>
                    <p class="text-body small mb-4">We are committed to sustainability. Our network uses premium recyclable materials, reusable wardrobe wardrobes, and clean biodegradable packing paper to minimize environment waste.</p>
                    <a href="{{ route('front.movers') }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold"><i class="fas fa-search me-2"></i> Find Professional Packers</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Directory Section -->
<section class="section-padding bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="packing-badge mb-3"><i class="fas fa-list me-1"></i> Mover Directory</span>
            <h2 class="fw-800 text-primary">Compare the Best Packing & Moving Companies</h2>
            <p class="text-body col-lg-8 mx-auto">Browse verified moving companies offering full-service packing and crating. Compare star ratings, reviews, and get free quotes.</p>
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

<!-- Deep Dive Content Block: Moving Box Science & Material Calculations -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-800 text-primary mb-4 text-center">Understanding Box Dimensions & Packing Logistics</h3>
                <p class="lh-lg text-secondary mb-4">A safe move depends on using the correct box sizes. Packing heavy items in large boxes, or overfilling lightweight boxes, can lead to structural damage and accidental drops on moving day. Professional packers organize cargo by density and weight distribution, using standard box dimensions designed for transit safety.</p>
                
                <h4 class="fw-bold text-dark mb-3">Standard Moving Box Specifications</h4>
                <p class="lh-lg text-secondary mb-4">Below is an overview of the standard boxes used by professional teams, along with their recommended cargo types:</p>
                
                <table class="table table-bordered bg-white my-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Box Type</th>
                            <th>Volume (Cubic Feet)</th>
                            <th>Average Dimensions</th>
                            <th>Best Used For</th>
                            <th>Packing Tip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Small Carton</td>
                            <td>1.5 cu ft</td>
                            <td>16" x 12" x 12"</td>
                            <td>Books, tools, records, canned goods, heavy cookware.</td>
                            <td>Keep the total weight under 50 lbs to prevent bottom rupture.</td>
                        </tr>
                        <tr>
                            <td>Medium Carton</td>
                            <td>3.0 cu ft</td>
                            <td>18" x 18" x 16"</td>
                            <td>Clothes, folded linens, toys, electronics, kitchen pots and pans.</td>
                            <td>Cushion the bottom with packing paper before loading.</td>
                        </tr>
                        <tr>
                            <td>Large Carton</td>
                            <td>4.5 cu ft</td>
                            <td>24" x 18" x 18"</td>
                            <td>Pillows, heavy winter coats, comforters, plastic storage bins.</td>
                            <td>Only use for lightweight, bulky items to prevent bowing.</td>
                        </tr>
                        <tr>
                            <td>Dishpack (Double-Walled)</td>
                            <td>5.2 cu ft</td>
                            <td>18" x 18" x 28"</td>
                            <td>China plates, fine crystal stemware, fragile vases, kitchen mixers.</td>
                            <td>Use cellular dividers and wrap each item individually in paper.</td>
                        </tr>
                        <tr>
                            <td>Wardrobe Box</td>
                            <td>10+ cu ft</td>
                            <td>24" x 21" x 48"</td>
                            <td>Hanging closet clothing, suits, dresses, drapes.</td>
                            <td>Features a metal hanger bar to transfer clothes directly.</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="fw-bold text-dark mb-3">Understanding the CP vs. PBO Liability Differences</h4>
                <p class="lh-lg text-secondary mb-4">When evaluating packing quotes, consider the insurance liability implications of who packs the boxes. This is denoted on moving invoices as either **CP (Carrier Packed)** or **PBO (Packed by Owner)**.</p>
                <p class="lh-lg text-secondary mb-4">For **CP (Carrier Packed)** boxes, the moving company assumes full cargo liability for the contents. If items break due to poor packing, the carrier is responsible for repairing or replacing them under your valuation agreement. For **PBO (Packed by Owner)** boxes, the carrier is not liable for damage to the contents unless the outer cardboard box shows visible, external damage from transit drop. Opting for professional packing services provides maximum insurance protection for your valuables.</p>
            </div>
        </div>
    </div>
</section>

<!-- 2. Full Packing Service Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="packing-badge mb-3"><i class="fas fa-boxes-stacked me-1"></i> Full Turnkey Service</span>
                <h2 class="fw-800 text-primary mb-4">Full House Packing Services</h2>
                <p class="text-body mb-3">Our full-service packing option is the ultimate time-saver. A professional crew arrives at your residence with all the necessary supplies and packs every room, closet, and drawer from top to bottom, labeling every box systematically.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Kitchen Packing:</strong> Kitchens are often the most complex areas to pack. We wrap every plate, cup, and bowl individually, utilizing double-walled dish packs for maximum safety.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Closet Transitions:</strong> Wardrobe boxes allow your clothes to hang upright during transit, preventing wrinkles and allowing quick transfer back to your new closets.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Attic and Garage Sorting:</strong> Tools, outdoor equipment, and holiday decorations are sorted, boxed, and taped securely to handle the bumpy ride.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-route text-accent me-2"></i> Moving Out of State?</h5>
                    <p class="mb-0 small text-muted">Long distance moves demand professional-grade wrapping to withstand highway vibrations. <a href="{{ route('front.service.long') }}" class="fw-bold text-primary text-decoration-none">Explore Long Distance Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-house-circle-check"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Stress-Free Moving Day</h3>
                    <p class="text-body text-secondary lh-lg">With full packing, you don't have to live out of boxes for weeks. Our teams typically arrive 1-2 days before moving day and pack your entire household swiftly and methodically.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">All boxes are taped, reinforced, and room-mapped for quick offloading.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Partial Packing Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="packing-badge mb-3"><i class="fas fa-circle-nodes me-1"></i> Customized Solutions</span>
                <h2 class="fw-800 text-primary mb-4">Partial & Fragile Packing</h2>
                <p class="text-body mb-3">Want to pack most of your things yourself but need expert help with the breakables? Our partial packing service is designed exactly for this. We step in to pack only the designated rooms, cabinets, or delicate items you choose.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Glassware & China:</strong> Kitchen cabinets containing delicate porcelain and crystal stemware are wrapped and boxed using professional techniques.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Artwork & Mirrors:</strong> We use telescoping mirror cartons and bubble wrap to protect large mirrors, paintings, and framed photographs.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Media & Electronics:</strong> Expensive televisions, computer setups, and audio systems are wrapped in protective foam to absorb transit vibrations.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-briefcase text-accent me-2"></i> Relocating a Business?</h5>
                    <p class="mb-0 small text-muted">We provide specialized IT workstations and server migration packing for commercial operations. <a href="{{ route('front.service.commercial') }}" class="fw-bold text-primary text-decoration-none">Explore Commercial Moving <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="premium-card p-5 bg-white">
                    <div class="icon-box mb-4">
                        <i class="fas fa-wine-glass"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Fragile-Only Experts</h3>
                    <p class="text-body text-secondary lh-lg">Our crews are experts in fragile wrapping. We utilize custom dish-pack boxes with cellular cardboard dividers and thick bubble wraps to prevent glass-on-glass friction.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-award text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Highly trained packers who understand weight distribution in boxes.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Custom Crating Section -->
<section class="section-padding bg-light-peach border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="packing-badge mb-3"><i class="fas fa-hammer me-1"></i> Heavy-Duty Shielding</span>
            <h2 class="fw-800 text-primary">Custom Wooden Crating</h2>
            <p class="text-body col-lg-8 mx-auto">Standard cardboard boxes are not enough for high-value antiques or specialty items. We offer customized on-site wood crating to guarantee zero movements.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Fine Art & Sculptures</h3>
                    <p class="text-body small text-muted">We construct custom-sized plywood crates padded with foam sheets for expensive canvases, sculptures, and glass art pieces to ensure complete protection.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Grandfather Clocks</h3>
                    <p class="text-body small text-muted">Securing internal chimes, weights, and glass panels with specialized foam inserts before loading them into strong outer wooden crates.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-tv"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Massive Displays</h3>
                    <p class="text-body small text-muted">Heavy-duty wood crating for oversized flat-screen televisions, high-end marble table tops, and heavy architectural structures.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Request Custom Crating Quote <i class="fas fa-toolbox ms-2"></i></a>
        </div>
    </div>
</section>

<!-- 5. Unpacking Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="packing-badge mb-3"><i class="fas fa-handshake-angle me-1"></i> Settling in Faster</span>
                <h2 class="fw-800 text-primary mb-4">Complete Unpacking & Room Setup</h2>
                <p class="text-body mb-4">Arriving at your new home surrounded by a mountain of cardboard boxes can be overwhelming. We offer comprehensive unpacking services to help you settle in instantly.</p>
                <p class="text-body mb-4">Our crews carefully unpack every box, place items neatly onto countertops, desks, or shelves, reassemble all bed frames and tables, and load all the used boxes and packing debris onto our trucks, leaving your new home clean and functional.</p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('front.calculator') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">Plan Your Full-Service Move <i class="fas fa-house-laptop ms-2"></i></a>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Debris & Box Removal</h3>
                    <p class="text-body text-secondary lh-lg">We don't leave you with a mess. Once unpacking is finished, our team will clean up, stack, and haul away all used boxes, wrapping sheets, bubble wraps, and tape scraps for recycling.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-circle-check text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Complete debris removal leaves your new neighborhood clean and eco-friendly.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Vetting & Materials Standards Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="packing-badge mb-3"><i class="fas fa-star me-1"></i> Vetted Professionals</span>
            <h2 class="fw-800 text-primary">Why Choose Our Professional Packers?</h2>
            <p class="text-body col-lg-8 mx-auto">Every packer in our network undergoes rigorous training in packing physics, weight distribution, and high-value antique wrapping protocols.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Background-Checked</h3>
                    <p class="text-body small text-muted">All packers are full-time employees, background-checked, drug-tested, and fully insured for your safety and trust.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-couch"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Thick Furniture Blankets</h3>
                    <p class="text-body small text-muted">We wrap all large wood, leather, and metal surfaces in clean, thick logistics blankets to prevent scratches and dents during transit.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Secure Warehouse Storage</h3>
                    <p class="text-body small text-muted">If you need storage during transit, your packed boxes are stored in climate-controlled vaults. <a href="{{ route('front.service.storage') }}" class="text-decoration-none text-primary fw-bold">Explore Storage <i class="fas fa-arrow-right ms-1"></i></a></p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-body">Want to read more about our trust policies, certifications, and local insurance structures? <a href="{{ route('front.about') }}" class="fw-bold text-accent text-decoration-none">About Move Smooth <i class="fas fa-arrow-right ms-1"></i></a></p>
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
                                What is the difference between full and partial packing services?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Full packing services mean our professional packers handle boxing up every single room in your home, including kitchens, closets, and garages. Partial packing services are customized to your needs, where you choose specific items or rooms (like just fragile glassware, artwork, or your clothes) for us to pack, while you handle the rest.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                What kinds of packing materials do you use?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                We use high-quality, heavy-duty, double-walled boxes of various sizes, specialized wardrobe boxes with hangers, thick bubble wrap, premium packing paper, custom wood crating for fine art and antiques, and heavy-duty tape to protect your belongings during transit.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                How do you handle fragile and high-value items?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Fragile and high-value items (like chinaware, glassware, paintings, electronics, and mirrors) are individually wrapped in protective packing paper or bubble wrap. They are packed in custom-sized boxes and loaded with extra care. For extremely valuable or delicate antiques, we can construct custom wood crates to ensure zero movement.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Do you offer unpacking services at my new location?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes! We offer comprehensive unpacking services. Our crew will carefully unpack your boxes, place items on countertops or shelves, assemble beds and furniture, and remove all empty boxes and packing debris, leaving your new home ready for you to enjoy.
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
        <h2 class="fw-800 text-white mb-3">Ready to Let Professional Packers Handle It?</h2>
        <p class="lead opacity-75 mb-4 col-lg-7 mx-auto text-white">Get your free, customized packing estimate today. Our professional packing crews will wrap, box, and protect your home in record time.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 shadow fw-bold text-white">Get a Packing Estimate <i class="fas fa-box-open ms-2"></i></a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Calculate Moving Cost <i class="fas fa-calculator ms-2"></i></a>
        </div>
    </div>
</section>
@endsection
