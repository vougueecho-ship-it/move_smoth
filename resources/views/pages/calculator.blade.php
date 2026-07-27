@extends('layouts.master')

@section('title', 'Moving Cost Calculator | Free Estimator & Quote Calculator')
@section('meta_description', 'Estimate moving costs instantly with our free calculator. Get accurate local & long-distance moving estimates, quotes, and cost breakdowns.')

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
            "name": "Moving Cost Calculator",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [{
    "@@type": "Question",
    "name": "How much does a moving company cost?",
    "acceptedAnswer": {
      "@@type": "Answer",
      "text": "Costs vary depending on distance, home size, and services required."
    }
  }, {
    "@@type": "Question",
    "name": "Is the moving estimate accurate?",
    "acceptedAnswer": {
      "@@type": "Answer",
      "text": "The calculator provides an estimate. Actual quotes may vary between moving companies."
    }
  }, {
    "@@type": "Question",
    "name": "Can I calculate long-distance moving costs?",
    "acceptedAnswer": {
      "@@type": "Answer",
      "text": "Yes, the calculator estimates both local and interstate moving expenses."
    }
  }, {
    "@@type": "Question",
    "name": "Are packing services included?",
    "acceptedAnswer": {
      "@@type": "Answer",
      "text": "Packing services can be added to the estimate."
    }
  }]
}
</script>
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebApplication",
    "@@id": "{{ url()->current() }}#webapplication",
    "url": "{{ url()->current() }}",
    "name": "Move Smooth Moving Cost Calculator",
    "description": "Calculate your moving costs instantly with Move Smooth. Get dynamic local and long distance moving estimates based on home size and distance.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "browserRequirements": "Requires HTML5 and JavaScript support.",
    "offers": {
        "@@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "category": "Free"
    },
    "publisher": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    }
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/calculator.css') }}?v={{ filemtime(public_path('css/pages/calculator.css')) }}" rel="stylesheet">
@endsection

@section('content')
<!-- Hero Section -->
<section class="calc-hero">
    <div class="container text-center">
        <h1 class="display-3 fw-900 text-white mb-3 animate__animated animate__fadeInDown">Moving Cost Calculator</h1>
        <p class="lead text-white opacity-75 mb-0 max-w-800 mx-auto animate__animated animate__fadeInUp">Planning a move? Use our free Moving Cost Calculator to estimate moving expenses for local and long-distance moves. Whether you're moving a small apartment, a family home, or an office, our moving cost estimator helps you calculate expected moving costs in minutes.</p>
    </div>
</section>

