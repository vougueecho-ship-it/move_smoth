@extends('layouts.admin')

@section('title', 'Blog Category Management')
@section('page_title', 'Blog Categories')

@section('content')

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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

<div class="row">
    <!-- Create Form -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-light py-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-plus-circle me-1"></i> Add New Category</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.blog-categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Relocation Guides" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Slug (Optional)</label>
                        <input type="text" name="slug" class="form-control" placeholder="auto-generated-if-empty">
                        <small class="text-muted">Used for SEO URLs.</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold"><i class="fas fa-save me-1"></i> Save Category</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Category List -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-light py-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-tags me-1"></i> Category Registry</h5>
            </div>
            <div class="card-body p-0">
                <div class="px-4 pt-3 pb-2">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search categories by name, slug..." id="adminCategorySearch">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Category Name</th>
                                <th>Slug</th>
                                <th>Associated Blogs</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark fs-6">{{ $category->name }}</span>
                                </td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-bold">
                                        <i class="fas fa-newspaper me-1"></i> {{ $category->blogs_count }} posts
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.blog-categories.delete', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')" {{ $category->blogs_count > 0 ? 'disabled' : '' }} title="{{ $category->blogs_count > 0 ? 'Cannot delete category containing blogs' : 'Delete Category' }}">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="mb-3 text-muted"><i class="fas fa-tags fa-3x"></i></div>
                                    <h6 class="text-muted">No blog categories registered yet.</h6>
                                    <p class="text-muted small">Create one on the left to start organizing your posts!</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($categories->hasPages())
            <div class="card-footer bg-white border-0 py-3 ps-4 pe-4">
                {{ $categories->links() }}
            </div>
            @endif
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
