@extends('layouts.master')

@section('title', 'Compare Best Moving Companies | Free Moving Quotes')
@section('meta_description', 'Compare licensed local and long-distance moving companies. Check ratings, reviews, USDOT registrations, phone numbers, and request quotes instantly.')

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
            "name": "Compare Movers",
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
    "@@type": "WebApplication",
    "name": "Move Smooth Mover Comparison Tool",
    "url": "{{ url()->current() }}",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "description": "Interactive moving company comparison tool to evaluate rates, ratings, and services of over 1,000 licensed movers in the US."
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "How do I compare moving company quotes effectively?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "To compare quotes effectively, ensure all estimates are based on the same inventory list and service requirements. Request binding or binding-not-to-exceed estimates, verify the movers' USDOT and MC licensing numbers via the FMCSA, and read verified reviews detailing customer experiences."
            }
        },
        {
            "@@type": "Question",
            "name": "What is the difference between a binding and non-binding estimate?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "A binding estimate guarantees the final price of the move based on the estimated inventory. A non-binding estimate is a general projection; the final cost is calculated based on the actual weight of the shipment and hours worked on moving day. A binding-not-to-exceed estimate is the most customer-friendly, ensuring you pay no more than the quote, but less if your cargo weighs less."
            }
        },
        {
            "@@type": "Question",
            "name": "How can I verify if a moving company is licensed and insured?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "All interstate movers must register with the Federal Motor Carrier Safety Administration (FMCSA) and hold an active USDOT number. You can verify licensing, insurance certificates, and safety records by inputting the USDOT number into the official FMCSA Mover Search Portal."
            }
        },
        {
            "@@type": "Question",
            "name": "What are common red flags when hiring a professional mover?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Common red flags include movers refusing to conduct a physical or virtual walk-through of your inventory, requesting a large cash deposit upfront, using unmarked rental trucks, lack of a physical office address, and failing to provide the federal 'Your Rights and Responsibilities When You Move' booklet."
            }
        },
        {
            "@@type": "Question",
            "name": "Do moving companies charge extra fees for stairs or long carries?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes, many moving companies charge additional fees for access obstacles, such as climbing multiple flights of stairs (flight fees), carrying items a long distance from the truck to the door (long-carry fees), elevator reservations, or using a smaller shuttle truck for narrow driveways."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
<style>
    /* Premium Comparison Section Styles */
    .compare-hero {
        background: radial-gradient(circle at top right, #1e293b 0%, #0f172a 100%);
        padding: 80px 0 60px 0;
        position: relative;
        overflow: hidden;
        border-bottom: 4px solid #2563eb;
    }
    .compare-box {
        margin-top: -40px;
        position: relative;
        z-index: 10;
    }
    .compare-card-slot {
        background: #ffffff;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        height: 100%;
        min-height: 280px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .compare-card-slot.active {
        border-style: solid;
        border-color: #e2e8f0;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.06);
    }
    .compare-card-slot:hover {
        border-color: #3b82f6;
        transform: translateY(-2px);
    }
    .add-mover-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .add-mover-btn:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    
    /* Search Autocomplete Dropdown */
    .mover-search-wrapper {
        position: relative;
        width: 100%;
    }
    .mover-search-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s ease;
    }
    .mover-search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .mover-dropdown-results {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        max-height: 250px;
        overflow-y: auto;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        z-index: 100;
        display: none;
        margin-top: 5px;
    }
    .mover-dropdown-item {
        padding: 12px 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s ease;
        text-align: left;
    }
    .mover-dropdown-item:hover {
        background: #f8fafc;
    }
    .mover-dropdown-item .name {
        font-weight: 700;
        color: #1e293b;
    }
    .mover-dropdown-item .meta {
        font-size: 0.8rem;
        color: #64748b;
    }

    /* Horizontal Responsive Compare Table */
    .compare-table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.06);
        background: #ffffff;
    }
    .compare-grid-table {
        min-width: 800px;
        display: flex;
        flex-direction: column;
    }
    .compare-row {
        display: flex;
        border-bottom: 1px solid #f1f5f9;
        align-items: stretch;
    }
    .compare-row:last-child {
        border-bottom: none;
    }
    .compare-label-cell {
        width: 220px;
        min-width: 220px;
        background: #f8fafc;
        padding: 20px 24px;
        font-weight: 800;
        color: #475569;
        display: flex;
        align-items: center;
        border-right: 2px solid #e2e8f0;
        position: sticky;
        left: 0;
        z-index: 20;
        box-shadow: 2px 0 5px rgba(0,0,0,0.02);
    }
    .compare-value-cell {
        flex: 1;
        min-width: 200px;
        padding: 20px 24px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-right: 1px solid #f1f5f9;
        background: #ffffff;
        transition: background 0.25s ease;
    }
    .compare-value-cell:last-child {
        border-right: none;
    }
    .compare-row:hover .compare-value-cell {
        background: #fafafb;
    }
    .slot-logo-container {
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }
    .slot-logo-container img {
        max-height: 100%;
        max-width: 150px;
        object-fit: contain;
    }
    .slot-logo-fallback {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.2rem;
        border: 1px solid #bfdbfe;
    }
    .service-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 100px;
        font-weight: 700;
        margin: 3px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: 1px solid transparent;
    }
    .service-badge.yes {
        background: #dcfce7;
        color: #166534;
        border-color: #bbf7d0;
    }
    .service-badge.no {
        background: #f1f5f9;
        color: #94a3b8;
        border-color: #e2e8f0;
        opacity: 0.65;
    }
    .clear-slot-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #fee2e2;
        color: #ef4444;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 5;
    }
    .clear-slot-btn:hover {
        background: #ef4444;
        color: #ffffff;
        transform: scale(1.1);
    }
    .seo-rich-content {
        line-height: 1.8;
        font-size: 1.05rem;
        color: #334155;
    }
    .seo-rich-content h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        margin-top: 40px;
        margin-bottom: 20px;
    }
    .seo-rich-content h3 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1e293b;
        margin-top: 30px;
        margin-bottom: 15px;
    }
    .seo-rich-content h4 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 25px;
        margin-bottom: 10px;
    }
    .seo-rich-content p {
        margin-bottom: 20px;
    }
    .seo-rich-content ul {
        margin-bottom: 20px;
        padding-left: 20px;
    }
    .seo-rich-content li {
        margin-bottom: 10px;
    }
    .faq-accordion .accordion-item {
        border-radius: 12px !important;
        margin-bottom: 16px;
        overflow: hidden;
    }
    .faq-accordion .accordion-button {
        color: #1e293b;
        background-color: #ffffff;
        box-shadow: none;
        font-weight: 700;
    }
    .faq-accordion .accordion-button:not(.collapsed) {
        color: #2563eb;
        background-color: #f8fafc;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="compare-hero">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-900 text-white mb-2">Compare Moving Companies</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-600 mx-auto">Select up to 4 local & interstate movers to compare ratings, reviews, licenses, and services in real-time.</p>
    </div>
</section>

<!-- Interactive Comparison Area -->
<section class="section-padding bg-light compare-box">
    <div class="container">
        <!-- Interactive Slots -->
        <div class="row g-4 mb-5">
            @for ($i = 0; $i < 4; $i++)
            <div class="col-lg-3 col-md-6">
                <div class="compare-card-slot" id="slot-{{ $i }}" data-slot-index="{{ $i }}">
                    <!-- Placeholder State -->
                    <div class="slot-placeholder text-center py-4 w-100">
                        <div class="text-muted mb-3"><i class="fas fa-truck-moving fa-3x" style="opacity: 0.35;"></i></div>
                        <h4 class="h6 fw-bold text-secondary mb-3">Mover Slot {{ $i + 1 }}</h4>
                        <button class="add-mover-btn mx-auto" onclick="openSearch({{ $i }})">
                            <i class="fas fa-plus text-primary"></i> Select Mover
                        </button>
                    </div>

                    <!-- Search Autocomplete Input -->
                    <div class="slot-search w-100 d-none">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="small fw-bold text-muted mb-0">Search Movers</label>
                            <button class="btn btn-sm text-danger p-0 border-0" onclick="cancelSearch({{ $i }})"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="mover-search-wrapper">
                            <input type="text" class="mover-search-input" id="search-input-{{ $i }}" placeholder="Type company name..." oninput="filterMovers({{ $i }})">
                            <div class="mover-dropdown-results" id="results-{{ $i }}"></div>
                        </div>
                    </div>

                    <!-- Active Company State -->
                    <div class="slot-active d-none w-100 text-center position-relative">
                        <button class="clear-slot-btn" onclick="clearSlot({{ $i }})" title="Remove"><i class="fas fa-times"></i></button>
                        <div class="slot-logo-container mt-3" id="slot-logo-{{ $i }}"></div>
                        <h3 class="h6 fw-bold text-dark mb-1" id="slot-name-{{ $i }}" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px; line-height: 1.2;"></h3>
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-2">
                            <span class="text-warning small" id="slot-stars-{{ $i }}"></span>
                            <span class="small fw-bold text-dark" id="slot-rating-val-{{ $i }}"></span>
                        </div>
                        <p class="small text-muted mb-0" id="slot-reviews-{{ $i }}" style="font-size: 0.75rem;"></p>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <!-- Detailed Comparison Table Wrapper -->
        <div class="compare-table-responsive d-none mb-5" id="comparisonTableContainer">
            <div class="compare-grid-table" id="comparisonTable">
                <!-- Header Row / Logo & Names -->
                <div class="compare-row bg-light">
                    <div class="compare-label-cell">Mover Info</div>
                    @for ($i = 0; $i < 4; $i++)
                    <div class="compare-value-cell d-none" id="table-header-slot-{{ $i }}">
                        <div class="fw-800 text-primary" id="table-name-{{ $i }}"></div>
                    </div>
                    @endfor
                </div>
                
                <!-- Rating Row -->
                <div class="compare-row">
                    <div class="compare-label-cell">Rating & Reviews</div>
                    @for ($i = 0; $i < 4; $i++)
                    <div class="compare-value-cell d-none" id="table-rating-slot-{{ $i }}">
                        <div class="d-flex align-items-center justify-content-center gap-1">
                            <span class="text-warning small" id="table-stars-{{ $i }}"></span>
                            <span class="fw-bold text-dark" id="table-rating-val-{{ $i }}"></span>
                        </div>
                        <span class="small text-muted" id="table-reviews-{{ $i }}"></span>
                    </div>
                    @endfor
                </div>

                <!-- Location Row -->
                <div class="compare-row">
                    <div class="compare-label-cell">Base Location</div>
                    @for ($i = 0; $i < 4; $i++)
                    <div class="compare-value-cell d-none" id="table-location-slot-{{ $i }}">
                        <span class="fw-bold text-dark" id="table-location-{{ $i }}"></span>
                    </div>
                    @endfor
                </div>

                <!-- USDOT License Row -->
                <div class="compare-row">
                    <div class="compare-label-cell">USDOT Registration</div>
                    @for ($i = 0; $i < 4; $i++)
                    <div class="compare-value-cell d-none" id="table-usdot-slot-{{ $i }}">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 font-monospace px-2 py-1" id="table-usdot-{{ $i }}"></span>
                    </div>
                    @endfor
                </div>

            <!-- Supported Services Row -->
            <div class="compare-row">
                <div class="compare-label-cell">Supported Services</div>
                @for ($i = 0; $i < 4; $i++)
                <div class="compare-value-cell d-none" id="table-services-slot-{{ $i }}">
                    <div class="d-flex flex-wrap justify-content-center" id="table-services-{{ $i }}"></div>
                </div>
                @endfor
            </div>

            <!-- Contact Row -->
            <div class="compare-row">
                <div class="compare-label-cell">Phone & Website</div>
                @for ($i = 0; $i < 4; $i++)
                <div class="compare-value-cell d-none" id="table-contact-slot-{{ $i }}">
                    <div class="mb-2" id="table-phone-{{ $i }}"></div>
                    <a href="#" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary py-1 text-decoration-none" id="table-website-{{ $i }}">Visit Site</a>
                </div>
                @endfor
            </div>

            <!-- Action buttons Row -->
            <div class="compare-row bg-light">
                <div class="compare-label-cell">Action</div>
                @for ($i = 0; $i < 4; $i++)
                <div class="compare-value-cell d-none" id="table-action-slot-{{ $i }}">
                    <div class="d-flex flex-column gap-2 w-100 px-3">
                        <a href="#" class="btn btn-sm btn-primary py-2 fw-bold" id="table-profile-btn-{{ $i }}">View Profile</a>
                        <a href="#" class="btn btn-sm btn-accent py-2 fw-bold text-white" id="table-quote-btn-{{ $i }}">Get Quote</a>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>

<!-- SEO Rich Content Block -->
<section class="section-padding bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 seo-rich-content">
                <h2>How to Compare Moving Companies: A Complete Guide to Finding the Best Moving Quotes</h2>
                <p>Relocating your household, apartment, or business is a monumental project that requires meticulous planning and resource allocation. While packing boxes and changing address forms represent key steps, selecting the correct relocation logistics provider remains the single most impactful factor in ensuring a stress-free move. With hundreds of operators promising competitive rates, comparing moving quotes, credentials, safety records, and services is a critical step in avoiding surprise charges and ensuring cargo safety.</p>
                <p>Move Smooth provides this comprehensive guide to demystify the vetting process. Using our real-time comparison tool, you can evaluate companies' records side by side. Below, we break down the vital parameters to look for when selecting a moving company, how pricing is constructed, and critical consumer warnings.</p>

                <h3>1. Vetting Licensing and Insurance (USDOT & FMCSA Requirements)</h3>
                <p>Licensing and regulatory compliance represent the absolute baseline of security when selecting a relocation partner. You should never hire an unlicensed team, regardless of how attractive their pricing quote seems. Interstate moves (crossing state lines) and local intrastate moves (within the same state borders) operate under distinct federal and local jurisdictions.</p>
                <ul>
                    <li><strong>Interstate Moving Regulations:</strong> Any company crossing state lines must hold active operational authority granted by the <strong>Federal Motor Carrier Safety Administration (FMCSA)</strong>. They are required to have a registered <strong>USDOT Number</strong> and a valid **MC (Motor Carrier) Number**. You can verify a company's registration history, operating status, and safety history by checking their USDOT number on the official FMCSA safety portal.</li>
                    <li><strong>Intrastate Moving Regulations:</strong> Local moves are regulated by state-specific agencies, such as a state Department of Transportation, Public Utilities Commission, or consumer protection bureau. Licensing requirements range from specific state permits to simple business registration. Make sure you check local authority licenses for same-city moving services.</li>
                    <li><strong>Insurance Coverages:</strong> Standard consumer protection mandates two types of cargo protection. The standard plan is **Released Value Protection**, which is free and covers cargo at a minimal rate (typically $0.60 per pound per item). The premium option is **Full Value Protection**, which holds the mover liable for the replacement value of lost or broken items. Ensure your provider offers clear terms for these coverages.</li>
                </ul>

                <h3>2. Understanding Moving Estimates: Binding, Non-Binding, and Binding-Not-to-Exceed</h3>
                <p>When you receive quotes from multiple companies, the estimates will fall under three standard categories. Understanding the legal difference between them protects you from unexpected price hikes when the truck arrives at your new home.</p>
                <p>A <strong>Non-Binding Estimate</strong> is a preliminary cost estimate based on the projected weight of your shipment and any ancillary services requested. It is not a contract, and the final price can be higher or lower depending on the actual weight of the shipment on moving day. By federal law, movers cannot demand more than 110% of the non-binding estimate at delivery, but they can bill you for the remaining balance later.</p>
                <p>A <strong>Binding Estimate</strong> is a firm agreement that guarantees the total moving cost based on the exact inventory list compiled during the walkthrough. If you add items on moving day, the company can write a new estimate, but otherwise, the price cannot change. This is ideal for fixed budgeting.</p>
                <p>A <strong>Binding-Not-to-Exceed Estimate</strong> (sometimes called a guaranteed price plan) represents the most consumer-friendly option. It sets a maximum ceiling price for the relocation based on your inventory. If your shipment weighs less than estimated, you pay a lower amount, but if it weighs more, you do not pay extra.</p>

                <h3>3. Service Type Analysis: Full-Service vs. Self-Service vs. Container Shipping</h3>
                <p>Choosing the correct logistics framework depends on your budget, timeframe, and physical capacity. Vetting service models helps align expectation with reality:</p>
                <ul>
                    <li><strong>Full-Service Movers:</strong> The company handles the heavy lifting, packing, loading, transport, unloading, and furniture assembly. This is the most stress-free option, ideal for families and busy professionals.</li>
                    <li><strong>Self-Service / Rental Trucks:</strong> You rent a moving truck (e.g. U-Haul) and handle the loading, driving, and unloading yourself, or hire labor-only crews. This is highly budget-friendly but requires significant labor and risk management.</li>
                    <li><strong>Container Moving:</strong> You rent portable storage containers (like PODS or U-Pack) that are dropped off at your house. You load them, and the container company transports them to your destination. This provides flexible timelines and intermediate storage.</li>
                </ul>

                <h3>4. Spotting Rogue Movers and Red Flags</h3>
                <p>The FMCSA receives thousands of consumer complaints yearly regarding rogue operators who hold goods hostage or demand cash to release cargo. Watch out for these standard warnings during the comparison process:</p>
                <ul>
                    <li><strong>No Physical Survey:</strong> Refusing to perform a virtual or physical inspection of your inventory before giving a binding estimate is a major warning sign. Online quotes given solely based on square footage are rarely binding.</li>
                    <li><strong>High Upfront Deposits:</strong> Reputable moving companies do not demand large cash deposits before the move. Payments are usually made upon delivery or split with standard credit card systems.</li>
                    <li><strong>Unmarked Rental Trucks:</strong> Vetted professional movers arrive in clean, branded company vehicles. If a crew shows up in a generic rented truck without uniform, double-check their credentials.</li>
                    <li><strong>Generic Phone Greetings:</strong> When calling, listen for generic answers like "Movers" instead of the registered company name. Professional agencies use consistent branding.</li>
                </ul>

                <h3>5. Moving Cost Factors & Average Distance Pricing Structure</h3>
                <p>Understanding standard cost averages helps evaluate if a received quote is realistic or suspiciously cheap. The table below represents estimated national average pricing categories:</p>
                
                <table class="table table-bordered bg-white my-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Home Size</th>
                            <th>Local Move (Under 100 Miles)</th>
                            <th>Long-Distance Move (1,000+ Miles)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1 Bedroom Apartment</td>
                            <td>$300 - $600</td>
                            <td>$1,500 - $3,200</td>
                        </tr>
                        <tr>
                            <td>2-3 Bedroom House</td>
                            <td>$800 - $1,600</td>
                            <td>$3,500 - $6,500</td>
                        </tr>
                        <tr>
                            <td>4+ Bedroom House</td>
                            <td>$1,800 - $3,500</td>
                            <td>$6,000 - $10,500+</td>
                        </tr>
                    </tbody>
                </table>

                <p>Additional cost variables include time of year (summer peak season represents higher demand), accessibility factors (walk-up stairs, long-carry distances), special item handling (pianos, pool tables), and packing material supply costs.</p>

                <h3>6. 10 Questions to Ask Before Hiring a Moving Company</h3>
                <p>Ensure you conduct a final interview with your selected relocation provider using these questions:</p>
                <ol>
                    <li>Are you a licensed moving carrier or an independent broker? (Brokers do not own trucks; they outsource to local crews).</li>
                    <li>What is your USDOT number and MC registration number?</li>
                    <li>Is the quote you provided binding, non-binding, or binding-not-to-exceed?</li>
                    <li>What standard valuation coverage is included, and how much does it cost to upgrade to full value protection?</li>
                    <li>Do you charge extra for stairs, long carries, elevator access, or narrow street shuttle services?</li>
                    <li>What is your delivery timeframe window, and what are the penalties if my cargo arrives late?</li>
                    <li>Do you use sub-contracted labor, or are all crew members direct, background-checked employees?</li>
                    <li>What payment methods do you accept, and what is your deposit and cancellation policy?</li>
                    <li>Are there any potential fuel surcharges or travel fees not written in this estimate?</li>
                    <li>How do you handle dispute resolution and damage claims?</li>
                </ol>

                <div class="card p-4 my-5 bg-white border shadow-sm">
                    <h4 class="fw-bold"><i class="fas fa-info-circle text-primary me-2"></i> The Move Smooth Advantage</h4>
                    <p class="mb-0">Our mission is to foster transparency across the domestic logistics market. We verify DOT license registrations, coordinate real-time comparisons, and gather verified customer feedback to protect your belongings and ensure a stress-free transition. Check the interactive dropdown selector above to compare our top-rated partners in your region.</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row justify-content-center pt-5">
            <div class="col-lg-10">
                <h3 class="text-center fw-800 mb-4">Frequently Asked Questions</h3>
                <div class="accordion faq-accordion" id="compareFaqAccordion">
                    <div class="accordion-item border shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h4 class="accordion-header">
                            <button class="accordion-button fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqC1">
                                How do I compare moving company quotes effectively?
                            </button>
                        </h4>
                        <div id="faqC1" class="accordion-collapse collapse show" data-bs-parent="#compareFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                To compare quotes effectively, ensure all estimates are based on the same inventory list and service requirements. Request binding or binding-not-to-exceed estimates, verify the movers' USDOT and MC licensing numbers via the FMCSA, and read verified reviews detailing customer experiences.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h4 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqC2">
                                What is the difference between a binding and non-binding estimate?
                            </button>
                        </h4>
                        <div id="faqC2" class="accordion-collapse collapse" data-bs-parent="#compareFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                A binding estimate guarantees the final price of the move based on the estimated inventory. A non-binding estimate is a general projection; the final cost is calculated based on the actual weight of the shipment and hours worked on moving day. A binding-not-to-exceed estimate is the most customer-friendly, ensuring you pay no more than the quote, but less if your cargo weighs less.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h4 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqC3">
                                How can I verify if a moving company is licensed and insured?
                            </button>
                        </h4>
                        <div id="faqC3" class="accordion-collapse collapse" data-bs-parent="#compareFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                All interstate movers must register with the Federal Motor Carrier Safety Administration (FMCSA) and hold an active USDOT number. You can verify licensing, insurance certificates, and safety records by inputting the USDOT number into the official FMCSA Mover Search Portal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h4 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqC4">
                                What are common red flags when hiring a professional mover?
                            </button>
                        </h4>
                        <div id="faqC4" class="accordion-collapse collapse" data-bs-parent="#compareFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Common red flags include movers refusing to conduct a physical or virtual walk-through of your inventory, requesting a large cash deposit upfront, using unmarked rental trucks, lack of a physical office address, and failing to provide the federal "Your Rights and Responsibilities When You Move" booklet.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border shadow-sm mb-3 rounded-3 overflow-hidden">
                        <h4 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqC5">
                                Do moving companies charge extra fees for stairs or long carries?
                            </button>
                        </h4>
                        <div id="faqC5" class="accordion-collapse collapse" data-bs-parent="#compareFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                Yes, many moving companies charge additional fees for access obstacles, such as climbing multiple flights of stairs (flight fees), carrying items a long distance from the truck to the door (long-carry fees), elevator reservations, or using a smaller shuttle truck for narrow driveways.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script>
    // Load companies dataset
    const allCompanies = {!! json_encode($companies) !!};

    // Tracks selected company object in each slot (0, 1, 2, 3)
    const selectedSlots = [null, null, null, null];

    function openSearch(slotIndex) {
        const slotEl = document.getElementById(`slot-${slotIndex}`);
        slotEl.querySelector('.slot-placeholder').classList.add('d-none');
        slotEl.querySelector('.slot-search').classList.remove('d-none');
        const input = document.getElementById(`search-input-${slotIndex}`);
        input.value = '';
        input.focus();
        filterMovers(slotIndex);
    }

    function cancelSearch(slotIndex) {
        const slotEl = document.getElementById(`slot-${slotIndex}`);
        slotEl.querySelector('.slot-search').classList.add('d-none');
        if (selectedSlots[slotIndex]) {
            slotEl.querySelector('.slot-active').classList.remove('d-none');
        } else {
            slotEl.querySelector('.slot-placeholder').classList.remove('d-none');
        }
    }

    function filterMovers(slotIndex) {
        const query = document.getElementById(`search-input-${slotIndex}`).value.toLowerCase();
        const dropdown = document.getElementById(`results-${slotIndex}`);
        dropdown.innerHTML = '';
        
        // Find already selected company IDs to exclude them from dropdown selection
        const selectedIds = selectedSlots.filter(s => s !== null).map(s => s.id);

        const matches = allCompanies.filter(c => 
            c.name.toLowerCase().includes(query) && !selectedIds.includes(c.id)
        ).slice(0, 10); // Limit to top 10 results for quick UI response

        if (matches.length === 0) {
            dropdown.innerHTML = '<div class="p-3 text-muted small">No movers found. Try another search.</div>';
        } else {
            matches.forEach(mover => {
                const item = document.createElement('div');
                item.className = 'mover-dropdown-item';
                item.innerHTML = `
                    <div>
                        <div class="name">${mover.name}</div>
                        <div class="meta">${mover.city ? mover.city + ', ' : ''}${mover.state}</div>
                    </div>
                    <div class="text-warning small fw-bold"><i class="fas fa-star"></i> ${mover.rating}</div>
                `;
                item.onclick = () => selectMover(slotIndex, mover);
                dropdown.appendChild(item);
            });
        }
        dropdown.style.display = 'block';
    }

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
        for (let i = 0; i < 4; i++) {
            const dropdown = document.getElementById(`results-${i}`);
            const input = document.getElementById(`search-input-${i}`);
            if (dropdown && input && !input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        }
    });

    function selectMover(slotIndex, mover) {
        selectedSlots[slotIndex] = mover;
        
        const slotEl = document.getElementById(`slot-${slotIndex}`);
        slotEl.querySelector('.slot-search').classList.add('d-none');
        
        // Fill active slot info
        const logoContainer = document.getElementById(`slot-logo-${slotIndex}`);
        if (mover.logo) {
            logoContainer.innerHTML = `<img src="${mover.logo}" alt="${mover.name}">`;
        } else {
            logoContainer.innerHTML = `<div class="slot-logo-fallback">${mover.name.substring(0,2).toUpperCase()}</div>`;
        }

        document.getElementById(`slot-name-${slotIndex}`).innerText = mover.name;
        document.getElementById(`slot-rating-val-${slotIndex}`).innerText = `${mover.rating}/5`;
        
        // Fill stars
        let starsHtml = '';
        const ratingFloat = parseFloat(mover.rating);
        for(let s = 1; s <= 5; s++) {
            if (ratingFloat >= s) {
                starsHtml += '<i class="fas fa-star"></i>';
            } else if (ratingFloat >= (s - 0.5)) {
                starsHtml += '<i class="fas fa-star-half-alt"></i>';
            } else {
                starsHtml += '<i class="far fa-star"></i>';
            }
        }
        document.getElementById(`slot-stars-${slotIndex}`).innerHTML = starsHtml;
        document.getElementById(`slot-reviews-${slotIndex}`).innerText = `(${mover.reviews_count} Verified Reviews)`;

        slotEl.querySelector('.slot-active').classList.remove('d-none');
        slotEl.classList.add('active');

        updateComparisonTable();
    }

    function clearSlot(slotIndex) {
        selectedSlots[slotIndex] = null;
        
        const slotEl = document.getElementById(`slot-${slotIndex}`);
        slotEl.classList.remove('active');
        slotEl.querySelector('.slot-active').classList.add('d-none');
        slotEl.querySelector('.slot-placeholder').classList.remove('d-none');

        updateComparisonTable();
    }

    function updateComparisonTable() {
        const container = document.getElementById('comparisonTableContainer');
        const activeCount = selectedSlots.filter(s => s !== null).length;

        if (activeCount < 2) {
            container.classList.add('d-none');
            // Hide columns
            for(let i = 0; i < 4; i++) {
                toggleColumnVisibility(i, false);
            }
            return;
        }

        container.classList.remove('d-none');

        for(let i = 0; i < 4; i++) {
            const mover = selectedSlots[i];
            if (!mover) {
                toggleColumnVisibility(i, false);
                continue;
            }

            // Fill header
            document.getElementById(`table-name-${i}`).innerText = mover.name;

            // Fill rating
            document.getElementById(`table-rating-val-${i}`).innerText = `${mover.rating}/5`;
            document.getElementById(`table-reviews-${i}`).innerText = `(${mover.reviews_count} reviews)`;
            let starsHtml = '';
            const ratingFloat = parseFloat(mover.rating);
            for(let s = 1; s <= 5; s++) {
                if (ratingFloat >= s) {
                    starsHtml += '<i class="fas fa-star text-warning"></i>';
                } else if (ratingFloat >= (s - 0.5)) {
                    starsHtml += '<i class="fas fa-star-half-alt text-warning"></i>';
                } else {
                    starsHtml += '<i class="far fa-star text-secondary opacity-25"></i>';
                }
            }
            document.getElementById(`table-stars-${i}`).innerHTML = starsHtml;

            // Fill Location
            document.getElementById(`table-location-${i}`).innerText = `${mover.city ? mover.city + ', ' : ''}${mover.state}`;

            // Fill USDOT
            document.getElementById(`table-usdot-${i}`).innerText = `USDOT ${mover.usdot}`;

            // Fill services
            const sContainer = document.getElementById(`table-services-${i}`);
            sContainer.innerHTML = '';
            
            const serviceMapping = [
                { label: 'Local', active: mover.services.local },
                { label: 'Interstate', active: mover.services.long },
                { label: 'Commercial', active: mover.services.commercial },
                { label: 'Residential', active: mover.services.residential },
                { label: 'Packing', active: mover.services.packing },
                { label: 'Storage', active: mover.services.storage }
            ];

            serviceMapping.forEach(srv => {
                const badge = document.createElement('span');
                badge.className = `service-badge ${srv.active ? 'yes' : 'no'}`;
                badge.innerHTML = `${srv.active ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'} ${srv.label}`;
                sContainer.appendChild(badge);
            });

            // Fill Contact info
            document.getElementById(`table-phone-${i}`).innerHTML = `<a href="tel:${mover.phone}" class="text-dark small fw-bold text-decoration-none"><i class="fas fa-phone-alt text-accent me-1"></i> ${mover.phone}</a>`;
            
            const webBtn = document.getElementById(`table-website-${i}`);
            let websiteUrl = mover.website ? mover.website.trim() : '';
            if (websiteUrl) {
                if (!websiteUrl.startsWith('http://') && !websiteUrl.startsWith('https://')) {
                    websiteUrl = 'https://' + websiteUrl;
                }
                webBtn.href = websiteUrl;
                webBtn.style.display = 'inline-block';
            } else {
                webBtn.href = '#';
                webBtn.style.display = 'none';
            }

            // Profile Link and Quote trigger
            document.getElementById(`table-profile-btn-${i}`).href = `/mover/${mover.slug}`;
            
            // Set up direct contact link
            const quoteBtn = document.getElementById(`table-quote-btn-${i}`);
            quoteBtn.href = `/contact-mover/${mover.slug}`;
            quoteBtn.onclick = null;

            toggleColumnVisibility(i, true);
        }
    }

    function toggleColumnVisibility(slotIndex, show) {
        const visibilityClass = show ? 'remove' : 'add';
        
        document.getElementById(`table-header-slot-${slotIndex}`).classList[visibilityClass]('d-none');
        document.getElementById(`table-rating-slot-${slotIndex}`).classList[visibilityClass]('d-none');
        document.getElementById(`table-location-slot-${slotIndex}`).classList[visibilityClass]('d-none');
        document.getElementById(`table-usdot-slot-${slotIndex}`).classList[visibilityClass]('d-none');
        document.getElementById(`table-services-slot-${slotIndex}`).classList[visibilityClass]('d-none');
        document.getElementById(`table-contact-slot-${slotIndex}`).classList[visibilityClass]('d-none');
        document.getElementById(`table-action-slot-${slotIndex}`).classList[visibilityClass]('d-none');
    }
</script>
@endsection
