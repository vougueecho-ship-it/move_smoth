@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page_title', 'Global Site Settings')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'MoveSmooth' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'contact@movesmooth.com' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '+1 406 505 9198' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Address</label>
                    <input type="text" name="contact_address" class="form-control" value="{{ $settings['contact_address'] ?? '' }}">
                </div>
                
                <hr class="my-4">
                <h4>SEO Global Settings</h4>
                <div class="col-12 mb-3">
                    <label class="form-label">Homepage Title</label>
                    <input type="text" name="home_seo_title" class="form-control" value="{{ $settings['home_seo_title'] ?? '' }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Homepage Meta Description</label>
                    <textarea name="home_seo_description" class="form-control" rows="3">{{ $settings['home_seo_description'] ?? '' }}</textarea>
                </div>

                <hr class="my-4">
                <h4>Home Page Content</h4>
                <div class="col-12 mb-3">
                    <label class="form-label">Hero Title</label>
                    <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'Find Trusted Movers Near You' }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Hero Subtitle</label>
                    <input type="text" name="hero_subtitle" class="form-control" value="{{ $settings['hero_subtitle'] ?? 'Compare verified moving companies, read real reviews, get free quotes.' }}">
                </div>

                <hr class="my-4">
                <h4>Social Media Links</h4>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="social_facebook" class="form-control" value="{{ $settings['social_facebook'] ?? '' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Twitter</label>
                    <input type="text" name="social_twitter" class="form-control" value="{{ $settings['social_twitter'] ?? '' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="social_instagram" class="form-control" value="{{ $settings['social_instagram'] ?? '' }}">
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-5">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
