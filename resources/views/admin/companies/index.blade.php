@extends('layouts.admin')

@section('title', 'Companies Management')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Companies Management</h1>
    <div>
        <a href="{{ route('admin.companies.import') }}" class="btn btn-outline-primary me-2"><i class="fas fa-file-import me-1"></i> Bulk Import CSV</a>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add New Company</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search companies by name, email, location, DOT..." id="adminCompanySearch">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>DOT #</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($company->logo_url)
                                    <img src="{{ $company->logo_url }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-truck text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $company->name }}</div>
                                    <div class="small text-muted">{{ $company->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $company->city }}, {{ $company->state->code ?? '' }}</td>
                        <td>
                            @if($company->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                            @if($company->is_lead_active)
                                <span class="badge bg-primary" title="Active in Lead System"><i class="fas fa-magic"></i> Lead Active</span>
                            @else
                                <span class="badge bg-secondary" title="Inactive in Lead System">Lead Inactive</span>
                            @endif
                            @if($company->is_verified)
                                <span class="badge bg-info"><i class="fas fa-check"></i> Verified</span>
                            @endif
                        </td>
                        <td>{{ $company->dot_number ?: 'N/A' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.companies.delete', $company->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection
