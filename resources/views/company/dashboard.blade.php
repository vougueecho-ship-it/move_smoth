@extends('layouts.master')

@section('title', 'Company Dashboard | MoveSmooth')

@section('custom_styles')
<style>
    .sidebar { background: #f8fafc; min-height: 100vh; border-right: 1px solid #e2e8f0; }
    .nav-link { color: #64748b; font-weight: 500; padding: 0.8rem 1.5rem; }
    .nav-link:hover { background: #f1f5f9; color: var(--primary); }
    .nav-link.active { background: #e2e8f0; color: var(--primary); }
    .stat-card { border: none; border-radius: 12px; transition: transform 0.2s; }
    .stat-card:hover { transform: translateY(-5px); }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
            <div class="position-sticky pt-3">
                <div class="px-4 mb-4">
                    <h5 class="fw-bold text-primary">{{ $company->name ?? 'My Company' }}</h5>
                    <span class="badge bg-success">Verified Partner</span>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('company.dashboard') }}"><i class="fas fa-home me-2"></i> Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.leads') }}"><i class="fas fa-user-friends me-2"></i> Leads</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.reviews') }}"><i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.profile') }}"><i class="fas fa-building me-2"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.analytics') }}"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.billing') }}"><i class="fas fa-credit-card me-2"></i> Billing</a></li>
                    <li class="nav-item mt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Overview</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('front.company.profile', $company->slug) }}" class="btn btn-sm btn-outline-primary" target="_blank">View Public Profile</a>
                </div>
            </div>

            <!-- Stats -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card stat-card shadow-sm bg-white p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Leads</h6>
                                <h2 class="fw-bold mb-0">{{ $leadsCount }}</h2>
                            </div>
                            <div class="bg-primary text-white rounded-circle p-3"><i class="fas fa-users fs-4"></i></div>
                        </div>
                        <div class="mt-3 small text-success"><i class="fas fa-arrow-up"></i> 12% increase</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card shadow-sm bg-white p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Reviews</h6>
                                <h2 class="fw-bold mb-0">{{ $reviewsCount }}</h2>
                            </div>
                            <div class="bg-accent text-white rounded-circle p-3"><i class="fas fa-star fs-4"></i></div>
                        </div>
                        <div class="mt-3 small text-muted">Average Rating: {{ $company->averageRating() }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card shadow-sm bg-white p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Profile Views</h6>
                                <h2 class="fw-bold mb-0">{{ rand(100, 500) }}</h2>
                            </div>
                            <div class="bg-info text-white rounded-circle p-3"><i class="fas fa-eye fs-4"></i></div>
                        </div>
                        <div class="mt-3 small text-success"><i class="fas fa-arrow-up"></i> 5% this week</div>
                    </div>
                </div>
            </div>

            <!-- Recent Leads -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0">Recent Leads</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Customer</th>
                                    <th>Move From/To</th>
                                    <th>Date</th>
                                    <th>Size</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $recentLeads = \App\Models\Lead::where('company_id', $company->id)->latest()->take(5)->get(); @endphp
                                @forelse($recentLeads as $lead)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">{{ $lead->name }}</div>
                                        <div class="small text-muted">{{ $lead->email }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $lead->zip_from }}</span>
                                        <i class="fas fa-arrow-right mx-2 text-muted small"></i>
                                        <span class="badge bg-light text-dark border">{{ $lead->zip_to }}</span>
                                    </td>
                                    <td>{{ $lead->move_date ? $lead->move_date->format('M d, Y') : 'TBD' }}</td>
                                    <td>{{ $lead->move_size }}</td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="btn btn-sm btn-primary">View Details</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No leads found yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