<!-- 1. Calculator Card Section -->
<div class="container calc-container">
    <div class="calc-card">
        <!-- Step Progress Bar -->
        <div class="calc-progress-bar">
            <div class="calc-progress-step active" id="indicator-1">
                <div class="calc-progress-num">1</div>
                <div class="calc-progress-label">Location</div>
            </div>
            <div class="calc-progress-line"></div>
            <div class="calc-progress-step" id="indicator-2">
                <div class="calc-progress-num">2</div>
                <div class="calc-progress-label">Size &amp; Rooms</div>
            </div>
            <div class="calc-progress-line"></div>
            <div class="calc-progress-step" id="indicator-3">
                <div class="calc-progress-num">3</div>
                <div class="calc-progress-label">Services</div>
            </div>
            <div class="calc-progress-line"></div>
            <div class="calc-progress-step" id="indicator-4">
                <div class="calc-progress-num">4</div>
                <div class="calc-progress-label">Details</div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="calc-form-side">
                <form id="calculatorForm">
                    @csrf
                    <input type="hidden" name="move_size" id="input_move_size" value="Studio / 1BR">
                    <input type="hidden" name="num_rooms" id="input_num_rooms" value="1-2 Rooms">
                    <input type="hidden" name="packing_service" id="input_packing_service" value="No Packing">
                    <input type="hidden" name="storage_option" id="input_storage_option" value="No Storage">

                    <!-- STEP 1: Locations -->
                    <div class="calc-step active" id="step-section-1">
                        <div class="calc-step-badge"><i class="fas fa-map-pin me-1"></i> Step 1 of 4</div>
                        <h3>Where are you relocating?</h3>
                        <p class="step-desc">Enter your origin and destination zip codes or cities to calculate distance.</p>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Moving From</label>
                                <div class="input-box zip-input-wrapper">
                                    <i class="fas fa-map-marker-alt me-3"></i>
                                    <input type="text" name="zip_from" id="zip_from" class="form-control border-0 bg-transparent p-0 shadow-none zip-autocomplete" placeholder="ZIP or City" autocomplete="off" required>
                                    <div class="zip-autocomplete-dropdown"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Moving To</label>
                                <div class="input-box zip-input-wrapper">
                                    <i class="fas fa-route me-3"></i>
                                    <input type="text" name="zip_to" id="zip_to" class="form-control border-0 bg-transparent p-0 shadow-none zip-autocomplete" placeholder="ZIP or City" autocomplete="off" required>
                                    <div class="zip-autocomplete-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="calc-btn-next" onclick="goToStep(2)">Next Step <i class="fas fa-chevron-right ms-2"></i></button>
                        </div>
                    </div>

                    <!-- STEP 2: Move Size & Number of Rooms -->
                    <div class="calc-step" id="step-section-2">
                        <div class="calc-step-badge"><i class="fas fa-box-open me-1"></i> Step 2 of 4</div>
                        <h3>Select Move Size &amp; Rooms</h3>
                        
                        <label class="form-label fw-bold small text-muted text-uppercase mb-3">Overall Move Size</label>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="size-option-card active" onclick="selectMoveSize('Studio / 1BR', this)">
                                    <div class="size-icon"><i class="fas fa-door-open"></i></div>
                                    <h5 class="fw-bold mb-1">Studio / 1BR</h5>
                                    <p class="small text-muted mb-0">Apartment / single room</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="size-option-card" onclick="selectMoveSize('2 - 3 Bedroom', this)">
                                    <div class="size-icon"><i class="fas fa-house-chimney"></i></div>
                                    <h5 class="fw-bold mb-1">2 - 3 Bedroom</h5>
                                    <p class="small text-muted mb-0">Average family home</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="size-option-card" onclick="selectMoveSize('4+ Bedroom', this)">
                                    <div class="size-icon"><i class="fas fa-hotel"></i></div>
                                    <h5 class="fw-bold mb-1">4+ Bedroom</h5>
                                    <p class="small text-muted mb-0">Large estate / multi-story</p>
                                </div>
                            </div>
                        </div>

                        <label class="form-label fw-bold small text-muted text-uppercase mb-3">Total Number of Rooms</label>
                        <div class="row g-2 mb-4">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100 py-3 rounded-3 fw-bold active" id="btn-room-1" onclick="selectNumRooms('1-2 Rooms', this)">1 - 2</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100 py-3 rounded-3 fw-bold" id="btn-room-2" onclick="selectNumRooms('3-4 Rooms', this)">3 - 4</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100 py-3 rounded-3 fw-bold" id="btn-room-3" onclick="selectNumRooms('5+ Rooms', this)">5+</button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button type="button" class="btn-back" onclick="goToStep(1)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="button" class="calc-btn-next" onclick="goToStep(3)">Next Step <i class="fas fa-chevron-right ms-2"></i></button>
                        </div>
                    </div>

                    <!-- STEP 3: Extra Services -->
                    <div class="calc-step" id="step-section-3">
                        <div class="calc-step-badge"><i class="fas fa-hand-holding-hand me-1"></i> Step 3 of 4</div>
                        <h3>Choose Extra Services</h3>
                        
                        <label class="form-label fw-bold small text-muted text-uppercase mb-3">Packing Services</label>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="option-select-box active d-flex flex-column justify-content-between h-100" id="pack-opt-1" onclick="selectPacking('No Packing', this)">
                                    <div>
                                        <h6 class="fw-bold mb-1 text-primary">No Packing</h6>
                                        <p class="small text-muted mb-0">I will pack myself</p>
                                    </div>
                                    <span class="badge bg-light text-dark mt-2 align-self-start">$0 (Free)</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="option-select-box d-flex flex-column justify-content-between h-100" id="pack-opt-2" onclick="selectPacking('Partial Packing', this)">
                                    <div>
                                        <h6 class="fw-bold mb-1 text-primary">Partial Packing</h6>
                                        <p class="small text-muted mb-0">Fragile/heavy items only</p>
                                    </div>
                                    <span class="badge bg-accent-light text-accent mt-2 align-self-start">+$250</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="option-select-box d-flex flex-column justify-content-between h-100" id="pack-opt-3" onclick="selectPacking('Full Packing', this)">
                                    <div>
                                        <h6 class="fw-bold mb-1 text-primary">Full Packing</h6>
                                        <p class="small text-muted mb-0">Professional full service</p>
                                    </div>
                                    <span class="badge bg-accent-light text-accent mt-2 align-self-start">+$500</span>
                                </div>
                            </div>
                        </div>

                        <label class="form-label fw-bold small text-muted text-uppercase mb-3">Storage Needs</label>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="option-select-box active d-flex align-items-center gap-3" id="storage-opt-1" onclick="selectStorage('No Storage', this)">
                                    <div class="fs-4 text-primary"><i class="fas fa-house"></i></div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-primary">No Storage</h6>
                                        <p class="small text-muted mb-0">Move straight to destination</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="option-select-box d-flex align-items-center gap-3" id="storage-opt-2" onclick="selectStorage('Storage Required', this)">
                                    <div class="fs-4 text-primary"><i class="fas fa-warehouse"></i></div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-primary">Storage-in-Transit</h6>
                                        <p class="small text-muted mb-0">Climate-controlled (+$300)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button type="button" class="btn-back" onclick="goToStep(2)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="button" class="calc-btn-next" onclick="goToStep(4)">Next Step <i class="fas fa-chevron-right ms-2"></i></button>
                        </div>
                    </div>

                    <!-- STEP 4: Contact Details -->
                    <div class="calc-step" id="step-section-4">
                        <div class="calc-step-badge"><i class="fas fa-address-card me-1"></i> Step 4 of 4</div>
                        <h3>Complete Your Instant Quote</h3>
                        <p class="step-desc">Fill in your details to save your estimate and get matched with top movers.</p>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Full Name</label>
                                <div class="input-box">
                                    <i class="fas fa-user me-3"></i>
                                    <input type="text" name="name" id="name" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="John Doe" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Move Date</label>
                                <div class="input-box">
                                    <i class="fas fa-calendar me-3"></i>
                                    <input type="text" name="move_date" id="move_date" class="form-control border-0 bg-transparent p-0 shadow-none flatpickr-date" placeholder="Select Date" tabindex="0" required style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Email Address</label>
                                <div class="input-box">
                                    <i class="fas fa-envelope me-3"></i>
                                    <input type="email" name="email" id="email" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="john@example.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Phone Number</label>
                                <div class="input-box">
                                    <i class="fas fa-phone me-3"></i>
                                    <input type="tel" name="phone" id="phone" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="(555) 555-5555" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button type="button" class="btn-back" onclick="goToStep(3)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="submit" class="calc-btn-submit" id="submitBtn">
                                Calculate My Cost <i class="fas fa-calculator ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 5: Success -->
                    <div class="calc-step" id="step-section-5">
                        <div class="text-center py-3">
                            <div class="display-1 text-success mb-4"><i class="fas fa-check-circle animate__animated animate__bounceIn"></i></div>
                            <h3 class="fw-800 text-primary mb-3">Estimate Generated!</h3>

                            <div class="price-result-box">
                                <div class="price-result-label">Your Estimated Moving Cost</div>
                                <div class="price-range-display" id="display-price-range">$500 – $850</div>
                                <p class="price-result-note" id="display-subtitle">Based on average rates for a Studio / 1BR move.</p>
                            </div>
                            <p class="text-muted mb-4">Your estimates have been recorded. A moving coordinator will contact you with binding quotes from top-rated movers.</p>
                            
                            <div class="p-4 bg-light rounded-4 border text-start mb-4">
                                <h5 class="fw-800 mb-3 text-primary"><i class="fas fa-circle-info me-2 text-accent"></i> Move Summary</h5>
                                <div class="row small g-2">
                                    <div class="col-sm-6"><strong>From:</strong> <span id="summary-from">-</span></div>
                                    <div class="col-sm-6"><strong>To:</strong> <span id="summary-to">-</span></div>
                                    <div class="col-sm-6"><strong>Size:</strong> <span id="summary-size">-</span></div>
                                    <div class="col-sm-6"><strong>Rooms:</strong> <span id="summary-rooms">-</span></div>
                                    <div class="col-sm-6"><strong>Packing:</strong> <span id="summary-packing">-</span></div>
                                    <div class="col-sm-6"><strong>Storage:</strong> <span id="summary-storage">-</span></div>
                                    <div class="col-sm-6"><strong>Distance:</strong> <span id="summary-distance">-</span> miles</div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ route('front.movers') }}" class="btn btn-primary rounded-pill px-4 fw-800">Browse Movers</a>
                                <a href="{{ route('front.home') }}" class="btn btn-outline-primary rounded-pill px-4 fw-800">Return Home</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SEO Content: How Our Moving Cost Calculator Works -->
