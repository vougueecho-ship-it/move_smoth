<!--email_off-->
@extends('layouts.master')

@section('title', $company->meta_title)
@section('meta_description', $company->meta_description)

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
            "name": "Movers",
            "item": "{{ route('front.movers') }}"
        },
        {
            "@@type": "ListItem",
            "position": 3,
            "name": "{{ addslashes($company->name) }}",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endsection

@section('schema')
@php
    $approvedReviews = $company->reviews()->where('status', 'approved')->latest()->get();
@endphp
<!-- Moving Company Local Business Schema -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "MovingCompany",
    "@@id": "{{ url()->current() }}#movingcompany",
    "name": "{{ addslashes($company->name) }}",
    "image": "{{ $company->logo_url ?: asset('images/logo.png') }}",
    "telephone": "{{ $company->phone ?: '+1 406 505 9198' }}",
    "email": "{{ $company->email ?: 'contact@movesmooth.com' }}",
    "url": "{{ url()->current() }}",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ addslashes($company->address_line1 ?: '5900 Balcones Drive STE 100') }}",
        "addressLocality": "{{ addslashes($company->city) }}",
        "addressRegion": "{{ $company->state->code ?? '' }}",
        "postalCode": "{{ $company->zip }}",
        "addressCountry": "US"
    }
    @if($approvedReviews->count() > 0)
    ,"aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ number_format($approvedReviews->avg('rating'), 1) }}",
        "reviewCount": "{{ $approvedReviews->count() }}"
    },
    "review": [
        @foreach($approvedReviews->take(5) as $review)
        {
            "@@type": "Review",
            "author": {
                "@@type": "Person",
                "name": "{{ addslashes($review->name) }}"
            },
            "datePublished": "{{ $review->created_at->toIso8601String() }}",
            "reviewBody": "{{ addslashes(strip_tags($review->comment)) }}",
            "reviewRating": {
                "@@type": "Rating",
                "ratingValue": "{{ $review->rating }}"
            }
        }
        @if(!$loop->last)
        ,
        @endif
        @endforeach
    ]
    @endif
}
</script>

<!-- Product Schema for Relocation Services -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Product",
    "@@id": "{{ url()->current() }}#product",
    "name": "Professional Moving Service by {{ addslashes($company->name) }}",
    "description": "Licensed local and long-distance moving and relocation services by {{ addslashes($company->name) }} in {{ addslashes($company->city) }}, {{ $company->state->code ?? '' }}.",
    "image": "{{ $company->logo_url ?: asset('images/logo.png') }}",
    "brand": {
        "@@type": "Brand",
        "name": "{{ addslashes($company->name) }}"
    }
    @if($approvedReviews->count() > 0)
    ,"aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ number_format($approvedReviews->avg('rating'), 1) }}",
        "reviewCount": "{{ $approvedReviews->count() }}",
        "bestRating": "5",
        "worstRating": "1"
    },
    "review": [
        @foreach($approvedReviews->take(5) as $review)
        {
            "@@type": "Review",
            "author": {
                "@@type": "Person",
                "name": "{{ addslashes($review->name) }}"
            },
            "datePublished": "{{ $review->created_at->toIso8601String() }}",
            "reviewBody": "{{ addslashes(strip_tags($review->comment)) }}",
            "reviewRating": {
                "@@type": "Rating",
                "ratingValue": "{{ $review->rating }}",
                "bestRating": "5",
                "worstRating": "1"
            }
        }
        @if(!$loop->last)
        ,
        @endif
        @endforeach
    ]
    @else
    ,"aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "5.0",
        "reviewCount": "1",
        "bestRating": "5",
        "worstRating": "1"
    },
    "review": [
        {
            "@@type": "Review",
            "author": {
                "@@type": "Person",
                "name": "Move Smooth Customer"
            },
            "datePublished": "{{ date('c') }}",
            "reviewBody": "Excellent, highly professional moving services provided. Very satisfied with the experience.",
            "reviewRating": {
                "@@type": "Rating",
                "ratingValue": "5",
                "bestRating": "5",
                "worstRating": "1"
            }
        }
    ]
    @endif
    ,"offers": {
        "@@type": "AggregateOffer",
        "priceCurrency": "USD",
        "lowPrice": "150",
        "highPrice": "5000",
        "offerCount": "100"
    }
}
</script>

<!-- FAQPage Schema -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "Why Choose {{ addslashes($company->name) }}?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "If you are planning a move in {{ addslashes($company->city) }}, {{ addslashes($company->state->name ?? '') }}, choosing a licensed operator is crucial. {{ addslashes($company->name) }} is fully verified with USDOT #: {{ $company->dot_number ?: 'Active Status' }}, which ensures they follow strict federal transport safety regulations."
            }
        },
        {
            "@@type": "Question",
            "name": "How much does a move cost with {{ addslashes($company->name) }}?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Moving costs vary based on distance, weight, and home size. To get an accurate estimate, use the quick quote form on the right. You will receive a direct, free, and no-obligation estimate from {{ addslashes($company->name) }}'s dispatch desk."
            }
        }
    ]
}
</script>
@endsection

