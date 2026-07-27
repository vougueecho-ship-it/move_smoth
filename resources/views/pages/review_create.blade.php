@extends('layouts.master')

@section('title', 'Write a Moving Review | Share Your Experience | MoveSmooth')
@section('meta_description', 'Help others find the best movers by sharing your recent relocation experience. Rate your moving company and provide valuable feedback.')

@section('custom_styles')
    <link href="{{ asset('css/pages/review_create.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="review-hero">
    <div class="container">
        <h1 class="display-4 fw-800 mb-3">Share Your <span class="text-primary">Experience</span></h1>
        <p class="lead text-muted">Select the moving company you used to start your review.</p>
    </div>
</section>

<div class="container">
    <div class="search-container">
        <div class="input-group input-group-lg bg-white shadow-lg rounded-pill p-2 border">
            <span class="input-group-text bg-transparent border-0"><i class="fas fa-search text-muted"></i></span>
            <input type="text" class="form-control border-0 shadow-none" placeholder="Search for your moving company...">
            <button class="btn btn-primary rounded-pill px-5 fw-bold">FIND MOVER</button>
        </div>
    </div>

    <div class="row g-4 mb-5">
        @forelse($companies as $company)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="company-selection-card">
                <div class="company-logo-circle">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="w-100 h-100 object-fit-contain rounded-circle">
                    @else
                        {{ strtoupper(substr($company->name, 0, 2)) }}
                    @endif
                </div>
                <h5 class="fw-bold mb-3">{{ $company->name }}</h5>
                <a href="{{ route('front.review.form', $company->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold">WRITE REVIEW</a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No companies found. Try searching by name.</p>
        </div>
        @endforelse
    </div>
    
    <div class="mt-5 d-flex justify-content-center">
        {{ $companies->links() }}
    </div>
</div>

<section class="section-padding bg-light mt-5">
    <div class="container text-center">
        <h2 class="fw-800 mb-4">Can't find your mover?</h2>
        <p class="text-muted mb-5">If your moving company isn't listed, you can suggest them to our directory.</p>
        <a href="{{ route('front.contact') }}" class="btn btn-primary px-5 py-3 fw-bold rounded-pill">SUGGEST A COMPANY</a>
    </div>
</section>
@endsection
