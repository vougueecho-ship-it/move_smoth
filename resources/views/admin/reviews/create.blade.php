@extends('layouts.admin')

@section('title', 'Add Manual Review')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Manual Review (Google/External)</h1>
    <a href="{{ route('admin.reviews') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.reviews.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Company</label>
                    <select name="company_id" class="form-select select2-company" required>
                        <option value="">Choose a company...</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Reviewer Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. John Doe">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Rating (1.0 - 5.0)</label>
                    <input type="number" name="rating" class="form-control" step="0.1" min="1" max="5" placeholder="e.g. 4.2" required>
                </div>
                
                <div class="col-md-8 mb-3">
                    <label class="form-label">Review Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Excellent service!">
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Review Content</label>
                    <textarea name="review" class="form-control" rows="5" required placeholder="Copy and paste the review content here..."></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="approved">Approved (Published)</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 pt-4">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured">
                        <label class="form-check-label" for="isFeatured">Show as Testimonial on Homepage</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-5">Add Review</button>
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
