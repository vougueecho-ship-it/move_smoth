@extends('layouts.admin')

@section('title', 'States Management')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cities & States Page Management</h1>
    <div>
        <a href="{{ route('admin.cities.create-page') }}" class="btn btn-outline-primary me-2"><i class="fas fa-plus-circle me-1"></i> Create City Page</a>
        <a href="{{ route('admin.states.create-page') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-1"></i> Create State Page</a>
    </div>
</div>

<div class="btn-group mb-4" role="group">
    <a href="{{ route('admin.cities') }}" class="btn btn-outline-primary px-4">Cities Page Contents</a>
    <a href="{{ route('admin.states') }}" class="btn btn-primary px-4">States Page Contents</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Search states by name, code, SEO title..." id="adminStateSearch">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Companies</th>
                        <th>Status</th>
                        <th>SEO Title</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($states as $state)
                    <tr>
                        <td class="fw-bold">{{ $state->name }}</td>
                        <td>{{ $state->code }}</td>
                        <td><span class="badge bg-info">{{ $state->companies_count }}</span></td>
                        <td>
                            @if($state->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $state->meta_title ?: 'N/A' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.states.edit', $state->id) }}" class="btn btn-sm btn-outline-primary">Edit Content</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $states->links() }}
        </div>
    </div>
</div>
@endsection