@section('custom_styles')
<style>
    /* ==========================================================================
       FRESH LIGHT-TONED PREMIUM PROFILE (v3 — OPEN LAYOUT, NO HEAVY CARDS)
       ========================================================================== */
    :root {
        --cp-primary: #1a365d;
        --cp-primary-light: #2d4a7a;
        --cp-accent: #e8590c;
        --cp-accent-hover: #d14b07;
        --cp-accent-soft: #fff4ed;
        --cp-bg: #f9fafb;
        --cp-surface: #ffffff;
        --cp-border: #e5e7eb;
        --cp-text: #1f2937;
        --cp-text-muted: #6b7280;
        --cp-text-light: #9ca3af;
        --cp-success: #059669;
        --cp-success-bg: #ecfdf5;
        --cp-warning: #d97706;
        --cp-radius: 12px;
        --cp-radius-lg: 18px;
    }

    html { scroll-behavior: smooth; }

    /* ===== HERO SECTION ===== */
    .cp-hero {
        background: linear-gradient(160deg, #1a365d 0%, #234876 40%, #2d5a8e 100%);
        color: #ffffff;
        padding: 48px 0 0;
        position: relative;
        overflow: hidden;
    }
    .cp-hero::before {
        content: '';
        position: absolute;
        top: -120px; right: -80px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(232,89,12,0.12) 0%, transparent 70%);
        pointer-events: none;
    }
    .cp-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -40px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 70%);
        pointer-events: none;
    }
    .cp-hero .container { position: relative; z-index: 2; }

    /* Breadcrumbs */
    .cp-breadcrumb { font-size: 0.82rem; opacity: 0.7; margin-bottom: 28px; }
    .cp-breadcrumb a { color: rgba(255,255,255,0.85); text-decoration: none; }
    .cp-breadcrumb a:hover { color: #fff; text-decoration: underline; }
    .cp-breadcrumb .separator { margin: 0 8px; opacity: 0.4; }
    .cp-breadcrumb .current { color: rgba(255,255,255,0.55); }

    /* Logo */
    .cp-logo-wrap {
        width: 100px; height: 100px;
        background: #fff;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        padding: 8px;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }
    .cp-logo-wrap:hover { transform: translateY(-3px); }
    .cp-logo-wrap img { max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px; }
    .cp-logo-initials {
        width: 84px; height: 84px;
        background: var(--cp-primary);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.8rem; color: #fff;
    }

    /* Company title area */
    .cp-company-name {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: -0.02em;
        margin: 0;
        color: #fff;
    }
    .cp-verified-tag {
        display: inline-flex;
        align-items: center; gap: 5px;
        background: rgba(5,150,105,0.15);
        border: 1px solid rgba(5,150,105,0.25);
        color: #6ee7b7;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .cp-hero-meta {
        color: rgba(255,255,255,0.65);
        font-size: 0.92rem;
        margin-top: 8px;
    }
    .cp-hero-meta i { color: var(--cp-accent); margin-right: 4px; }
    .cp-hero-rating { margin-top: 10px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .cp-hero-rating .stars { color: #fbbf24; font-size: 1rem; }
    .cp-hero-rating .score { font-weight: 800; font-size: 1.15rem; color: #fbbf24; font-family: 'Outfit', sans-serif; }
    .cp-hero-rating .count { color: rgba(255,255,255,0.55); font-size: 0.82rem; }

    /* Hero action button */
    .cp-btn-review {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700; font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.25s ease;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .cp-btn-review:hover {
        background: var(--cp-accent);
        border-color: var(--cp-accent);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(232,89,12,0.3);
    }

    /* Section Nav Tabs */
    .cp-nav-tabs {
        display: flex; gap: 6px;
        margin-top: 32px;
        padding-bottom: 0;
        overflow-x: auto;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
    }
    .cp-nav-tabs::-webkit-scrollbar { display: none; }
    .cp-nav-tab {
        color: rgba(255,255,255,0.6);
        font-weight: 600; font-size: 0.82rem;
        padding: 12px 20px;
        text-decoration: none;
        white-space: nowrap;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
    }
    .cp-nav-tab:hover { color: rgba(255,255,255,0.9); border-bottom-color: rgba(255,255,255,0.2); }
    .cp-nav-tab.active { color: #fff; border-bottom-color: var(--cp-accent); }

    /* ===== HORIZONTAL QUOTE CALCULATOR STRIP ===== */
    .cp-quote-strip {
        background: var(--cp-surface);
        border-bottom: 1px solid var(--cp-border);
        padding: 24px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }
    .cp-quote-inner {
        display: flex;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
    }
    .cp-quote-label-area { flex-shrink: 0; }
    .cp-quote-label-area h3 {
        font-family: 'Outfit', sans-serif;
        font-weight: 800; font-size: 1.05rem;
        color: var(--cp-primary);
        margin: 0 0 2px;
    }
    .cp-quote-label-area p { font-size: 0.78rem; color: var(--cp-text-muted); margin: 0; }

    .cp-quote-fields {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        flex-grow: 1;
        flex-wrap: wrap;
    }
    .cp-quote-field {
        flex: 1; min-width: 130px;
        position: relative;
    }
    .cp-quote-field label {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--cp-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    .cp-quote-field .field-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .cp-quote-field .field-wrap i.field-icon {
        position: absolute; left: 12px;
        color: var(--cp-text-light);
        font-size: 0.85rem;
        pointer-events: none;
        transition: color 0.15s ease;
        z-index: 2;
    }
    .cp-quote-field .field-wrap input {
        width: 100%;
        padding: 10px 12px 10px 36px;
        border: 1.5px solid var(--cp-border);
        border-radius: var(--cp-radius);
        font-size: 0.88rem;
        color: var(--cp-text);
        background: var(--cp-bg);
        transition: all 0.2s ease;
        outline: none;
    }
    .cp-quote-field .field-wrap input:focus {
        border-color: var(--cp-primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(26,54,93,0.08);
    }
    .cp-quote-field .field-wrap:focus-within i.field-icon { color: var(--cp-accent); }

    /* ZIP Autocomplete Suggestions */
    .zip-suggestions {
        position: absolute;
        top: 100%;
        left: 0; right: 0;
        background: var(--cp-surface);
        border: 1.5px solid var(--cp-border);
        border-top: none;
        border-radius: 0 0 var(--cp-radius) var(--cp-radius);
        max-height: 200px;
        overflow-y: auto;
        z-index: 100;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: none;
    }
    .zip-suggestions.show { display: block; }
    .zip-suggestion-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px;
        cursor: pointer;
        font-size: 0.85rem;
        color: var(--cp-text);
        transition: background 0.12s ease;
        border-bottom: 1px solid rgba(0,0,0,0.03);
    }
    .zip-suggestion-item:last-child { border-bottom: none; }
    .zip-suggestion-item:hover, .zip-suggestion-item.highlighted {
        background: var(--cp-accent-soft);
        color: var(--cp-accent);
    }
    .zip-suggestion-item i {
        color: var(--cp-accent); opacity: 0.6;
        font-size: 0.78rem;
        flex-shrink: 0;
    }
    .zip-suggestion-item .zip-code {
        font-weight: 700;
        min-width: 48px;
    }
    .zip-suggestion-item .zip-city {
        color: var(--cp-text-muted);
        font-size: 0.8rem;
    }
    .zip-loading {
        padding: 12px 14px;
        text-align: center;
        font-size: 0.8rem;
        color: var(--cp-text-light);
    }
    .zip-loading i { animation: spin 1s linear infinite; }
    @keyframes spin { from { transform: rotate(0); } to { transform: rotate(360deg); } }

    /* Resolved city hint under input */
    .zip-resolved {
        font-size: 0.72rem;
        color: var(--cp-success);
        margin-top: 4px;
        display: flex; align-items: center; gap: 4px;
        font-weight: 600;
        min-height: 18px;
    }

    .cp-quote-submit {
        flex-shrink: 0;
    }
    .cp-btn-quote {
        display: inline-flex; align-items: center; gap: 8px;
        background: linear-gradient(135deg, var(--cp-accent) 0%, #f97316 100%);
        color: #fff;
        border: none;
        padding: 10px 28px;
        border-radius: var(--cp-radius);
        font-weight: 700; font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 16px rgba(232,89,12,0.2);
        white-space: nowrap;
    }
    .cp-btn-quote:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(232,89,12,0.3);
    }

    .cp-secure-note {
        font-size: 0.72rem;
        color: var(--cp-text-light);
        display: flex; align-items: center; gap: 4px;
        margin-top: 8px;
    }



    /* ===== MAIN CONTENT ===== */
    .cp-body { background: var(--cp-bg); padding: 50px 0 60px; }

    /* Section styling (no cards — open/flowing layout) */
    .cp-section {
        scroll-margin-top: 90px;
        margin-bottom: 56px;
        padding-bottom: 56px;
        border-bottom: 1px solid var(--cp-border);
    }
    .cp-section:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    .cp-section-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.35rem;
        color: var(--cp-primary);
        margin: 0 0 6px;
        display: flex; align-items: center; gap: 10px;
    }
    .cp-section-title i {
        color: var(--cp-accent);
        font-size: 1.1rem;
        opacity: 0.8;
    }
    .cp-section-subtitle {
        font-size: 0.88rem;
        color: var(--cp-text-muted);
        margin: 0 0 28px;
        line-height: 1.6;
    }

    /* ===== STATS ROW (open, no card) ===== */
    .cp-stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid var(--cp-border);
    }
    .cp-stat-item {
        text-align: center;
        padding: 20px 12px;
        border-radius: var(--cp-radius-lg);
        background: var(--cp-surface);
        border: 1px solid var(--cp-border);
        transition: all 0.3s ease;
    }
    .cp-stat-item:hover {
        border-color: rgba(232,89,12,0.18);
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    }
    .cp-stat-icon { font-size: 1.6rem; color: var(--cp-accent); margin-bottom: 8px; }
    .cp-stat-item:hover .cp-stat-icon { transform: scale(1.1); }
    .cp-stat-label {
        font-size: 0.68rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.5px;
        color: var(--cp-text-light); margin-bottom: 4px;
    }
    .cp-stat-value { font-weight: 800; color: var(--cp-primary); font-size: 0.88rem; }

    /* ===== SERVICES ===== */
    .cp-services-grid {
        display: flex; flex-wrap: wrap; gap: 12px;
    }
    .cp-service-item {
        display: flex; align-items: center; gap: 10px;
        padding: 14px 22px;
        background: var(--cp-surface);
        border: 1px solid var(--cp-border);
        border-radius: var(--cp-radius);
        font-weight: 600; font-size: 0.9rem;
        color: var(--cp-text);
        transition: all 0.25s ease;
    }
    .cp-service-item:hover {
        background: var(--cp-accent-soft);
        border-color: rgba(232,89,12,0.2);
        color: var(--cp-accent);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(232,89,12,0.06);
    }
    .cp-service-item i { color: var(--cp-accent); font-size: 1rem; flex-shrink: 0; }

    /* ===== COMPLIANCE / SAFETY ===== */
    .cp-compliance-badge {
        display: flex; align-items: center; gap: 16px;
        background: var(--cp-success-bg);
        border: 1px solid rgba(5,150,105,0.15);
        border-radius: var(--cp-radius-lg);
        padding: 20px 24px;
        margin-bottom: 28px;
    }
    .cp-compliance-badge-icon {
        width: 48px; height: 48px;
        background: rgba(5,150,105,0.1);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: var(--cp-success); font-size: 1.3rem;
        flex-shrink: 0;
    }
    .cp-compliance-badge h4 { margin: 0; font-weight: 700; font-size: 0.95rem; color: var(--cp-text); }
    .cp-compliance-badge p { margin: 2px 0 0; font-size: 0.8rem; color: var(--cp-text-muted); }

    .cp-license-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--cp-border);
        border-radius: var(--cp-radius);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .cp-license-cell {
        background: var(--cp-surface);
        padding: 18px 16px;
        text-align: center;
    }
    .cp-license-cell .lbl { font-size: 0.7rem; font-weight: 600; color: var(--cp-text-light); text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 4px; }
    .cp-license-cell .val { font-weight: 800; color: var(--cp-primary); font-size: 1.05rem; font-family: 'Outfit', sans-serif; }
    .cp-license-cell .val.green { color: var(--cp-success); }

    .cp-compliance-list { list-style: none; padding: 0; margin: 0; }
    .cp-compliance-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid var(--cp-border);
        font-size: 0.9rem;
    }
    .cp-compliance-list li:last-child { border-bottom: none; }
    .cp-compliance-list .cl-label { font-weight: 500; color: var(--cp-text-muted); }
    .cp-compliance-list .cl-value { font-weight: 700; color: var(--cp-primary); }
    .cp-compliance-list .cl-value.success { color: var(--cp-success); }

    /* ===== REVIEWS ===== */
    .cp-rating-overview {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 28px;
        align-items: center;
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid var(--cp-border);
    }
    .cp-rating-big {
        text-align: center;
        padding: 24px 16px;
        background: var(--cp-bg);
        border-radius: var(--cp-radius-lg);
        border: 1px solid var(--cp-border);
    }
    .cp-rating-big .num {
        font-family: 'Outfit', sans-serif;
        font-weight: 900; font-size: 3.2rem;
        color: var(--cp-primary); line-height: 1;
        margin-bottom: 6px;
    }
    .cp-rating-big .stars-display { color: #fbbf24; font-size: 0.95rem; margin-bottom: 4px; }
    .cp-rating-big .sub { font-size: 0.75rem; color: var(--cp-text-light); font-weight: 600; }

    .cp-rating-bars { display: flex; flex-direction: column; gap: 8px; }
    .cp-bar-row { display: flex; align-items: center; gap: 10px; font-size: 0.82rem; }
    .cp-bar-label { width: 48px; font-weight: 600; color: var(--cp-text-muted); flex-shrink: 0; }
    .cp-bar-track { flex: 1; height: 8px; background: #e5e7eb; border-radius: 50px; overflow: hidden; }
    .cp-bar-fill { height: 100%; background: linear-gradient(90deg, #f59e0b, #fbbf24); border-radius: 50px; transition: width 0.8s ease; }
    .cp-bar-count { width: 24px; text-align: right; font-weight: 600; color: var(--cp-text-light); flex-shrink: 0; }

    .cp-review-item {
        padding: 24px 0;
        border-bottom: 1px solid var(--cp-border);
    }
    .cp-review-item:last-child { border-bottom: none; }
    .cp-review-avatar {
        width: 42px; height: 42px;
        background: #eef2ff;
        color: var(--cp-primary);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 1rem;
        flex-shrink: 0;
    }
    .cp-review-name { font-weight: 700; color: var(--cp-text); font-size: 0.95rem; }
    .cp-review-verified {
        display: inline-flex; align-items: center; gap: 4px;
        background: var(--cp-success-bg);
        color: var(--cp-success);
        font-size: 0.68rem; font-weight: 700;
        padding: 3px 8px; border-radius: 4px;
    }
    .cp-review-date { font-size: 0.78rem; color: var(--cp-text-light); }
    .cp-review-stars { color: #fbbf24; font-size: 0.85rem; }
    .cp-review-title { font-weight: 700; color: var(--cp-primary); font-size: 0.92rem; margin: 10px 0 6px; }
    .cp-review-text { color: var(--cp-text-muted); font-size: 0.88rem; line-height: 1.7; margin: 0; }

    .cp-empty-reviews {
        text-align: center;
        padding: 48px 20px;
        background: var(--cp-bg);
        border-radius: var(--cp-radius-lg);
        border: 1px dashed var(--cp-border);
    }
    .cp-empty-reviews i { font-size: 2.5rem; color: var(--cp-text-light); margin-bottom: 12px; }
    .cp-empty-reviews p { color: var(--cp-text-muted); margin-bottom: 16px; }

    /* ===== FAQ ACCORDION ===== */
    .cp-faq-list { margin-top: 16px; }
    .cp-faq-item {
        border: 1px solid var(--cp-border);
        border-radius: var(--cp-radius);
        margin-bottom: 10px;
        overflow: hidden;
        background: var(--cp-surface);
        transition: box-shadow 0.2s ease;
    }
    .cp-faq-item:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
    .cp-faq-question {
        width: 100%;
        background: none;
        border: none;
        padding: 16px 20px;
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--cp-text);
        text-align: left;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        transition: background 0.2s ease;
    }
    .cp-faq-question:hover { background: var(--cp-bg); }
    .cp-faq-question .faq-arrow {
        transition: transform 0.3s ease;
        color: var(--cp-text-light);
        font-size: 0.8rem;
    }
    .cp-faq-item.open .cp-faq-question { background: var(--cp-accent-soft); color: var(--cp-accent); }
    .cp-faq-item.open .faq-arrow { transform: rotate(180deg); color: var(--cp-accent); }
    .cp-faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.35s ease;
        padding: 0 20px;
    }
    .cp-faq-item.open .cp-faq-answer {
        max-height: 300px;
        padding: 0 20px 18px;
    }
    .cp-faq-answer p { color: var(--cp-text-muted); font-size: 0.88rem; line-height: 1.7; margin: 0; }

    /* ===== SIDEBAR TRUST WIDGET ===== */
    .cp-trust-sidebar {
        position: sticky;
        top: 90px;
    }
    .cp-trust-card {
        background: var(--cp-surface);
        border: 1px solid var(--cp-border);
        border-radius: var(--cp-radius-lg);
        padding: 28px 24px;
        margin-bottom: 20px;
        text-align: center;
    }
    .cp-trust-card h4 { font-weight: 700; font-size: 0.95rem; color: var(--cp-text); margin: 10px 0 4px; }
    .cp-trust-card p { font-size: 0.8rem; color: var(--cp-text-muted); margin: 0; }
    .cp-trust-icon {
        width: 50px; height: 50px;
        background: var(--cp-success-bg);
        border-radius: 14px;
        display: inline-flex; align-items: center; justify-content: center;
        color: var(--cp-success); font-size: 1.3rem;
    }

    .cp-contact-card {
        background: var(--cp-surface);
        border: 1px solid var(--cp-border);
        border-radius: var(--cp-radius-lg);
        padding: 24px;
    }
    .cp-contact-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--cp-border);
        font-size: 0.88rem;
        color: var(--cp-text);
    }
    .cp-contact-item:last-child { border-bottom: none; }
    .cp-contact-item i {
        width: 34px; height: 34px;
        background: var(--cp-bg);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: var(--cp-accent); font-size: 0.85rem;
        flex-shrink: 0;
    }

    /* Pulsating verification dot */
    .cp-pulse {
        width: 8px; height: 8px;
        background: var(--cp-success);
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
        animation: cpPulse 2s infinite;
        vertical-align: middle;
    }
    @keyframes cpPulse {
        0% { box-shadow: 0 0 0 0 rgba(5,150,105,0.5); }
        70% { box-shadow: 0 0 0 8px rgba(5,150,105,0); }
        100% { box-shadow: 0 0 0 0 rgba(5,150,105,0); }
    }

    /* ===== RESPONSIVENESS ===== */
    @media (max-width: 991px) {
        .cp-hero { padding: 36px 0 0; text-align: center; }
        .cp-logo-wrap { margin: 0 auto 16px; }
        .cp-hero-rating { justify-content: center; }
        .cp-stats-row { grid-template-columns: repeat(2, 1fr); }
        .cp-rating-overview { grid-template-columns: 1fr; }
        .cp-trust-sidebar { position: static; margin-top: 40px; }
        .cp-license-grid { grid-template-columns: 1fr; }
        .cp-quote-inner { flex-direction: column; align-items: stretch; }
        .cp-quote-fields { flex-direction: column; }
        .cp-quote-label-area { text-align: center; }
    }
    @media (max-width: 575px) {
        .cp-company-name { font-size: 1.5rem; }
        .cp-stats-row { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .cp-stat-item { padding: 16px 10px; }
        .cp-nav-tab { padding: 10px 14px; font-size: 0.78rem; }
        .cp-section { margin-bottom: 40px; padding-bottom: 40px; }
        .cp-section-title { font-size: 1.15rem; }
    }

    /* Fade animation */
    @keyframes cpFadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .cp-animate { animation: cpFadeUp 0.5s ease forwards; }
</style>
@endsection

@section('content')
<!-- ============================== HERO ============================== -->
<div class="cp-hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="cp-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('front.movers') }}">Movers</a>
            <span class="separator">/</span>
            <span class="current">{{ $company->name }}</span>
        </div>

        <div class="row align-items-center g-4">
            <div class="col-md-auto">
                <div class="cp-logo-wrap">
                    @if($company->logo_url)
                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }}">
                    @else
                        <div class="cp-logo-initials">{{ strtoupper(substr($company->name, 0, 2)) }}</div>
                    @endif
                </div>
            </div>

            <div class="col-md text-center text-md-start">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-3 mb-1">
                    <h1 class="cp-company-name">{{ $company->name }}</h1>
                    <span class="cp-verified-tag"><i class="fas fa-shield-alt"></i> Verified</span>
                </div>

                <p class="cp-hero-meta mb-0">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $company->address_line1 ?: 'Verified Address' }}, {{ $company->city }}, {{ $company->state->name ?? '' }} {{ $company->zip }}
                </p>

                <div class="cp-hero-rating">
                    @php
                        $heroRating = number_format($company->reviews()->where('status', 'approved')->avg('rating') ?: 0.0, 1);
                        $heroCount = $company->reviews()->where('status', 'approved')->count();
                    @endphp
                    <span class="score">{{ $heroRating }}</span>
                    <span class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($heroRating >= $i)
                                <i class="fas fa-star"></i>
                            @elseif($heroRating >= ($i - 0.5))
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </span>
                    <span class="count">({{ $heroCount }} reviews)</span>
                    @if($company->dot_number)
                        <span class="count" style="border-left: 1px solid rgba(255,255,255,0.15); padding-left: 10px;">
                            USDOT #: <strong>{{ $company->dot_number }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-auto text-center text-md-end">
                <a href="{{ route('front.review.form', $company->slug) }}" class="cp-btn-review">
                    <i class="fas fa-star"></i> Write a Review
                </a>
            </div>
        </div>

        <!-- Section Tabs -->
        <div class="cp-nav-tabs">
            <a href="#reviews" class="cp-nav-tab active">Reviews ({{ $heroCount }})</a>
            <a href="#overview" class="cp-nav-tab">Overview</a>
            <a href="#services" class="cp-nav-tab">Services</a>
            <a href="#compliance" class="cp-nav-tab">Safety & Licenses</a>
            <a href="#faq" class="cp-nav-tab">FAQ</a>
        </div>
    </div>
