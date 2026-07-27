@extends('layouts.master')

@section('title', 'My Leads | MoveSmooth')

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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('company.leads') }}"><i class="fas fa-user-friends me-2"></i> Leads</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.reviews') }}"><i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.profile') }}"><i class="fas fa-building me-2"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.analytics') }}"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Leads Management</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <i class="fas fa-calendar me-1"></i> This Month
                    </button>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Customer Name</th>
                                    <th>Contact Information</th>
                                    <th>Move Details</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Date Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leads as $lead)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">{{ $lead->name }}</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-2 text-muted small"></i>{{ $lead->email }}</div>
                                        <div><i class="fas fa-phone me-2 text-muted small"></i>{{ $lead->phone }}</div>
                                    </td>
                                    <td>
                                        <div class="small fw-medium">From: {{ $lead->zip_from }}</div>
                                        <div class="small fw-medium">To: {{ $lead->zip_to }}</div>
                                        <div class="small text-muted">Date: {{ $lead->move_date ? $lead->move_date->format('M d, Y') : 'TBD' }}</div>
                                    </td>
                                    <td><span class="badge bg-info text-white">{{ $lead->move_size }}</span></td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'new' => 'bg-warning text-dark',
                                                'contacted' => 'bg-primary',
                                                'quoted' => 'bg-success',
                                                'lost' => 'bg-danger'
                                            ][$lead->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($lead->status) }}</span>
                                    </td>
                                    <td class="text-end pe-4 small text-muted">{{ $lead->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <img src="https://illustrations.popsy.co/slate/waiting-for-customer.svg" alt="No leads" style="height: 150px;" class="mb-3">
                                        <h5 class="text-muted">No leads found yet</h5>
                                        <p class="text-muted small">Promote your profile to get more leads!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                {{ $leads->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
