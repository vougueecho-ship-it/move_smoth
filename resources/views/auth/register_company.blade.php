@extends('layouts.master')

@section('title', 'Company Registration | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Premium Select2 overrides */
    .select2-container .select2-selection--single {
        height: 50px !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 8px !important;
        background-color: #fafbfc !important;
        padding-top: 10px !important;
        font-size: 0.95rem !important;
        transition: all 0.2s ease !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px !important;
        right: 12px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #4a5568 !important;
        padding-left: 16px !important;
    }
    .select2-container--default .select2-selection--single:focus,
    .select2-container .select2-selection--single:focus-within {
        border-color: #0f2b4c !important;
        outline: none !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(15, 43, 76, 0.08) !important;
    }
    .select2-dropdown {
        border: 2px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
        z-index: 9999 !important;
    }
    .select2-search__field {
        border: 1px solid #cbd5e0 !important;
        border-radius: 6px !important;
        padding: 8px 12px !important;
    }

    .register-section {
        background: #f7fafc;
        min-height: 90vh;
        display: flex;
        align-items: center;
    }
    .register-card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 40px;
    }
    .register-title {
        color: #0f2b4c;
        font-weight: 800;
        font-size: 2.5rem;
        letter-spacing: -0.03em;
        text-transform: uppercase;
        margin-bottom: 30px;
    }
    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: #fafbfc;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0f2b4c;
        box-shadow: 0 0 0 3px rgba(15, 43, 76, 0.08);
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 700;
        color: #4a5568;
        font-size: 0.88rem;
        margin-bottom: 8px;
    }
    .service-checkboxes {
        background: #fafbfc;
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 16px;
    }
    .logo-upload-box {
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        background: #fcfdfe;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .logo-upload-box:hover {
        border-color: #0f2b4c;
        background: #f0f4f8;
    }
    .btn-register {
        background-color: #f26b3a;
        color: white;
        font-weight: 800;
        border-radius: 100px;
        padding: 14px 40px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(242, 107, 58, 0.2);
    }
    .btn-register:hover {
        background-color: #d85a2d;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(242, 107, 58, 0.35);
    }
</style>
@endsection

