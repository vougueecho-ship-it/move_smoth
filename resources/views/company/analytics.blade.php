@extends('layouts.master')

@section('title', 'My Analytics | MoveSmooth')

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
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.reviews') }}"><i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.profile') }}"><i class="fas fa-building me-2"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('company.analytics') }}"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Company Analytics</h1>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-4">
                        <h6 class="text-muted text-uppercase small font-weight-bold">Profile Views</h6>
                        <h2 class="display-5 fw-bold text-primary">1,248</h2>
                        <span class="text-success small"><i class="fas fa-arrow-up"></i> +12% this month</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-4">
                        <h6 class="text-muted text-uppercase small font-weight-bold">Lead Conversions</h6>
                        <h2 class="display-5 fw-bold text-success">38%</h2>
                        <span class="text-success small"><i class="fas fa-arrow-up"></i> +4% this month</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-4">
                        <h6 class="text-muted text-uppercase small font-weight-bold">Review Score</h6>
                        <h2 class="display-5 fw-bold text-warning">4.8</h2>
                        <span class="text-muted small">Based on customer ratings</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 p-4 text-center py-5">
                <i class="fas fa-chart-line fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Analytics reports are currently being compiled</h5>
                <p class="text-muted small">Detailed graph distributions of your leads and view conversions will appear here.</p>
            </div>
        </main>
    </div>
</div>
@endsection
