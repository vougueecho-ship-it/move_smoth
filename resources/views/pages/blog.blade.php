@extends('layouts.master')

@section('title', 'Moving Blog & Expert Relocation Guides | MoveSmooth')
@section('meta_description', 'Expert moving tips, cost-saving guides, and relocation advice from the industry pros at MoveSmooth. Make your next move your best move.')

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
            "name": "Moving Blog",
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
    "@@type": "CollectionPage",
    "@@id": "{{ url()->current() }}#blogpage",
    "url": "{{ url()->current() }}",
    "name": "Moving Blog & Expert Relocation Guides | MoveSmooth",
    "description": "Expert moving tips, cost-saving guides, and relocation advice from the industry pros at MoveSmooth. Make your next move your best move."
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/blog.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="blog-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-4 fw-bold mb-3">Moving <span class="text-primary">Insights</span></h1>
                <p class="lead text-muted mb-4">Your definitive guide to a stress-free relocation. Expert tips, city guides, and money-saving hacks.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('front.blog') }}" class="category-pill {{ !request()->has('category') ? 'active' : '' }}">All Posts</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('front.blog', ['category' => $cat->slug]) }}{{ request()->has('search') ? '&search=' . urlencode(request()->query('search')) : '' }}" 
                           class="category-pill {{ request()->query('category') === $cat->slug ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <form action="{{ route('front.blog') }}" method="GET" class="w-100">
                    @if(request()->has('category'))
                        <input type="hidden" name="category" value="{{ request()->query('category') }}">
                    @endif
                    <div class="input-group bg-white p-2 rounded-pill shadow-sm border">
                        <span class="input-group-text bg-transparent border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search articles..." value="{{ request()->query('search') }}">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <!-- Featured Post -->
    @if($blogs->currentPage() === 1 && $blogs->count() > 0 && !request()->has('search') && !request()->has('category'))
        @php $featured = $blogs->first(); @endphp
        <div class="featured-post animate__animated animate__fadeIn mb-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="featured-tag">FEATURED GUIDE</span>
                    <h2 class="display-5 fw-800 mb-4 text-white">{{ $featured->title }}</h2>
                    <p class="lead opacity-75 mb-5">{{ Str::limit(strip_tags($featured->content), 180) }}</p>
                    <div class="d-flex align-items-center gap-4">
                        <a href="{{ route('front.blog.detail', [$featured->category?->slug ?? 'uncategorized', $featured->slug]) }}" class="btn btn-accent btn-lg px-5 fw-800 rounded-pill">READ FULL GUIDE</a>
                        <span class="small opacity-50"><i class="far fa-clock me-1"></i> {{ $featured->reading_time ?? '8 Min Read' }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if($featured->featured_image)
                        <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}" class="img-fluid rounded-4 shadow-2xl" style="max-height: 380px; width: 100%; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/moving-boxes.jpg') }}" alt="Moving Boxes" class="img-fluid rounded-4 shadow-2xl">
                    @endif
                </div>
            </div>
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.03); border-radius: 50%;"></div>
        </div>
    @endif

    <!-- Blog Grid -->
    <div class="row g-4">
        @forelse($blogs as $index => $blog)
            @if($blogs->currentPage() === 1 && $index === 0 && !request()->has('search') && !request()->has('category'))
                @continue
            @endif
            <div class="col-lg-4 col-md-6">
                <article class="blog-card">
                    <div class="blog-img-container">
                        <span class="blog-badge">{{ $blog->category->name ?? 'Relocation' }}</span>
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="blog-img" style="height: 240px; object-fit: cover; width: 100%;">
                        @else
                            <img src="{{ asset('images/house-property.jpg') }}" alt="Blog Post" class="blog-img" style="height: 240px; object-fit: cover; width: 100%;">
                        @endif
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><a href="{{ route('front.blog.detail', [$blog->category?->slug ?? 'uncategorized', $blog->slug]) }}">{{ $blog->title }}</a></h3>
                        <p class="text-muted small mb-0">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                        
                        <div class="blog-meta">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.6rem; font-weight: 800;">MS</div>
                                <span class="fw-bold text-dark">MoveSmooth Team</span>
                            </div>
                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="mb-4"><i class="fas fa-pen-nib fa-3x text-muted"></i></div>
                <h4 class="text-muted">No posts found matching your criteria.</h4>
                <p class="text-muted">Check back soon or try another search term!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>

<section class="section-padding bg-light mt-5">
    <div class="container">
        <div class="card bg-primary text-white rounded-4 p-5 overflow-hidden position-relative">
            <div class="row align-items-center position-relative z-index-1">
                <div class="col-lg-8">
                    <h2 class="fw-800 mb-3">Never Miss a Moving Hack</h2>
                    <p class="lead opacity-75 mb-0">Join 50,000+ subscribers who get our best moving tips and exclusive mover discounts every week.</p>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
                    <div class="input-group">
                        <input type="email" class="form-control py-3 px-4" placeholder="Your email address">
                        <button class="btn btn-accent px-4 fw-800">SUBSCRIBE</button>
                    </div>
                </div>
            </div>
            <i class="fas fa-envelope-open-text position-absolute" style="right: -30px; bottom: -30px; font-size: 15rem; opacity: 0.05;"></i>
        </div>
    </div>
</section>
@endsection
