@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Companies</h6>
                    <h3 class="fw-bold mb-0">{{ $companiesCount ?? 0 }}</h3>
                </div>
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                    <i class="fas fa-building fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-left-color: #10B981;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Pending Approvals</h6>
                    <h3 class="fw-bold mb-0">{{ $pendingCompanies ?? 0 }}</h3>
                </div>
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle">
                    <i class="fas fa-clock fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-left-color: #F59E0B;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Reviews</h6>
                    <h3 class="fw-bold mb-0">{{ $reviewsCount ?? 0 }}</h3>
                </div>
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                    <i class="fas fa-star fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-left-color: #8B5CF6;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Quote Requests</h6>
                    <h3 class="fw-bold mb-0">{{ $quotesCount ?? 0 }}</h3>
                </div>
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle">
                    <i class="fas fa-file-invoice-dollar fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold">Recent Quote Requests</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Est. Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentQuotes ?? [] as $quote)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $quote->name }}</div>
                                    <div class="small text-muted">{{ $quote->email }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $quote->zip_from }}</span> 
                                    <i class="fas fa-arrow-right text-muted mx-1" style="font-size:0.8em"></i> 
                                    <span class="badge bg-light text-dark border">{{ $quote->zip_to }}</span>
                                </td>
                                <td>{{ $quote->created_at->format('M d, Y') }}</td>
                                <td class="text-success fw-bold">${{ number_format($quote->min_price) }} - ${{ number_format($quote->max_price) }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">No recent quotes found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold">Newly Registered Companies</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($recentCompanies ?? [] as $company)
                    <li class="list-group-item p-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded p-2 me-3">
                                <i class="fas fa-building text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $company->name }}</h6>
                                <small class="text-muted">{{ $company->city }}, {{ $company->state->code ?? '' }}</small>
                            </div>
                            @if($company->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item text-center py-4 text-muted">No recent companies found.</li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer bg-white text-center border-top">
                <a href="{{ route('admin.companies') }}" class="btn btn-sm btn-outline-primary">View All Companies</a>
            </div>
        </div>
    </div>
</div>
@endsection
