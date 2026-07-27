@extends('layouts.master')

@section('title', 'Rate ' . $company->name . ' | Leave a Review | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('custom_styles')
    <link href="{{ asset('css/pages/review_form.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="review-form-page">
    <div class="container">
        <div class="form-card animate__animated animate__fadeIn">
            <div class="text-center mb-5">
                <div class="d-flex justify-content-center mb-4">
                    <div class="shadow-sm border" style="width: 90px; height: 90px; background: #ffffff; border-radius: 16px; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 8px;">
                        @if($company->logo_url)
                            <img src="{{ $company->logo_url }}" alt="{{ $company->name }} Logo" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        @else
                            <div class="fw-bold text-primary" style="font-size: 1.8rem; font-family: 'Outfit', sans-serif;">
                                {{ strtoupper(substr($company->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                </div>
                <h1 class="fw-800">Review {{ $company->name }}</h1>
                <p class="text-muted">Your feedback helps thousands of people move with confidence.</p>
            </div>

            <form action="{{ route('front.review.store', $company->slug) }}" method="POST">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}">
                
                <!-- Star Rating -->
                <div class="mb-5">
                    <label class="form-label d-block text-center mb-3">Overall Satisfaction</label>
                    <div class="star-rating justify-content-center">
                        <input type="radio" id="star5" name="rating" value="5" required/><label for="star5" title="Amazing"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Good"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Average"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Poor"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Bad"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Review Headline</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Professional crew and timely delivery" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tell us about your move</label>
                        <textarea name="comment" class="form-control" rows="6" placeholder="Share the details of your experience..." required></textarea>
                    </div>
                </div>

                <div class="p-4 bg-light rounded-4 mb-5">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="verifyCheck" required>
                        <label class="form-check-label small text-muted" for="verifyCheck">
                            I certify that this review is based on my own genuine experience and that I have no personal or business affiliation with this company.
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-800 rounded-pill shadow-lg">SUBMIT VERIFIED REVIEW</button>
            </form>
        </div>
    </div>
</div>
@endsection