<section class="section-padding" style="background: #f1f5f9;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge"><i class="fas fa-cogs me-1"></i> How It Works</span>
            <h2 class="display-6 fw-800 text-primary">How the Calculator Works</h2>
            <p class="text-muted col-lg-7 mx-auto">Our calculator processes real market data to estimate your moving costs based on these key factors.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="how-it-works-card">
                    <div class="hiw-icon"><i class="fas fa-route"></i></div>
                    <h5 class="fw-bold">Distance</h5>
                    <p class="text-muted small mb-0">From local hops to cross-country hauls — distance directly impacts pricing.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="how-it-works-card">
                    <div class="hiw-icon"><i class="fas fa-home"></i></div>
                    <h5 class="fw-bold">Home Size</h5>
                    <p class="text-muted small mb-0">Volume directly correlates to truck size and labor hours required.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="how-it-works-card">
                    <div class="hiw-icon"><i class="fas fa-users"></i></div>
                    <h5 class="fw-bold">Number of Movers</h5>
                    <p class="text-muted small mb-0">Determines the hourly rate for local moves and crew requirements.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="how-it-works-card">
                    <div class="hiw-icon"><i class="fas fa-boxes-packing"></i></div>
                    <h5 class="fw-bold">Packing Services</h5>
                    <p class="text-muted small mb-0">Full-service packing vs. DIY — adds material and labor costs.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="how-it-works-card">
                    <div class="hiw-icon"><i class="fas fa-warehouse"></i></div>
                    <h5 class="fw-bold">Storage Needs</h5>
                    <p class="text-muted small mb-0">Short-term transit storage adds fees for warehousing and redelivery.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="how-it-works-card">
                    <div class="hiw-icon"><i class="fas fa-calendar-days"></i></div>
                    <h5 class="fw-bold">Moving Date</h5>
                    <p class="text-muted small mb-0">Peak seasons and weekends affect availability and pricing.</p>
                </div>
            </div>
        </div>
        <p class="text-center text-muted mt-4">By entering these details, the calculator provides an estimated moving quote to help you plan your relocation budget effectively.</p>
    </div>
