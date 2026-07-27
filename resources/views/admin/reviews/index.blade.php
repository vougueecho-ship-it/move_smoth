@extends('layouts.admin')

@section('title', 'Reviews Management')
@section('page_title', 'Reviews Management')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-end">
        <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">Add Manual Review</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search reviews by mover, user, rating..." id="adminReviewSearch">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Mover</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Review Snippet</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->company->name ?? 'N/A' }}</td>
                        <td>
                            <div>{{ $review->name }}</div>
                            <small class="text-muted">{{ $review->email }}</small>
                        </td>
                        <td>
                            <div class="text-accent">
                                @for($i=1; $i<=5; $i++)
                                    @if($review->rating >= $i)
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($review->rating >= ($i - 0.5))
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    @else
                                        <i class="far fa-star text-secondary opacity-25"></i>
                                    @endif
                                @endfor
                                <span class="ms-1 small">({{ number_format($review->rating, 1) }})</span>
                            </div>
                        </td>
                        <td><small>{{ Str::limit($review->review, 50) }}</small></td>
                        <td>
                            @if($review->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($review->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($review->status !== 'approved')
                                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @endif
                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this review?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection
