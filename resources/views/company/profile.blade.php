@extends('layouts.master')

@section('title', 'My Profile | MoveSmooth')

@section('custom_styles')
<style>
    .sidebar { background: #f8fafc; min-height: 100vh; border-right: 1px solid #e2e8f0; }
    .nav-link { color: #64748b; font-weight: 500; padding: 0.8rem 1.5rem; }
    .nav-link:hover { background: #f1f5f9; color: var(--primary); }
    .nav-link.active { background: #e2e8f0; color: var(--primary); }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
            <div class="position-sticky pt-3">
                <div class="px-4 mb-4">
                    <h5 class="fw-bold text-primary">{{ Auth::user()->company->name ?? 'My Company' }}</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.dashboard') }}"><i class="fas fa-home me-2"></i> Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.leads') }}"><i class="fas fa-user-friends me-2"></i> Leads</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.reviews') }}"><i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('company.profile') }}"><i class="fas fa-building me-2"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company.analytics') }}"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 bg-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Company Profile</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('company.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Company Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Company Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $company->email }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Website</label>
                                <input type="url" name="website" class="form-control" value="{{ $company->website }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Street Address</label>
                                <input type="text" name="address_line1" class="form-control" value="{{ $company->address_line1 }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">USDOT Number</label>
                                <input type="text" name="dot_number" class="form-control" value="{{ $company->dot_number }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">MC Number</label>
                                <input type="text" name="mc_number" class="form-control" value="{{ $company->mc_number }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Select State</label>
                                <select name="state_id" class="form-select" required>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ $company->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save me-2"></i> Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