</section>

<!-- Factors That Affect Moving Costs -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge"><i class="fas fa-sliders me-1"></i> Cost Variables</span>
            <h2 class="display-6 fw-800 text-primary">Factors That Affect Moving Costs</h2>
            <p class="text-muted col-lg-7 mx-auto">Understanding what drives your moving estimate.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="factor-num-card">
                    <div class="factor-num">01</div>
                    <div>
                        <h5 class="fw-bold text-primary mb-2">Distance</h5>
                        <p class="text-muted small mb-0">Long-distance moves typically cost more than local moves. While local moves are charged by the hour, interstate and cross-country moving costs are determined by the exact mileage and the total weight of your shipment. Fuel surcharges and tolls are also factored into long-distance tariffs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="factor-num-card">
                    <div class="factor-num">02</div>
                    <div>
                        <h5 class="fw-bold text-primary mb-2">Home Size & Weight</h5>
                        <p class="text-muted small mb-0">Larger homes require more labor and truck space. Moving a 4-bedroom house requires significantly more effort, a larger moving truck (or multiple trucks), and a larger crew compared to a studio apartment.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="factor-num-card">
                    <div class="factor-num">03</div>
                    <div>
                        <h5 class="fw-bold text-primary mb-2">Packing Services</h5>
                        <p class="text-muted small mb-0">Professional packing services increase moving costs but save time and ensure your items are properly protected. Full-service packing includes the cost of materials and the labor required.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="factor-num-card">
                    <div class="factor-num">04</div>
                    <div>
                        <h5 class="fw-bold text-primary mb-2">Storage</h5>
                        <p class="text-muted small mb-0">Temporary storage solutions can affect the final moving estimate. If your new home isn't ready, you might need Storage-in-Transit (SIT) with extra fees for warehousing and redelivery.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="factor-num-card">
                    <div class="factor-num">05</div>
                    <div>
                        <h5 class="fw-bold text-primary mb-2">Moving Season</h5>
                        <p class="text-muted small mb-0">Peak moving months often have higher prices. Approximately 70% of moves occur between May and September. Weekends and end of month are also more expensive.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="factor-num-card">
                    <div class="factor-num">06</div>
                    <div>
                        <h5 class="fw-bold text-primary mb-2">Additional Fees</h5>
                        <p class="text-muted small mb-0">Stairs, elevators, and long carrying distances can trigger additional accessorial charges. Specialty items like pianos also require custom crating and handling fees.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Average Moving Costs Table -->
