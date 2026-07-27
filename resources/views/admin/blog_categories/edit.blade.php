@extends('layouts.admin')

@section('title', 'Edit Blog Category')
@section('page_title', 'Edit Blog Category')

@section('content')

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-light py-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-edit me-1"></i> Edit Category Details</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.blog-categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Category Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $category->name) }}" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
                        <small class="text-muted">Slug is used in SEO URLs. Editing it might break existing search engine links.</small>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold"><i class="fas fa-save me-1"></i> Save Changes</button>
                        <a href="{{ route('admin.blog-categories') }}" class="btn btn-outline-secondary px-4 py-2"><i class="fas fa-arrow-left me-1"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('input[name="name"]');
        const slugInput = document.querySelector('input[name="slug"]');
        
        if (nameInput && slugInput) {
            // Set dataset manual to true since we are editing a pre-existing slug
            slugInput.dataset.manual = 'true';
            
            nameInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual) {
                    slugInput.value = slugify(this.value);
                }
            });
            
            slugInput.addEventListener('input', function() {
                slugInput.dataset.manual = 'true';
                slugInput.value = slugify(this.value);
            });
        }
        
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
