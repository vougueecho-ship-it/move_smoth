@extends('layouts.master')

@section('title', 'Best Commercial Moving Companies | Office Relocations')
@section('meta_description', 'Compare the best commercial moving companies and office relocation specialists. Request free quotes from top business moving services in your area.')

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
            "name": "Commercial Moving Services",
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
    "serviceType": "Commercial Moving Services",
    "provider": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    },
    "areaServed": {
        "@@type": "Country",
        "name": "US"
    },
    "name": "Commercial Moving Services",
    "description": "Professional office moving, modular desk installation, records management, and IT migration services for businesses and corporations."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "How much does a commercial office move cost?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Commercial office moving costs are typically calculated based on square footage, the number of employee workstations, or the volume of physical items. On average, office moves cost between $1.50 and $3.00 per square foot, or approximately $150 to $300 per employee workstation. This includes standard packing, transport, and desk reassembly."
            }
        },
        {
            "@@type": "Question",
            "name": "What is required to secure a Certificate of Insurance (COI) for an office building?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Commercial properties require moving companies to issue a COI with specific coverage limits—typically $1 Million per occurrence and $2 Million general aggregate. Property management companies must be listed as 'Additional Insured' and 'Certificate Holder' on the ACORD form. Move Smooth connects you with commercial carriers who coordinate directly with building managers to issue these certificates."
            }
        },
        {
            "@@type": "Question",
            "name": "Do commercial movers handle server rack migration and IT disconnects?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes, specialized commercial movers provide dedicated IT migration teams. They handle server rack breakdown, computer disconnects, labeling of cords, anti-static wrapping, and re-mounting at the new office location. Standard movers handle physical transport, while IT specialists manage connections and cable routes."
            }
        },
        {
            "@@type": "Question",
            "name": "How do businesses handle confidential archives during a move?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Confidential files are packed in secure, lockable document crates to comply with HIPAA, SOX, and GLBA privacy regulations. These bins are sealed with tamper-evident tags at the old office and are only unsealed in the presence of authorized business personnel at the new location."
            }
        },
        {
            "@@type": "Question",
            "name": "Can modular cubicles (Herman Miller, Steelcase) be disassembled and reassembled?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes. Professional office moving crews include certified modular furniture installers who specialize in dismantling, packing, and rebuilding cubicles from major brands including Herman Miller, Steelcase, and Haworth. They align electrical and data wiring routes through modular raceways to ensure workstations are ready for IT hookups."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/commercial-moving.css') }}" rel="stylesheet">
    <style>
        .commercial-badge {
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
<section class="commercial-hero" style="border-bottom: 4px solid #e11d48;">
    <div class="container text-center py-5">
        <nav class="breadcrumb-nav mb-4 d-inline-block">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item text-white opacity-50" aria-current="page">Services</li>
                <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Commercial Moving</li>
            </ol>
        </nav>
        <h1 class="display-3 fw-900 text-white mb-3">Compare the Best Commercial Moving Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Compare corporate moving quotes, business relocation specialists, ratings, and licensing information for the best movers.</p>
    </div>
</section>

<!-- 1. Overview Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <span class="commercial-badge mb-3"><i class="fas fa-briefcase me-1"></i> Business Relocations</span>
                <h2 class="fw-800 text-primary mb-4">Precision Corporate Relocations & Office Moving</h2>
                <p class="text-body mb-4">Relocating a business is an operation that demands thorough coordination, strict schedule compliance, and specialized logistics. Unlike residential moving, which centers on household items, a commercial move involves migrating computer networks, modular desk systems, archives, and heavy commercial machinery. At <strong>Move Smooth</strong>, we coordinate high-precision office moves that prioritize efficiency, security, and minimal disruption to your daily operations. Our network of vetted commercial movers is equipped to manage transitions of all scales.</p>
                <p class="text-body mb-4">Our corporate clients benefit from customized moving strategies tailored to their specific lease requirements, building regulations, and technological setups. We work with property managers to schedule freight elevator access, obtain municipal parking permits, and issue necessary Certificates of Insurance (COIs) to ensure access on moving day. By planning every detail, we help you transition to your new office layout with zero operational friction.</p>
                
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Get a Business Quote <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Cost Calculator <i class="fas fa-calculator ms-2"></i></a>
                </div>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-truck-moving text-accent me-2"></i> Relocating Your Home?</h5>
                    <p class="mb-0 small text-muted">If you are moving personal goods, apartments, or private single-family homes, explore our residential page. <a href="{{ route('front.service.residential') }}" class="fw-bold text-primary text-decoration-none">Explore Residential Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="premium-card bg-light-peach border-0 text-center p-5">
                    <div class="icon-box mx-auto mb-4">
                        <i class="fas fa-calendar-days"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Nights & Weekends</h3>
                    <p class="text-body small mb-4">We minimize downtime by scheduling packing, disassembly, and loading sessions during off-peak commercial hours, including nights, weekends, and holidays.</p>
                    <a href="tel:+14065059198" class="btn btn-primary w-100 py-3 rounded-pill fw-bold"><i class="fas fa-phone-alt me-2"></i> Call Corporate Desk</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Directory Section -->
<section class="section-padding bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="commercial-badge mb-3"><i class="fas fa-list me-1"></i> Mover Directory</span>
            <h2 class="fw-800 text-primary">Compare the Best Commercial Moving Companies</h2>
            <p class="text-body col-lg-8 mx-auto">Compare licensing, commercial insurance bounds, ratings, and specialized business relocation reviews. Request free quotes instantly.</p>
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

<!-- Deep Dive Content Block: Corporate Relocation Costs & Planning -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-800 text-primary mb-4 text-center">Planning Your Commercial Relocation: Cost Estimations</h3>
                <p class="lh-lg text-secondary mb-4">A successful office move relies on structured timelines and budget allocations. Commercial moving rates depend on the overall layout size and specialized labor requirements, such as IT technicians or modular furniture installers. Understanding average pricing metrics helps you plan resources effectively.</p>
                
                <h4 class="fw-bold text-dark mb-3">Commercial Moving Cost Estimates</h4>
                <p class="lh-lg text-secondary mb-4">The cost of commercial relocations is typically estimated based on employee count or square footage. Below is a layout of standard market cost ranges:</p>
                
                <table class="table table-bordered bg-white my-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Office Scale</th>
                            <th>Workstations</th>
                            <th>Average Square Footage</th>
                            <th>Average Relocation Cost</th>
                            <th>Key Services Included</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Small Office</td>
                            <td>5 - 15 Workstations</td>
                            <td>1,000 - 3,000 sq ft</td>
                            <td>$1,500 - $4,500</td>
                            <td>Desk disassembly, basic packing, transport, and setup.</td>
                        </tr>
                        <tr>
                            <td>Medium Office</td>
                            <td>20 - 50 Workstations</td>
                            <td>4,000 - 10,000 sq ft</td>
                            <td>$5,000 - $15,000</td>
                            <td>Cubicle installation, IT packing, file archiving, and multi-truck transport.</td>
                        </tr>
                        <tr>
                            <td>Large Enterprise</td>
                            <td>60 - 150 Workstations</td>
                            <td>12,000 - 30,000 sq ft</td>
                            <td>$20,000 - $50,000+</td>
                            <td>Project manager, server migration, modular re-cabling, staging phases.</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="fw-bold text-dark mb-3">Vetting Building Requirements & Liability (COI Limits)</h4>
                <p class="lh-lg text-secondary mb-4">Most modern commercial offices operate under strict asset protection rules. Property managers will refuse loading dock access to moving teams that do not carry adequate insurance. Move Smooth connects you with carriers who issue Certificates of Insurance (COIs) meeting high commercial liability thresholds: $1 Million per occurrence, $2 Million general aggregate, and $1 Million workers' compensation limits. These documents are delivered directly to building managers to ensure access on moving day.</p>
            </div>
        </div>
    </div>
</section>

<!-- 2. Office Relocation Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <span class="commercial-badge mb-3"><i class="fas fa-chair me-1"></i> Corporate Operations</span>
                <h2 class="fw-800 text-primary mb-4">Seamless Office Relocations</h2>
                <p class="text-body mb-3">Moving desks, workstations, conference tables, and archival storage requires organized tracking. Our experienced commercial movers tag every box and piece of furniture with color-coded labels that align with the seating chart of your new location. This ensures that when our trucks arrive at the destination, items are delivered to the correct desks, eliminating sorting delays.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Floor Plan Mapping:</strong> We coordinate with your facilities manager to match label coding with the new blueprint layout, ensuring furniture is placed correctly.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Freight Elevator Scheduling:</strong> We coordinate access windows with building managers to avoid elevator conflicts during loading.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Corporate Assets Breakdown:</strong> Heavy items such as industrial printers, heavy conference tables, and reception units are protected with blankets and straps during transit.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-route text-accent me-2"></i> Moving Across the Country?</h5>
                    <p class="mb-0 small text-muted">If your business is opening a branch in another state, explore our state-to-state moving network. <a href="{{ route('front.service.long') }}" class="fw-bold text-primary text-decoration-none">Explore Long Distance Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-1">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Multi-Story Logistics</h3>
                    <p class="text-body text-secondary lh-lg">We are highly experienced in working with property managers, scheduling loading dock access, and providing standard Certificates of Insurance (COIs) required by corporate skyscrapers.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-file-invoice text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">COI credentials issued immediately to building management prior to move day.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. IT & Server Migration Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="commercial-badge mb-3"><i class="fas fa-server me-1"></i> Sensitive Technology</span>
                <h2 class="fw-800 text-primary mb-4">IT, Workstation & Server Migration</h2>
                <p class="text-body mb-3">Computers, server racks, networking switches, and active data infrastructure demand highly specialized treatment. We partner with technological relocation technicians who follow electrostatic discharge (ESD) standards.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>IT disconnect and mapping:</strong> We disconnect computers, label cords, and document connectivity layouts to ensure fast hookup at the new workspace.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Anti-static padding:</strong> Monitors, keyboards, and computer units are packed in static-resistant bubble wrap and placed in secure tech bins.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Server Rack Logistics:</strong> High-value server units are transported in climate-controlled moving vans on shock-absorbing rolling carts to protect hardware.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-boxes-packing text-accent me-2"></i> Professional Pack-up Needed?</h5>
                    <p class="mb-0 small text-muted">We provide full packing materials and dedicated boxes for all business files and office equipment. <a href="{{ route('front.service.packing') }}" class="fw-bold text-primary text-decoration-none">Explore Packing Services <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="premium-card p-5 bg-white">
                    <div class="icon-box mb-4">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Secure Asset Protection</h3>
                    <p class="text-body text-secondary lh-lg">All computers and technology arrays are securely tracked with custom barcodes and transported on specialty pneumatic-wheeled carts to absorb road vibrations during transit.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield-halved text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Protected by specialized high-value tech transit liability riders.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Cubicle Installation Section -->
<section class="section-padding bg-light-peach border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="commercial-badge mb-3"><i class="fas fa-screwdriver-wrench me-1"></i> Modular Workspace Assembly</span>
            <h2 class="fw-800 text-primary">Cubicle & Modular Furniture Installation</h2>
            <p class="text-body col-lg-8 mx-auto">Leave the heavy tools behind. Our modular furniture specialists handle the complete disassembly, packing, transport, and reassembly of executive workstations and cubicles.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Modular Disassembly</h3>
                    <p class="text-body small text-muted">Careful breakdown of complex modular workstations, cataloging all connecting brackets, screws, and desk components to ensure straightforward reassembly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-map"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Layout Planning</h3>
                    <p class="text-body small text-muted">Our installation crews work off your new blueprint layouts to set up workstation configurations matching your organizational chart.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-screwdriver"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Reassembly & Leveling</h3>
                    <p class="text-body small text-muted">Complete re-anchoring, modular desk mounting, drawer alignment, and structural leveling for safe cubicle operations.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 fw-bold text-white shadow">Schedule Furniture Installation <i class="fas fa-tools ms-2"></i></a>
        </div>
    </div>
</section>

<!-- 5. Asset & Records Management Section -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="commercial-badge mb-3"><i class="fas fa-folder-closed me-1"></i> Data Security & Retention</span>
                <h2 class="fw-800 text-primary mb-4">Secure Records & Asset Management</h2>
                <p class="text-body mb-3">Protecting sensitive intellectual property, client records, medical physical files, and financial history is paramount. We offer HIPAA-compliant secure records handling and barcode-audited inventories.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Confidential Document Sealing:</strong> We place tamper-evident tags on document crates to prevent unauthorized access during transit.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Barcode Auditing:</strong> Every file archive box is scanned at loading and unloading to guarantee that no documentation is misplaced.</span>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-accent mt-1"></i>
                        <span><strong>Climate-Controlled Storage:</strong> We offer climate-controlled offsite storage vaults for business archives and historical blueprints.</span>
                    </li>
                </ul>

                <div class="cta-box-inline">
                    <h5 class="fw-bold"><i class="fas fa-warehouse text-accent me-2"></i> Need Offsite Business Storage?</h5>
                    <p class="mb-0 small text-muted">We offer climate-controlled storage vaults for physical files, blueprints, and excess office furniture. <a href="{{ route('front.service.storage') }}" class="fw-bold text-primary text-decoration-none">Explore Storage Units <i class="fas fa-chevron-right ms-1"></i></a></p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="premium-card p-5 bg-light border-0">
                    <div class="icon-box mb-4">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <h3 class="fw-800 text-primary mb-3">Asset Barcode Tracking</h3>
                    <p class="text-body text-secondary lh-lg">Our network utilizes real-time barcode inventory scanning, enabling you to trace the exact truck loading position, transit status, and unpacking location of every box of records.</p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-circle-check text-accent fs-3"></i>
                        <span class="small fw-semibold text-muted">Full compliance with HIPAA, SOX, and standard records protection guidelines.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Project Management Section -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="commercial-badge mb-3"><i class="fas fa-user-tie me-1"></i> Corporate Supervision</span>
            <h2 class="fw-800 text-primary">Dedicated Corporate Project Managers</h2>
            <p class="text-body col-lg-8 mx-auto">Every corporate relocation is assigned a senior Project Manager who outlines blueprints, chairs planning meetings, and supervises on-site crews for zero downtime.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Phase Scheduling</h3>
                    <p class="text-body small text-muted">We map out multi-phase relocations, breaking down the move into departments so your key operations stay online during the transition.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-clipboard-question"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Permit & Access Setup</h3>
                    <p class="text-body small text-muted">We coordinate street blocking permits, high-rise freight permissions, and parking authorizations with city authorities to ensure smooth access.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-card bg-white p-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-building-circle-check"></i>
                    </div>
                    <h3 class="h5 fw-800 text-primary mb-3">Building Rules Compliance</h3>
                    <p class="text-body small text-muted">Protecting floorboards, wall panels, elevator walls, and meeting HOA guidelines to prevent property damage and building penalties.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-body">Want to read more about our background-checked crew screening and licensing details? <a href="{{ route('front.about') }}" class="fw-bold text-accent text-decoration-none">Learn More About Move Smooth <i class="fas fa-arrow-right ms-1"></i></a></p>
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
                                How do you minimize downtime during an office move?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                We minimize downtime by conducting moves during off-peak hours, such as nights and weekends. A dedicated project manager coordinates the entire process, organizing the sequence of packing, loading, and setup to ensure your critical business operations are restored as quickly as possible.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Do you handle sensitive IT and electronics migration?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes, our commercial moving partners specialize in IT migration. We handle servers, computers, monitors, and networking equipment with anti-static packaging, specialized rolling carts, and climate-controlled transport vehicles to ensure safety and data integrity.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Do you offer cubicle and office furniture installation?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                Yes! Full disassembly and modular installation of cubicles, conference tables, executive desks, and shelving are included in our commercial relocation packages. Experienced technicians ensure all furniture is reconfigured perfectly at your new office layout.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                What is records management and secure file storage?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-body bg-white text-muted">
                                We offer secure, off-site storage solutions for physical business files, records, archives, and blueprints. Our facilities are climate-controlled and fully monitored 24/7 to ensure data security and compliance with records protection standards.
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
        <h2 class="fw-800 text-white mb-3">Ready to Schedule Your Business Relocation?</h2>
        <p class="lead opacity-75 mb-4 col-lg-7 mx-auto text-white">Connect with a commercial moving specialist today. We coordinate high-efficiency commercial moves to ensure seamless transitions.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg px-5 py-3 shadow fw-bold text-white">Get a Corporate Estimate <i class="fas fa-briefcase ms-2"></i></a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Calculate Business Cost <i class="fas fa-calculator ms-2"></i></a>
        </div>
    </div>
</section>
@endsection
