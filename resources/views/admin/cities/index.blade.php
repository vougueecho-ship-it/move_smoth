@extends('layouts.admin')

@section('title', 'Cities Management')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cities & States Page Management</h1>
    <div>
        <a href="{{ route('admin.cities.create-page') }}" class="btn btn-primary me-2"><i class="fas fa-plus-circle me-1"></i> Create City Page</a>
        <a href="{{ route('admin.states.create-page') }}" class="btn btn-outline-primary"><i class="fas fa-plus-circle me-1"></i> Create State Page</a>
    </div>
</div>

<div class="btn-group mb-4" role="group">
    <a href="{{ route('admin.cities') }}" class="btn btn-primary px-4">Cities Page Contents</a>
    <a href="{{ route('admin.states') }}" class="btn btn-outline-primary px-4">States Page Contents</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.cities') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="q" class="form-control" placeholder="Search city..." value="{{ request('q') }}">
            </div>
            <div class="col-md-4">
                <select name="state_id" class="form-select">
                    <option value="">All States</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.cities') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 admin-search-input" placeholder="Instant search cities by name, state, SEO title..." id="adminCitySearch">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>State</th>
                        <th>Status</th>
                        <th>SEO Title</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $city)
                    <tr>
                        <td class="fw-bold">{{ $city->name }}</td>
                        <td>{{ $city->state->name }}</td>
                        <td>
                            @if($city->content && $city->content->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $city->content->meta_title ?? 'N/A' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-outline-primary">Edit Content</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $cities->links() }}
        </div>
    </div>
</div>
@endsection
