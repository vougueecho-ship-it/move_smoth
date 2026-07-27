@extends('layouts.master')

@section('title', 'Contact Move Smooth | Get Free Moving Quote')
@section('meta_description', 'Contact Move Smooth today for free moving estimates and professional relocation services.')

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
            "name": "Contact Us",
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
    "@@type": "ContactPage",
    "@@id": "{{ url()->current() }}#contactpage",
    "url": "{{ url()->current() }}",
    "name": "Contact Move Smooth | Get Free Moving Quote",
    "description": "Contact Move Smooth today for free moving estimates and professional relocation services.",
    "mainEntity": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    }
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/contact.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1 class="display-3 fw-800 mb-3 text-white animate__animated animate__fadeInDown">Contact Move Smooth</h1>
        <p class="lead opacity-75 animate__animated animate__fadeInUp">Get a free moving consultation, resolve support queries, and connect with licensed movers.</p>
    </div>
</section>

<!-- Contact Form and Information Grid -->
<div class="container mb-5">
    <div class="contact-card-wrapper">
        <div class="row g-5">
            <!-- Left Column: Contact Details & Info -->
            <div class="col-lg-5">
                <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-headset me-1"></i> Reach Out Anytime</span>
                <h2 class="fw-800 text-primary mb-4">Let's Discuss Your Relocation</h2>
                <p class="text-muted lh-lg mb-5">Ready to <strong>get moving quote</strong> details or need a professional <strong>moving consultation</strong>? Our team is available 24/7 to connect you with the most reliable local and interstate movers nationwide.</p>

                <!-- Phone -->
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="contact-info-text">
                        <h5>Phone Number</h5>
                        <a href="tel:+14065059198" class="fw-bold hover-primary">+1 (406) 505-9198</a>
                    </div>
                </div>

                <!-- Email -->
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div class="contact-info-text">
                        <h5>Email Address</h5>
                        <!--email_off-->
                        <a href="mailto:contact@movesmooth.com" class="fw-bold hover-primary">contact@movesmooth.com</a>
                        <!--/email_off-->
                    </div>
                </div>

                <!-- Address -->
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-info-text">
                        <h5>Office Headquarters</h5>
                        <p class="fw-semibold">5900 Balcones Drive STE 100, Austin, TX 78731</p>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div class="contact-info-text">
                        <h5>Business Hours</h5>
                        <p class="small mb-1"><strong>Monday - Friday:</strong> 8:00 AM - 7:00 PM</p>
                        <p class="small mb-1"><strong>Saturday:</strong> 9:00 AM - 5:00 PM</p>
                        <p class="small"><strong>Sunday:</strong> Closed (Support Active)</p>
                    </div>
                </div>

                <!-- Service Areas -->
                <div class="contact-info-item mb-0">
                    <div class="contact-icon"><i class="fas fa-globe"></i></div>
                    <div class="contact-info-text">
                        <h5>Service Areas</h5>
                        <p class="small mb-0">Proudly providing licensed moving logistics across all 50 states, covering thousands of cities nationwide.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-box shadow-xs">
                    <h3 class="fw-800 text-primary mb-3">Send a Message</h3>
                    <p class="text-muted small mb-4">Feel free to write to us to register your company, request support, or get answers to your questions.</p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4 p-3" role="alert" style="background-color: #f0fdf4; color: #166534;">
                            <i class="fas fa-check-circle me-2"></i> <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('front.contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Requesting a Moving Consultation" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="How can we help you coordinate your upcoming relocation?" required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-800 rounded-pill shadow-sm">
                                    SEND MESSAGE <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Google Map Section (Local SEO signals) -->
<section class="section-padding bg-white border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-accent-light text-accent px-3 py-2 rounded-pill mb-3 fw-bold"><i class="fas fa-map me-1"></i> Interactive Map</span>
            <h2 class="display-5 fw-800 text-primary">Find Us on the Map</h2>
            <p class="text-muted lead">Visit our headquarters or coordinate a direct <strong>contact moving company</strong> session.</p>
        </div>
        <div class="map-container">
            <!-- Leaflet/Google Map Responsive Iframe -->
            <iframe 
                src="https://maps.google.com/maps?q=5900%20Balcones%20Drive%20STE%20100,%20Austin,%20TX%2078731&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endsection
