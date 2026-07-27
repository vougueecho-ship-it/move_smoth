@extends('layouts.admin')

@section('title', 'Top Movers Management')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-crown text-warning me-2"></i> Top Movers Management</h1>
    <a href="{{ route('admin.top-movers.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-1"></i> Add Top Mover</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <p class="text-muted small">Companies added here will show inside the featured **Top 3 Movers Cards** at the top of their respective State pages and selected City pages.</p>
        
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search top movers by company, city, state..." id="adminTopMoverSearch">
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>City / Base State</th>
                        <th>Mapped States & Cities</th>
                        <th>Card Badge & Highlights</th>
                        <th>Sort Order</th>
                        <th>Rating</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topMovers as $mover)
                    <tr>
                        <td class="fw-bold text-dark">
                            @if($mover->company->logo)
                                <img src="{{ asset('storage/' . $mover->company->logo) }}" alt="Logo" class="rounded me-2" style="height: 30px; width: 30px; object-fit: contain; background: #f8fafc;">
                            @endif
                            {{ $mover->company->name ?? 'N/A' }}
                        </td>
                        <td>{{ $mover->company->city ?? 'N/A' }}, {{ $mover->company->state->code ?? '' }}</td>
                        <td>
                            @if($mover->states->count() > 0)
                                <div class="mb-1">
                                    <span class="small fw-bold text-muted d-block" style="font-size: 0.72rem;">STATES:</span>
                                    @foreach($mover->states as $st)
                                        <span class="badge bg-primary me-1" style="font-size: 0.72rem;">{{ $st->code }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($mover->cities->count() > 0)
                                <div>
                                    <span class="small fw-bold text-muted d-block" style="font-size: 0.72rem;">CITIES:</span>
                                    @foreach($mover->cities as $ct)
                                        <span class="badge bg-info text-dark me-1" style="font-size: 0.72rem;">{{ $ct->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($mover->states->count() == 0 && $mover->cities->count() == 0)
                                <span class="text-muted small">None (Draft)</span>
                            @endif
                        </td>
                        <td>
                            @if($mover->badge)
                                <span class="badge bg-warning text-dark mb-1 d-inline-block">{{ $mover->badge }}</span>
                            @endif
                            <ul class="list-unstyled mb-0 text-muted small" style="font-size: 0.78rem;">
                                <li><i class="fas fa-check text-success me-1"></i> {{ $mover->heading_1 ?? 'Nationwide Network' }}</li>
                                <li><i class="fas fa-check text-success me-1"></i> {{ $mover->heading_2 ?? 'Customer Satisfaction Guarantee' }}</li>
                                <li><i class="fas fa-check text-success me-1"></i> {{ $mover->heading_3 ?? 'Dedicated Cargo Support' }}</li>
                            </ul>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $mover->order }}</span>
                        </td>
                        <td>
                            <span class="text-warning"><i class="fas fa-star me-1"></i>{{ number_format($mover->company->reviews_avg_rating ?? 0.0, 1) }}</span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.top-movers.edit', $mover->id) }}" class="btn btn-sm btn-outline-primary me-2 rounded"><i class="fas fa-edit me-1"></i> Edit</a>
                                <form action="{{ route('admin.top-movers.delete', $mover->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this company from Top Movers?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded"><i class="fas fa-trash-alt me-1"></i> Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-crown fa-2x mb-2 text-black-50"></i>
                            <p class="mb-0">No companies registered as Top Movers yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($topMovers instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $topMovers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
