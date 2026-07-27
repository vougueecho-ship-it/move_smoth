@extends('layouts.admin')

@section('title', 'Add Top Mover | Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h4 class="fw-bold mb-0 text-primary"><i class="fas fa-crown text-warning me-2"></i> Add Company to Top Movers</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.top-movers.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Moving Company <span class="text-danger">*</span></label>
                        <select name="company_id" class="form-select select2" required data-placeholder="Choose a company...">
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->name }} ({{ $company->city }}, {{ $company->state->code ?? '' }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted small">Only companies that are NOT currently top movers are listed above.</div>
                        @error('company_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Custom Card Badge (Optional)</label>
                            <input type="text" name="badge" class="form-control" placeholder="e.g. Best for Quality Moves" value="{{ old('badge') }}">
                            <div class="form-text text-muted small">Text shown in the pill at the top of the card.</div>
                            @error('badge')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sort Order (Optional)</label>
                            <input type="number" name="order" class="form-control" placeholder="e.g. 0, 1, 2" value="0">
                            <div class="form-text text-muted small">Lower numbers display first.</div>
                            @error('order')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card border bg-light mb-4 rounded-3 p-3">
                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-list-check me-2"></i> Mover Bullet Highlights (3 Headings for Cards)</h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Highlight 1 <span class="text-danger">*</span></label>
                            <input type="text" name="heading_1" class="form-control form-control-sm" placeholder="e.g. Nationwide Network" value="{{ old('heading_1', 'Nationwide Network') }}" required>
                            @error('heading_1')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Highlight 2 <span class="text-danger">*</span></label>
                            <input type="text" name="heading_2" class="form-control form-control-sm" placeholder="e.g. Customer Satisfaction Guarantee" value="{{ old('heading_2', 'Customer Satisfaction Guarantee') }}" required>
                            @error('heading_2')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-0">
                            <label class="form-label fw-bold small">Highlight 3 <span class="text-danger">*</span></label>
                            <input type="text" name="heading_3" class="form-control form-control-sm" placeholder="e.g. Dedicated Cargo Support" value="{{ old('heading_3', 'Dedicated Cargo Support') }}" required>
                            @error('heading_3')
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
                        <div class="form-text text-muted small">Select all states where this company should appear as a top featured mover.</div>
                        @error('states')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Map to City Pages (Select Multiple)</label>
                        <select name="cities[]" class="form-select select2-multiple" multiple="multiple" data-placeholder="Select cities...">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}, {{ $city->state->code ?? '' }}</option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted small">Select all cities where this company should appear as a top featured mover.</div>
                        @error('cities')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="border-top pt-3 text-end">
                        <a href="{{ route('admin.top-movers') }}" class="btn btn-outline-secondary px-4 me-2">Cancel</a>
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
