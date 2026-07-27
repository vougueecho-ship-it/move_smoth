@extends('layouts.master')

@section('title', 'Browse Verified Moving Companies | MoveSmooth')
@section('meta_description', 'Discover and compare top moving companies nationwide. Filter by services, ratings, and locations to find your perfect moving partner.')

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
    "@@type": "SearchResultsPage",
    "@@id": "{{ url()->current() }}#searchpage",
    "url": "{{ url()->current() }}",
    "name": "Browse Verified Moving Companies | MoveSmooth",
    "description": "Discover and compare top moving companies nationwide. Filter by services, ratings, and locations to find your perfect moving partner."
}
</script>
@endsection

@section('custom_styles')
    <link href="{{ asset('css/pages/movers.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="movers-hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 text-white">Find Your Perfect Movers</h1>
        <p class="lead opacity-75">Browse {{ $companies->total() }} verified moving companies across the country.</p>
    </div>
</section>

<section class="filter-section">
    <div class="container">
        <div class="filter-card">
            <form action="{{ route('front.movers') }}" method="GET" class="row g-3">
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-start-0 py-3" placeholder="Search by name, city, or state..." value="{{ $q }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">SEARCH COMPANIES</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar-widget">
                    <h4>Filter by Service</h4>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="srv_local">
                        <label class="form-check-label small" for="srv_local">Local Moving</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="srv_inter">
                        <label class="form-check-label small" for="srv_inter">Interstate Moving</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="srv_comm">
                        <label class="form-check-label small" for="srv_comm">Commercial</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="srv_pack">
                        <label class="form-check-label small" for="srv_pack">Packing Services</label>
                    </div>
                </div>

                <div class="sidebar-widget bg-primary text-white">
                    <h4 class="text-white border-white-50">Need Help?</h4>
                    <p class="small opacity-75">Not sure which mover to choose? Our experts can help you compare quotes.</p>
                    <a href="{{ route('front.calculator') }}" class="btn btn-accent btn-sm w-100 fw-bold">GET FREE ESTIMATE</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="text-muted mb-0">Showing <strong>{{ $companies->firstItem() }}-{{ $companies->lastItem() }}</strong> of {{ $companies->total() }} results</p>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">Sort By: Recommended</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Highest Rated</a></li>
                            <li><a class="dropdown-item" href="#">Most Reviews</a></li>
                            <li><a class="dropdown-item" href="#">Newest</a></li>
                        </ul>
                    </div>
                </div>

                @forelse($companies as $company)
                <div class="mover-item-card">
                    <div class="d-flex flex-row">
                        <div class="mover-logo-box">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="img-fluid object-fit-contain">
                            @else
                                <div class="bg-primary text-white w-100 h-100 rounded-3 d-flex align-items-center justify-content-center fw-bold fs-3">{{ strtoupper(substr($company->name, 0, 2)) }}</div>
                            @endif
                        </div>
                        <div class="mover-info">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h3 class="h4 mb-1"><a href="{{ route('front.company.profile', $company->slug) }}" class="text-dark">{{ $company->name }}</a></h3>
                                    <div class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $company->city_name ?? $company->city }}, {{ $company->state->name ?? '' }}</div>
                                </div>
                                <div class="rating-badge"><i class="fas fa-star me-1"></i>{{ number_format($company->reviews_avg_rating ?? 0.0, 1) }}</div>
                            </div>
                            
                            <div class="mb-3 d-flex flex-wrap gap-1">
                                <span class="stat-pill text-success bg-success bg-opacity-10 border border-success border-opacity-20"><i class="fas fa-shield-check me-1"></i>Licensed</span>
                                <span class="stat-pill text-success bg-success bg-opacity-10 border border-success border-opacity-20"><i class="fas fa-file-invoice-dollar me-1"></i>Insured</span>
                                @php
                                    $servicesArray = explode(',', $company->service_type ?: 'local,long_distance');
                                @endphp
                                @foreach($servicesArray as $srv)
                                    @if($srv === 'local')
                                        <span class="stat-pill"><i class="fas fa-map-marker-alt me-1"></i>Local</span>
                                    @elseif($srv === 'long_distance')
                                        <span class="stat-pill"><i class="fas fa-route me-1"></i>Interstate</span>
                                    @elseif($srv === 'commercial')
                                        <span class="stat-pill"><i class="fas fa-building me-1"></i>Commercial</span>
                                    @elseif($srv === 'packing')
                                        <span class="stat-pill"><i class="fas fa-box me-1"></i>Packing</span>
                                    @elseif($srv === 'storage')
                                        <span class="stat-pill"><i class="fas fa-warehouse me-1"></i>Storage</span>
                                    @elseif($srv === 'residential')
                                        <span class="stat-pill"><i class="fas fa-home me-1"></i>Residential</span>
                                    @endif
                                @endforeach
                            </div>

                            <p class="text-muted small mb-4">{{ Str::limit($company->description, 160) }}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="verify-badge"><i class="fas fa-check-shield"></i> Verified Pro</div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('front.company.profile', $company->slug) }}" class="btn btn-outline-primary px-4 fw-bold">Profile</a>
                                    <button class="btn btn-primary px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Quote</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No companies found matching "{{ $q }}"</h4>
                    <p class="text-muted">Try adjusting your search filters or browse by state.</p>
                    <a href="{{ route('front.movers') }}" class="btn btn-primary mt-3">Clear Search</a>
                </div>
                @endforelse

                <div class="mt-5 d-flex justify-content-center">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
