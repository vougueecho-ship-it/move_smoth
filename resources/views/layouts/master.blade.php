<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) - Deferred loading to speed up initial render and solve unused JavaScript errors -->
    <script>
      window.addEventListener('load', function() {
        var script = document.createElement('script');
        script.src = "https://www.googletagmanager.com/gtag/js?id=G-S1E71C8ZZ3";
        script.async = true;
        document.head.appendChild(script);

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-S1E71C8ZZ3');
      });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="w8JFych0DrhcP4fFP6YqOkq_VHRM0oQECvcqpjuU0Jg" />
    <title>@yield('title', 'Move Smooth | Local & Long Distance Moving Company')</title>
    <meta name="description" content="@yield('meta_description', 'Move Smooth offers affordable local and long-distance moving services with professional movers, fast quotes, and stress-free relocation solutions.')">
    @php
        $robots = 'index, follow';
        if (request()->has('q') || request()->path() === 'movers/search') {
            $robots = 'noindex, follow';
        }
    @endphp
    <meta name="robots" content="@yield('meta_robots', $robots)">
    @php
        $canonicalHost = str_contains(request()->getHost(), 'localhost') || str_contains(request()->getHost(), '127.0.0.1')
            ? request()->getSchemeAndHttpHost()
            : 'https://movesmoth.com';
        $canonicalUrl = rtrim($canonicalHost, '/') . '/' . ltrim(request()->path() === '/' ? '' : request()->path(), '/');
        if (request()->has('page')) {
            $canonicalUrl .= '?page=' . request()->get('page');
        }
        
        // Hreflang should only be present on canonical pages (URLs without query strings / parameters)
        // to prevent search crawlers from flagging mismatches or self-referential conflicts.
        $showHreflang = empty(request()->query());
    @endphp
    <link rel="canonical" href="{{ $canonicalUrl }}">
    
    @if($showHreflang)
    <!-- International SEO (Targeting English speakers in the United States) -->
    <link rel="alternate" hreflang="en-us" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="x-default" href="{{ $canonicalUrl }}">
    @endif
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Move Smooth | Local & Long Distance Moving Company')">
    <meta property="og:description" content="@yield('meta_description', 'Move Smooth offers affordable local and long-distance moving services with professional movers, fast quotes, and stress-free relocation solutions.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:site_name" content="Move Smooth">

    <!-- Early Connection to CDNs (Preconnect) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    <!-- Preload FontAwesome Webfonts to eliminate Flash of Invisible Text (FOIT) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Google Fonts: Outfit, Inter, Roboto (Asynchronous loading to prevent render-blocking) -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Roboto:wght@400;500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"></noscript>

    <!-- Bootstrap 5 (Critical CSS - remains synchronous to avoid Flash of Unstyled Content) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome (Asynchronous loading to prevent render-blocking) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"></noscript>

    <!-- Flatpickr CSS (Asynchronous loading to prevent render-blocking) -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet"></noscript>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css" rel="stylesheet"></noscript>

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('custom_styles')

    <!-- Global WebPage Schema -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebPage",
        "@@id": "{{ url()->current() }}#webpage",
        "url": "{{ url()->current() }}",
        "name": "@yield('title', 'Move Smooth | Local & Long Distance Moving Company')",
        "description": "@yield('meta_description', 'Move Smooth offers affordable local and long-distance moving services with professional movers, fast quotes, and stress-free relocation solutions.')",
        "isPartOf": {
            "@@type": "WebSite",
            "@@id": "{{ url('/') }}#website",
            "name": "Move Smooth",
            "url": "{{ url('/') }}"
        },
        "publisher": {
            "@@type": "Organization",
            "@@id": "{{ url('/') }}#organization",
            "name": "Move Smooth",
            "legalName": "LeadmotionX LLC",
            "logo": "{{ asset('images/logo.png') }}"
        }
    }
    </script>

    <!-- Breadcrumb Schema -->
    @yield('schema_breadcrumb')

    <!-- Page-specific Schema -->
    @yield('schema')
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.header')

    <main class="flex-grow-1" style="padding-top: 76px;">
        @yield('content')

        <!-- Global Quick Quote Section (appears on every page) -->
        @if(!Request::is('/'))
        <section class="global-quote-section" id="getQuoteSection">
            <div class="container position-relative z-index-1">
                <div class="row align-items-center">
                    <div class="col-lg-5 text-white mb-4 mb-lg-0">
                        <h2 class="fw-800 mb-3" style="color: white;">Get Your Free Moving Quote</h2>
                        <p class="opacity-75 mb-0">Enter your zip codes and we'll connect you with the best movers in your area. Fast, free, no obligation.</p>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{ route('front.calculator') }}" method="GET" class="quote-form-inline" id="globalQuoteForm">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Moving From</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-map-marker-alt input-icon"></i>
                                        <input type="text" name="zip_from" class="form-control zip-autocomplete" placeholder="ZIP or City" autocomplete="off" required>
                                        <div class="zip-autocomplete-dropdown"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Moving To</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-route input-icon"></i>
                                        <input type="text" name="zip_to" class="form-control zip-autocomplete" placeholder="ZIP or City" autocomplete="off" required>
                                        <div class="zip-autocomplete-dropdown"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-accent w-100 fw-800">
                                        GET QUOTE <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>

    @include('layouts.footer')

    <!-- Quote Modal -->
    <div class="modal fade" id="quoteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-xl">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-900 text-primary fs-3"><i class="fas fa-calculator text-accent me-2"></i>Get Your Free Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <!-- Stepper Tracker Header -->
                    <div class="stepper-wrapper mb-5 px-md-4">
                        <div class="stepper-line position-absolute top-50 start-0 end-0 bg-slate-200" style="height: 3px; z-index: 1; transform: translateY(-380%); left: 10%; right: 10%;">
                            <div class="stepper-line-progress h-100" id="stepper-progress-line" style="width: 0%;"></div>
                        </div>
                        <div class="d-flex justify-content-between position-relative" style="z-index: 2;">
                            <div class="step-node active" id="node-1">
                                <div class="node-circle d-flex align-items-center justify-content-center rounded-circle shadow-sm border border-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span class="node-text">Location</span>
                            </div>
                            <div class="step-node" id="node-2">
                                <div class="node-circle d-flex align-items-center justify-content-center rounded-circle shadow-sm border border-2">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <span class="node-text">Specs</span>
                            </div>
                            <div class="step-node" id="node-3">
                                <div class="node-circle d-flex align-items-center justify-content-center rounded-circle shadow-sm border border-2">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <span class="node-text">Contact</span>
                            </div>
                        </div>
                    </div>

                    <form id="multistepQuoteForm" action="{{ route('front.quote.submit') }}" method="POST">
                        @csrf
                        
                        <!-- Step 1: Location -->
                        <div class="modal-step-section" id="modal-step-1">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Moving From (Zip or City)</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-map-marker-alt input-icon"></i>
                                        <input type="text" name="zip_from" id="modal_zip_from" class="form-control zip-autocomplete" placeholder="Enter Zip or City" autocomplete="off" required>
                                        <div class="zip-autocomplete-dropdown"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Moving To (Zip or City)</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-route input-icon"></i>
                                        <input type="text" name="zip_to" id="modal_zip_to" class="form-control zip-autocomplete" placeholder="Enter Zip or City" autocomplete="off" required>
                                        <div class="zip-autocomplete-dropdown"></div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 pt-2 step-nav-buttons d-flex justify-content-end">
                                    <button type="button" class="btn btn-next px-5" id="btn-next-1">
                                        Next Step <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Specs -->
                        <div class="modal-step-section d-none" id="modal-step-2">
                            <div class="row g-4">
                                <div class="col-md-5">
                                    <label class="form-label">Move Date</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-calendar-alt input-icon"></i>
                                        <input type="text" name="move_date" id="modal_move_date" class="form-control flatpickr-date" placeholder="Select Relocation Date" tabindex="0" required>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label class="form-label mb-1">Select Home Size</label>
                                    <div class="row g-2 mt-1" id="move-size-cards">
                                        <div class="col-6 col-sm-3">
                                            <div class="move-size-card text-center p-3 d-flex flex-column align-items-center justify-content-center" data-value="Studio">
                                                <i class="fas fa-home mb-2"></i>
                                                <span class="card-label small fw-bold text-muted">Studio</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="move-size-card text-center p-3 d-flex flex-column align-items-center justify-content-center" data-value="1 Bedroom">
                                                <i class="fas fa-door-open mb-2"></i>
                                                <span class="card-label small fw-bold text-muted">1 Bed</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="move-size-card text-center p-3 d-flex flex-column align-items-center justify-content-center" data-value="2 Bedroom">
                                                <i class="fas fa-bed mb-2"></i>
                                                <span class="card-label small fw-bold text-muted">2 Bed</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="move-size-card text-center p-3 d-flex flex-column align-items-center justify-content-center" data-value="3+ Bedroom">
                                                <i class="fas fa-warehouse mb-2"></i>
                                                <span class="card-label small fw-bold text-muted">3+ Bed</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="move_size" id="modal_move_size" required>
                                </div>
                                <div class="col-12 mt-4 pt-2 step-nav-buttons d-flex justify-content-between">
                                    <button type="button" class="btn btn-back px-4" id="btn-back-2">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-next px-4" id="btn-next-2">
                                        Next Step <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Contact Info -->
                        <div class="modal-step-section d-none" id="modal-step-3">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Full Name</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" name="name" id="modal_name" class="form-control" placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email" name="email" id="modal_email" class="form-control" placeholder="Enter email address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <div class="zip-input-wrapper">
                                        <i class="fas fa-phone-alt input-icon"></i>
                                        <input type="text" name="phone" id="modal_phone" class="form-control" placeholder="Enter phone number" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 pt-2 step-nav-buttons d-flex justify-content-between">
                                    <button type="button" class="btn btn-back px-4" id="btn-back-3">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </button>
                                    <button type="submit" class="btn btn-accent px-5 py-3" id="btn-submit">
                                        Get Free Estimate <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Quote Button -->
    <button class="sticky-quote-btn animate-pulse-glow" id="stickyQuoteBtn" data-bs-toggle="modal" data-bs-target="#quoteModal">
        <i class="fas fa-calculator"></i> Free Quote
    </button>

    <!-- Click-to-Call (Mobile) -->
    <a href="tel:+14065059198" class="click-to-call" title="Call Move Smooth">
        <i class="fas fa-phone-alt"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>

    <!-- Zip Autocomplete Script -->
    <!-- Zip Autocomplete Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    (function() {
        let debounceTimer;
        const MIN_CHARS = 2;

        function initAutocomplete(input) {
            const wrapper = input.closest('.zip-input-wrapper');
            if (!wrapper) return;
            const dropdown = wrapper.querySelector('.zip-autocomplete-dropdown');
            if (!dropdown) return;

            // Initialize valid state: true if pre-populated, false if empty
            input.dataset.valid = input.value.trim() !== '' ? 'true' : 'false';

            input.addEventListener('input', function() {
                // Any manual typing invalidates the selection
                input.dataset.valid = 'false';
                input.classList.remove('is-invalid');
                const feedback = input.closest('.zip-input-wrapper').querySelector('.invalid-feedback');
                if (feedback) feedback.remove();

                clearTimeout(debounceTimer);
                const query = this.value.trim();

                if (query.length < MIN_CHARS) {
                    dropdown.classList.remove('show');
                    dropdown.innerHTML = '';
                    return;
                }

                debounceTimer = setTimeout(function() {
                    fetch('/api/zip-search?q=' + encodeURIComponent(query))
                        .then(r => r.json())
                        .then(data => {
                            if (!data.length) {
                                dropdown.classList.remove('show');
                                return;
                            }
                            dropdown.innerHTML = data.map(item =>
                                '<div class="zip-autocomplete-item" data-value="' + item.zip_code + ' - ' + item.city + ', ' + item.state + '">' +
                                    '<span class="zip-code">' + item.zip_code + '</span>' +
                                    '<span class="zip-location">' + item.city + '</span>' +
                                    '<span class="zip-state">' + item.state + '</span>' +
                                '</div>'
                            ).join('');
                            dropdown.classList.add('show');
                        })
                        .catch(() => dropdown.classList.remove('show'));
                }, 250);
            });

            dropdown.addEventListener('click', function(e) {
                const item = e.target.closest('.zip-autocomplete-item');
                if (item) {
                    input.value = item.dataset.value;
                    input.dataset.valid = 'true';
                    input.classList.remove('is-invalid');
                    const feedback = input.closest('.zip-input-wrapper').querySelector('.invalid-feedback');
                    if (feedback) feedback.remove();
                    dropdown.classList.remove('show');
                }
            });

            input.addEventListener('blur', function() {
                setTimeout(() => dropdown.classList.remove('show'), 200);
            });

            input.addEventListener('keydown', function(e) {
                const items = dropdown.querySelectorAll('.zip-autocomplete-item');
                const active = dropdown.querySelector('.zip-autocomplete-item.active');
                let idx = Array.from(items).indexOf(active);

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    if (active) active.classList.remove('active');
                    idx = (idx + 1) % items.length;
                    items[idx]?.classList.add('active');
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (active) active.classList.remove('active');
                    idx = idx <= 0 ? items.length - 1 : idx - 1;
                    items[idx]?.classList.add('active');
                } else if (e.key === 'Enter') {
                    if (active) {
                        e.preventDefault();
                        input.value = active.dataset.value;
                        input.dataset.valid = 'true';
                        input.classList.remove('is-invalid');
                        const feedback = input.closest('.zip-input-wrapper').querySelector('.invalid-feedback');
                        if (feedback) feedback.remove();
                        dropdown.classList.remove('show');
                    }
                }
            });
        }

        // Initialize all current zip autocompletes
        document.querySelectorAll('.zip-autocomplete').forEach(initAutocomplete);

        // Global Dynamic Autocomplete Observer (handles AJAX-inserted elements)
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        if (node.classList.contains('zip-autocomplete')) {
                            initAutocomplete(node);
                        }
                        node.querySelectorAll('.zip-autocomplete').forEach(initAutocomplete);
                    }
                });
            });
        });
        observer.observe(document.body, { childList: true, subtree: true });

        // Intercept form submissions globally for validation
        document.addEventListener('submit', function(e) {
            const form = e.target;
            const autocompletes = form.querySelectorAll('.zip-autocomplete');
            if (autocompletes.length === 0) return;

            let allValid = true;
            autocompletes.forEach(function(input) {
                if (input.dataset.valid !== 'true') {
                    allValid = false;
                    input.classList.add('is-invalid');
                    
                    const wrapper = input.closest('.zip-input-wrapper');
                    if (wrapper) {
                        let feedback = wrapper.querySelector('.invalid-feedback');
                        if (!feedback) {
                            feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback d-block';
                            feedback.style.fontSize = '0.8rem';
                            feedback.style.marginTop = '4px';
                            feedback.textContent = 'Please select a valid location from the suggestions list.';
                            wrapper.appendChild(feedback);
                        }
                    }
                }
            });

            if (!allValid) {
                e.preventDefault();
                e.stopPropagation();
                alert('Please select valid locations from the suggestions list for both origin and destination before proceeding.');
            }
        });

        // Sticky button scroll behavior
        const stickyBtn = document.getElementById('stickyQuoteBtn');
        if (stickyBtn) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    stickyBtn.style.opacity = '1';
                    stickyBtn.style.pointerEvents = 'auto';
                } else {
                    stickyBtn.style.opacity = '0';
                    stickyBtn.style.pointerEvents = 'none';
                }
            });
            stickyBtn.style.opacity = '0';
            stickyBtn.style.pointerEvents = 'none';
            stickyBtn.style.transition = 'opacity 0.3s ease';
        }

        // Multi-Step Modal Form JavaScript Logic
        const multistepForm = document.getElementById('multistepQuoteForm');
        if (multistepForm) {
            let currentStep = 1;
            
            const step1 = document.getElementById('modal-step-1');
            const step2 = document.getElementById('modal-step-2');
            const step3 = document.getElementById('modal-step-3');
            
            const btnNext1 = document.getElementById('btn-next-1');
            const btnNext2 = document.getElementById('btn-next-2');
            const btnBack2 = document.getElementById('btn-back-2');
            const btnBack3 = document.getElementById('btn-back-3');
            
            // Stepper Tracker Nodes
            const node1 = document.getElementById('node-1');
            const node2 = document.getElementById('node-2');
            const node3 = document.getElementById('node-3');
            const progressLine = document.getElementById('stepper-progress-line');
            
            // Original icon markup mapping
            const icons = {
                1: '<i class="fas fa-map-marker-alt"></i>',
                2: '<i class="fas fa-calendar-alt"></i>',
                3: '<i class="fas fa-user-shield"></i>'
            };
            
            function updateProgress(step) {
                currentStep = step;
                
                // Hide/show form steps
                step1.classList.toggle('d-none', step !== 1);
                step2.classList.toggle('d-none', step !== 2);
                step3.classList.toggle('d-none', step !== 3);
                
                // Stepper progress tracker state logic
                if (step === 1) {
                    progressLine.style.width = "0%";
                    
                    node1.className = "step-node active";
                    node2.className = "step-node";
                    node3.className = "step-node";
                    
                    node1.querySelector('.node-circle').innerHTML = icons[1];
                    node2.querySelector('.node-circle').innerHTML = icons[2];
                    node3.querySelector('.node-circle').innerHTML = icons[3];
                } else if (step === 2) {
                    progressLine.style.width = "50%";
                    
                    node1.className = "step-node completed";
                    node2.className = "step-node active";
                    node3.className = "step-node";
                    
                    node1.querySelector('.node-circle').innerHTML = '<i class="fas fa-check"></i>';
                    node2.querySelector('.node-circle').innerHTML = icons[2];
                    node3.querySelector('.node-circle').innerHTML = icons[3];
                } else if (step === 3) {
                    progressLine.style.width = "100%";
                    
                    node1.className = "step-node completed";
                    node2.className = "step-node completed";
                    node3.className = "step-node active";
                    
                    node1.querySelector('.node-circle').innerHTML = '<i class="fas fa-check"></i>';
                    node2.querySelector('.node-circle').innerHTML = '<i class="fas fa-check"></i>';
                    node3.querySelector('.node-circle').innerHTML = icons[3];
                }
            }
            
            // Handlers for Clickable Bedroom/Size Cards
            const sizeCards = document.querySelectorAll('#move-size-cards .move-size-card');
            const hiddenMoveSizeInput = document.getElementById('modal_move_size');
            
            sizeCards.forEach(card => {
                card.addEventListener('click', function() {
                    sizeCards.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    
                    hiddenMoveSizeInput.value = this.dataset.value;
                    
                    // Clear error styling on card row if validated previously
                    const cardsContainer = document.getElementById('move-size-cards');
                    cardsContainer.classList.remove('is-invalid');
                    const feedback = cardsContainer.parentNode.querySelector('.invalid-feedback');
                    if (feedback) feedback.remove();
                });
            });
            
            // Validate Step 1
            btnNext1.addEventListener('click', function() {
                const zipFrom = document.getElementById('modal_zip_from');
                const zipTo = document.getElementById('modal_zip_to');
                
                let valid = true;
                
                function validateField(input) {
                    if (input.value.trim() === '') {
                        input.classList.add('is-invalid');
                        valid = false;
                    } else if (input.dataset.valid !== 'true') {
                        input.classList.add('is-invalid');
                        valid = false;
                        
                        const wrapper = input.closest('.zip-input-wrapper');
                        if (wrapper) {
                            let feedback = wrapper.querySelector('.invalid-feedback');
                            if (!feedback) {
                                feedback = document.createElement('div');
                                feedback.className = 'invalid-feedback d-block';
                                feedback.style.fontSize = '0.8rem';
                                feedback.style.marginTop = '4px';
                                feedback.textContent = 'Please select a valid location from the suggestions.';
                                wrapper.appendChild(feedback);
                            }
                        }
                    } else {
                        input.classList.remove('is-invalid');
                        const wrapper = input.closest('.zip-input-wrapper');
                        if (wrapper) {
                            const feedback = wrapper.querySelector('.invalid-feedback');
                            if (feedback) feedback.remove();
                        }
                    }
                }
                
                validateField(zipFrom);
                validateField(zipTo);
                
                if (valid) {
                    updateProgress(2);
                }
            });
            
            // Validate Step 2
            btnNext2.addEventListener('click', function() {
                const moveDate = document.getElementById('modal_move_date');
                const moveSizeInput = document.getElementById('modal_move_size');
                const cardsContainer = document.getElementById('move-size-cards');
                
                let valid = true;
                
                if (moveDate.value.trim() === '') {
                    moveDate.classList.add('is-invalid');
                    valid = false;
                } else {
                    moveDate.classList.remove('is-invalid');
                }
                
                if (moveSizeInput.value.trim() === '') {
                    valid = false;
                    // Highlight choices grid with red validation feedback
                    const parent = cardsContainer.parentNode;
                    let feedback = parent.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback d-block mt-2';
                        feedback.style.fontSize = '0.8rem';
                        feedback.textContent = 'Please select a home bedroom size to proceed.';
                        parent.appendChild(feedback);
                    }
                } else {
                    const feedback = cardsContainer.parentNode.querySelector('.invalid-feedback');
                    if (feedback) feedback.remove();
                }
                
                if (valid) {
                    updateProgress(3);
                }
            });
            
            btnBack2.addEventListener('click', function() {
                updateProgress(1);
            });
            
            btnBack3.addEventListener('click', function() {
                updateProgress(2);
            });
            
            // Reset to step 1 when modal is hidden
            const myModalEl = document.getElementById('quoteModal');
            if (myModalEl) {
                myModalEl.addEventListener('hidden.bs.modal', function () {
                    updateProgress(1);
                    hiddenMoveSizeInput.value = '';
                    sizeCards.forEach(c => c.classList.remove('active'));
                    multistepForm.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    multistepForm.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                });
            }

            // Intercept all 2-field mini forms to open the multi-step modal quote form instead
            document.addEventListener('submit', function (e) {
                const form = e.target;
                
                // Skip if the form is part of the modal itself or on page calculators
                if (form.closest('#quoteModal') || 
                    form.id === 'stateCalcForm' || 
                    form.id === 'stateCalcFormInline' || 
                    form.id === 'calculator-steps-form' || 
                    form.id === 'cityCalcForm') {
                    return;
                }
                
                const zipFromInput = form.querySelector('input[name="zip_from"]') || form.querySelector('input[name="from"]');
                const zipToInput = form.querySelector('input[name="zip_to"]') || form.querySelector('input[name="to"]');
                
                // If both inputs exist and this is a simple 2-field form (e.g. not a full calculator form)
                if (zipFromInput && zipToInput && !form.querySelector('input[name="move_size"]')) {
                    e.preventDefault();
                    
                    const valFrom = zipFromInput.value.trim();
                    const valTo = zipToInput.value.trim();
                    
                    // Get the modal inputs
                    const modalZipFrom = document.getElementById('modal_zip_from');
                    const modalZipTo = document.getElementById('modal_zip_to');
                    
                    if (modalZipFrom && modalZipTo) {
                        modalZipFrom.value = valFrom;
                        modalZipTo.value = valTo;
                        modalZipFrom.dataset.valid = 'true';
                        modalZipTo.dataset.valid = 'true';
                        
                        // Clear validation errors on modal fields
                        modalZipFrom.classList.remove('is-invalid');
                        modalZipTo.classList.remove('is-invalid');
                        const formGroupFrom = modalZipFrom.closest('.zip-input-wrapper');
                        if (formGroupFrom) {
                            const feedback = formGroupFrom.querySelector('.invalid-feedback');
                            if (feedback) feedback.remove();
                        }
                        const formGroupTo = modalZipTo.closest('.zip-input-wrapper');
                        if (formGroupTo) {
                            const feedback = formGroupTo.querySelector('.invalid-feedback');
                            if (feedback) feedback.remove();
                        }
                        
                        // Copy date if exists
                        const dateInput = form.querySelector('input[name="date"]') || form.querySelector('input[name="move_date"]');
                        if (dateInput && dateInput.value.trim() !== '') {
                            const modalMoveDate = document.getElementById('modal_move_date');
                            if (modalMoveDate) {
                                modalMoveDate.value = dateInput.value.trim();
                                if (modalMoveDate._flatpickr) {
                                    modalMoveDate._flatpickr.setDate(dateInput.value.trim());
                                }
                            }
                        }
                        
                        // Open the quote modal using Bootstrap API
                        const modalElement = document.getElementById('quoteModal');
                        if (modalElement) {
                            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
                            modalInstance.show();
                        }
                    }
                }
            });
        }

        // Initialize Flatpickr on all date fields
        if (typeof flatpickr !== 'undefined') {
            flatpickr(".flatpickr-date", {
                minDate: "today",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: true,
                disableMobile: true, // Force consistent elegant UI on mobile and avoid browser native tabindex injections
                onReady: function(selectedDates, dateStr, instance) {
                    if (instance.altInput) {
                        instance.altInput.setAttribute('tabindex', '0');
                    }
                    if (instance.input) {
                        instance.input.setAttribute('tabindex', '-1');
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (instance.altInput) {
                        instance.altInput.setAttribute('tabindex', '0');
                    }
                }
            });
        }

        // Global function to trigger quote modal for a specific company
        window.openQuoteModal = function(companyId, companyName) {
            const modalElement = document.getElementById('quoteModal');
            if (!modalElement) return;

            const compInput = modalElement.querySelector('input[name="company_id"]');
            if (compInput) {
                compInput.value = companyId;
            }

            const compBadge = modalElement.querySelector('.selected-company-badge');
            if (compBadge) {
                compBadge.innerText = companyName;
                compBadge.classList.remove('d-none');
            }

            if (typeof updateProgress === 'function') {
                updateProgress(1);
            }

            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
            modalInstance.show();
        };
    })();
    });
    </script>

    <!-- Global Floating AI Chatbot Widget -->
    <style>
        /* GET A QUOTE button overrides - Move to Left Side */
        .sticky-quote-btn {
            left: 24px !important;
            right: auto !important;
        }

        #movesmooth-chatbot-toggle {
            position: fixed;
            bottom: 25px;
            right: 25px;
            left: auto;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f26b3a 0%, #e25c2b 100%);
            border-radius: 50%;
            box-shadow: 0 8px 24px rgba(242, 107, 58, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 99999;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            outline: none;
        }
        #movesmooth-chatbot-toggle:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 30px rgba(242, 107, 58, 0.6);
        }
        #movesmooth-chatbot-toggle i {
            font-size: 24px;
            color: white;
        }
        .chatbot-ai-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #0f2b4c;
            color: white;
            font-size: 9px;
            font-weight: 800;
            padding: 3px 6px;
            border-radius: 10px;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        #movesmooth-chatbot-window {
            position: fixed;
            bottom: 100px;
            right: 25px;
            left: auto;
            width: 380px;
            height: 520px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(15, 43, 76, 0.15);
            z-index: 99999;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(30px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.15);
        }
        #movesmooth-chatbot-window.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        /* Chat Header */
        .movesmooth-chat-header {
            background: linear-gradient(135deg, #0f2b4c 0%, #1e3a60 100%);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }
        .movesmooth-chat-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .movesmooth-chat-bot-av {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 3px rgba(242, 107, 58, 0.3);
            animation: chatBreathe 3s infinite;
        }
        @keyframes chatBreathe {
            0%,100% { box-shadow: 0 0 0 3px rgba(242, 107, 58, 0.3); }
            50% { box-shadow: 0 0 0 7px rgba(242, 107, 58, 0.1); }
        }
        .movesmooth-chat-bot-av img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .movesmooth-chat-header-text h3 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: white;
        }
        .movesmooth-chat-header-text p {
            margin: 0;
            color: #f26b3a;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }
        .movesmooth-chat-live-dot {
            width: 6px;
            height: 6px;
            background-color: #4ade80;
            border-radius: 50%;
            display: inline-block;
            animation: chatPulse 2s infinite;
        }
        @keyframes chatPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.35; }
        }

        /* Chat Messages */
        .movesmooth-chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px 16px;
            background-color: #f7fafc;
            display: flex;
            flex-direction: column;
            gap: 12px;
            scroll-behavior: smooth;
        }
        .movesmooth-chat-messages::-webkit-scrollbar {
            width: 4px;
        }
        .movesmooth-chat-messages::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        .movesmooth-chat-msg {
            display: flex;
            gap: 10px;
            animation: chatMsgIn 0.3s ease both;
            align-items: flex-start;
        }
        @keyframes chatMsgIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .movesmooth-chat-msg.user {
            flex-direction: row-reverse;
        }
        .movesmooth-chat-av {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            flex-shrink: 0;
        }
        .movesmooth-chat-msg.bot .movesmooth-chat-av {
            background-color: #0f2b4c;
            color: #f26b3a;
        }
        .movesmooth-chat-msg.user .movesmooth-chat-av {
            background-color: #f26b3a;
            color: white;
        }

        .movesmooth-chat-bub {
            max-width: 80%;
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 0.85rem;
            line-height: 1.5;
            color: #2d3748;
        }
        .movesmooth-chat-msg.bot .movesmooth-chat-bub {
            background-color: white;
            border-top-left-radius: 4px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.04);
        }
        .movesmooth-chat-msg.user .movesmooth-chat-bub {
            background: linear-gradient(135deg, #0f2b4c 0%, #1e3a60 100%);
            color: white;
            border-top-right-radius: 4px;
        }

        /* Typing Indicator */
        .movesmooth-chat-typing-bub {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 12px 14px;
        }
        .movesmooth-chat-typing-bub span {
            width: 6px;
            height: 6px;
            background: #cbd5e0;
            border-radius: 50%;
            animation: chatBounce 1.2s infinite;
        }
        .movesmooth-chat-typing-bub span:nth-child(2) { animation-delay: 0.2s; }
        .movesmooth-chat-typing-bub span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes chatBounce {
            0%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-5px); }
        }

        /* Saved lead box */
        .movesmooth-chat-lead-saved {
            background: linear-gradient(135deg, #0f2b4c, #1e3a60);
            border-radius: 14px;
            padding: 14px;
            color: white;
            font-size: 0.78rem;
            line-height: 1.7;
            margin-top: 4px;
            width: 100%;
        }
        .movesmooth-chat-lead-saved .title {
            color: #f26b3a;
            font-weight: 800;
            font-size: 0.85rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .movesmooth-chat-lead-saved .row-info {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 2px 0;
        }
        .movesmooth-chat-lead-saved .row-info:last-child {
            border-bottom: none;
        }
        .movesmooth-chat-lead-saved .lbl {
            color: rgba(255, 255, 255, 0.5);
            font-weight: 600;
        }

        /* Chat Footer */
        .movesmooth-chat-footer {
            padding: 12px 14px;
            background-color: white;
            border-top: 1px solid #edf2f7;
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .movesmooth-chat-inp {
            flex: 1;
            padding: 10px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 24px;
            font-size: 0.85rem;
            outline: none;
            background-color: #f7fafc;
            transition: all 0.2s ease;
            color: #2d3748;
        }
        .movesmooth-chat-inp:focus {
            border-color: #f26b3a;
            background-color: white;
        }
        .movesmooth-chat-send {
            width: 38px;
            height: 38px;
            background-color: #0f2b4c;
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .movesmooth-chat-send:hover {
            background-color: #f26b3a;
            transform: scale(1.05);
        }
        .movesmooth-chat-send:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
        }

        .movesmooth-chat-powered {
            text-align: center;
            font-size: 0.65rem;
            color: #a0aec0;
            padding: 4px 0 10px;
            background-color: white;
            letter-spacing: 0.2px;
        }

        @media (max-width: 767px) {
            .sticky-quote-btn {
                display: none !important;
            }
            #movesmooth-chatbot-window {
                bottom: 0;
                right: 0;
                left: auto;
                width: 100vw;
                height: 100vh;
                border-radius: 0;
            }
        }
    </style>

    <button id="movesmooth-chatbot-toggle">
        <i class="fas fa-comments"></i>
        <span class="chatbot-ai-badge">AI</span>
    </button>

    <div id="movesmooth-chatbot-window">
        <div class="movesmooth-chat-header">
            <div class="movesmooth-chat-header-left">
                <div class="movesmooth-chat-bot-av">
                    <img src="{{ asset('images/favicon.png') }}" alt="MoveSmooth Icon">
                </div>
                <div class="movesmooth-chat-header-text">
                    <h3>MoveSmooth Assistant</h3>
                    <p><span class="movesmooth-chat-live-dot"></span> Live AI Assistant</p>
                </div>
            </div>
            <div id="movesmooth-chatbot-close" style="cursor: pointer; padding: 5px;">
                <i class="fas fa-times" style="font-size: 1.1rem; opacity: 0.8;"></i>
            </div>
        </div>

        <div class="movesmooth-chat-messages" id="movesmooth-chat-messages">
            <!-- Messages load dynamically -->
        </div>

        <div class="movesmooth-chat-footer">
            <input class="movesmooth-chat-inp" id="movesmooth-chat-inp" placeholder="Ask me anything about moving..." autocomplete="off" />
            <button class="movesmooth-chat-send" id="movesmooth-chat-send">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        <div class="movesmooth-chat-powered">AI-powered by MoveSmooth © 2026</div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        (function() {
            let history = [];
            let leadSaved = false;

            const msgsEl = document.getElementById('movesmooth-chat-messages');
            const inpEl  = document.getElementById('movesmooth-chat-inp');
            const btnEl  = document.getElementById('movesmooth-chat-send');
            const toggleEl = document.getElementById('movesmooth-chatbot-toggle');
            const windowEl = document.getElementById('movesmooth-chatbot-window');
            const closeEl = document.getElementById('movesmooth-chatbot-close');

            function scrollBottom() {
                if(msgsEl) msgsEl.scrollTop = msgsEl.scrollHeight;
            }

            if (toggleEl && windowEl && closeEl) {
                toggleEl.onclick = () => {
                    windowEl.classList.toggle('active');
                    scrollBottom();
                    if (history.length === 0) {
                        initGreeting();
                    }
                };

                closeEl.onclick = () => {
                    windowEl.classList.remove('active');
                };
            }

            function addBubble(text, role) {
                if (!msgsEl) return;
                const wrap = document.createElement('div');
                wrap.className = `movesmooth-chat-msg ${role}`;

                const av = document.createElement('div');
                av.className = 'movesmooth-chat-av';
                av.innerHTML = role === 'bot' ? '🤖' : '<i class="fas fa-user"></i>';

                const bub = document.createElement('div');
                bub.className = 'movesmooth-chat-bub';
                bub.innerHTML = text
                    .replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>')
                    .replace(/\n/g,'<br>');

                wrap.appendChild(av);
                wrap.appendChild(bub);
                msgsEl.appendChild(wrap);
                scrollBottom();
                return bub;
            }

            function showTyping() {
                if (!msgsEl) return;
                const wrap = document.createElement('div');
                wrap.className = 'movesmooth-chat-msg bot';
                wrap.id = 'movesmooth-chat-typing';
                
                const av = document.createElement('div');
                av.className = 'movesmooth-chat-av';
                av.innerHTML = '🤖';
                
                const bub = document.createElement('div');
                bub.className = 'movesmooth-chat-bub movesmooth-chat-typing-bub';
                bub.innerHTML = '<span></span><span></span><span></span>';
                
                wrap.appendChild(av);
                wrap.appendChild(bub);
                msgsEl.appendChild(wrap);
                scrollBottom();
            }

            function hideTyping() {
                const t = document.getElementById('movesmooth-chat-typing');
                if(t) t.remove();
            }

            function showLeadCard(lead) {
                if (!msgsEl) return;
                const wrap = document.createElement('div');
                wrap.className = 'movesmooth-chat-msg bot';
                
                const av = document.createElement('div');
                av.className = 'movesmooth-chat-av';
                av.innerHTML = '🤖';
                
                const card = document.createElement('div');
                card.className = 'movesmooth-chat-lead-saved';
                card.innerHTML = `
                    <div class="title">✅ Quote Estimate Saved!</div>
                    <div class="row-info"><span class="lbl">Name</span><span>${lead.name||'—'}</span></div>
                    <div class="row-info"><span class="lbl">Email</span><span>${lead.email||'—'}</span></div>
                    <div class="row-info"><span class="lbl">Phone</span><span>${lead.phone||'—'}</span></div>
                    <div class="row-info"><span class="lbl">From</span><span>${lead.from_city||'—'}</span></div>
                    <div class="row-info"><span class="lbl">To</span><span>${lead.to_city||'—'}</span></div>
                    <div class="row-info"><span class="lbl">Home Size</span><span>${lead.home_size||'—'}</span></div>
                `;
                wrap.appendChild(av);
                wrap.appendChild(card);
                msgsEl.appendChild(wrap);
                scrollBottom();
            }

            function extractLead(text) {
                const match = text.match(/<!--LEAD_DATA:(\{.*?\})-->/s);
                if(match){
                    try { return JSON.parse(match[1]); } catch(e){}
                }
                return null;
            }

            function cleanText(text) {
                return text.replace(/<!--LEAD_DATA:.*?-->/s,'').trim();
            }

            async function saveLead(lead) {
                try {
                    await fetch('/api/chatbot/lead', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || ''
                        },
                        body: JSON.stringify(lead)
                    });
                } catch(e) {
                    console.log('Lead save offline fallback:', lead);
                }
            }

            async function sendMessage(userText) {
                if (!userText.trim() || !inpEl || !btnEl) return;

                inpEl.disabled = true;
                btnEl.disabled = true;
                inpEl.value = '';

                addBubble(userText, 'user');
                history.push({role: 'user', content: userText});

                showTyping();

                try {
                    const res = await fetch('/api/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || ''
                        },
                        body: JSON.stringify({ messages: history })
                    });

                    const data = await res.json();
                    hideTyping();

                    const raw = data.content?.[0]?.text || "Oops, I'm having trouble connecting right now. Please try again in a bit!";
                    const lead = extractLead(raw);
                    const clean = cleanText(raw);

                    addBubble(clean, 'bot');
                    history.push({role: 'assistant', content: raw});

                    if (lead && !leadSaved) {
                        leadSaved = true;
                        showLeadCard(lead);
                        await saveLead(lead);
                    }
                } catch(e) {
                    hideTyping();
                    addBubble("Oops! Something went wrong. Let me reset my circuits, please try again 😅", 'bot');
                    console.error(e);
                }

                inpEl.disabled = false;
                btnEl.disabled = false;
                inpEl.focus();
            }

            async function initGreeting() {
                showTyping();
                try {
                    const res = await fetch('/api/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || ''
                        },
                        body: JSON.stringify({ messages: [{role: 'user', content: 'hello'}] })
                    });
                    const data = await res.json();
                    hideTyping();
                    
                    const text = data.content?.[0]?.text || "Hey there! 👋 Welcome to MoveSmooth! How can I help you plan your upcoming move today?";
                    const clean = cleanText(text);
                    addBubble(clean, 'bot');
                    history.push({role: 'assistant', content: text});
                } catch(e) {
                    hideTyping();
                    addBubble("Hey! 👋 Welcome to MoveSmooth! Planning a move or just have questions? I'm here to help!", 'bot');
                }
            }

            if (btnEl) {
                btnEl.onclick = () => sendMessage(inpEl.value);
            }
            if (inpEl) {
                inpEl.onkeydown = e => {
                    if(e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendMessage(inpEl.value);
                    }
                };
            }
        })();
    });
    </script>

    @yield('custom_scripts')
</body>
</html>