<section class="section-padding" style="background: #f1f5f9;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                    <span class="section-badge"><i class="fas fa-table-list me-1"></i> Price Guide</span>
                    <h2 class="display-6 fw-800 text-primary">Average Moving Costs</h2>
                    <p class="text-muted">Standard US moving rates based on dwelling size.</p>
                </div>
                <div class="avg-cost-table">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Move Type</th>
                                <th>Estimated Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong>Studio Apartment</strong></td><td>$300 - $1,000</td></tr>
                            <tr><td><strong>1 Bedroom</strong></td><td>$500 - $1,500</td></tr>
                            <tr><td><strong>2 Bedroom</strong></td><td>$1,000 - $3,000</td></tr>
                            <tr><td><strong>3 Bedroom</strong></td><td>$2,000 - $6,000</td></tr>
                            <tr><td><strong>Long Distance Move</strong></td><td>$2,500 - $10,000+</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-muted small text-center mt-3"><i class="fas fa-info-circle me-1 text-accent"></i> Prices are estimates and vary based on seasonal demand, fuel costs, and additional services.</p>
            </div>
        </div>
    </div>
</section>

<!-- Local vs. Long-Distance Moving Costs -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge"><i class="fas fa-arrows-left-right me-1"></i> Compare</span>
            <h2 class="display-6 fw-800 text-primary">Local vs. Long-Distance Moving Costs</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="compare-card compare-local">
                    <div class="compare-icon"><i class="fas fa-city"></i></div>
                    <h2 class="h5 fw-800 mb-3 text-primary">Local Moving Cost Calculator</h2>
                    <p class="text-muted small">For local moves, costs are generally based on:</p>
                    <ul class="compare-list">
                        <li><strong>Hourly labor</strong> — The going rate for movers in your city</li>
                        <li><strong>Number of movers</strong> — Crew size required for the job</li>
                        <li><strong>Truck size</strong> — Sized properly for your inventory</li>
                        <li><strong>Packing services</strong> — Optional full or partial pack</li>
                    </ul>
                    <p class="text-muted small mt-3 mb-0">Our moving estimate calculator can help determine expected local moving expenses.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="compare-card compare-longdist">
                    <div class="compare-icon"><i class="fas fa-truck-moving"></i></div>
                    <h2 class="h5 fw-800 mb-3 text-primary">Long Distance Moving Cost Estimator</h2>
                    <p class="text-muted small">Long-distance moving costs depend on:</p>
                    <ul class="compare-list">
                        <li><strong>Mileage</strong> — Exact distance between zip codes</li>
                        <li><strong>Shipment weight</strong> — Total volume and weight of goods</li>
                        <li><strong>Fuel costs</strong> — Fuel surcharges and travel tolls</li>
                        <li><strong>Storage needs</strong> — Temporary transit warehousing</li>
                        <li><strong>Additional services</strong> — Custom crating, stairs, long carries</li>
                    </ul>
                    <p class="text-muted small mt-3 mb-0">Use our moving quote calculator to estimate interstate moving expenses.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Frequently Asked Questions -->