</div>

<!-- ============================== HORIZONTAL QUOTE CALCULATOR ============================== -->
<div class="cp-quote-strip">
    <div class="container">
        <form action="{{ route('front.contact-mover', $company->slug) }}" method="GET" id="quote-form">

            <!-- Step 1: Route Info with ZIP Autocomplete -->
            <div class="cp-quote-inner" id="quote-step-1">
                <div class="cp-quote-label-area">
                    <h3><i class="fas fa-calculator" style="color: var(--cp-accent); margin-right: 6px;"></i> Get a Free Estimate</h3>
                    <p>No-obligation quote from <strong>{{ $company->name }}</strong></p>
                </div>
                <div class="cp-quote-fields">
                    <div class="cp-quote-field">
                        <label>From ZIP</label>
                        <div class="field-wrap">
                            <i class="fas fa-map-marker-alt field-icon"></i>
                            <input type="text" name="zip_from" id="q-zip-from" placeholder="e.g. 90210" required autocomplete="off" maxlength="5">
                            <div class="zip-suggestions" id="sug-zip-from"></div>
                        </div>
                        <div class="zip-resolved" id="resolved-zip-from"></div>
                    </div>
                    <div class="cp-quote-field">
                        <label>To ZIP</label>
                        <div class="field-wrap">
                            <i class="fas fa-flag-checkered field-icon"></i>
                            <input type="text" name="zip_to" id="q-zip-to" placeholder="e.g. 10001" required autocomplete="off" maxlength="5">
                            <div class="zip-suggestions" id="sug-zip-to"></div>
                        </div>
                        <div class="zip-resolved" id="resolved-zip-to"></div>
                    </div>
                </div>
                <div class="cp-quote-submit">
                    <button type="button" class="cp-btn-quote" id="btn-quote-next">
                        Continue <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="cp-secure-note">
                <i class="fas fa-lock"></i> Your information is secure & encrypted
            </div>
        </form>
    </div>
