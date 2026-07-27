@extends('layouts.admin')

@section('title', 'Blog Management')
@section('page_title', 'Blog Management')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-end">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Create New Post</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search blogs by title, slug, category..." id="adminBlogSearch">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $blog->title }}</div>
                            <small class="text-muted">{{ $blog->slug }}</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $blog->category->name ?? 'Uncategorized' }}</span></td>
                        <td>{{ $blog->user->name ?? 'Admin' }}</td>
                        <td>
                            @if($blog->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $blog->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.blogs.delete', $blog->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection
