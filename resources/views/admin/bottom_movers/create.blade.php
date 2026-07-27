@extends('layouts.admin')

@section('title', 'Add Bottom Mover | Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h4 class="fw-bold mb-0 text-primary"><i class="fas fa-list-ol text-success me-2"></i> Add Company to Bottom Movers</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.bottom-movers.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-bold">Select Moving Company <span class="text-danger">*</span></label>
                            <select name="company_id" class="form-select select2" required data-placeholder="Choose a company...">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->name }} ({{ $company->city }}, {{ $company->state->code ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text text-muted small">Only companies that are NOT currently bottom movers are listed above.</div>
                            @error('company_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Sort Order (Optional)</label>
                            <input type="number" name="order" class="form-control" placeholder="e.g. 0, 1, 2" value="0">
                            <div class="form-text text-muted small">Lower numbers display first.</div>
                            @error('order')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Map to State Pages (Select Multiple)</label>
                        <select name="states[]" class="form-select select2-multiple" multiple="multiple" data-placeholder="Select states...">
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->code }})</option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted small">Select all states where this company should appear as a bottom mover.</div>
                        @error('states')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Map to City Pages (Select Multiple)</label>
                        <select name="cities[]" class="form-select select2-multiple" multiple="multiple" data-placeholder="Select cities...">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}, {{ $city->state->code ?? '' }}</option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted small">Select all cities where this company should appear as a bottom mover.</div>
                        @error('cities')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">In-Depth Review & Collapsible Accordion (HTML via TinyMCE)</label>
                        <textarea name="content" class="form-control tinymce" rows="15">
<div class="accordion" id="moverAcc-__ID__">
    <!-- Accordion 1: Pros & Cons -->
    <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm" style="border: 1px solid #e2e8f0 !important; border-radius: 10px !important;">
        <h5 class="accordion-header">
            <button class="accordion-button collapsed fw-bold text-primary" style="font-size: 0.82rem; padding: 12px 18px; background: #f8fafc;" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePros-__ID__">
                Pros And Cons
            </button>
        </h5>
        <div id="collapsePros-__ID__" class="accordion-collapse collapse" data-bs-parent="#moverAcc-__ID__">
            <div class="accordion-body p-3 bg-white">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <h6 class="fw-bold text-success small mb-2"><i class="fas fa-thumbs-up me-1"></i> Pros</h6>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-1"><i class="fas fa-check text-success me-1"></i> Fully licensed, insured & USDOT/FMCSA registered</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-1"></i> Clear, transparent hourly rates & zero hidden fees</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-1"></i> Highly trained, drug-tested & background-checked crew</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-danger small mb-2"><i class="fas fa-thumbs-down me-1"></i> Cons</h6>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-1"><i class="fas fa-times text-danger me-1"></i> Rates can be elevated during peak summer weekends</li>
                            <li class="mb-1"><i class="fas fa-times text-danger me-1"></i> Requires advance reservations during peak season</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accordion 2: Estimated Costs -->
    <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm" style="border: 1px solid #e2e8f0 !important; border-radius: 10px !important;">
        <h5 class="accordion-header">
            <button class="accordion-button collapsed fw-bold text-primary" style="font-size: 0.82rem; padding: 12px 18px; background: #f8fafc;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCost-__ID__">
                Estimated Costs
            </button>
        </h5>
        <div id="collapseCost-__ID__" class="accordion-collapse collapse" data-bs-parent="#moverAcc-__ID__">
            <div class="accordion-body p-3 bg-white text-muted small" style="line-height: 1.75;">
                A typical local relocation with this mover generally ranges from <strong>$140 to $220 per hour</strong>, depending on the crew size and total packing requirements. For long-distance moves crossing state lines, rates range from <strong>$1,800 to $4,500</strong> based on total shipment weight and transport mileage. Request a free estimate above to secure binding written rates.
            </div>
        </div>
    </div>
</div>
                        </textarea>
                        <div class="form-text text-muted small">TinyMCE handles formatting. Note: <strong>__ID__</strong> in the template will be automatically replaced with the mover's ID in the frontend to make the accordions work. Do not change the classes/styles.</div>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="border-top pt-3 text-end">
                        <a href="{{ route('admin.bottom-movers') }}" class="btn btn-outline-secondary px-4 me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save me-2"></i> Add Mover</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });
    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: function() {
            return $(this).data('placeholder');
        }
    });
});
</script>
@endsection
