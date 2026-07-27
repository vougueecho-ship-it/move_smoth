@extends('layouts.master')

@section('title', 'My Billing | MoveSmooth')

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
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.analytics') }}"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Billing & Subscription</h1>
            </div>

            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="fw-bold text-primary">Current Plan</h5>
                <p class="text-muted">You are currently on the **Free Directory Listing Plan**.</p>
                <div class="mt-3">
                    <button class="btn btn-primary" disabled><i class="fas fa-arrow-up"></i> Upgrade to Premium Partner</button>
                </div>
            </div>

            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold mb-3 text-dark">Invoice History</h5>
                <div class="text-center py-4">
                    <p class="text-muted small mb-0">No invoices generated yet.</p>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
