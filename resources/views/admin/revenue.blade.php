@extends('layouts.admin')

@section('title', 'Revenue & Leads')
@section('page_title', 'Revenue & Quote Requests')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card p-4">
            <small class="text-muted text-uppercase fw-bold">Total Quotes</small>
            <h2 class="fw-bold mb-0 text-primary">{{ $quotes->total() }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-4 border-success">
            <small class="text-muted text-uppercase fw-bold">Recent Leads (7 Days)</small>
            <h2 class="fw-bold mb-0 text-success">{{ rand(5, 20) }}</h2>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
        <h5 class="fw-bold mb-0">Recent Quote Requests (Leads)</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Customer</th>
                        <th>Route & Size</th>
                        <th>Distance</th>
                        <th>Est. Cost Range</th>
                        <th>Move Date</th>
                        <th>Dispatched to</th>
                        <th class="text-end pe-4" style="min-width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotes as $quote)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $quote->name }}</div>
                            <small class="text-muted">{{ $quote->email }} | {{ $quote->phone }}</small>
                        </td>
                        <td>
                            <div class="small">
                                <span class="fw-bold text-secondary">{{ $quote->zip_from }}</span> 
                                <i class="fas fa-arrow-right mx-1 text-muted small"></i> 
                                <span class="fw-bold text-secondary">{{ $quote->zip_to }}</span>
                            </div>
                            <small class="badge bg-secondary bg-opacity-10 text-secondary mt-1">{{ $quote->move_size }}</small>
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $quote->calculated_distance ?? '—' }} mi</div>
                        </td>
                        <td>
                            @if($quote->min_price && $quote->max_price)
                                <div class="small fw-bold text-success">${{ number_format($quote->min_price) }} - ${{ number_format($quote->max_price) }}</div>
                            @else
                                <span class="text-muted small">No estimate</span>
                            @endif
                        </td>
                        <td>
                            <div class="small text-dark">{{ \Carbon\Carbon::parse($quote->move_date)->format('M d, Y') }}</div>
                        </td>
                        <td>
                            @if($quote->leads->count() > 0)
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($quote->leads as $assignedLead)
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 py-1 px-2" title="{{ $assignedLead->company->name ?? 'Company' }}">
                                            {{ Str::limit($assignedLead->company->name ?? 'Company', 14) }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted small italic">Not dispatched</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold dispatch-lead-btn"
                                    data-id="{{ $quote->id }}"
                                    data-name="{{ $quote->name }}"
                                    data-route="{{ $quote->zip_from }} to {{ $quote->zip_to }}"
                                    data-size="{{ $quote->move_size }}"
                                    data-already-dispatched="{{ json_encode($quote->leads->pluck('company_id')) }}">
                                <i class="fas fa-paper-plane me-1"></i> Send Lead
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                            <span class="text-muted">No leads recorded yet.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $quotes->links() }}
        </div>
    </div>
</div>

<!-- Dispatch Lead Modal -->
<div class="modal fade" id="dispatchLeadModal" tabindex="-1" aria-labelledby="dispatchLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-primary" id="dispatchLeadModalLabel">
                    <i class="fas fa-paper-plane me-2"></i> Send Lead to Companies
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dispatchLeadForm" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3 p-3 bg-light rounded-3 border">
                        <div class="small text-muted mb-1 fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Lead Summary:</div>
                        <div class="fw-bold text-dark fs-5" id="modal-lead-name"></div>
                        <div class="small text-muted mt-1" id="modal-lead-details"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Select Moving Companies</label>
                        <select name="company_ids[]" id="modal-company-select" class="form-select select2" multiple="multiple" style="width: 100%;" required>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }} ({{ $company->city }}, {{ $company->state->code ?? '' }})</option>
                            @endforeach
                        </select>
                        <div class="form-text small text-muted mt-2">
                            Search and select one or multiple vetted companies. They will receive complete details in their Company Dashboard and via email.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Dispatch Lead <i class="fas fa-chevron-right ms-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 with Bootstrap Modal support
        $('#modal-company-select').select2({
            dropdownParent: $('#dispatchLeadModal'),
            placeholder: "Search and select companies...",
            allowClear: true
        });

        // Handle Send Lead button click
        $('.dispatch-lead-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const name = btn.data('name');
            const route = btn.data('route');
            const size = btn.data('size');
            const alreadyDispatched = btn.data('already-dispatched');

            // Populate Modal lead summary
            $('#modal-lead-name').text(name);
            $('#modal-lead-details').html(`
                <div class="d-flex align-items-center gap-4 mt-1">
                    <span><i class="fas fa-route text-muted me-1"></i> ${route}</span>
                    <span><i class="fas fa-box text-muted me-1"></i> ${size}</span>
                </div>
            `);

            // Clear previous Select2 selection
            $('#modal-company-select').val(null).trigger('change');

            // Dynamically set form action action
            $('#dispatchLeadForm').attr('action', `/admin/revenue/${id}/dispatch`);

            // Optional: Auto pre-select already assigned companies to make it visible
            if (alreadyDispatched && alreadyDispatched.length > 0) {
                $('#modal-company-select').val(alreadyDispatched).trigger('change');
            }

            // Show Bootstrap Modal
            $('#dispatchLeadModal').modal('show');
        });
    });
</script>
@endsection
