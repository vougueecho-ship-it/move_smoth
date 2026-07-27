@extends('layouts.admin')

@section('title', 'Edit City: ' . $city->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit City: {{ $city->name }}</h1>
    <a href="{{ route('admin.cities') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">City Name (From Database)</label>
                    <input type="text" class="form-control bg-light" value="{{ $city->name }}" readonly disabled>
                    <small class="text-muted">Name is managed via SQL import</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control bg-light" value="{{ $city->state->name }}" readonly disabled>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">URL Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ $city->content->slug ?? Str::slug($city->name) }}" required>
                </div>

                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ ($city->content->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-primary" for="isActive">Page Active (Requires Content to show on site)</label>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Custom Heading (H1)</label>
                    <input type="text" name="heading" class="form-control" value="{{ $city->content->heading ?? '' }}" placeholder="e.g., Trusted Movers in {{ $city->name }}">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">SEO Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ $city->content->meta_title ?? '' }}">
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">SEO Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ $city->content->meta_description ?? '' }}</textarea>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary"><i class="fas fa-arrow-up me-1"></i> Page Content Above Movers (HTML support)</label>
                    <textarea name="content" class="form-control tinymce" rows="8">{!! $city->content->content ?? '' !!}</textarea>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-success"><i class="fas fa-arrow-down me-1"></i> Page Content Below Movers (HTML support)</label>
                    <textarea name="content_below" class="form-control tinymce" rows="8">{!! $city->content->content_below ?? '' !!}</textarea>
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
                <button type="submit" class="btn btn-primary px-5">Update City Content</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Pre-populate existing FAQs
        @if(\Illuminate\Support\Facades\Schema::hasTable('city_faqs'))
            @foreach($city->faqs->sortBy('order') as $faq)
                faqsContainer.appendChild(createFaqRow(faqIndex, @json($faq->question), @json($faq->answer), {{ $faq->order }}));
                faqIndex++;
            @endforeach
        @endif
    });
</script>
@endsection
