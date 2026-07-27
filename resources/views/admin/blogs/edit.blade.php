@extends('layouts.admin')

@section('title', 'Edit Blog Post')
@section('page_title', 'Edit Blog Post')

@section('content')

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Post Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" value="{{ $blog->title }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $blog->slug }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Content</label>
                        <textarea name="content" class="form-control tinymce" rows="15">{!! $blog->content !!}</textarea>
                    </div>

                    <!-- FAQs Manager -->
                    <div class="card border shadow-sm rounded-3 mt-4 mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                            <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-question-circle me-1"></i> Post FAQs (Optional)</h5>
                            <button type="button" class="btn btn-sm btn-primary fw-bold px-3" id="add-faq-btn"><i class="fas fa-plus me-1"></i> Add FAQ</button>
                        </div>
                        <div class="card-body">
                            <div id="faqs-container">
                                <!-- Dynamic FAQs will be appended here -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="bg-light p-4 rounded-3 border">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $blog->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="published" {{ $blog->status === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ $blog->status === 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Featured Image</label>
                            @if($blog->featured_image)
                                <img src="{{ asset('storage/'.$blog->featured_image) }}" class="img-fluid rounded mb-2 border">
                            @endif
                            <input type="file" name="featured_image" class="form-control">
                        </div>

                        <hr>

                        <h6 class="fw-bold mb-3">SEO Settings</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control form-control-sm" value="{{ $blog->meta_title }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Meta Description</label>
                            <textarea name="meta_description" class="form-control form-control-sm" rows="3">{{ $blog->meta_description }}</textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-2">Update Post</button>
                            <a href="{{ route('admin.blogs') }}" class="btn btn-link w-100 mt-2 text-muted">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.querySelector('input[name="title"]');
        const slugInput = document.querySelector('input[name="slug"]');
        
        if (titleInput && slugInput) {
            // Edit forms are manually controlled initially
            slugInput.dataset.manual = 'true';

            titleInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual) {
                    slugInput.value = slugify(this.value);
                }
            });
            
            slugInput.addEventListener('input', function() {
                slugInput.dataset.manual = 'true';
                slugInput.value = slugify(this.value);
            });
        }

        // FAQ Dynamic Handling
        const faqsContainer = document.getElementById('faqs-container');
        const addFaqBtn = document.getElementById('add-faq-btn');
        let faqIndex = 0;

        function createFaqRow(index, question = '', answer = '', order = 0) {
            const div = document.createElement('div');
            div.className = 'faq-row p-3 mb-3 border rounded bg-white position-relative shadow-sm animate__animated animate__fadeIn';
            div.style.borderRadius = '12px';
            div.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-faq-btn" style="font-size: 0.8rem; padding: 10px;" aria-label="Remove"></button>
                <div class="row g-3">
                    <div class="col-md-9">
                        <label class="form-label small fw-bold text-dark">Question</label>
                        <input type="text" name="faqs[${index}][question]" class="form-control" placeholder="e.g. How much does moving cost?" value="${question}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-dark">Sort Order</label>
                        <input type="number" name="faqs[${index}][order]" class="form-control" value="${order}">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold text-dark">Answer</label>
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
        @foreach($blog->faqs->sortBy('order') as $faq)
            faqsContainer.appendChild(createFaqRow(faqIndex, @json($faq->question), @json($faq->answer), {{ $faq->order }}));
            faqIndex++;
        @endforeach
        
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }
    });
</script>
@endsection
