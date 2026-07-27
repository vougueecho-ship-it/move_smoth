@extends('layouts.admin')

@section('title', 'Pending Approvals')
@section('page_title', 'Pending Company Approvals')

@section('content')
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Date Joined</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $company->name }}</div>
                            <small class="text-muted">DOT: {{ $company->dot_number ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <div>{{ $company->email }}</div>
                            <small class="text-muted">{{ $company->phone }}</small>
                        </td>
                        <td>{{ $company->city }}, {{ $company->state->code ?? '' }}</td>
                        <td>{{ $company->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <form action="{{ route('admin.approve', $company->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success px-3">Approve</button>
                            </form>
                            <form action="{{ route('admin.reject', $company->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Reject this company?')">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-check-circle fs-1 mb-3 opacity-25"></i>
                            <p class="mb-0">All clear! No pending approvals at the moment.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection
