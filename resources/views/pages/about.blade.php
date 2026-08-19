@extends('layouts.master')

@section('title', 'About Move Smooth | Trusted Professional Movers')
@section('meta_description', 'Discover the Move Smooth journey. Learn how our team of logistics and tech professionals is transforming the relocation industry through transparency, FMCSA licensing verification, and smart compare tools.')

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
            "name": "About Us",
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
    "@@type": "AboutPage",
    "@@id": "{{ url()->current() }}#aboutpage",
    "url": "{{ url()->current() }}",
    "name": "About Move Smooth | Trusted Professional Movers",
    "description": "Discover the Move Smooth journey. Learn how our team of logistics and tech professionals is transforming the relocation industry through transparency, FMCSA licensing verification, and smart compare tools.",
    "mainEntity": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization",
        "name": "Move Smooth",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+1-406-505-9198",
            "contactType": "customer service",
            "email": "contact@movesmooth.com"
        }
    }
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/about.css') }}" rel="stylesheet">
    <style>
        .about-detailed-section {
            line-height: 1.8;
            color: #475569;
        }
        .about-detailed-section h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 50px;
            margin-bottom: 25px;
        }
        .about-detailed-section h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 35px;
            margin-bottom: 15px;
        }
        .about-detailed-section p {
            margin-bottom: 20px;
            font-size: 1.05rem;
        }
        .about-detailed-section ul, .about-detailed-section ol {
            margin-bottom: 25px;
            padding-left: 20px;
        }
        .about-detailed-section li {
            margin-bottom: 10px;
            font-size: 1.02rem;
        }
        .value-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.05);
        }
        .team-profile-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }
        .team-profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px -5px rgba(0,0,0,0.08);
        }
        .team-avatar-fallback {
            height: 250px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <h1 class="display-3 fw-800 mb-3 text-white animate__animated animate__fadeInDown">About Move Smooth</h1>
        <p class="lead opacity-75 animate__animated animate__fadeInUp max-w-700 mx-auto">We are tech innovators and logistics experts on a mission to bring absolute transparency, security, and simplicity to the relocation industry.</p>
    </div>
</section>

<!-- Overlapping Story Card -->
<div class="container mb-5">
    <div class="mission-card">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-history me-1"></i> Founded in 2021</span>
                <h2 class="display-6 fw-800 mb-4 text-primary">The Origin of Move Smooth</h2>
                <p class="lh-lg text-muted fs-6">Move Smooth was born out of a shared frustration. Our founding team, consisting of database developers and logistics managers, realized that coordinating a house move in the United States remained one of the most stressful consumer experiences. The industry was saturated with unlicensed brokers, hidden fee estimates, and unvetted crews.</p>
                <p class="lh-lg text-muted">We believed that finding a <strong>trusted moving company</strong> shouldn't require days of phone tagging or risking your valuable belongings with unauthorized operators. We set out to design a digital platform built on manual verification checks, automated federal license synchronization, and real-time comparison grids to empower consumers nationwide.</p>
                
                <div class="mt-4 d-flex gap-4">
                    <div class="text-center">
                        <div class="h3 fw-800 mb-0 text-primary">150k+</div>
                        <div class="extra-small text-muted fw-bold">Moves Coordinated</div>
                    </div>
                    <div class="text-center border-start ps-4">
                        <div class="h3 fw-800 mb-0 text-primary">1,000+</div>
                        <div class="extra-small text-muted fw-bold">Vetted Movers</div>
                    </div>
                    <div class="text-center border-start ps-4">
                        <div class="h3 fw-800 mb-0 text-primary">4.9/5</div>
                        <div class="extra-small text-muted fw-bold">User Satisfaction</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-light rounded-4 border text-center">
                    <i class="fas fa-truck-moving fa-4x text-accent mb-4"></i>
                    <h3 class="h4 fw-bold text-dark mb-3">Reimagining Relocation Logistics</h3>
                    <p class="small text-muted lh-lg mb-0">By combining dynamic software tools (like our multi-step quote calculator) with official Federal Motor Carrier Safety Administration (FMCSA) database integration, we provide consumers with verified ratings, active USDOT credentials, and direct access to licensed moving professionals.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Narrative Content -->
<div class="container about-detailed-section my-5 py-3">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            
            <h2>1. The Problem with Modern Relocation Logistics</h2>
            <p>Every year, millions of Americans pack up their lives to move across cities, states, and the entire continent. Whether it is a student relocating to a new college dorm, a family upgrading to their dream suburban home, or a commercial enterprise transferring its corporate headquarters, the physical relocation of goods represents a crucial developmental step. However, the moving industry has historically operated with a low level of transparency. Rogue operators, operating under fake business names without proper USDOT registrations, routinely trick consumers by offering suspiciously cheap online estimates, only to hold their furniture hostage for thousands of dollars in extra fees upon delivery.</p>
            <p>Furthermore, standard consumer review systems are frequently manipulated. Independent moving brokers—who do not own any trucks or hire any moving crews—pose as actual carriers, contracting out jobs to local crews with poor safety records. This structural complexity leaves consumers overwhelmed, unable to differentiate between a legally compliant, insured moving carrier and an unauthorized paper broker. Move Smooth was designed specifically to dismantle this lack of transparency.</p>

            <h2>2. The Move Smooth Solution & Brand Philosophy</h2>
            <p>We believe that absolute transparency is the only cure for relocation stress. To accomplish this, we developed a digital platform that serves as a single, verified directory and interactive comparison engine. We define our brand through our core <strong>S.M.O.T.H.</strong> values:</p>
            
            <div class="row g-3 my-4">
                <div class="col-md">
                    <div class="value-card text-center h-100 p-3">
                        <div class="h2 fw-900 text-accent mb-1">S</div>
                        <h6 class="fw-bold text-primary mb-1">Smart</h6>
                        <p class="extra-small text-muted mb-0">Tech-driven AI calculators & ZIP tools</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="value-card text-center h-100 p-3">
                        <div class="h2 fw-900 text-accent mb-1">M</div>
                        <h6 class="fw-bold text-primary mb-1">Modern</h6>
                        <p class="extra-small text-muted mb-0">Efficient relocation & real-time quotes</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="value-card text-center h-100 p-3">
                        <div class="h2 fw-900 text-accent mb-1">O</div>
                        <h6 class="fw-bold text-primary mb-1">Optimized</h6>
                        <p class="extra-small text-muted mb-0">Budget-friendly & transparent rates</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="value-card text-center h-100 p-3">
                        <div class="h2 fw-900 text-accent mb-1">T</div>
                        <h6 class="fw-bold text-primary mb-1">Trusted</h6>
                        <p class="extra-small text-muted mb-0">100% FMCSA & USDOT verified</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="value-card text-center h-100 p-3">
                        <div class="h2 fw-900 text-accent mb-1">H</div>
                        <h6 class="fw-bold text-primary mb-1">Honest</h6>
                        <p class="extra-small text-muted mb-0">Zero hidden fees or surprises</p>
                    </div>
                </div>
            </div>

            <p>Our engineering team created a backend system that synchronizes directly with the **Federal Motor Carrier Safety Administration (FMCSA)** database. When a mover registers on our platform or is searched by a user, our system pulls their active registration records, insurance status, safety performance scores, and USDOT numbers. This allows users to check the credentials of over a thousand local and interstate movers in real-time, eliminating the risk of hiring rogue operators.</p>

            <h2>3. Our Core Pillars of Operation</h2>
            <p>Our platform is built upon four foundational pillars that guide our development roadmap, customer service standards, and corporate philosophy:</p>
            
            <div class="row g-4 my-3">
                <div class="col-md-6">
                    <div class="value-card h-100">
                        <div class="text-primary mb-3"><i class="fas fa-user-shield fa-2x"></i></div>
                        <h4 class="fw-bold text-dark mb-2">Absolute Verification</h4>
                        <p class="small text-muted mb-0">We manually audit the business registrations, local permits, liability insurance certificates, and USDOT safety records of every single moving carrier before they are displayed as "Verified" in our directory lists.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="value-card h-100">
                        <div class="text-primary mb-3"><i class="fas fa-balance-scale fa-2x"></i></div>
                        <h4 class="fw-bold text-dark mb-2">Unbiased Transparency</h4>
                        <p class="small text-muted mb-0">We display ratings and consumer reviews exactly as they are submitted, filtering out spam or artificial manipulation. Our sitemaps and comparison grids list movers side-by-side without hidden sponsored prioritization.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="value-card h-100">
                        <div class="text-primary mb-3"><i class="fas fa-code fa-2x"></i></div>
                        <h4 class="fw-bold text-dark mb-2">Smart Technology</h4>
                        <p class="small text-muted mb-0">From ZIP code autocomplete dropdowns and dynamic route maps to our multi-step moving cost calculator, we leverage modern software engineering to make planning a move efficient and stress-free.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="value-card h-100">
                        <div class="text-primary mb-3"><i class="fas fa-hearthandshake fa-2x"></i></div>
                        <h4 class="fw-bold text-dark mb-2">User Empowerment</h4>
                        <p class="small text-muted mb-0">We believe you should have total control over your move. Our comparison tool lets you compare up to four movers simultaneously, allowing you to choose the partner that matches your budget and timeline.</p>
                    </div>
                </div>
            </div>

            <h2>4. Understanding the Move Smooth Vetting Standard</h2>
            <p>Many directory sites claim to vet their participants, but their checks are often limited to a simple email confirmation. At Move Smooth, we enforce a strict 5-step verification process before any Mover is marked as a verified partner in our regional listing guides:</p>
            <ol>
                <li><strong>Active Federal Authority Auditing:</strong> For all interstate movers, we verify that the carrier holds active operational authority with the FMCSA, including an active USDOT number and an MC registration number. Intrastate movers are verified against relevant state departments of transportation.</li>
                <li><strong>Financial Security & Bond Checks:</strong> We confirm that the moving carrier maintains the mandatory levels of cargo insurance and public liability insurance, as well as necessary surety bonds. This ensures that in the rare event of transit damage, your belongings are financially protected.</li>
                <li><strong>Safety Record Verification:</strong> We review the mover's safety data, including vehicle out-of-service rates, driver inspection histories, and crash records over the past 24 months. Carriers with safety records below the national average are not allowed on the platform.</li>
                <li><strong>Physical Location Auditing:</strong> Rogue movers often list fake virtual addresses to hide from consumer complaints. We verify that each registered mover operates a physical logistics office, warehouse, or commercial truck yard in their base city.</li>
                <li><strong>Consumer History Checks:</strong> We audit BBB registries, consumer protection databases, and historical reviews to check for patterns of bait-and-switch pricing or hostage cargo practices. Only carriers with a clean, verified reputation are listed.</li>
            </ol>

            <h2>5. The Features That Set Us Apart</h2>
            <p>Our platform is packed with custom-built tools designed to simplify your relocation journey from start to finish:</p>
            <ul>
                <li><strong>The 4-Step Moving Cost Estimator:</strong> A dynamic calculator that asks for your route, home size, and date, then generates a projected cost range based on real market averages. This gives you a baseline to evaluate the quotes you receive.</li>
                <li><strong>Side-by-Side Comparison Tool:</strong> Allows you to select up to four moving companies from our directory and contrast their star ratings, USDOT numbers, supported services, base locations, and direct contact options on a single grid.</li>
                <li><strong>Direct Company Lead System:</strong> Instead of broadcasting your phone number to dozens of telemarketers, you submit a quote request directly to the specific movers you select. They contact you with a customized estimate, keeping your contact details secure.</li>
                <li><strong>Comprehensive State & City Directories:</strong> We host detailed regional guides for major states and cities, detailing the top-rated local movers, city FAQs, moving costs, and local regulations.</li>
            </ul>

            <h2>6. Our Technological Vision for the Future</h2>
            <p>We are constantly looking for ways to improve our platform. Our engineering team is currently working on several advanced features to make moving even smoother:</p>
            <ul>
                <li><strong>AI-Powered Volume Estimators:</strong> Leveraging machine learning to estimate the cubic volume and weight of your household goods based on a simple photo or video scan of your rooms.</li>
                <li><strong>Carbon-Neutral Relocation Tracking:</strong> Helping users calculate the carbon footprint of their move and connect with eco-friendly carriers that utilize electric moving trucks or support verified carbon offset initiatives.</li>
                <li><strong>Smart Document Management:</strong> A secure dashboard where you can upload and sign bills of lading, inventory lists, and insurance contracts, keeping all your move paperwork in one place.</li>
            </ul>

            <h2>7. Corporate Accountability and Licensing</h2>
            <p>Move Smooth is operated under the legal authorization of LeadmotionX LLC. We are registered in the State of Texas and adhere to all consumer protection laws, data security mandates, and regulatory rules. Because we are not a moving carrier or freight broker, we do not require a USDOT or MC number. However, we ensure that every carrier listed in our directory holds a valid, active registration with the relevant authorities.</p>
            <p>If you represent a licensed moving carrier and want to update your company profile, claim a listing, or submit licensing details for verification, please contact our Mover Relations team. We work with carriers across the country to maintain accurate, up-to-date information for our users.</p>

            <h2>8. Partner Network and Service Availability</h2>
            <p>Our network of vetted moving carriers spans all 50 states, covering thousands of cities from New York to Seattle. We connect users with carriers specializing in all aspects of relocation logistics, including:</p>
            <ul>
                <li><strong>Local Household Movers:</strong> Dedicated local crews who understand your city and can complete same-day apartment or residential moves efficiently.</li>
                <li><strong>Interstate Moving Carriers:</strong> Vetted long-distance carriers equipped with commercial transport trucks to safely relocate your belongings across state lines.</li>
                <li><strong>Commercial Relocation Experts:</strong> Specialists in office moves, laboratory logistics, server rack transports, and corporate employee relocations.</li>
                <li><strong>Full-Service Packing & Storage:</strong> Companies offering professional packing, custom wooden crating, furniture assembly, and secure, climate-controlled storage.</li>
            </ul>

            <h2>9. Contacting Our Offices</h2>
            <p>We are always happy to hear from you. If you have questions about our platform, need help using the comparison tools, want to report a listing error, or are a mover looking to join our network, please contact us:</p>
            
            <div class="card p-4 bg-light border-0 mt-4" style="border-radius: 12px;">
                <h6 class="fw-bold text-dark mb-2">MoveSmooth Headquarters</h6>
                <ul class="list-unstyled mb-0 small">
                    <li><i class="fas fa-envelope text-primary me-2"></i> Email: <strong>contact@movesmooth.com</strong></li>
                    <li><i class="fas fa-map-marker-alt text-primary me-2"></i> Address: <strong>5900 Balcones Drive STE 100, Austin, TX 78731</strong></li>
                    <li><i class="fas fa-phone-alt text-primary me-2"></i> Phone: <strong>+1 (406) 505-9198</strong></li>
                    <li><i class="fas fa-clock text-primary me-2"></i> Support Hours: <strong>24/7 Support Desk Active</strong></li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Stats Row Section -->
<section class="section-padding bg-light text-center border-top border-bottom">
    <div class="container">
        <h3 class="text-uppercase fw-bold mb-5 small text-primary" style="letter-spacing: 2px;">Our Satisfaction Record</h3>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <h2 class="display-4 fw-800 text-accent mb-2">5+ Years</h2>
                <p class="text-muted fw-bold small text-uppercase mb-0" style="letter-spacing: 1px;">Platform History</p>
            </div>
            <div class="col-md-3 col-6">
                <h2 class="display-4 fw-800 text-accent mb-2">50M</h2>
                <p class="text-muted fw-bold small text-uppercase mb-0" style="letter-spacing: 1px;">Miles Coordinated</p>
            </div>
            <div class="col-md-3 col-6">
                <h2 class="display-4 fw-800 text-accent mb-2">99.2%</h2>
                <p class="text-muted fw-bold small text-uppercase mb-0" style="letter-spacing: 1px;">Satisfaction Rate</p>
            </div>
            <div class="col-md-3 col-6">
                <h2 class="display-4 fw-800 text-accent mb-2">24/7</h2>
                <p class="text-muted fw-bold small text-uppercase mb-0" style="letter-spacing: 1px;">Active Support</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="section-padding mb-0 bg-accent-light text-center py-5 border-bottom">
    <div class="container py-4">
        <h2 class="display-5 fw-800 mb-3 text-primary">Ready for a Safe, <span class="text-accent">Stress-Free</span> Relocation?</h2>
        <p class="lead mb-4 text-muted mx-auto" style="max-width: 600px;">Connect with the nation's most trusted moving partners today. Fast, reliable, and 100% vetted.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('front.movers') }}" class="btn btn-primary btn-lg px-5 py-3 fw-800 rounded-pill shadow">FIND VERIFIED MOVERS</a>
            <a href="{{ route('front.calculator') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-800 rounded-pill">COST ESTIMATOR</a>
        </div>
    </div>
</section>
@endsection