<section class="section-padding" style="background: #f1f5f9;">
    <div class="container">
        <h2 class="text-center fw-800 text-primary mb-5">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion faq-accordion" id="seoFaqAccordion">
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                        <h3 class="accordion-header">
                            <button class="accordion-button fw-bold text-primary rounded" type="button" data-bs-toggle="collapse" data-bs-target="#seoFaq1">
                                How much does a moving company cost?
                            </button>
                        </h3>
                        <div id="seoFaq1" class="accordion-collapse collapse show" data-bs-parent="#seoFaqAccordion">
                            <div class="accordion-body text-body">
                                Costs vary widely depending on distance, home size, and services required. A local move can range from $300 for a small apartment to over $3,000 for a large house. Long-distance moves generally start around $2,500 and can easily exceed $10,000 for massive cross-country relocations involving full packing services.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary rounded" type="button" data-bs-toggle="collapse" data-bs-target="#seoFaq2">
                                Is the moving estimate accurate?
                            </button>
                        </h3>
                        <div id="seoFaq2" class="accordion-collapse collapse" data-bs-parent="#seoFaqAccordion">
                            <div class="accordion-body text-body">
                                The calculator provides a highly accurate estimate based on historical moving data and current market rates. However, actual quotes may vary between moving companies. To get a binding quote, you will need to provide a complete inventory list or complete a virtual walkthrough with the moving company.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary rounded" type="button" data-bs-toggle="collapse" data-bs-target="#seoFaq3">
                                Can I calculate long-distance moving costs?
                            </button>
                        </h3>
                        <div id="seoFaq3" class="accordion-collapse collapse" data-bs-parent="#seoFaqAccordion">
                            <div class="accordion-body text-body">
                                Yes, the calculator estimates both local and interstate moving expenses. By inputting your origin and destination zip codes, our tool automatically calculates the mileage and switches to the appropriate tariff rates used by cross-country movers.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-primary rounded" type="button" data-bs-toggle="collapse" data-bs-target="#seoFaq4">
                                Are packing services included?
                            </button>
                        </h3>
                        <div id="seoFaq4" class="accordion-collapse collapse" data-bs-parent="#seoFaqAccordion">
                            <div class="accordion-body text-body">
                                Packing services are not included in the base rate, but they can be added to the estimate in the calculator. You can choose between "No Packing", "Partial Packing", or "Full Packing" to see exactly how these add-ons impact your final moving quote.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interlinking Section -->
