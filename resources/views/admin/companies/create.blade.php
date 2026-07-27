@extends('layouts.admin')

@section('title', 'Add New Company | Admin Dashboard')
@section('page_title', 'Add New Moving Company')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                <h4 class="fw-bold mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i> Add New Moving Company</h4>
            </div>
            <div class="card-body p-4 pt-2">
                <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Section 1: Owner Login Account Details -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fas fa-user-cog text-muted me-2"></i> Owner Account Credentials</h5>
                    <p class="text-muted small mb-3">Creating a company will automatically register an associated user account. The owner will use these credentials to log in to their Company Dashboard.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Owner Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror" placeholder="e.g. John Doe" value="{{ old('owner_name') }}" required>
                            @error('owner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Owner Email <span class="text-danger">*</span></label>
                            <input type="email" name="owner_email" class="form-control @error('owner_email') is-invalid @enderror" placeholder="e.g. owner@example.com" value="{{ old('owner_email') }}" required>
                            @error('owner_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Account Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 6 characters" required>
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
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Flexdolly Moving & Delivery" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="e.g. admin@flexdolly.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g. 858-733-0775" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company Website</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" placeholder="e.g. https://www.flexdolly.com" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Company Logo</label>
                            <input type="file" name="logo" class="form-control">
                            <div class="form-text text-muted small mt-1">Upload a custom logo image, or leave empty to auto-map files from storage or use a initials placeholder.</div>
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
                                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
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
                            <input type="text" name="address_line1" class="form-control @error('address_line1') is-invalid @enderror" placeholder="e.g. 4508 Moraga Ave Unit 6" value="{{ old('address_line1') }}" required>
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
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="local" id="srv_local" checked>
                                        <label class="form-check-label fw-semibold" for="srv_local">Local Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="long_distance" id="srv_long_distance" checked>
                                        <label class="form-check-label fw-semibold" for="srv_long_distance">Long Distance Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="commercial" id="srv_commercial">
                                        <label class="form-check-label fw-semibold" for="srv_commercial">Commercial & Office Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="residential" id="srv_residential" checked>
                                        <label class="form-check-label fw-semibold" for="srv_residential">Residential Home Moving</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="packing" id="srv_packing">
                                        <label class="form-check-label fw-semibold" for="srv_packing">Packing & Crating Services</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="storage" id="srv_storage">
                                        <label class="form-check-label fw-semibold" for="srv_storage">Secured Storage Units</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">ICC MC License No</label>
                            <input type="text" name="mc_number" class="form-control @error('mc_number') is-invalid @enderror" placeholder="e.g. MC-123456" value="{{ old('mc_number') }}">
                            @error('mc_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">US DOT No</label>
                            <input type="text" name="dot_number" class="form-control @error('dot_number') is-invalid @enderror" placeholder="e.g. 4329208" value="{{ old('dot_number') }}">
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
                            <textarea name="description" class="form-control tinymce" rows="6" placeholder="Describe the company's background, services, history..."></textarea>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Profile Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active (Approved)</option>
                                <option value="pending">Pending Approval</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>

                        <div class="col-md-8 d-flex flex-wrap gap-4 align-items-end mt-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                                <label class="form-check-label fw-bold" for="isActive">Visible on Front Directory</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_lead_active" id="isLeadActive" checked>
                                <label class="form-check-label fw-bold text-primary" for="isLeadActive"><i class="fas fa-magic me-1"></i> Active in Lead System</label>
                            </div>
                        </div>

                        <!-- Section 6: SEO Metadata Settings -->
                        <div class="col-12"><hr class="my-4"></div>
                        <h5 class="fw-bold text-dark mb-3"><i class="fas fa-search text-muted me-2"></i> SEO Metadata Settings (Optional Override)</h5>
                        <p class="text-muted small mb-3">Leave these fields blank to use our automated, intelligent SEO generator which dynamically ensures unique titles & descriptions.</p>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Custom Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Leave blank for automatic smart meta title" value="{{ old('meta_title') }}">
                            <div class="form-text text-muted small mt-1">If blank, dynamically generates: <code>[Name] - Movers in [City], [State] | Star Ratings & Quotes</code></div>
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Custom Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2" placeholder="Leave blank for automatic smart meta description">{{ old('meta_description') }}</textarea>
                            <div class="form-text text-muted small mt-1">If blank, dynamically generates a unique description including city, licensing, services, and ratings.</div>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-5 border-top pt-4">
                            <button type="submit" class="btn btn-primary px-5 btn-lg shadow-sm rounded-3"><i class="fas fa-save me-2"></i> Save Company</button>
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
                var oldCity = "{{ old('city') }}";
                var oldCityFound = false;
                
                if (data && data.length > 0) {
                    $.each(data, function(index, city) {
                        var selected = (oldCity && city.name == oldCity) ? 'selected' : '';
                        if (oldCity && city.name == oldCity) {
                            oldCityFound = true;
                        }
                        html += '<option value="' + city.name + '" ' + selected + '>' + city.name + '</option>';
                    });
                }
                
                // If oldCity is set but wasn't found in database list, append it as selected
                if (oldCity && !oldCityFound) {
                    html += '<option value="' + oldCity + '" selected>' + oldCity + '</option>';
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

    // Trigger state change immediately on page load to fetch cities if state is pre-selected
    if ($('#state_id').val()) {
        $('#state_id').trigger('change');
    }
});
</script>
@endsection
