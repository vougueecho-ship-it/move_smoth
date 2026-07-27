@extends('layouts.master')

@section('title', 'Login | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Welcome Back</h2>
                            <p class="text-muted">Login to manage your moves or profile</p>
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

                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg" required autofocus value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">Password</label>
                                    <a href="{{ route('forgot.password') }}" class="small text-decoration-none">Forgot?</a>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fs-5 shadow-sm">Login</button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted small">Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-primary">Sign up here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
