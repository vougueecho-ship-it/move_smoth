@extends('layouts.master')

@section('title', $blog->title . ' | MoveSmooth Blog')
@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160))

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
            "name": "Blog",
            "item": "{{ route('front.blog') }}"
        },
        {
            "@@type": "ListItem",
            "position": 3,
            "name": "{{ addslashes($blog->title) }}",
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
    "@@type": "BlogPosting",
    "@@id": "{{ url()->current() }}#post",
    "headline": "{{ addslashes($blog->title) }}",
    "description": "{{ addslashes($blog->meta_description ?: Str::limit(strip_tags($blog->content), 160)) }}",
    "image": "{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/house-property.jpg') }}",
    "datePublished": "{{ $blog->created_at->toIso8601String() }}",
    "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
    "author": {
        "@@type": "Organization",
        "name": "MoveSmooth Editorial"
    },
    "publisher": {
        "@@type": "Organization",
        "@@id": "{{ url('/') }}#organization"
    }
}
</script>
@if($blog->faqs && $blog->faqs->count() > 0)
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        @foreach($blog->faqs->sortBy('order') as $faq)
        {
            "@@type": "Question",
            "name": "{{ addslashes($faq->question) }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ addslashes(strip_tags($faq->answer)) }}"
            }
        }@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endif
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/blog_detail.css') }}" rel="stylesheet">
@endsection

@section('content')
<header class="post-header">
    <div class="container text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-4 text-white fw-bold">{{ $blog->category->name ?? 'Moving Guide' }}</span>
        <h1 class="display-3 fw-800 mb-4 mx-auto" style="max-width: 900px;">{{ $blog->title }}</h1>
        <div class="post-meta justify-content-center">
            <div class="d-flex align-items-center gap-2">
                <i class="far fa-calendar-alt"></i>
                <span>{{ $blog->created_at->format('M d, Y') }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="far fa-clock"></i>
                <span>{{ $blog->reading_time ?? '8 Min Read' }}</span>
            </div>
        </div>
    </div>
</header>

<div class="container pb-5">
    <div class="post-img-hero animate__animated animate__fadeIn">
        @if($blog->featured_image)
            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-100" style="max-height: 600px; object-fit: cover;">
        @else
            <img src="{{ asset('images/house-property.jpg') }}" alt="Blog Hero" class="w-100" style="max-height: 600px; object-fit: cover;">
        @endif
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <article class="post-content">
                {!! $blog->content !!}
            </article>

            <div class="mt-5 pt-5 border-top d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Share this article:</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="share-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="share-btn"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="share-btn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            @if($blog->faqs && $blog->faqs->count() > 0)
            <div class="mt-5 pt-5 border-top">
                <h3 class="fw-800 text-primary mb-4"><i class="fas fa-question-circle me-2"></i> Frequently Asked Questions</h3>
                <div class="accordion blog-faq-accordion animate__animated animate__fadeIn" id="blogFaqAccordion">
                    @foreach($blog->faqs->sortBy('order') as $index => $faq)
                    <div class="accordion-item border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                        <h4 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem-{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h4>
                        <div id="faqItem-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#blogFaqAccordion">
                            <div class="accordion-body bg-white lh-lg text-muted">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="sidebar-author">
                <h5 class="fw-800 mb-4">About the Author</h5>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-weight: 800; font-size: 1.2rem;">MS</div>
                    <div>
                        <h6 class="fw-bold mb-0">MoveSmooth Editorial</h6>
                        <span class="text-muted small">Moving Experts</span>
                    </div>
                </div>
                <p class="text-muted small lh-lg">Our editorial team consists of relocation specialists who provide vetted data and expert advice to simplify your moving process.</p>
                
                <hr class="my-4">
                
                <h6 class="fw-800 mb-3">Newsletter</h6>
                <p class="extra-small text-muted mb-4">Get the latest moving tips delivered to your inbox.</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Posts -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="fw-800 mb-5">You might also like</h2>
        <div class="row g-4">
            @forelse($relatedBlogs as $rel)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    @if($rel->featured_image)
                        <img src="{{ asset('storage/' . $rel->featured_image) }}" class="card-img-top" alt="{{ $rel->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/moving-guide.jpg') }}" class="card-img-top" alt="{{ $rel->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body p-4">
                        <h6 class="fw-800 mb-0"><a href="{{ route('front.blog.detail', [$rel->category?->slug ?? 'uncategorized', $rel->slug]) }}" class="text-dark text-decoration-none">{{ $rel->title }}</a></h6>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('images/moving-guide.jpg') }}" class="card-img-top" alt="Related" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h6 class="fw-800 mb-0">10 Things to Pack Last During Your Move</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('images/about-story.jpg') }}" class="card-img-top" alt="Related" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h6 class="fw-800 mb-0">How to Hire Reliable Local Movers</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('images/moving-boxes.jpg') }}" class="card-img-top" alt="Related" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h6 class="fw-800 mb-0">Moving With Pets: A Stress-Free Guide</h6>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
