@extends('layouts.master')

@section('title', 'Disclaimer | MoveSmooth')

@section('custom_styles')
<style>
    .legal-page { padding: 80px 0; background: #f8fafc; }
    .legal-card { background: white; border-radius: 24px; padding: 60px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; line-height: 1.8; }
    .legal-card h2 { margin-top: 40px; color: var(--primary); font-weight: 800; }
</style>
@endsection

@section('content')
<div class="legal-page">
    <div class="container">
        <div class="legal-card mx-auto" style="max-width: 900px;">
            <h1 class="display-4 fw-800 mb-5">Legal Disclaimer</h1>
            <hr class="my-5">
            <p>The information provided by MoveSmooth is for general informational purposes only. All information on the site is provided in good faith, however we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability or completeness of any information on the site.</p>
            <p>Your use of the site and your reliance on any information on the site is solely at your own risk. Under no circumstance shall we have any liability to you for any loss or damage of any kind incurred as a result of the use of the site.</p>
        </div>
    </div>
</div>
@endsection
