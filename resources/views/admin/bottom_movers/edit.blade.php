@extends('layouts.admin')

@section('title', 'Edit Bottom Mover | Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h4 class="fw-bold mb-0 text-primary"><i class="fas fa-edit text-primary me-2"></i> Edit Bottom Mover: {{ $bottomMover->company->name }}</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.bottom-movers.update', $bottomMover->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-bold">Selected Moving Company <span class="text-danger">*</span></label>
                            <select name="company_id" class="form-select select2" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $bottomMover->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }} ({{ $company->city }}, {{ $company->state->code ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Sort Order (Optional)</label>
                            <input type="number" name="order" class="form-control" placeholder="e.g. 0, 1, 2" value="{{ old('order', $bottomMover->order) }}">
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
                                <option value="{{ $state->id }}" {{ in_array($state->id, $selectedStates) ? 'selected' : '' }}>{{ $state->name }} ({{ $state->code }})</option>
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
                                <option value="{{ $city->id }}" {{ in_array($city->id, $selectedCities) ? 'selected' : '' }}>{{ $city->name }}, {{ $city->state->code ?? '' }}</option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted small">Select all cities where this company should appear as a bottom mover.</div>
                        @error('cities')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">In-Depth Review & Collapsible Accordion (HTML via TinyMCE)</label>
                        <textarea name="content" class="form-control tinymce" rows="15">{!! old('content', $bottomMover->content) !!}</textarea>
                        <div class="form-text text-muted small">TinyMCE handles formatting. Note: Use <strong>__ID__</strong> in the template to make the accordions work (it will be replaced by the mover's ID in the frontend).</div>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="border-top pt-3 text-end">
                        <a href="{{ route('admin.bottom-movers') }}" class="btn btn-outline-secondary px-4 me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save me-2"></i> Update Bottom Mover</button>
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
