@extends('layouts.master')

@section('title', 'Thank You | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('custom_styles')
<style>
    /* Styling variables */
    :root {
        --color-navy: #0f2b4c;
        --color-orange: #f26b3a;
        --color-green: #10b981;
        --color-border: #e2e8f0;
        --color-bg-light: #f7fafc;
    }

    .thank-you-section {
        background: radial-gradient(circle at top right, rgba(242, 107, 58, 0.03) 0%, rgba(15, 43, 76, 0.02) 50%, #ffffff 100%);
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    /* Animated Success Tick */
    .success-badge-container {
        position: relative;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
    }
    .success-pulse-ring {
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background-color: rgba(16, 185, 129, 0.1);
        animation: pulseRing 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }
    .success-badge {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, var(--color-green) 0%, #059669 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2.8rem;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        z-index: 2;
        animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* Custom Animations */
    @keyframes pulseRing {
        0% { transform: scale(0.65); opacity: 1; }
        100% { transform: scale(1.15); opacity: 0; }
    }
    @keyframes scaleIn {
        0% { transform: scale(0); }
        100% { transform: scale(1); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease forwards;
    }

    /* Stepper UI */
    .stepper-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 600px;
        margin: 2.5rem auto;
        position: relative;
        padding: 0 20px;
    }
    .stepper-line {
        position: absolute;
        top: 25px;
        left: 40px;
        right: 40px;
        height: 3px;
        background-color: var(--color-border);
        z-index: 1;
    }
    .stepper-line-active {
        position: absolute;
        top: 25px;
        left: 40px;
        height: 3px;
        background: linear-gradient(to right, var(--color-green), var(--color-green) 50%, var(--color-navy) 100%);
        width: 75%;
        z-index: 2;
    }
    .step-item {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 120px;
    }
    .step-dot {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: white;
        border: 3px solid var(--color-border);
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        font-size: 1.1rem;
        color: #718096;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .step-item.completed .step-dot {
        background-color: var(--color-green);
        border-color: var(--color-green);
        color: white;
    }
    .step-item.active .step-dot {
        border-color: var(--color-navy);
        color: var(--color-navy);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(15, 43, 76, 0.1);
        animation: pulseActive 1.5s infinite alternate;
    }
    .step-label {
        margin-top: 10px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #718096;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .step-item.completed .step-label {
        color: var(--color-green);
    }
    .step-item.active .step-label {
        color: var(--color-navy);
    }

    @keyframes pulseActive {
        0% { transform: scale(1); }
        100% { transform: scale(1.06); }
    }

    /* Detail Card */
    .thank-you-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid var(--color-border);
        box-shadow: 0 15px 40px rgba(15, 43, 76, 0.04);
        overflow: hidden;
        margin-bottom: 2.5rem;
    }

    .route-display {
        background: #fcfdfe;
        border-right: 1px solid var(--color-border);
        padding: 30px;
    }

    .route-node {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        position: relative;
    }
    .route-node:last-child {
        margin-bottom: 0;
    }
    .route-node-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 15px;
        font-size: 0.9rem;
        flex-shrink: 0;
        z-index: 2;
    }
    .route-node-icon.from {
        background-color: rgba(242, 107, 58, 0.1);
        color: var(--color-orange);
        border: 2px solid var(--color-orange);
    }
    .route-node-icon.to {
        background-color: rgba(15, 43, 76, 0.1);
        color: var(--color-navy);
        border: 2px solid var(--color-navy);
    }
    .route-line {
        position: absolute;
        left: 15px;
        top: 32px;
        bottom: -20px;
        width: 2px;
        border-left: 2px dashed #cbd5e0;
        z-index: 1;
    }
    .route-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #a0aec0;
        font-weight: 700;
        margin-bottom: 2px;
    }
    .route-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--color-navy);
    }

    .param-badge {
        background: var(--color-bg-light);
        border: 1px solid var(--color-border);
        border-radius: 10px;
        padding: 8px 14px;
        display: inline-flex;
        align-items: center;
        font-size: 0.88rem;
        color: #4a5568;
        font-weight: 600;
    }
    .param-badge i {
        color: var(--color-orange);
        margin-right: 8px;
    }

    /* Price badge */
    .estimate-display {
        background: linear-gradient(135deg, var(--color-navy) 0%, #1a3a60 100%);
        color: white;
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .estimate-display::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(242, 107, 58, 0.05);
        border-radius: 50%;
        top: -150px;
        right: -150px;
    }
    .estimate-title {
        font-size: 0.85rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 12px;
    }
    .estimate-price-range {
        font-size: 2.8rem;
        font-weight: 900;
        color: #ffffff;
        letter-spacing: -0.02em;
        line-height: 1;
        margin-bottom: 8px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .estimate-tag {
        background-color: var(--color-orange);
        color: white;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 100px;
        letter-spacing: 0.05em;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(242, 107, 58, 0.3);
    }

    .dispatch-alert {
        background-color: #fffaf0;
        border: 1px solid #feebc8;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: flex-start;
        text-align: left;
    }
    .dispatch-beacon {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--color-orange);
        margin-top: 6px;
        margin-right: 15px;
        flex-shrink: 0;
        position: relative;
    }
    .dispatch-beacon::after {
        content: '';
        position: absolute;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: rgba(242, 107, 58, 0.3);
        top: -6px;
        left: -6px;
        animation: pulseBeacon 1.5s infinite;
    }
    @keyframes pulseBeacon {
        0% { transform: scale(0.8); opacity: 0.8; }
        100% { transform: scale(2.2); opacity: 0; }
    }

    .btn-custom {
        font-weight: 800;
        padding: 14px 32px;
        border-radius: 100px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    .btn-primary-custom {
        background-color: var(--color-orange);
        color: white;
        box-shadow: 0 8px 20px rgba(242, 107, 58, 0.25);
        border: none;
        text-decoration: none;
    }
    .btn-primary-custom:hover {
        background-color: #d85a2d;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(242, 107, 58, 0.38);
    }
    .btn-outline-custom {
        background-color: transparent;
        border: 2px solid var(--color-navy);
        color: var(--color-navy);
        text-decoration: none;
    }
    .btn-outline-custom:hover {
        background-color: var(--color-navy);
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .route-display {
            border-right: none;
            border-bottom: 1px solid var(--color-border);
        }
        .estimate-price-range {
            font-size: 2.2rem;
        }
    }
</style>
@endsection

@section('content')
<section class="thank-you-section py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center animate-fade-in">
                
                <!-- Success Tick Animation -->
                <div class="success-badge-container">
                    <div class="success-pulse-ring"></div>
                    <div class="success-badge">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <h1 class="display-5 fw-bold text-dark mb-2" style="letter-spacing: -0.02em;">Relocation Request Received!</h1>
                <p class="lead text-muted max-w-md mx-auto mb-4" style="font-size: 1.1rem; max-width: 600px;">
                    Thank you, <span class="fw-bold text-dark">{{ session('quote_data')['name'] ?? 'Customer' }}</span>. Your request has been securely processed. Top verified moving professionals are preparing matching quotes.
                </p>

                <!-- Stepper Progress Tracker -->
                <div class="stepper-container">
                    <div class="stepper-line"></div>
                    <div class="stepper-line-active"></div>
                    
                    <div class="step-item completed">
                        <div class="step-dot">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="step-label">Submitted</div>
                    </div>
                    
                    <div class="step-item completed">
                        <div class="step-dot">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="step-label">Calculated</div>
                    </div>
                    
                    <div class="step-item active">
                        <div class="step-dot">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="step-label">Dispatching</div>
                    </div>
                </div>

                <!-- Main Details Card -->
                <div class="thank-you-card text-start">
                    <div class="row g-0">
                        <!-- Left Panel: Trip & Parameters -->
                        <div class="col-md-7 route-display">
                            <h5 class="fw-extrabold text-dark mb-4" style="font-weight: 800; letter-spacing: -0.01em;">Trip Details</h5>
                            
                            <div class="route-nodes-container mb-4">
                                <div class="route-node">
                                    <div class="route-node-icon from">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="route-line"></div>
                                    <div>
                                        <div class="route-label">Origin Location</div>
                                        <div class="route-value">{{ session('quote_data')['zip_from'] ?? 'Origin ZIP / City' }}</div>
                                    </div>
                                </div>
                                
                                <div class="route-node">
                                    <div class="route-node-icon to">
                                        <i class="fas fa-route"></i>
                                    </div>
                                    <div>
                                        <div class="route-label">Destination Location</div>
                                        <div class="route-value">{{ session('quote_data')['zip_to'] ?? 'Destination ZIP / City' }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" style="border-color: var(--color-border);">

                            <!-- Parameters Badges -->
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @if(session('quote_data')['move_size'] ?? false)
                                <div class="param-badge">
                                    <i class="fas fa-box"></i> {{ session('quote_data')['move_size'] }}
                                </div>
                                @endif
                                
                                @if(session('quote_data')['move_date'] ?? false)
                                <div class="param-badge">
                                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse(session('quote_data')['move_date'])->format('M d, Y') }}
                                </div>
                                @endif

                                @if(session('quote_data')['calculated_distance'] ?? false)
                                <div class="param-badge">
                                    <i class="fas fa-road"></i> {{ session('quote_data')['calculated_distance'] }} Miles
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Panel: Cost Range Estimate -->
                        <div class="col-md-5 estimate-display">
                            <div class="estimate-title">Calculated Estimate</div>
                            
                            @if(session('quote_data')['min_price'] ?? false)
                            <div class="estimate-tag">Instant Auto-Estimate</div>
                            <div class="estimate-price-range">
                                ${{ number_format(session('quote_data')['min_price']) }} - ${{ number_format(session('quote_data')['max_price']) }}
                            </div>
                            <p class="text-white-50 small mb-0 px-2 mt-2" style="font-size: 0.78rem;">
                                Based on standard regional rates and the calculated route distance of <strong>{{ session('quote_data')['calculated_distance'] ?? '150' }} miles</strong>.
                            </p>
                            @else
                            <div class="estimate-tag">Pending Verification</div>
                            <div class="h3 fw-bold text-white mb-3">Custom Quotes</div>
                            <p class="text-white-50 small mb-0 px-2" style="font-size: 0.78rem;">
                                Verified local companies are calculating direct estimates based on your parameters.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Dispatching status message -->
                <div class="dispatch-alert mb-5">
                    <div class="dispatch-beacon"></div>
                    <div class="small text-muted fw-semibold" style="line-height: 1.5;">
                        <span class="text-dark fw-bold">Live Status:</span> We've matched your request with local moving companies in our network. Keep an eye on your inbox (<span class="text-dark font-monospace">{{ session('quote_data')['email'] ?? 'your email' }}</span>) or phone for detailed binding estimates and customized service offers shortly.
                    </div>
                </div>

                <!-- Call to Actions -->
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('front.movers') }}" class="btn btn-custom btn-primary-custom px-4 py-3">
                        <i class="fas fa-search me-2"></i> Explore Verified Movers
                    </a>
                    <a href="{{ route('front.home') }}" class="btn btn-custom btn-outline-custom px-4 py-3">
                        <i class="fas fa-home me-2"></i> Back to Homepage
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
