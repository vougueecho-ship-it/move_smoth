@extends('layouts.admin')

@section('title', 'Edit Company | Admin Dashboard')
@section('page_title', 'Edit ' . $company->name)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                <h4 class="fw-bold mb-0 text-primary"><i class="fas fa-edit me-2"></i> Edit Moving Company</h4>
            </div>
            <div class="card-body p-4 pt-2">
                <form action="{{ route('admin.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Section 1: Owner Login Account Details -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-user-cog text-muted me-2"></i> Owner Account Credentials</h5>
                    <p class="text-muted small mb-3">Manage the owner's dashboard account details. Fill in the Password field only if you want to <strong>reset/change</strong> their login password.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Owner Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror" placeholder="e.g. John Doe" value="{{ old('owner_name', $company->owner->name ?? '') }}" required>
                            @error('owner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Owner Email <span class="text-danger">*</span></label>
                            <input type="email" name="owner_email" class="form-control @error('owner_email') is-invalid @enderror" placeholder="e.g. owner@example.com" value="{{ old('owner_email', $company->owner->email ?? '') }}" required>
                            @error('owner_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Reset Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Section 2: Company Details -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3 mt-4"><i class="fas fa-truck text-muted me-2"></i> Company Business Details</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Flexdolly Moving & Delivery" value="{{ old('name', $company->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="e.g. admin@flexdolly.com" value="{{ old('email', $company->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g. 858-733-0775" value="{{ old('phone', $company->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company Website</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" placeholder="e.g. https://www.flexdolly.com" value="{{ old('website', $company->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Company Logo</label>
                            <div class="d-flex align-items-center gap-3">
                                @if($company->logo_url)
                                    <img src="{{ $company->logo_url }}" alt="Logo" class="rounded border p-1 bg-light" style="width: 80px; height: 80px; object-fit: contain;">
                                @else
                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center fw-bold text-muted text-center" style="width: 80px; height: 80px; font-size: 11px;">
                                        No Logo Uploaded
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="logo" class="form-control">
                                    <div class="form-text text-muted small mt-1">Upload a new custom logo image to overwrite the existing one.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Location and Address Details -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3 mt-4"><i class="fas fa-map-marker-alt text-muted me-2"></i> Service Area & Location Details</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">State <span class="text-danger">*</span></label>
                            <select name="state_id" id="state_id" class="form-select select2" required>
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ old('state_id', $company->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">City <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-select select2" required data-placeholder="Choose City...">
                                <option value="">Select State First</option>
                            </select>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Street Address <span class="text-danger">*</span></label>
                            <input type="text" name="address_line1" class="form-control @error('address_line1') is-invalid @enderror" placeholder="e.g. 4508 Moraga Ave Unit 6" value="{{ old('address_line1', $company->address_line1) }}" required>
                            @error('address_line1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Section 4: Service Types & Regulatory Credentials -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3 mt-4"><i class="fas fa-shield-alt text-muted me-2"></i> Services & Regulatory Credentials</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-bold d-block mb-3">Service Types Offered</label>
                            @php
                                $selectedServices = explode(',', $company->service_type ?: '');
                            @endphp
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="local" id="srv_local" {{ in_array('local', $selectedServices) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="srv_local">Local Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="long_distance" id="srv_long_distance" {{ in_array('long_distance', $selectedServices) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="srv_long_distance">Long Distance Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="commercial" id="srv_commercial" {{ in_array('commercial', $selectedServices) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="srv_commercial">Commercial & Office Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="residential" id="srv_residential" {{ in_array('residential', $selectedServices) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="srv_residential">Residential Home Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="packing" id="srv_packing" {{ in_array('packing', $selectedServices) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="srv_packing">Packing & Crating Services</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="storage" id="srv_storage" {{ in_array('storage', $selectedServices) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="srv_storage">Secured Storage Units</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">ICC MC License No</label>
                            <input type="text" name="mc_number" class="form-control @error('mc_number') is-invalid @enderror" placeholder="e.g. MC-123456" value="{{ old('mc_number', $company->mc_number) }}">
                            @error('mc_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">US DOT No</label>
                            <input type="text" name="dot_number" class="form-control @error('dot_number') is-invalid @enderror" placeholder="e.g. 4329208" value="{{ old('dot_number', $company->dot_number) }}">
                            @error('dot_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Section 5: About & Settings -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3 mt-4"><i class="fas fa-sliders-h text-muted me-2"></i> Profile Content & Dashboard Settings</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">About Company (Description)</label>
                            <textarea name="description" class="form-control tinymce" rows="6" placeholder="Describe the company's background, services, history...">{!! $company->description !!}</textarea>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Profile Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ old('status', $company->status) == 'active' ? 'selected' : '' }}>Active (Approved)</option>
                                <option value="pending" {{ old('status', $company->status) == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                                <option value="suspended" {{ old('status', $company->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>

                        <div class="col-md-8 d-flex flex-wrap gap-4 align-items-end mt-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $company->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Visible on Front Directory</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_lead_active" id="isLeadActive" {{ $company->is_lead_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-primary" for="isLeadActive"><i class="fas fa-magic me-1"></i> Active in Lead System</label>
                            </div>
                        </div>

                        <!-- Section 6: SEO Metadata Settings -->
                        <div class="col-12"><hr class="my-4"></div>
                        <h5 class="fw-bold text-dark mb-3"><i class="fas fa-search text-muted me-2"></i> SEO Metadata Settings (Optional Override)</h5>
                        <p class="text-muted small mb-3">Leave these fields blank to use our automated, intelligent SEO generator which dynamically ensures unique titles & descriptions.</p>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Custom Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Leave blank for automatic smart meta title" value="{{ old('meta_title', $company->getRawOriginal('meta_title')) }}">
                            <div class="form-text text-muted small mt-1">If blank, dynamically generates: <code>[Name] - Movers in [City], [State] | Star Ratings & Quotes</code></div>
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Custom Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2" placeholder="Leave blank for automatic smart meta description">{{ old('meta_description', $company->getRawOriginal('meta_description')) }}</textarea>
                            <div class="form-text text-muted small mt-1">If blank, dynamically generates a unique description including city, licensing, services, and ratings.</div>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-5 border-top pt-4">
                            <button type="submit" class="btn btn-primary px-5 btn-lg shadow-sm rounded-3"><i class="fas fa-save me-2"></i> Update Company</button>
                            <a href="{{ route('admin.companies') }}" class="btn btn-link text-muted ms-3">Cancel</a>
                        </div>
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
    // Initialize state select standard
    $('#state_id').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // Initialize city select with tags support
    $('#city').select2({
        theme: 'bootstrap-5',
        width: '100%',
        tags: true,
        placeholder: 'Choose or type City...',
        createTag: function (params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true
            }
        }
    });

    // Dynamic State-to-City Loading
    $('#state_id').on('change', function() {
        var stateId = $(this).val();
        var citySelect = $('#city');
        var currentCity = "{{ old('city', $company->city) }}";
        
        // Destroy Select2 before altering DOM
        if (citySelect.data('select2')) {
            citySelect.select2('destroy');
        }
        
        // Clear current options and show loading
        citySelect.html('<option value="">Loading cities...</option>');
        
        // Re-initialize Select2 for loading state
        citySelect.select2({
            theme: 'bootstrap-5',
            width: '100%',
            tags: true,
            placeholder: 'Choose or type City...'
        });
        
        if (!stateId) {
            if (citySelect.data('select2')) {
                citySelect.select2('destroy');
            }
            citySelect.html('<option value="">Select State First</option>');
            citySelect.select2({
                theme: 'bootstrap-5',
                width: '100%',
                tags: true,
                placeholder: 'Choose or type City...'
            });
            return;
        }
        
        // Build AJAX URL
        var url = "{{ url('/admin/get-cities') }}/" + stateId;
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var html = '<option value="">Select City</option>';
                var currentCityFound = false;
                
                if (data && data.length > 0) {
                    $.each(data, function(index, city) {
                        var selected = (city.name == currentCity) ? 'selected' : '';
                        if (city.name == currentCity) {
                            currentCityFound = true;
                        }
                        html += '<option value="' + city.name + '" ' + selected + '>' + city.name + '</option>';
                    });
                }
                
                // If currentCity is set but wasn't found in database list, append it as selected
                if (currentCity && !currentCityFound) {
                    html += '<option value="' + currentCity + '" selected>' + currentCity + '</option>';
                }
                
                if (citySelect.data('select2')) {
                    citySelect.select2('destroy');
                }
                
                citySelect.html(html);
                
                citySelect.select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    tags: true,
                    placeholder: 'Choose or type City...',
                    createTag: function (params) {
                        var term = $.trim(params.term);
                        if (term === '') {
                            return null;
                        }
                        return {
                            id: term,
                            text: term,
                            newTag: true
                        }
                    }
                });
                
                citySelect.trigger('change');
            },
            error: function(xhr, status, error) {
                console.error("Failed to load cities: ", error);
                if (citySelect.data('select2')) {
                    citySelect.select2('destroy');
                }
                citySelect.html('<option value="">Error loading cities</option>');
                citySelect.select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    tags: true,
                    placeholder: 'Choose or type City...'
                });
            }
        });
    });

    // Trigger state change immediately on page load to fetch and pre-select current city
    if ($('#state_id').val()) {
        $('#state_id').trigger('change');
    }
});
</script>
@endsection
