@extends('layouts.master')

@section('title', 'Get a Quote from ' . $company->name . ' | MoveSmooth')
@section('meta_description', 'Request a direct moving cost quote from ' . $company->name . ' in ' . $company->city . ', ' . ($company->state->code ?? $company->state->name ?? '') . '. Vetted and verified professional movers.')

@section('custom_styles')
    <style>
        /* Base page layout styles */
        .contact-mover-hero {
            background: linear-gradient(135deg, #0a1628 0%, #0F2B4C 100%);
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid #FF6B35;
        }
        
        .company-logo-badge {
            background: #ffffff;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
        }
        
        .company-logo-badge img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .company-logo-badge-fallback {
            font-weight: 800;
            font-size: 2.2rem;
            color: #0F2B4C;
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #e8eff7 0%, #bcd0e6 100%);
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .verified-badge-pill {
            background-color: rgba(232, 239, 247, 0.15);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 6px 14px;
            border-radius: 100px;
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Lead Form Container */
        .quote-form-container {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(15, 43, 76, 0.08);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .quote-form-header {
            background: #f8fafc;
            border-bottom: 1.5px solid #e8eff7;
            padding: 24px 32px;
        }

        .quote-form-body {
            padding: 32px;
        }

        /* Progress Wizard Header */
        .quote-progress-wizard {
            padding: 0 10px;
        }
        .calc-progress-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .calc-progress-bar-background {
            position: absolute;
            top: 19px;
            left: 45px;
            right: 45px;
            height: 4px;
            background: #e2e8f0;
            z-index: 1;
            border-radius: 2px;
        }
        .calc-progress-bar-fill {
            position: absolute;
            top: 19px;
            left: 45px;
            height: 4px;
            background: linear-gradient(90deg, #0F2B4C 0%, #FF6B35 100%);
            z-index: 1;
            border-radius: 2px;
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 0%;
        }
        .calc-progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        .calc-progress-step-num {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
            background: #ffffff;
            color: #94a3b8;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .calc-progress-step-label {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .calc-progress-step.active .calc-progress-step-num {
            border-color: #FF6B35;
            background: #FF6B35;
            color: #ffffff;
            box-shadow: 0 0 0 5px rgba(255, 107, 53, 0.15);
        }
        .calc-progress-step.active .calc-progress-step-label {
            color: #0f172a;
        }
        .calc-progress-step.completed .calc-progress-step-num {
            border-color: #0F2B4C;
            background: #0F2B4C;
            color: #ffffff;
        }
        .calc-progress-step.completed .calc-progress-step-label {
            color: #0F2B4C;
        }

        /* Step Card Styling */
        .calc-step {
            display: none;
        }
        .calc-step.active {
            display: block;
            animation: formStepFadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @keyframes formStepFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .calc-step-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #FF6B35;
            background: rgba(255, 107, 53, 0.08);
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .calc-step h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
            font-family: 'Outfit', sans-serif;
        }

        .calc-step .step-desc {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 30px;
        }

        /* Input Controls */
        .premium-input-box {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            padding: 16px 20px;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            position: relative;
        }
        .premium-input-box:focus-within {
            border-color: #FF6B35;
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.12);
            transform: translateY(-1px);
        }
        .premium-input-box i {
            color: #94a3b8;
            font-size: 1.1rem;
            transition: color 0.3s;
        }
        .premium-input-box:focus-within i {
            color: #FF6B35;
        }

        /* Size Select Cards */
        .premium-size-card {
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.01);
            position: relative;
            overflow: hidden;
        }
        .premium-size-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0F2B4C 0%, #FF6B35 100%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .premium-size-card:hover {
            border-color: #0F2B4C;
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(15, 43, 76, 0.08);
        }
        .premium-size-card.active {
            border-color: #FF6B35;
            background: rgba(255,107,53,0.03);
            box-shadow: 0 10px 20px rgba(255, 107, 53, 0.06);
        }
        .premium-size-card.active::before {
            opacity: 1;
        }
        .premium-size-icon {
            font-size: 2.2rem;
            margin-bottom: 16px;
            color: #0F2B4C;
            transition: transform 0.3s ease;
        }
        .premium-size-card:hover .premium-size-icon {
            transform: scale(1.1);
        }
        .premium-size-card.active .premium-size-icon {
            color: #FF6B35;
        }

        .bedroom-pill-btn {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 16px 20px;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        .bedroom-pill-btn:hover {
            border-color: #0F2B4C;
            color: #0F2B4C;
            background: #f8fafc;
        }
        .bedroom-pill-btn.active {
            background: #0F2B4C;
            border-color: #0F2B4C;
            color: #ffffff;
            box-shadow: 0 6px 15px rgba(15, 43, 76, 0.25);
        }

        /* Option Boxes (Packing/Storage) */
        .premium-option-box {
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.01);
        }
        .premium-option-box:hover {
            border-color: #0F2B4C;
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(15, 43, 76, 0.06);
        }
        .premium-option-box.active {
            border-color: #FF6B35;
            background: rgba(255, 107, 53, 0.03);
            box-shadow: 0 8px 16px rgba(255, 107, 53, 0.06);
        }
        .premium-option-icon {
            font-size: 1.8rem;
            color: #0F2B4C;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .premium-option-box.active .premium-option-icon {
            background: rgba(255,107,53,0.1);
            color: #FF6B35;
        }

        /* Zip Dropdown Custom styling */
        .zip-autocomplete-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(15, 43, 76, 0.12);
            max-height: 250px;
            overflow-y: auto;
            margin-top: 6px;
            display: none;
        }
        .zip-autocomplete-dropdown.show {
            display: block;
        }
        .zip-autocomplete-item {
            padding: 12px 18px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .zip-autocomplete-item:last-child {
            border-bottom: none;
        }
        .zip-autocomplete-item:hover, .zip-autocomplete-item.active {
            background-color: #f0f5fb;
            color: #0F2B4C;
        }
        .zip-autocomplete-item .zip-code {
            font-weight: 700;
            color: #FF6B35;
        }
        .zip-autocomplete-item .zip-location {
            font-weight: 600;
            color: #1e293b;
            margin-left: 8px;
            flex: 1;
        }
        .zip-autocomplete-item .zip-state {
            font-size: 0.8rem;
            color: #64748b;
            background: #f1f5f9;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
        }

        /* Buttons styling */
        .btn-premium-next {
            background: #0F2B4C;
            color: #ffffff !important;
            border: none;
            padding: 15px 40px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(15, 43, 76, 0.15);
            transition: all 0.3s ease;
        }
        .btn-premium-next:hover {
            background: #1e3a60;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 43, 76, 0.25);
        }
        .btn-premium-submit {
            background: linear-gradient(135deg, #f26b3a 0%, #e25c2b 100%);
            color: #ffffff !important;
            border: none;
            padding: 15px 40px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 18px rgba(242, 107, 58, 0.3);
            transition: all 0.3s ease;
        }
        .btn-premium-submit:hover {
            background: linear-gradient(135deg, #ff7c4d 0%, #ed6533 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(242, 107, 58, 0.45);
        }
        .btn-premium-back {
            background: #f1f5f9;
            color: #475569 !important;
            border: 1.5px solid #e2e8f0;
            padding: 15px 30px;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        .btn-premium-back:hover {
            background: #e2e8f0;
            color: #1e293b !important;
            transform: translateY(-1px);
        }

        /* Sidebar trust factor items */
        .trust-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }
        .trust-item-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e8eff7;
            color: #0F2B4C;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }
        .trust-item-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .trust-item-desc {
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.4;
        }

        /* Responsive styling */
        @media (max-width: 991.98px) {
            .quote-form-header {
                padding: 20px;
            }
            .quote-form-body {
                padding: 20px;
            }
        }

        @media (max-width: 575.98px) {
            .calc-progress-step-label {
                display: none;
            }
            .calc-progress-step-num {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }
            .calc-progress-bar-background, .calc-progress-bar-fill {
                top: 16px;
                left: 20px;
                right: 20px;
            }
            .company-logo-badge {
                width: 90px !important;
                height: 90px !important;
            }
            .company-logo-badge-fallback {
                font-size: 1.8rem;
            }
            .contact-mover-hero {
                padding: 35px 0 !important;
                text-align: center !important;
            }
            .contact-mover-hero p {
                justify-content: center !important;
            }
            .premium-size-card {
                padding: 20px 10px;
            }
        }
    </style>
@endsection

@section('content')
<!-- Hero Header Section with Company Branding -->
<section class="contact-mover-hero py-5 text-white">
    <!-- Overlay decorations for depth -->
    <div style="position: absolute; top: -50%; right: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,107,53,0.12) 0%, rgba(0,0,0,0) 80%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(26,65,117,0.25) 0%, rgba(0,0,0,0) 80%); pointer-events: none;"></div>

    <div class="container relative-content">
        <div class="row align-items-center g-4">
            <!-- Company Logo -->
            <div class="col-md-auto d-flex justify-content-center">
                <div class="company-logo-badge shadow-lg" style="width: 110px; height: 110px;">
                    @if($company->logo_url)
                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }} Logo">
                    @else
                        <div class="company-logo-badge-fallback">
                            {{ strtoupper(substr($company->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Company Information -->
            <div class="col-md">
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start align-items-center gap-2 mb-2">
                    <span class="verified-badge-pill">
                        <img src="{{ asset('images/verified_badge.png') }}" alt="Verified" style="width: 14px; height: 14px; object-fit: contain;">
                        MoveSmooth Verified Partner
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.75rem;">Direct Quote Request</span>
                </div>
                <h1 class="display-6 fw-900 text-white mb-2 text-center text-md-start" style="font-family: 'Outfit', sans-serif;">Get a Quote from {{ $company->name }}</h1>
                <p class="text-white-50 mb-0 d-flex flex-wrap justify-content-center justify-content-md-start align-items-center gap-3">
                    <span><i class="fas fa-map-marker-alt text-accent me-1" style="color: #FF6B35;"></i> {{ $company->city }}, {{ $company->state->code ?? '' }}</span>
                    @if($company->dot_number)
                        <span><i class="fas fa-shield-alt text-accent me-1" style="color: #FF6B35;"></i> USDOT #{{ $company->dot_number }}</span>
                    @endif
                    <span class="d-flex align-items-center gap-1">
                        <span style="color: #fbbf24; display: flex; gap: 2px;">
                            @php $stars = (float)$company->rating; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($stars >= $i)
                                    <i class="fas fa-star text-warning"></i>
                                @elseif($stars >= ($i - 0.5))
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </span>
                        <strong class="text-white ms-1">{{ number_format($stars, 1) }}</strong>
                        <span class="text-white-50">({{ $company->reviews->count() }} reviews)</span>
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumbs -->
<div class="bg-light py-3 border-bottom mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color: #0F2B4C;">Home</a></li>
                <li class="breadcrumb-item"><a href="/movers" class="text-decoration-none" style="color: #0F2B4C;">Movers</a></li>
                <li class="breadcrumb-item"><a href="/mover/{{ $company->slug }}" class="text-decoration-none" style="color: #0F2B4C;">{{ $company->name }}</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Contact Mover</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Section -->
<section class="mb-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <!-- Left Side: Custom Multi-step Form -->
            <div class="col-lg-8">
                <div class="quote-form-container">
                    <!-- Progress wizard -->
                    <div class="quote-form-header">
                        <div class="quote-progress-wizard">
                            <div class="calc-progress-row">
                                <!-- Background Line -->
                                <div class="calc-progress-bar-background"></div>
                                <!-- Fill Line -->
                                <div class="calc-progress-bar-fill"></div>

                                <div class="calc-progress-step active" id="indicator-1">
                                    <div class="calc-progress-step-num">1</div>
                                    <div class="calc-progress-step-label">Locations</div>
                                </div>
                                <div class="calc-progress-step" id="indicator-2">
                                    <div class="calc-progress-step-num">2</div>
                                    <div class="calc-progress-step-label">Move Size</div>
                                </div>
                                <div class="calc-progress-step" id="indicator-3">
                                    <div class="calc-progress-step-num">3</div>
                                    <div class="calc-progress-step-label">Services</div>
                                </div>
                                <div class="calc-progress-step" id="indicator-4">
                                    <div class="calc-progress-step-num">4</div>
                                    <div class="calc-progress-step-label">Contact</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Steps Form Body -->
                    <div class="quote-form-body">
                        <form id="contactMoverForm" action="{{ route('front.contact-mover.submit', $company->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" name="move_size" id="input_move_size" value="Studio / 1BR">
                            <input type="hidden" name="num_rooms" id="input_num_rooms" value="1-2 Rooms">
                            <input type="hidden" name="packing_service" id="input_packing_service" value="No Packing">
                            <input type="hidden" name="storage_option" id="input_storage_option" value="No Storage">

                            <!-- STEP 1: Locations -->
                            <div class="calc-step active" id="step-section-1">
                                <div class="calc-step-badge"><i class="fas fa-map-pin me-1"></i> Step 1 of 4</div>
                                <h3>Where are you relocating?</h3>
                                <p class="step-desc">Enter your origin and destination zip codes or cities to route your request.</p>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Moving From</label>
                                        <div class="premium-input-box zip-input-wrapper">
                                            <i class="fas fa-map-marker-alt me-3"></i>
                                            <input type="text" name="zip_from" id="zip_from" class="form-control border-0 bg-transparent p-0 shadow-none zip-autocomplete" placeholder="ZIP Code or City" autocomplete="off" required>
                                            <div class="zip-autocomplete-dropdown"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Moving To</label>
                                        <div class="premium-input-box zip-input-wrapper">
                                            <i class="fas fa-route me-3"></i>
                                            <input type="text" name="zip_to" id="zip_to" class="form-control border-0 bg-transparent p-0 shadow-none zip-autocomplete" placeholder="ZIP Code or City" autocomplete="off" required>
                                            <div class="zip-autocomplete-dropdown"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn-premium-next btn" onclick="goToStep(2)">Next Step <i class="fas fa-chevron-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- STEP 2: Move Size & Bedrooms -->
                            <div class="calc-step" id="step-section-2">
                                <div class="calc-step-badge"><i class="fas fa-box-open me-1"></i> Step 2 of 4</div>
                                <h3>Relocation shipment size</h3>
                                <p class="step-desc">Specify the approximate scale of items you plan to transport.</p>
                                
                                <label class="form-label fw-bold small text-muted text-uppercase mb-3">Overall shipment size</label>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="premium-size-card active" onclick="selectMoveSize('Studio / 1BR', this)">
                                            <div class="premium-size-icon"><i class="fas fa-door-open"></i></div>
                                            <h5 class="fw-bold mb-1">Studio / 1BR</h5>
                                            <p class="small text-muted mb-0">Apartment / Single Room</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="premium-size-card" onclick="selectMoveSize('2 - 3 Bedroom', this)">
                                            <div class="premium-size-icon"><i class="fas fa-house-user"></i></div>
                                            <h5 class="fw-bold mb-1">2 - 3 Bedroom</h5>
                                            <p class="small text-muted mb-0">Average Family House</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="premium-size-card" onclick="selectMoveSize('4+ Bedroom', this)">
                                            <div class="premium-size-icon"><i class="fas fa-hotel"></i></div>
                                            <h5 class="fw-bold mb-1">4+ Bedroom</h5>
                                            <p class="small text-muted mb-0">Large Multi-Story Estate</p>
                                        </div>
                                    </div>
                                </div>

                                <label class="form-label fw-bold small text-muted text-uppercase mb-3">Estimated room count</label>
                                <div class="row g-2 mb-4">
                                    <div class="col-4">
                                        <button type="button" class="btn bedroom-pill-btn w-100 active" id="btn-room-1" onclick="selectNumRooms('1-2 Rooms', this)">1 - 2 Rooms</button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn bedroom-pill-btn w-100" id="btn-room-2" onclick="selectNumRooms('3-4 Rooms', this)">3 - 4 Rooms</button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn bedroom-pill-btn w-100" id="btn-room-3" onclick="selectNumRooms('5+ Rooms', this)">5+ Rooms</button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <button type="button" class="btn btn-premium-back" onclick="goToStep(1)"><i class="fas fa-chevron-left me-2"></i> Back</button>
                                    <button type="button" class="btn btn-premium-next" onclick="goToStep(3)">Next Step <i class="fas fa-chevron-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- STEP 3: Extra Services -->
                            <div class="calc-step" id="step-section-3">
                                <div class="calc-step-badge"><i class="fas fa-hands-helping me-1"></i> Step 3 of 4</div>
                                <h3>Relocation service options</h3>
                                <p class="step-desc">Customize your estimate with professional packing or secure warehouse storage.</p>
                                
                                <label class="form-label fw-bold small text-muted text-uppercase mb-3">Packing preferences</label>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="premium-option-box active" id="pack-opt-1" onclick="selectPacking('No Packing', this)">
                                            <div class="premium-option-icon"><i class="fas fa-user-check"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-1 text-primary">No Packing</h6>
                                                <p class="small text-muted mb-0">I will pack myself</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="premium-option-box" id="pack-opt-2" onclick="selectPacking('Partial Packing', this)">
                                            <div class="premium-option-icon"><i class="fas fa-box"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-1 text-primary">Partial Packing</h6>
                                                <p class="small text-muted mb-0">Fragile items only</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="premium-option-box" id="pack-opt-3" onclick="selectPacking('Full Packing', this)">
                                            <div class="premium-option-icon"><i class="fas fa-boxes-packing"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-1 text-primary">Full Packing</h6>
                                                <p class="small text-muted mb-0">Professional packing</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <label class="form-label fw-bold small text-muted text-uppercase mb-3">Storage requirements</label>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="premium-option-box active" id="storage-opt-1" onclick="selectStorage('No Storage', this)">
                                            <div class="premium-option-icon"><i class="fas fa-truck-ramp-box"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-0 text-primary">Direct Relocation</h6>
                                                <p class="small text-muted mb-0">Straight transfer to new home</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="premium-option-box" id="storage-opt-2" onclick="selectStorage('Storage Required', this)">
                                            <div class="premium-option-icon"><i class="fas fa-warehouse"></i></div>
                                            <div>
                                                <h6 class="fw-bold mb-0 text-primary">Storage-in-Transit</h6>
                                                <p class="small text-muted mb-0">Temporary storage needed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <button type="button" class="btn btn-premium-back" onclick="goToStep(2)"><i class="fas fa-chevron-left me-2"></i> Back</button>
                                    <button type="button" class="btn btn-premium-next" onclick="goToStep(4)">Next Step <i class="fas fa-chevron-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- STEP 4: Personal Details & Custom message -->
                            <div class="calc-step" id="step-section-4">
                                <div class="calc-step-badge"><i class="fas fa-address-card me-1"></i> Step 4 of 4</div>
                                <h3>Contact Details &amp; Date</h3>
                                <p class="step-desc">Verify your information to transmit this quote request directly to {{ $company->name }}.</p>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Full Name</label>
                                        <div class="premium-input-box">
                                            <i class="fas fa-user me-3"></i>
                                            <input type="text" name="name" id="name" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="John Doe" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Planned Move Date</label>
                                        <div class="premium-input-box">
                                            <i class="fas fa-calendar-alt me-3"></i>
                                            <input type="text" name="move_date" id="move_date" class="form-control border-0 bg-transparent p-0 shadow-none flatpickr-date" placeholder="Select Relocation Date" tabindex="0" required style="cursor: pointer;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Email Address</label>
                                        <div class="premium-input-box">
                                            <i class="fas fa-envelope me-3"></i>
                                            <input type="email" name="email" id="email" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="john.doe@example.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Phone Number</label>
                                        <div class="premium-input-box">
                                            <i class="fas fa-phone-alt me-3"></i>
                                            <input type="tel" name="phone" id="phone" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="(555) 000-0000" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Special Instructions / Inventory Details (Optional)</label>
                                        <div class="premium-input-box align-items-start">
                                            <i class="fas fa-comment-alt me-3 mt-1"></i>
                                            <textarea name="message" id="message" rows="3" class="form-control border-0 bg-transparent p-0 shadow-none" placeholder="Let {{ $company->name }} know about narrow staircases, elevators, double-parking limitations, or oversized items (pianos, safes, etc.)"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <button type="button" class="btn btn-premium-back" onclick="goToStep(3)"><i class="fas fa-chevron-left me-2"></i> Back</button>
                                    <button type="submit" class="btn btn-premium-submit px-5" id="submitBtn">
                                        Send Request <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Sidebar Trust Card & Statistics -->
            <div class="col-lg-4">
                <!-- Verified Badges & Info -->
                <div class="card border rounded-4 shadow-sm p-4 bg-white mb-4">
                    <h5 class="fw-800 text-primary mb-4" style="font-family: 'Outfit', sans-serif;">Relocation Partner</h5>
                    
                    <div class="trust-item">
                        <div class="trust-item-icon"><i class="fas fa-shield-heart"></i></div>
                        <div>
                            <div class="trust-item-title">MoveSmooth Verified</div>
                            <div class="trust-item-desc">This company is fully licensed, insured, and verified by our relocation auditing team.</div>
                        </div>
                    </div>
                    
                    <div class="trust-item">
                        <div class="trust-item-icon"><i class="fas fa-handshake"></i></div>
                        <div>
                            <div class="trust-item-title">Direct Communication</div>
                            <div class="trust-item-desc">Your request goes straight to the manager at {{ $company->name }} with zero middleman markups.</div>
                        </div>
                    </div>

                    <div class="trust-item">
                        <div class="trust-item-icon"><i class="fas fa-circle-dollar-to-slot"></i></div>
                        <div>
                            <div class="trust-item-title">100% Free Service</div>
                            <div class="trust-item-desc">We never charge booking or hidden coordination fees. You pay the mover directly.</div>
                        </div>
                    </div>
                </div>

                <!-- Mover Contact info / Credentials -->
                <div class="card border rounded-4 shadow-sm p-4 bg-white">
                    <h5 class="fw-800 text-primary mb-3" style="font-family: 'Outfit', sans-serif;">Credentials</h5>
                    
                    <table class="table table-borderless mb-0 small">
                        <tbody>
                            <tr>
                                <td class="text-muted fw-bold ps-0 py-2">Office Location:</td>
                                <td class="text-dark fw-bold text-end py-2">{{ $company->city }}, {{ $company->state->code ?? '' }}</td>
                            </tr>
                            @if($company->dot_number)
                            <tr>
                                <td class="text-muted fw-bold ps-0 py-2">USDOT Number:</td>
                                <td class="text-dark fw-bold text-end py-2">{{ $company->dot_number }}</td>
                            </tr>
                            @endif
                            @if($company->phone)
                            <tr>
                                <td class="text-muted fw-bold ps-0 py-2">Registered Phone:</td>
                                <td class="text-dark fw-bold text-end py-2">{{ $company->phone }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td class="text-muted fw-bold ps-0 py-2">Rating Score:</td>
                                <td class="text-dark fw-bold text-end py-2">
                                    <span class="badge bg-warning text-dark fw-bold px-2.5 py-1">
                                        <i class="fas fa-star me-1 text-white"></i> {{ number_format($stars, 1) }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script>
    let currentStep = 1;
    let moveSize = "Studio / 1BR";
    let numRooms = "1-2 Rooms";
    let packingService = "No Packing";
    let storageOption = "No Storage";

    function updateProgressFill(step) {
        const fillBar = document.querySelector('.calc-progress-bar-fill');
        if (fillBar) {
            const pct = ((step - 1) / 3) * 100;
            fillBar.style.width = pct + '%';
        }
    }

    function goToStep(step) {
        // Validate inputs before advancing to the next steps
        if (step > currentStep) {
            if (currentStep === 1) {
                const zipFrom = document.getElementById('zip_from');
                const zipTo = document.getElementById('zip_to');
                
                let zipFromVal = zipFrom.value.trim();
                let zipToVal = zipTo.value.trim();
                
                if (zipFromVal === '' || zipToVal === '') {
                    zipFrom.classList.add('is-invalid');
                    zipTo.classList.add('is-invalid');
                    alert('Please input both origin and destination zip codes or cities before moving to the next step.');
                    return;
                } else if (zipFrom.dataset.valid !== 'true' || zipTo.dataset.valid !== 'true') {
                    // Highlight invalid zip fields if suggestions weren't selected
                    if (zipFrom.dataset.valid !== 'true') zipFrom.classList.add('is-invalid');
                    if (zipTo.dataset.valid !== 'true') zipTo.classList.add('is-invalid');
                    alert('Please select a valid location from the suggestions list for both fields.');
                    return;
                } else {
                    zipFrom.classList.remove('is-invalid');
                    zipTo.classList.remove('is-invalid');
                }
            }
        }

        // Deactivate all steps
        document.querySelectorAll('.calc-step').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.calc-progress-step').forEach(el => el.classList.remove('active', 'completed'));

        // Update step counter
        currentStep = step;

        // Activate new step
        document.getElementById(`step-section-${step}`).classList.add('active');

        // Update filled line
        updateProgressFill(step);

        // Update progress circles
        for (let i = 1; i <= 4; i++) {
            const indicator = document.getElementById(`indicator-${i}`);
            if (indicator) {
                if (i < currentStep) {
                    indicator.classList.add('completed');
                    indicator.querySelector('.calc-progress-step-num').innerHTML = '<i class="fas fa-check"></i>';
                } else {
                    indicator.querySelector('.calc-progress-step-num').textContent = i;
                    if (i === currentStep) {
                        indicator.classList.add('active');
                    }
                }
            }
        }
        
        // Scroll to container top on step transition for better mobile experience
        const container = document.querySelector('.quote-form-container');
        if (container) {
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function selectMoveSize(size, element) {
        moveSize = size;
        document.getElementById('input_move_size').value = size;
        document.querySelectorAll('.premium-size-card').forEach(card => card.classList.remove('active'));
        element.classList.add('active');
    }

    function selectNumRooms(rooms, element) {
        numRooms = rooms;
        document.getElementById('input_num_rooms').value = rooms;
        document.querySelectorAll('.bedroom-pill-btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
    }

    function selectPacking(pack, element) {
        packingService = pack;
        document.getElementById('input_packing_service').value = pack;
        document.querySelectorAll('[id^="pack-opt-"]').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
    }

    function selectStorage(storage, element) {
        storageOption = storage;
        document.getElementById('input_storage_option').value = storage;
        document.querySelectorAll('[id^="storage-opt-"]').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initial setup for the progress bar fill
        updateProgressFill(1);

        // Date restriction setup
        const dateInput = document.getElementById('move_date');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        }

        // Auto-parse URL search parameters
        const params = new URLSearchParams(window.location.search);
        const urlFrom = params.get('zip_from') || params.get('from');
        const urlTo = params.get('zip_to') || params.get('to');
        
        if (urlFrom) {
            const el = document.getElementById('zip_from');
            el.value = urlFrom;
            el.dataset.valid = 'true';
        }
        if (urlTo) {
            const el = document.getElementById('zip_to');
            el.value = urlTo;
            el.dataset.valid = 'true';
        }
        
        if (urlFrom && urlTo) {
            // Jump directly to size step if zip information is pre-filled
            goToStep(2);
        }

        // Handle loading state on submit
        document.getElementById('contactMoverForm').addEventListener('submit', function(e) {
            // Ensure inputs are valid
            const zipFrom = document.getElementById('zip_from');
            const zipTo = document.getElementById('zip_to');
            const moveDate = document.getElementById('move_date');
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');

            if (zipFrom.dataset.valid !== 'true' || zipTo.dataset.valid !== 'true') {
                e.preventDefault();
                alert('Please select valid locations from the autocomplete dropdown list before submitting.');
                goToStep(1);
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Submitting...';
        });
    });
</script>
@endsection
