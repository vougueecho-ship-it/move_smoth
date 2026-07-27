@extends('layouts.admin')

@section('title', 'Edit Review')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Review</h1>
    <a href="{{ route('admin.reviews') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Company</label>
                    <select name="company_id" class="form-select select2-company" required>
                        <option value="">Choose a company...</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ $review->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Reviewer Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. John Doe" value="{{ $review->name }}">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Rating (1.0 - 5.0)</label>
                    <input type="number" name="rating" class="form-control" step="0.1" min="1" max="5" placeholder="e.g. 4.2" required value="{{ $review->rating }}">
                </div>
                
                <div class="col-md-8 mb-3">
                    <label class="form-label">Review Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Excellent service!" value="{{ $review->title }}">
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Review Content</label>
                    <textarea name="review" class="form-control" rows="5" required placeholder="Copy and paste the review content here...">{{ $review->review }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="approved" {{ $review->status === 'approved' ? 'selected' : '' }}>Approved (Published)</option>
                        <option value="pending" {{ $review->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ $review->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 pt-4">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" {{ $review->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="isFeatured">Show as Testimonial on Homepage</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-5">Update Review</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2-company').select2({
            placeholder: "Search and select a company...",
            allowClear: true
        });
    });
</script>
@endsection