@section('content')
<section class="register-section py-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="register-card">
                    <div class="text-center mb-4">
                        <h1 class="register-title">Company Register</h1>
                        <p class="text-muted">Register your moving business and start managing reviews, leads, and custom profile content.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 p-3 mb-4">
                            <ul class="mb-0 small fw-bold">
                                @foreach($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.company.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Row 1: Your Name & Your Email -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Owner or manager's full name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Account login email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <!-- Row 2: Company Name & Company Email -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="company_name" class="form-control" placeholder="e.g. American Van Lines" value="{{ old('company_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company Email <span class="text-danger">*</span></label>
                                <input type="email" name="company_email" class="form-control" placeholder="e.g. contact@americanvanlines.com" value="{{ old('company_email') }}" required>
                            </div>
                        </div>

                        <!-- Row 3: Phone Number & Password -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. 858-733-0775" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters" required>
                            </div>
                        </div>

                        <!-- Row 4: Confirm Password & Website -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Re-type account password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company Website</label>
                                <input type="url" name="website" class="form-control" placeholder="e.g. https://www.americanvanlines.com" value="{{ old('website') }}">
                            </div>
                        </div>

                        <!-- Row 5: Location Details (State, City, Street Address) -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Select State <span class="text-danger">*</span></label>
                                <select name="state_id" id="state_id" class="form-select" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Select City <span class="text-danger">*</span></label>
                                <select name="city" id="city_id" class="form-select" required disabled>
                                    <option value="">Select State First</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Street Address <span class="text-danger">*</span></label>
                                <input type="text" name="address_line1" class="form-control" placeholder="e.g. 4508 Moraga Ave" value="{{ old('address_line1') }}" required>
                            </div>
                        </div>

                        <!-- Row 6: Service Type Checkboxes -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label d-block fw-bold text-dark">Services Provided <span class="text-danger">*</span></label>
                                <div class="row g-2">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="local" id="srv_local" checked>
                                            <label class="form-check-label fw-bold text-dark" for="srv_local" style="font-size: 0.95rem;">Local Moving</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="long_distance" id="srv_long_distance" checked>
                                            <label class="form-check-label fw-bold text-dark" for="srv_long_distance" style="font-size: 0.95rem;">Long Distance Moving</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="commercial" id="srv_commercial">
                                            <label class="form-check-label fw-bold text-dark" for="srv_commercial" style="font-size: 0.95rem;">Commercial Moving</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="residential" id="srv_residential" checked>
                                            <label class="form-check-label fw-bold text-dark" for="srv_residential" style="font-size: 0.95rem;">Residential Moving</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="packing" id="srv_packing">
                                            <label class="form-check-label fw-bold text-dark" for="srv_packing" style="font-size: 0.95rem;">Packing & Crating</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="storage" id="srv_storage">
                                            <label class="form-check-label fw-bold text-dark" for="srv_storage" style="font-size: 0.95rem;">Secured Storage</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 7: MC License & USDOT Numbers -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">ICC MC License No</label>
                                <input type="text" name="mc_number" class="form-control" placeholder="e.g. MC-123456" value="{{ old('mc_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">US DOT No</label>
                                <input type="text" name="dot_number" class="form-control" placeholder="e.g. 4329208" value="{{ old('dot_number') }}">
                            </div>
                        </div>

                        <!-- Row 8: Company Logo Upload -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label">Company Logo</label>
                                <div class="logo-upload-box" onclick="document.getElementById('logo_input').click();">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                    <div class="fw-bold text-dark">Click to upload company logo</div>
                                    <p class="text-muted small mb-0">Supports PNG, JPG, JPEG, or WEBP (Max 2MB)</p>
                                    <input type="file" name="logo" id="logo_input" class="d-none" onchange="updateFileName(this);">
                                    <div id="file_name_display" class="mt-2 text-primary fw-bold small"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 9: Terms and Register Button -->
                        <div class="row align-items-center mt-5">
                            <div class="col-md-7 mb-3 mb-md-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label text-muted small fw-semibold" for="terms">
                                        I agree to the <a href="{{ route('front.terms') }}" target="_blank" class="text-primary text-decoration-underline">Terms and Conditions</a> and privacy policies of MoveSmooth.
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5 text-md-end">
                                <button type="submit" class="btn btn-register px-5 py-3 w-100 w-md-auto"><i class="fas fa-user-plus me-2"></i> Register Company</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function updateFileName(input) {
        const display = document.getElementById('file_name_display');
        if (input.files && input.files[0]) {
            display.innerText = '✔️ Selected: ' + input.files[0].name;
        } else {
            display.innerText = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 on State and City dropdowns
        $('#state_id').select2({
            placeholder: "Select State",
            allowClear: true,
            width: '100%'
        });
        
        $('#city_id').select2({
            placeholder: "Select State First",
            allowClear: true,
            width: '100%'
        });

        $('#state_id').on('change', function() {
            const stateId = $(this).val();
            const citySelect = $('#city_id');
            
            citySelect.empty().append('<option value="">Loading...</option>').prop('disabled', true);
            citySelect.trigger('change'); // Refresh select2
            
            if (stateId) {
                $.ajax({
                    url: '/api/states/' + stateId + '/cities',
                    type: 'GET',
                    success: function(data) {
                        citySelect.empty().append('<option value="">Select City</option>');
                        $.each(data, function(index, city) {
                            citySelect.append('<option value="' + city.name + '">' + city.name + '</option>');
                        });
                        citySelect.prop('disabled', false);
                        citySelect.trigger('change'); // Refresh select2 with new option list!
                    },
                    error: function() {
                        citySelect.empty().append('<option value="">Select City</option>').prop('disabled', false);
                        citySelect.trigger('change'); // Refresh select2
                    }
                });
            } else {
                citySelect.empty().append('<option value="">Select State First</option>').prop('disabled', true);
                citySelect.trigger('change'); // Refresh select2
            }
        });
    });
</script>
@endsection