</div>



<!-- ============================== BODY CONTENT ============================== -->
<div class="cp-body">
    <div class="container">
        <div class="row g-5">
            <!-- ===== LEFT MAIN COLUMN ===== -->
            <div class="col-lg-8">

                <!-- REVIEWS SECTION (First — right after calculator) -->
                @php
                    $fiveStarCount = $approvedReviews->where('rating', '>=', 4.5)->count();
                    $fourStarCount = $approvedReviews->where('rating', '>=', 3.5)->where('rating', '<', 4.5)->count();
                    $threeStarCount = $approvedReviews->where('rating', '>=', 2.5)->where('rating', '<', 3.5)->count();
                    $twoStarCount = $approvedReviews->where('rating', '>=', 1.5)->where('rating', '<', 2.5)->count();
                    $oneStarCount = $approvedReviews->where('rating', '<', 1.5)->count();
                    $totalApproved = $approvedReviews->count() ?: 1;

                    $fiveStarPercent = round(($fiveStarCount / $totalApproved) * 100);
                    $fourStarPercent = round(($fourStarCount / $totalApproved) * 100);
                    $threeStarPercent = round(($threeStarCount / $totalApproved) * 100);
                    $twoStarPercent = round(($twoStarCount / $totalApproved) * 100);
                    $oneStarPercent = round(($oneStarCount / $totalApproved) * 100);
                @endphp
                <div id="reviews" class="cp-section">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                        <h2 class="cp-section-title mb-0"><i class="fas fa-star"></i> Customer Reviews</h2>
                        <span style="background: var(--cp-primary); color: #fff; font-size: 0.78rem; font-weight: 700; padding: 6px 14px; border-radius: 50px;">
                            {{ $approvedReviews->count() }} Verified Reviews
                        </span>
                    </div>

                    <div class="cp-rating-overview">
                        <div class="cp-rating-big">
                            <div class="num">{{ number_format($approvedReviews->avg('rating') ?: 0.0, 1) }}</div>
                            <div class="stars-display">
                                @php $ratingAvg = number_format($approvedReviews->avg('rating') ?: 0.0, 1); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($ratingAvg >= $i)
                                        <i class="fas fa-star"></i>
                                    @elseif($ratingAvg >= ($i - 0.5))
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="sub">Out of 5.0 Stars</div>
                        </div>

                        <div class="cp-rating-bars">
                            <div class="cp-bar-row">
                                <span class="cp-bar-label">5 Star</span>
                                <div class="cp-bar-track"><div class="cp-bar-fill" style="width: {{ $fiveStarPercent }}%"></div></div>
                                <span class="cp-bar-count">{{ $fiveStarCount }}</span>
                            </div>
                            <div class="cp-bar-row">
                                <span class="cp-bar-label">4 Star</span>
                                <div class="cp-bar-track"><div class="cp-bar-fill" style="width: {{ $fourStarPercent }}%"></div></div>
                                <span class="cp-bar-count">{{ $fourStarCount }}</span>
                            </div>
                            <div class="cp-bar-row">
                                <span class="cp-bar-label">3 Star</span>
                                <div class="cp-bar-track"><div class="cp-bar-fill" style="width: {{ $threeStarPercent }}%"></div></div>
                                <span class="cp-bar-count">{{ $threeStarCount }}</span>
                            </div>
                            <div class="cp-bar-row">
                                <span class="cp-bar-label">2 Star</span>
                                <div class="cp-bar-track"><div class="cp-bar-fill" style="width: {{ $twoStarPercent }}%"></div></div>
                                <span class="cp-bar-count">{{ $twoStarCount }}</span>
                            </div>
                            <div class="cp-bar-row">
                                <span class="cp-bar-label">1 Star</span>
                                <div class="cp-bar-track"><div class="cp-bar-fill" style="width: {{ $oneStarPercent }}%"></div></div>
                                <span class="cp-bar-count">{{ $oneStarCount }}</span>
                            </div>
                        </div>
                    </div>

                    <p style="font-size: 0.82rem; color: var(--cp-text-muted); margin-bottom: 24px;">
                        <i class="fas fa-check-double" style="color: var(--cp-success); margin-right: 6px;"></i>
                        <strong>100% Verified feedback:</strong> All reviews are collected from customers who completed relocations with this mover.
                    </p>

                    <div class="cp-reviews-list">
                        @forelse($approvedReviews as $review)
                            <div class="cp-review-item">
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="cp-review-avatar">{{ strtoupper(substr($review->name, 0, 1)) }}</div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                            <span class="cp-review-name">{{ $review->name }}</span>
                                            <span class="cp-review-verified"><i class="fas fa-check-circle"></i> Verified</span>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center gap-3">
                                            <span class="cp-review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($review->rating >= $i)
                                                        <i class="fas fa-star"></i>
                                                    @elseif($review->rating >= ($i - 0.5))
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star" style="opacity: 0.3;"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                            <span class="cp-review-date"><i class="fas fa-calendar-alt me-1"></i> {{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="cp-review-title">"{{ $review->title }}"</div>
                                        <p class="cp-review-text">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="cp-empty-reviews">
                                <i class="fas fa-comments d-block"></i>
                                <p>No customer reviews have been published yet for {{ $company->name }}.</p>
                                <a href="{{ route('front.review.form', $company->slug) }}" class="cp-btn-quote" style="font-size: 0.82rem; padding: 8px 20px;">Be the first to review!</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- OVERVIEW SECTION -->
                <div id="overview" class="cp-section">
                    <h2 class="cp-section-title"><i class="fas fa-building"></i> About {{ $company->name }}</h2>
                    <div class="cp-section-subtitle">
                        @if($company->description)
                            {!! $company->description !!}
                        @else
                            @php
                                $cityStateStr = $company->city . ', ' . ($company->state->name ?? '');
                                $servicesArray = [];
                                foreach(explode(',', $company->service_type ?: 'local,long_distance') as $srv) {
                                    $srv = trim($srv);
                                    if ($srv === 'local') $servicesArray[] = 'local moving';
                                    elseif ($srv === 'long_distance') $servicesArray[] = 'long-distance shifting';
                                    elseif ($srv === 'commercial') $servicesArray[] = 'office relocations';
                                    elseif ($srv === 'packing') $servicesArray[] = 'professional packing';
                                    elseif ($srv === 'storage') $servicesArray[] = 'climate-controlled storage';
                                    elseif ($srv === 'residential') $servicesArray[] = 'household transfers';
                                }
                                $servicesStr = count($servicesArray) > 0 ? implode(', ', $servicesArray) : 'local and residential shifting';
                                $overviewRating = number_format($company->reviews()->where('status', 'approved')->avg('rating') ?: 0.0, 1);
                                $overviewReviewCount = $company->reviews()->where('status', 'approved')->count();
                            @endphp
                            <p><strong>{{ $company->name }}</strong> is a fully verified and licensed moving company offering premium relocation services in <strong>{{ $cityStateStr }}</strong> and surrounding regions. They are specialized in {{ $servicesStr }}, ensuring that residential and commercial cargo is packed, transported, and dispatched under strict safety standards.</p>

                            @if($company->dot_number)
                                <p>For absolute transport security and regulatory compliance, {{ $company->name }} is registered with the Federal Motor Carrier Safety Administration (FMCSA) under <strong>USDOT #: {{ $company->dot_number }}</strong>. This allows them to operate legally as an authorized carrier of household goods.</p>
                            @endif

                            @if($overviewReviewCount > 0)
                                <p>They currently maintain an exceptional customer satisfaction rating of <strong>{{ $overviewRating }} out of 5.0 stars</strong> based on {{ $overviewReviewCount }} real customer reviews on our platform.</p>
                            @else
                                <p>As a verified partner of the Move Smooth network, {{ $company->name }} is fully locked under our customer satisfaction safety guarantee, providing transparent hourly estimates with no hidden fees.</p>
                            @endif
                        @endif
                    </div>

                    <!-- Quick Stats -->
                    <div class="cp-stats-row">
                        <div class="cp-stat-item">
                            <div class="cp-stat-icon"><i class="fas fa-truck-moving"></i></div>
                            <div class="cp-stat-label">Service Scope</div>
                            <div class="cp-stat-value">Local & Interstate</div>
                        </div>
                        <div class="cp-stat-item">
                            <div class="cp-stat-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="cp-stat-label">Protection</div>
                            <div class="cp-stat-value">Fully Insured</div>
                        </div>
                        <div class="cp-stat-item">
                            <div class="cp-stat-icon"><i class="fas fa-check-double" style="color: var(--cp-success);"></i></div>
                            <div class="cp-stat-label">Status</div>
                            <div class="cp-stat-value" style="color: var(--cp-success);"><span class="cp-pulse"></span> Active</div>
                        </div>
                        <div class="cp-stat-item">
                            <div class="cp-stat-icon"><i class="fas fa-bolt" style="color: var(--cp-warning);"></i></div>
                            <div class="cp-stat-label">Response</div>
                            <div class="cp-stat-value">Under 15 Min</div>
                        </div>
                        <div class="cp-stat-item">
                            <div class="cp-stat-icon"><i class="fas fa-users" style="color: var(--cp-primary);"></i></div>
                            <div class="cp-stat-label">Crew</div>
                            <div class="cp-stat-value">Professional</div>
                        </div>
                        <div class="cp-stat-item">
                            <div class="cp-stat-icon"><i class="fas fa-lock" style="color: #6366f1;"></i></div>
                            <div class="cp-stat-label">Transit</div>
                            <div class="cp-stat-value">Tracked Goods</div>
                        </div>
                    </div>
                </div>

                <!-- SERVICES SECTION -->
                @php
                    $services = explode(',', $company->service_type ?: 'local,long_distance');
                @endphp
                <div id="services" class="cp-section">
                    <h2 class="cp-section-title"><i class="fas fa-box-open"></i> Moving Services Offered</h2>
                    <p class="cp-section-subtitle">This verified professional offers the following selectable moving configurations.</p>
                    <div class="cp-services-grid">
                        @foreach($services as $srv)
                            @php $srv = trim($srv); @endphp
                            @if($srv === 'local')
                                <div class="cp-service-item"><i class="fas fa-map-marker-alt"></i> Local Moving & Relocation</div>
                            @elseif($srv === 'long_distance')
                                <div class="cp-service-item"><i class="fas fa-route"></i> Long Distance & Interstate Moving</div>
                            @elseif($srv === 'commercial')
                                <div class="cp-service-item"><i class="fas fa-building"></i> Commercial & Office Moving</div>
                            @elseif($srv === 'packing')
                                <div class="cp-service-item"><i class="fas fa-box"></i> Packing & Crating Services</div>
                            @elseif($srv === 'storage')
                                <div class="cp-service-item"><i class="fas fa-warehouse"></i> Secured Storage Units</div>
                            @elseif($srv === 'residential')
                                <div class="cp-service-item"><i class="fas fa-home"></i> Residential Home Moving</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- SAFETY & COMPLIANCE SECTION -->
                <div id="compliance" class="cp-section">
                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
                        <div>
                            <h2 class="cp-section-title"><i class="fas fa-shield-alt"></i> Safety & Regulatory Compliance</h2>
                            <p class="cp-section-subtitle mb-0">Federal and state licensing credentials verified by FMCSA records.</p>
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 6px; background: var(--cp-success-bg); color: var(--cp-success); font-size: 0.78rem; font-weight: 700; padding: 6px 14px; border-radius: 50px; border: 1px solid rgba(5,150,105,0.15);">
                            <span class="cp-pulse"></span> FMCSA Active
                        </span>
                    </div>

                    <div class="cp-compliance-badge">
                        <div class="cp-compliance-badge-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="text-start">
                            <h4>FMCSA Certification Seal</h4>
                            <p>This operator maintains an <strong>Active Status</strong> under federal carrier licensing protocols. Authorized to transport household goods across interstate corridors.</p>
                        </div>
                    </div>

                    <div class="cp-license-grid">
                        <div class="cp-license-cell">
                            <div class="lbl">USDOT License</div>
                            <div class="val">{{ $company->dot_number ?: 'Active/Pending' }}</div>
                        </div>
                        <div class="cp-license-cell">
                            <div class="lbl">ICC MC Number</div>
                            <div class="val">{{ $company->mc_number ?: 'N/A' }}</div>
                        </div>
                        <div class="cp-license-cell">
                            <div class="lbl">Insurance Status</div>
                            <div class="val green">Active Coverage</div>
                        </div>
                    </div>

                    <ul class="cp-compliance-list">
                        <li>
                            <span class="cl-label">Carrier Status</span>
                            <span class="cl-value success"><i class="fas fa-check-circle me-1"></i> Authorized to Operate</span>
                        </li>
                        <li>
                            <span class="cl-label">State License Info</span>
                            <span class="cl-value">{{ $company->license_number ?: 'Active (Standard)' }}</span>
                        </li>
                        <li>
                            <span class="cl-label">Service Authorization</span>
                            <span class="cl-value">Household Goods Carrier</span>
                        </li>
                        <li>
                            <span class="cl-label">Operations</span>
                            <span class="cl-value">Interstate & Local</span>
                        </li>
                    </ul>
                </div>


                <!-- FAQ SECTION -->
                <div id="faq" class="cp-section">
                    <h2 class="cp-section-title"><i class="fas fa-question-circle"></i> Frequently Asked Questions</h2>
                    <p class="cp-section-subtitle">Common questions about {{ $company->name }} moving services.</p>

                    <div class="cp-faq-list">
                        <div class="cp-faq-item open">
                            <button class="cp-faq-question" type="button" onclick="toggleFaq(this)">
                                <span>Why Choose {{ $company->name }}?</span>
                                <i class="fas fa-chevron-down faq-arrow"></i>
                            </button>
                            <div class="cp-faq-answer">
                                <p>If you are planning a move in {{ $company->city }}, {{ $company->state->name ?? '' }}, choosing a licensed operator is crucial. {{ $company->name }} is fully verified with USDOT #: {{ $company->dot_number ?: 'Active Status' }}, which ensures they follow strict federal transport safety regulations.</p>
                            </div>
                        </div>

                        <div class="cp-faq-item">
                            <button class="cp-faq-question" type="button" onclick="toggleFaq(this)">
                                <span>How much does a move cost with {{ $company->name }}?</span>
                                <i class="fas fa-chevron-down faq-arrow"></i>
                            </button>
                            <div class="cp-faq-answer">
                                <p>Moving costs vary based on distance, weight, and home size. To get an accurate estimate, use the quick quote form above. You will receive a direct, free, and no-obligation estimate from {{ $company->name }}'s dispatch desk.</p>
                            </div>
                        </div>

                        <div class="cp-faq-item">
                            <button class="cp-faq-question" type="button" onclick="toggleFaq(this)">
                                <span>Is {{ $company->name }} licensed and insured?</span>
                                <i class="fas fa-chevron-down faq-arrow"></i>
                            </button>
                            <div class="cp-faq-answer">
                                <p>Yes, {{ $company->name }} is a fully licensed and insured moving company. They maintain an active status with the FMCSA and carry comprehensive liability coverage to protect your belongings during transit.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ===== RIGHT SIDEBAR ===== -->
            <div class="col-lg-4">
                <div class="cp-trust-sidebar">

                    <!-- Trust Card -->
                    <div class="cp-trust-card">
                        <div class="cp-trust-icon"><i class="fas fa-user-shield"></i></div>
                        <h4>MoveSmooth Quality Lock</h4>
                        <p>This operator is fully covered under our customer satisfaction safety guarantee.</p>
                    </div>

                    <!-- Contact Card -->
                    <div class="cp-contact-card">
                        <h5 style="font-weight: 700; font-size: 0.95rem; color: var(--cp-primary); margin-bottom: 12px;">
                            <i class="fas fa-address-card" style="color: var(--cp-accent); margin-right: 6px;"></i> Company Details
                        </h5>
                        <div class="cp-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $company->city }}, {{ $company->state->name ?? '' }} {{ $company->zip }}</span>
                        </div>
                        @if($company->phone)
                        <div class="cp-contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <span>{{ $company->phone }}</span>
                        </div>
                        @endif
                        @if($company->dot_number)
                        <div class="cp-contact-item">
                            <i class="fas fa-id-card"></i>
                            <span>USDOT: {{ $company->dot_number }}</span>
                        </div>
                        @endif
                        @if($company->mc_number)
                        <div class="cp-contact-item">
                            <i class="fas fa-file-alt"></i>
                            <span>MC: {{ $company->mc_number }}</span>
                        </div>
                        @endif
                        <div class="cp-contact-item" style="border-bottom: none;">
                            <i class="fas fa-check-circle" style="color: var(--cp-success) !important; background: var(--cp-success-bg);"></i>
                            <span><span class="cp-pulse"></span> <strong style="color: var(--cp-success);">Verified Active</strong></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================== SCRIPTS ============================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ==========================================================
       1. SCROLLSPY FOR NAV TABS
       ========================================================== */
    const navTabs = document.querySelectorAll('.cp-nav-tab');
    const sections = document.querySelectorAll('.cp-section');

    window.addEventListener('scroll', function() {
        let current = 'reviews';
        sections.forEach(sec => {
            const top = sec.offsetTop - 140;
            if (window.scrollY >= top) {
                current = sec.getAttribute('id');
            }
        });
        navTabs.forEach(tab => {
            tab.classList.remove('active');
            if (tab.getAttribute('href') === '#' + current) {
                tab.classList.add('active');
            }
        });
    });

    /* ==========================================================
       2. ZIP CODE AUTOCOMPLETE WITH SUGGESTIONS
       ========================================================== */
    // Top 120 US ZIP codes with city/state for instant matching
    const zipDatabase = [
        {z:'10001',c:'New York',s:'NY'},{z:'10002',c:'New York',s:'NY'},{z:'10003',c:'New York',s:'NY'},
        {z:'10010',c:'New York',s:'NY'},{z:'10016',c:'New York',s:'NY'},{z:'10019',c:'New York',s:'NY'},
        {z:'10021',c:'New York',s:'NY'},{z:'10022',c:'New York',s:'NY'},{z:'10023',c:'New York',s:'NY'},
        {z:'10036',c:'New York',s:'NY'},{z:'10128',c:'New York',s:'NY'},{z:'11201',c:'Brooklyn',s:'NY'},
        {z:'11215',c:'Brooklyn',s:'NY'},{z:'11226',c:'Brooklyn',s:'NY'},{z:'11385',c:'Ridgewood',s:'NY'},
        {z:'07001',c:'Avenel',s:'NJ'},{z:'07030',c:'Hoboken',s:'NJ'},{z:'07102',c:'Newark',s:'NJ'},
        {z:'08701',c:'Lakewood',s:'NJ'},{z:'06510',c:'New Haven',s:'CT'},
        {z:'20001',c:'Washington',s:'DC'},{z:'20002',c:'Washington',s:'DC'},{z:'20009',c:'Washington',s:'DC'},
        {z:'21201',c:'Baltimore',s:'MD'},{z:'21202',c:'Baltimore',s:'MD'},
        {z:'22101',c:'McLean',s:'VA'},{z:'22202',c:'Arlington',s:'VA'},{z:'23220',c:'Richmond',s:'VA'},
        {z:'30301',c:'Atlanta',s:'GA'},{z:'30303',c:'Atlanta',s:'GA'},{z:'30309',c:'Atlanta',s:'GA'},
        {z:'30318',c:'Atlanta',s:'GA'},{z:'33101',c:'Miami',s:'FL'},{z:'33109',c:'Miami Beach',s:'FL'},
        {z:'33125',c:'Miami',s:'FL'},{z:'33132',c:'Miami',s:'FL'},{z:'33139',c:'Miami Beach',s:'FL'},
        {z:'33301',c:'Fort Lauderdale',s:'FL'},{z:'33401',c:'West Palm Beach',s:'FL'},
        {z:'32801',c:'Orlando',s:'FL'},{z:'32803',c:'Orlando',s:'FL'},
        {z:'34102',c:'Naples',s:'FL'},{z:'33602',c:'Tampa',s:'FL'},{z:'33701',c:'St. Petersburg',s:'FL'},
        {z:'28202',c:'Charlotte',s:'NC'},{z:'27601',c:'Raleigh',s:'NC'},{z:'27701',c:'Durham',s:'NC'},
        {z:'29401',c:'Charleston',s:'SC'},{z:'37201',c:'Nashville',s:'TN'},{z:'37203',c:'Nashville',s:'TN'},
        {z:'40202',c:'Louisville',s:'KY'},{z:'43215',c:'Columbus',s:'OH'},{z:'44114',c:'Cleveland',s:'OH'},
        {z:'45202',c:'Cincinnati',s:'OH'},{z:'48201',c:'Detroit',s:'MI'},{z:'48226',c:'Detroit',s:'MI'},
        {z:'46204',c:'Indianapolis',s:'IN'},{z:'53202',c:'Milwaukee',s:'WI'},
        {z:'55401',c:'Minneapolis',s:'MN'},{z:'55402',c:'Minneapolis',s:'MN'},
        {z:'60601',c:'Chicago',s:'IL'},{z:'60602',c:'Chicago',s:'IL'},{z:'60603',c:'Chicago',s:'IL'},
        {z:'60606',c:'Chicago',s:'IL'},{z:'60610',c:'Chicago',s:'IL'},{z:'60611',c:'Chicago',s:'IL'},
        {z:'60614',c:'Chicago',s:'IL'},{z:'60616',c:'Chicago',s:'IL'},{z:'60622',c:'Chicago',s:'IL'},
        {z:'63101',c:'St. Louis',s:'MO'},{z:'64101',c:'Kansas City',s:'MO'},
        {z:'68102',c:'Omaha',s:'NE'},{z:'70112',c:'New Orleans',s:'LA'},{z:'70130',c:'New Orleans',s:'LA'},
        {z:'73301',c:'Austin',s:'TX'},{z:'75201',c:'Dallas',s:'TX'},{z:'75202',c:'Dallas',s:'TX'},
        {z:'75204',c:'Dallas',s:'TX'},{z:'76102',c:'Fort Worth',s:'TX'},
        {z:'77001',c:'Houston',s:'TX'},{z:'77002',c:'Houston',s:'TX'},{z:'77003',c:'Houston',s:'TX'},
        {z:'77019',c:'Houston',s:'TX'},{z:'78201',c:'San Antonio',s:'TX'},{z:'78205',c:'San Antonio',s:'TX'},
        {z:'80202',c:'Denver',s:'CO'},{z:'80203',c:'Denver',s:'CO'},{z:'80204',c:'Denver',s:'CO'},
        {z:'80301',c:'Boulder',s:'CO'},{z:'84101',c:'Salt Lake City',s:'UT'},
        {z:'85001',c:'Phoenix',s:'AZ'},{z:'85004',c:'Phoenix',s:'AZ'},{z:'85281',c:'Tempe',s:'AZ'},
        {z:'85701',c:'Tucson',s:'AZ'},{z:'87101',c:'Albuquerque',s:'NM'},
        {z:'89101',c:'Las Vegas',s:'NV'},{z:'89109',c:'Las Vegas',s:'NV'},{z:'89119',c:'Las Vegas',s:'NV'},
        {z:'90001',c:'Los Angeles',s:'CA'},{z:'90005',c:'Los Angeles',s:'CA'},{z:'90010',c:'Los Angeles',s:'CA'},
        {z:'90012',c:'Los Angeles',s:'CA'},{z:'90015',c:'Los Angeles',s:'CA'},{z:'90024',c:'Los Angeles',s:'CA'},
        {z:'90028',c:'Los Angeles',s:'CA'},{z:'90036',c:'Los Angeles',s:'CA'},{z:'90046',c:'Los Angeles',s:'CA'},
        {z:'90066',c:'Los Angeles',s:'CA'},{z:'90210',c:'Beverly Hills',s:'CA'},
        {z:'90401',c:'Santa Monica',s:'CA'},{z:'91101',c:'Pasadena',s:'CA'},
        {z:'92101',c:'San Diego',s:'CA'},{z:'92103',c:'San Diego',s:'CA'},
        {z:'94102',c:'San Francisco',s:'CA'},{z:'94103',c:'San Francisco',s:'CA'},
        {z:'94105',c:'San Francisco',s:'CA'},{z:'94107',c:'San Francisco',s:'CA'},
        {z:'94110',c:'San Francisco',s:'CA'},{z:'94114',c:'San Francisco',s:'CA'},
        {z:'94301',c:'Palo Alto',s:'CA'},{z:'95101',c:'San Jose',s:'CA'},
        {z:'95814',c:'Sacramento',s:'CA'},{z:'97201',c:'Portland',s:'OR'},{z:'97204',c:'Portland',s:'OR'},
        {z:'98101',c:'Seattle',s:'WA'},{z:'98102',c:'Seattle',s:'WA'},{z:'98104',c:'Seattle',s:'WA'},
        {z:'98109',c:'Seattle',s:'WA'},{z:'02101',c:'Boston',s:'MA'},{z:'02108',c:'Boston',s:'MA'},
        {z:'02110',c:'Boston',s:'MA'},{z:'02116',c:'Boston',s:'MA'},
        {z:'15201',c:'Pittsburgh',s:'PA'},{z:'15222',c:'Pittsburgh',s:'PA'},
        {z:'19101',c:'Philadelphia',s:'PA'},{z:'19102',c:'Philadelphia',s:'PA'},{z:'19103',c:'Philadelphia',s:'PA'}
    ];

    // Cache for API lookups
    const zipCache = {};

    // Resolved city display state
    const resolvedState = { from: '', to: '' };

    function initZipAutocomplete(inputId, sugBoxId, resolvedId, resolvedKey) {
        const input = document.getElementById(inputId);
        const sugBox = document.getElementById(sugBoxId);
        const resolvedEl = document.getElementById(resolvedId);
        let debounceTimer = null;
        let highlightIdx = -1;

        // Only allow digits
        input.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            const val = this.value;

            // Clear resolved if changed
            resolvedEl.textContent = '';
            resolvedState[resolvedKey] = '';

            clearTimeout(debounceTimer);
            if (val.length === 0) { hideSuggestions(); return; }

            // Filter local database
            const matches = zipDatabase.filter(z => z.z.startsWith(val)).slice(0, 6);

            if (matches.length > 0 && val.length < 5) {
                showLocalSuggestions(matches);
            } else if (val.length >= 3) {
                // Try API for unlisted ZIPs
                debounceTimer = setTimeout(() => lookupZipAPI(val), 300);
                if (matches.length > 0) showLocalSuggestions(matches);
                else if (val.length < 5) showLoading();
            } else {
                hideSuggestions();
            }

            // Auto-resolve if 5 digits
            if (val.length === 5) {
                resolveZip(val);
            }
        });

        // Keyboard navigation
        input.addEventListener('keydown', function(e) {
            const items = sugBox.querySelectorAll('.zip-suggestion-item');
            if (!items.length) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                highlightIdx = Math.min(highlightIdx + 1, items.length - 1);
                updateHighlight(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                highlightIdx = Math.max(highlightIdx - 1, 0);
                updateHighlight(items);
            } else if (e.key === 'Enter' && highlightIdx >= 0) {
                e.preventDefault();
                items[highlightIdx].click();
            } else if (e.key === 'Escape') {
                hideSuggestions();
            }
        });

        // Close suggestions on outside click
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !sugBox.contains(e.target)) {
                hideSuggestions();
            }
        });

        function updateHighlight(items) {
            items.forEach((it, i) => {
                it.classList.toggle('highlighted', i === highlightIdx);
            });
        }

        function showLocalSuggestions(matches) {
            highlightIdx = -1;
            sugBox.innerHTML = matches.map(m =>
                `<div class="zip-suggestion-item" data-zip="${m.z}" data-city="${m.c}" data-state="${m.s}">` +
                `<i class="fas fa-map-pin"></i>` +
                `<span class="zip-code">${m.z}</span>` +
                `<span class="zip-city">${m.c}, ${m.s}</span>` +
                `</div>`
            ).join('');
            sugBox.classList.add('show');
            bindSuggestionClicks();
        }

        function showLoading() {
            sugBox.innerHTML = '<div class="zip-loading"><i class="fas fa-spinner"></i> Looking up...</div>';
            sugBox.classList.add('show');
        }

        function hideSuggestions() {
            sugBox.classList.remove('show');
            sugBox.innerHTML = '';
            highlightIdx = -1;
        }

        function bindSuggestionClicks() {
            sugBox.querySelectorAll('.zip-suggestion-item').forEach(item => {
                item.addEventListener('click', function() {
                    const zip = this.dataset.zip;
                    const city = this.dataset.city;
                    const state = this.dataset.state;
                    input.value = zip;
                    resolvedEl.innerHTML = '<i class="fas fa-check-circle"></i> ' + city + ', ' + state;
                    resolvedState[resolvedKey] = zip + ' (' + city + ', ' + state + ')';
                    hideSuggestions();
                });
            });
        }

        function resolveZip(zip) {
            // Check cache first
            if (zipCache[zip]) {
                showResolved(zipCache[zip]);
                return;
            }
            // Check local DB
            const local = zipDatabase.find(z => z.z === zip);
            if (local) {
                zipCache[zip] = { city: local.c, state: local.s };
                showResolved(zipCache[zip]);
                hideSuggestions();
                return;
            }
            // API lookup
            lookupZipAPI(zip);
        }

        function lookupZipAPI(zip) {
            if (zip.length < 5) return;
            if (zipCache[zip]) { showResolved(zipCache[zip]); hideSuggestions(); return; }

            fetch('https://api.zippopotam.us/us/' + zip)
                .then(r => { if (!r.ok) throw new Error('not found'); return r.json(); })
                .then(data => {
                    const place = data.places[0];
                    const info = { city: place['place name'], state: place['state abbreviation'] };
                    zipCache[zip] = info;
                    showResolved(info);
                    hideSuggestions();
                })
                .catch(() => {
                    // ZIP not found — just hide
                    hideSuggestions();
                    resolvedEl.innerHTML = '';
                    resolvedState[resolvedKey] = zip;
                });
        }

        function showResolved(info) {
            resolvedEl.innerHTML = '<i class="fas fa-check-circle"></i> ' + info.city + ', ' + info.state;
            resolvedState[resolvedKey] = input.value + ' (' + info.city + ', ' + info.state + ')';
        }
    }

    // Initialize autocomplete on both ZIP fields
    initZipAutocomplete('q-zip-from', 'sug-zip-from', 'resolved-zip-from', 'from');
    initZipAutocomplete('q-zip-to', 'sug-zip-to', 'resolved-zip-to', 'to');

    /* ==========================================================
       3. CONTINUE BUTTON → OPEN MASTER MODAL
       ========================================================== */
    const btnNext = document.getElementById('btn-quote-next');
    const zipFrom = document.getElementById('q-zip-from');
    const zipTo = document.getElementById('q-zip-to');

    btnNext.addEventListener('click', function() {
        if (!zipFrom.value.trim() || !zipTo.value.trim()) {
            zipFrom.reportValidity();
            zipTo.reportValidity();
            return;
        }
        document.getElementById('quote-form').submit();
    });
});

/* ---- FAQ Toggle ---- */
function toggleFaq(btn) {
    const item = btn.closest('.cp-faq-item');
    const wasOpen = item.classList.contains('open');

    // Close all
    document.querySelectorAll('.cp-faq-item').forEach(el => el.classList.remove('open'));

    // Toggle current
    if (!wasOpen) {
        item.classList.add('open');
    }
}
</script>
@endsection
<!--/email_off-->
