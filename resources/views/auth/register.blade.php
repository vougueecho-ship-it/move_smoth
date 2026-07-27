@extends('layouts.master')

@section('title', 'Register | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Join MoveSmooth</h2>
                            <p class="text-muted">Create an account to find the best movers</p>
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

                        <form action="{{ route('register.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone (Optional)</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 py-3 fs-5 shadow-sm">Create Account</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-muted small">Are you a moving company? <a href="{{ route('register.company') }}" class="fw-bold text-primary">Register as a Pro</a></p>
                            <p class="text-muted small">Already have an account? <a href="{{ route('login') }}" class="fw-bold">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