<section class="interlink-banner">
    <div class="container text-center">
        <h2 class="h4 fw-800 text-white mb-2">Find Movers Near You</h2>
        <p class="text-white-50 mb-4">Explore our top-rated moving networks after estimating your costs.</p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('front.state.movers', 'texas') }}" class="interlink-pill">Texas Movers</a>
            <a href="{{ route('front.state.movers', 'california') }}" class="interlink-pill">California Movers</a>
            <a href="{{ route('front.state.movers', 'florida') }}" class="interlink-pill">Florida Movers</a>
            <a href="{{ route('front.state.movers', 'new-york') }}" class="interlink-pill">New York Movers</a>
            <a href="{{ route('front.state.movers', 'illinois') }}" class="interlink-pill">Illinois Movers</a>
            <a href="{{ route('front.service.commercial') }}" class="interlink-pill interlink-pill-alt">Commercial Movers</a>
            <a href="{{ route('front.service.long') }}" class="interlink-pill interlink-pill-alt">Long Distance Movers</a>
            <a href="{{ route('front.service.local') }}" class="interlink-pill interlink-pill-alt">Local Movers</a>
            <a href="{{ route('front.movers.directory') }}" class="interlink-pill interlink-pill-accent">Best Movers Directory</a>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="section-padding bg-white text-center border-top">
    <div class="container">
        <h2 class="fw-800 text-primary mb-3">Ready to Plan Your Moving Budget?</h2>
        <p class="lead text-muted mb-4 col-lg-7 mx-auto">Get your free, no-obligation moving quote in minutes. Compare competitive rates from fully licensed, insured professionals.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-lg btn-pill px-5 py-3 shadow-lg fw-bold">Request Binding Estimates <i class="fas fa-file-invoice ms-2"></i></a>
            <a href="{{ route('front.movers.directory') }}" class="btn btn-outline-primary btn-lg btn-pill px-5 py-3 fw-bold">Browse Movers Directory <i class="fas fa-search ms-2"></i></a>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script>
    let currentStep = 1;
    
    // Default mock data variables for live calculation preview before submit
    let moveSize = "Studio / 1BR";
    let numRooms = "1-2 Rooms";
    let packingService = "No Packing";
    let storageOption = "No Storage";
    let distanceMiles = 150; // Default distance preview until calculated by zip

    function goToStep(step) {
        // Validate inputs before advancing
        if (step > currentStep) {
            if (currentStep === 1) {
                const zipFrom = document.getElementById('zip_from');
                const zipTo = document.getElementById('zip_to');
                
                if (zipFrom.value.trim() === '' || zipTo.value.trim() === '') {
                    zipFrom.classList.add('is-invalid');
                    zipTo.classList.add('is-invalid');
                    alert('Please input both origin and destination zip codes or cities before moving to next step.');
                    return;
                } else {
                    zipFrom.classList.remove('is-invalid');
                    zipTo.classList.remove('is-invalid');
                }
            }
        }

        // Deactivate all steps and progress markers
        document.querySelectorAll('.calc-step').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.calc-progress-step').forEach(el => el.classList.remove('active', 'completed'));

        // Update current step
        currentStep = step;

        // Activate step view
        document.getElementById(`step-section-${step}`).classList.add('active');

        // Render progress indicators
        for (let i = 1; i <= 4; i++) {
            const indicator = document.getElementById(`indicator-${i}`);
            if (i < currentStep) {
                indicator.classList.add('completed');
            } else if (i === currentStep) {
                indicator.classList.add('active');
            }
        }
    }

    function selectMoveSize(size, element) {
        moveSize = size;
        document.getElementById('input_move_size').value = size;
        document.querySelectorAll('.size-option-card').forEach(card => card.classList.remove('active'));
        element.classList.add('active');
        calculateLiveEstimate();
    }

    function selectNumRooms(rooms, element) {
        numRooms = rooms;
        document.getElementById('input_num_rooms').value = rooms;
        document.querySelectorAll('[id^="btn-room-"]').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
        calculateLiveEstimate();
    }

    function selectPacking(pack, element) {
        packingService = pack;
        document.getElementById('input_packing_service').value = pack;
        document.querySelectorAll('[id^="pack-opt-"]').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
        calculateLiveEstimate();
    }

    function selectStorage(storage, element) {
        storageOption = storage;
        document.getElementById('input_storage_option').value = storage;
        document.querySelectorAll('[id^="storage-opt-"]').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
        calculateLiveEstimate();
    }

    // High fidelity instantaneous pricing logic based on user selections
    function calculateLiveEstimate() {
        let base = 500;
        let roomMultiplier = 1.0;
        let packingCharge = 0;
        let storageCharge = 0;

        // Move Size base prices
        if (moveSize === "Studio / 1BR") {
            base = 500;
        } else if (moveSize === "2 - 3 Bedroom") {
            base = 1000;
        } else if (moveSize === "4+ Bedroom") {
            base = 1800;
        }

        // Room count multipliers
        if (numRooms === "1-2 Rooms") {
            roomMultiplier = 1.0;
        } else if (numRooms === "3-4 Rooms") {
            roomMultiplier = 1.35;
        } else if (numRooms === "5+ Rooms") {
            roomMultiplier = 1.7;
        }

        // Packing calculations
        if (packingService === "No Packing") {
            packingCharge = 0;
        } else if (packingService === "Partial Packing") {
            packingCharge = 250;
        } else if (packingService === "Full Packing") {
            packingCharge = 500;
        }

        // Storage calculations
        if (storageOption === "No Storage") {
            storageCharge = 0;
        } else if (storageOption === "Storage Required") {
            storageCharge = 300;
        }

        // Dynamic formula
        let minPrice = (base * roomMultiplier) + (distanceMiles * 1.25) + packingCharge + storageCharge;
        let maxPrice = (base * roomMultiplier) + (distanceMiles * 1.75) + 120 + packingCharge + storageCharge;

        document.getElementById('display-price-range').textContent = `$${Math.round(minPrice)} - $${Math.round(maxPrice)}`;
        document.getElementById('display-subtitle').textContent = `Based on a ${moveSize} move (${numRooms}) over ~${distanceMiles} miles, with ${packingService} and ${storageOption}.`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Auto parse url params if available
        const params = new URLSearchParams(window.location.search);
        const urlFrom = params.get('zip_from') || params.get('from');
        const urlTo = params.get('zip_to') || params.get('to');
        
        if (urlFrom) document.getElementById('zip_from').value = urlFrom;
        if (urlTo) document.getElementById('zip_to').value = urlTo;
        if (urlFrom && urlTo) {
            goToStep(2);
        }

        // Active min dates
        const dateInput = document.getElementById('move_date');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        }

        // Live estimate recalculation on load
        calculateLiveEstimate();

        // AJAX submit lead and return database-calculated precision quotes
        document.getElementById('calculatorForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Calculating...';

            const formData = new FormData(this);

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
                    // Update exact mileage distance parsed by server
                    distanceMiles = data.distance;

                    // Recalculate live estimate display using exact mileage
                    let base = 500;
                    if (moveSize === "Studio / 1BR") base = 500;
                    else if (moveSize === "2 - 3 Bedroom") base = 1000;
                    else if (moveSize === "4+ Bedroom") base = 1800;

                    let roomMultiplier = 1.0;
                    if (numRooms === "1-2 Rooms") roomMultiplier = 1.0;
                    else if (numRooms === "3-4 Rooms") roomMultiplier = 1.35;
                    else if (numRooms === "5+ Rooms") roomMultiplier = 1.7;

                    let packingCharge = 0;
                    if (packingService === "Partial Packing") packingCharge = 250;
                    else if (packingService === "Full Packing") packingCharge = 500;

                    let storageCharge = 0;
                    if (storageOption === "Storage Required") storageCharge = 300;

                    let minPrice = (base * roomMultiplier) + (distanceMiles * 1.25) + packingCharge + storageCharge;
                    let maxPrice = (base * roomMultiplier) + (distanceMiles * 1.75) + 120 + packingCharge + storageCharge;

                    document.getElementById('display-price-range').textContent = `$${Math.round(minPrice)} - $${Math.round(maxPrice)}`;
                    document.getElementById('display-subtitle').textContent = `Based on average rates over exact transit distance of ${distanceMiles} miles for a ${moveSize} move.`;

                    // Update Step 5 summaries
                    document.getElementById('summary-from').textContent = formData.get('zip_from');
                    document.getElementById('summary-to').textContent = formData.get('zip_to');
                    document.getElementById('summary-size').textContent = moveSize;
                    document.getElementById('summary-rooms').textContent = numRooms;
                    document.getElementById('summary-packing').textContent = packingService;
                    document.getElementById('summary-storage').textContent = storageOption;
                    document.getElementById('summary-distance').textContent = distanceMiles;

                    // Navigate to success step
                    goToStep(5);
                } else {
                    alert('There was a problem calculating your estimate. Please check inputs.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Something went wrong. Please check your network and try again.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Calculate My Cost <i class="fas fa-calculator ms-2"></i>';
            });
        });
    });
</script>
@endsection
