@extends('layouts.master')

@section('title', 'My Reviews | MoveSmooth')

@section('custom_styles')
<style>
    .sidebar { background: #f8fafc; min-height: 100vh; border-right: 1px solid #e2e8f0; }
    .nav-link { color: #64748b; font-weight: 500; padding: 0.8rem 1.5rem; }
    .nav-link:hover { background: #f1f5f9; color: var(--primary); }
    .nav-link.active { background: #e2e8f0; color: var(--primary); }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
            <div class="position-sticky pt-3">
                <div class="px-4 mb-4">
                    <h5 class="fw-bold text-primary">{{ Auth::user()->company->name ?? 'My Company' }}</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.dashboard') }}"><i class="fas fa-home me-2"></i> Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.leads') }}"><i class="fas fa-user-friends me-2"></i> Leads</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('company.reviews') }}"><i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.profile') }}"><i class="fas fa-building me-2"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.analytics') }}"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Customer Reviews</h1>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Reviewer</th>
                                    <th>Rating</th>
                                    <th>Title & Comment</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Date Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reviews as $review)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $review->name }}</div>
                                        <div class="text-muted small">{{ $review->email }}</div>
                                    </td>
                                    <td>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($review->rating >= $i)
                                                    <i class="fas fa-star"></i>
                                                @elseif($review->rating >= ($i - 0.5))
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-1 small text-muted">({{ number_format($review->rating, 1) }})</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $review->title }}</div>
                                        <p class="text-muted small mb-0 lh-base" style="max-width: 450px;">{{ $review->comment }}</p>
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'approved' => 'bg-success',
                                                'pending' => 'bg-warning text-dark',
                                                'spam' => 'bg-danger'
                                            ][$review->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($review->status) }}</span>
                                    </td>
                                    <td class="text-end pe-4 small text-muted">{{ $review->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="far fa-star fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No reviews found yet</h5>
                                        <p class="text-muted small">Share your profile link to gather reviews from customers!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                {{ $reviews instanceof \Illuminate\Pagination\LengthAwarePaginator ? $reviews->links() : '' }}
            </div>
        </main>
    </div>
</div>
@endsection
