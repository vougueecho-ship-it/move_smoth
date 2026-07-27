@extends('layouts.admin')

@section('title', 'Create City Page')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create/Configure City Page</h1>
    <a href="{{ route('admin.cities') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.cities.create-page.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Select State <span class="text-danger">*</span></label>
                    <select name="state_id" id="stateSelect" class="form-select select2" required>
                        <option value="">-- Select a State --</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->code }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Select City <span class="text-danger">*</span></label>
                    <select name="city_id" id="citySelect" class="form-select select2" disabled required>
                        <option value="">-- Choose a State First --</option>
                    </select>
                    <div id="citySpinner" class="spinner-border spinner-border-sm text-primary mt-1 d-none" role="status">
                        <span class="visually-hidden">Loading cities...</span>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">URL Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="citySlug" class="form-control" placeholder="e.g., los-angeles-movers" required>
                    <small class="text-muted">Slug used in the URL: /movers/state/<b>slug</b></small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Custom Heading (H1)</label>
                    <input type="text" name="heading" id="cityHeading" class="form-control" placeholder="e.g., Trusted Moving Companies in Los Angeles">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">SEO Title</label>
                    <input type="text" name="meta_title" id="cityMetaTitle" class="form-control" placeholder="e.g., Top 10 Moving Companies in Los Angeles | Reviews">
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">SEO Description</label>
                    <textarea name="meta_description" id="cityMetaDescription" class="form-control" rows="3" placeholder="Read verified reviews and get free quotes from top-rated moving companies in Los Angeles..."></textarea>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary"><i class="fas fa-arrow-up me-1"></i> Page Content Above Movers (HTML support)</label>
                    <textarea name="content" id="cityContent" class="form-control tinymce" rows="8"></textarea>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-success"><i class="fas fa-arrow-down me-1"></i> Page Content Below Movers (HTML support)</label>
                    <textarea name="content_below" id="cityContentBelow" class="form-control tinymce" rows="8"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                        <label class="form-check-label fw-bold text-primary" for="isActive">Set City Page to Active (Will appear on homepage/footer/state pages)</label>
                    </div>
                </div>

                <!-- FAQs Manager -->
                <div class="col-12 mb-3">
                    <div class="card border shadow-sm rounded-3 mt-4 mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                            <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-question-circle me-1"></i> City FAQs (Optional - HTML Links/Interlinking Supported)</h5>
                            <button type="button" class="btn btn-sm btn-primary fw-bold px-3" id="add-faq-btn"><i class="fas fa-plus me-1"></i> Add FAQ</button>
                        </div>
                        <div class="card-body">
                            <div id="faqs-container">
                                <!-- Dynamic FAQs will be appended here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-5 btn-lg">Publish City Page</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

        // FAQs logic
        const faqsContainer = document.getElementById('faqs-container');
        const addFaqBtn = document.getElementById('add-faq-btn');
        let faqIndex = 0;

        function createFaqRow(index, question = '', answer = '', order = 0) {
            const div = document.createElement('div');
            div.className = 'faq-row p-3 mb-3 border rounded bg-white position-relative shadow-sm';
            div.style.borderRadius = '12px';
            div.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-faq-btn" style="font-size: 0.8rem; padding: 10px;" aria-label="Remove"></button>
                <div class="row g-3">
                    <div class="col-md-9">
                        <label class="form-label small fw-bold text-dark">Question</label>
                        <input type="text" name="faqs[${index}][question]" class="form-control" placeholder="Enter question..." value="${question}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-dark">Sort Order</label>
                        <input type="number" name="faqs[${index}][order]" class="form-control" value="${order}">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Answer (Supports HTML links)</label>
                        <textarea name="faqs[${index}][answer]" class="form-control" rows="3" placeholder="Enter answer details..." required>${answer}</textarea>
                    </div>
                </div>
            `;
            
            div.querySelector('.remove-faq-btn').addEventListener('click', function() {
                div.remove();
            });
            
            return div;
        }

        if (addFaqBtn && faqsContainer) {
            addFaqBtn.addEventListener('click', function() {
                faqsContainer.appendChild(createFaqRow(faqIndex));
                faqIndex++;
            });
        }

        // Handle State Change to load cities via AJAX
        $('#stateSelect').on('change', function() {
            var stateId = $(this).val();
            var citySelect = $('#citySelect');
            
            if (!stateId) {
                citySelect.html('<option value="">-- Choose a State First --</option>').prop('disabled', true).trigger('change');
                return;
            }

            $('#citySpinner').removeClass('d-none');
            citySelect.prop('disabled', true);

            $.ajax({
                url: '{{ url("/admin/get-cities") }}/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var options = '<option value="">-- Choose a City --</option>';
                    $.each(data, function(key, city) {
                        options += '<option value="' + city.id + '" data-name="' + city.name + '">' + city.name + '</option>';
                    });
                    
                    citySelect.html(options).prop('disabled', false).trigger('change');
                    $('#citySpinner').addClass('d-none');
                },
                error: function() {
                    alert('Error loading cities. Please try again.');
                    $('#citySpinner').addClass('d-none');
                }
            });
        });

        // Handle City Change to pre-fill slug and heading
        $('#citySelect').on('change', function() {
            var selected = $(this).find(':selected');
            if (selected.val()) {
                var cityName = selected.data('name');
                
                // Helper to slugify
                var slug = cityName.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                
                $('#citySlug').val(slug + '-movers');
                $('#cityHeading').val('Trusted Moving Companies in ' + cityName);
                $('#cityMetaTitle').val('Top 10 Moving Companies in ' + cityName + ' | Reviews & Quotes');
                $('#cityMetaDescription').val('Compare the best licensed moving companies in ' + cityName + '. View reviews, phone numbers, and get instant free quotes to save up to 40% on your move.');
            } else {
                $('#citySlug').val('');
                $('#cityHeading').val('');
                $('#cityMetaTitle').val('');
                $('#cityMetaDescription').val('');
            }
        });
    });
</script>
@endsection
