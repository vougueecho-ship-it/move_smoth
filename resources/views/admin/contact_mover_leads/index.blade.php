@extends('layouts.admin')

@section('title', 'Contact Mover Leads')
@section('page_title', 'Contact Mover Direct Leads')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card p-4">
            <small class="text-muted text-uppercase fw-bold">Total Direct Leads</small>
            <h2 class="fw-bold mb-0 text-primary">{{ $leads->total() }}</h2>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
        <h5 class="fw-bold mb-0">Direct Company Lead Entries</h5>
    </div>
    <div class="card-body p-0">
        <div class="px-4 pt-3 pb-2">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search leads by company, customer, route, email..." id="adminLeadSearch">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Mover Destination</th>
                        <th>Customer Details</th>
                        <th>Route & Size</th>
                        <th>Move Date</th>
                        <th>Date Submitted</th>
                        <th class="text-end pe-4" style="min-width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                    <tr>
                        <td class="ps-4">
                            @if($lead->company)
                                <div class="fw-bold text-primary">{{ $lead->company->name }}</div>
                                <small class="text-muted">{{ $lead->company->city }}, {{ $lead->company->state->code ?? '' }}</small>
                            @else
                                <span class="text-muted">Deleted Company</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $lead->name }}</div>
                            <small class="text-muted">{{ $lead->email }} | {{ $lead->phone }}</small>
                        </td>
                        <td>
                            <div class="small">
                                <span class="fw-bold text-secondary">{{ $lead->move_from }}</span> 
                                <i class="fas fa-arrow-right mx-1 text-muted small"></i> 
                                <span class="fw-bold text-secondary">{{ $lead->move_to }}</span>
                            </div>
                            <small class="badge bg-secondary bg-opacity-10 text-secondary mt-1">{{ $lead->move_size }}</small>
                        </td>
                        <td>
                            <div class="small text-dark">
                                @if($lead->move_date instanceof \DateTimeInterface)
                                    {{ $lead->move_date->format('M d, Y') }}
                                @else
                                    {{ date('M d, Y', strtotime($lead->move_date)) }}
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="small text-muted">{{ $lead->created_at->format('M d, Y H:i') }}</div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary px-3 rounded-pill fw-bold view-lead-btn"
                                        data-id="{{ $lead->id }}">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </button>
                                <form action="{{ route('admin.contact-mover-leads.delete', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger px-3 rounded-pill fw-bold">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                            <span class="text-muted">No direct company leads recorded yet.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $leads->links() }}
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewLeadModal" tabindex="-1" aria-labelledby="viewLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom pb-3 pt-4 px-4">
                <h5 class="modal-title fw-bold text-primary" id="viewLeadModalLabel">
                    <i class="fas fa-paper-plane me-2"></i> Lead Submission Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <!-- General Details -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-secondary border-bottom pb-2">Customer Details</h6>
                        <table class="table table-borderless table-sm small">
                            <tr>
                                <td class="fw-bold text-muted" style="width: 35%;">Name:</td>
                                <td id="detail-name" class="fw-semibold"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted">Email:</td>
                                <td id="detail-email" class="fw-semibold"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted">Phone:</td>
                                <td id="detail-phone" class="fw-semibold"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted">Submitted:</td>
                                <td id="detail-submitted" class="fw-semibold"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-secondary border-bottom pb-2">Mover & Logistics</h6>
                        <table class="table table-borderless table-sm small">
                            <tr>
                                <td class="fw-bold text-muted" style="width: 35%;">Mover:</td>
                                <td id="detail-company" class="fw-bold text-primary"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted">From:</td>
                                <td id="detail-from" class="fw-semibold"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted">To:</td>
                                <td id="detail-to" class="fw-semibold"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted">Move Date:</td>
                                <td id="detail-date" class="fw-semibold"></td>
                            </tr>
                        </table>
                    </div>
                    <!-- Extra Parameters -->
                    <div class="col-12 mt-2">
                        <h6 class="fw-bold text-secondary border-bottom pb-2">Quote Parameters</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <small class="text-muted d-block fw-semibold mb-1">Move Size</small>
                                    <span id="detail-size" class="fw-bold text-dark"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <small class="text-muted d-block fw-semibold mb-1">Rooms</small>
                                    <span id="detail-rooms" class="fw-bold text-dark"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <small class="text-muted d-block fw-semibold mb-1">Packing</small>
                                    <span id="detail-packing" class="fw-bold text-dark"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light p-3 rounded text-center">
                                    <small class="text-muted d-block fw-semibold mb-1">Storage</small>
                                    <span id="detail-storage" class="fw-bold text-dark"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Message -->
                    <div class="col-12">
                        <h6 class="fw-bold text-secondary border-bottom pb-2">Customer Message</h6>
                        <div class="bg-light p-3 rounded border text-muted fs-7" style="white-space: pre-wrap; min-height: 80px;" id="detail-message"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top pb-4 pt-3 px-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.view-lead-btn').on('click', function() {
            const id = $(this).data('id');

            // Fetch lead details via AJAX
            $.ajax({
                url: `/admin/contact-mover-leads/${id}`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const lead = response.lead;
                        const dateFormatted = new Date(lead.move_date).toLocaleDateString('en-US', {
                            year: 'numeric', month: 'short', day: 'numeric'
                        });
                        const createdFormatted = new Date(lead.created_at).toLocaleString('en-US');

                        // Fill modal
                        $('#detail-name').text(lead.name);
                        $('#detail-email').text(lead.email);
                        $('#detail-phone').text(lead.phone);
                        $('#detail-submitted').text(createdFormatted);
                        
                        $('#detail-company').text(response.company_name);
                        $('#detail-from').text(lead.move_from);
                        $('#detail-to').text(lead.move_to);
                        $('#detail-date').text(dateFormatted);

                        $('#detail-size').text(lead.move_size);
                        $('#detail-rooms').text(lead.num_rooms || 'N/A');
                        $('#detail-packing').text(lead.packing_service || 'N/A');
                        $('#detail-storage').text(lead.storage_option || 'N/A');

                        $('#detail-message').text(lead.message || 'No special instructions provided.');

                        // Show Modal
                        $('#viewLeadModal').modal('show');
                    } else {
                        alert('Unable to load lead details.');
                    }
                },
                error: function() {
                    alert('Error retrieving lead information.');
                }
            });
        });
    });
</script>
@endsection
