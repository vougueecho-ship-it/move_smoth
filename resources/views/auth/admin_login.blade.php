@extends('layouts.master')

@section('title', 'Admin Login | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Admin Portal</h2>
                            <p class="text-muted">Enter your credentials to manage the platform</p>
                        </div>
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fs-5 shadow-sm">Secure Login</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('front.home') }}" class="text-muted small"><i class="fas fa-arrow-left me-1"></i> Back to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
