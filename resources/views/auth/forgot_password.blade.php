@extends('layouts.master')

@section('title', 'Forgot Password | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Reset Password</h2>
                            <p class="text-muted">Enter your email to receive a reset link</p>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('forgot.password.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fs-5 shadow-sm">Send Reset Link</button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted small">Remembered your password? <a href="{{ route('login') }}" class="fw-bold text-primary">Back to Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
