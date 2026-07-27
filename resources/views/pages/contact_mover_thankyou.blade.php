@extends('layouts.master')

@section('title', 'Thank You - Quote Request Sent | MoveSmooth')
@section('meta_robots', 'noindex, nofollow')
@section('meta_description', 'Your quote request has been sent successfully. The moving company will contact you shortly with estimates.')

@section('content')
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-5 text-center shadow-sm border-0 rounded-4 bg-white">
                    <div class="display-1 text-success mb-4"><i class="fas fa-check-circle animate__animated animate__bounceIn"></i></div>
                    <h1 class="fw-900 text-primary mb-3" style="font-size: 2.2rem;">Quote Request Sent!</h1>
                    
                    <p class="lead text-muted mb-4">
                        Thank you! Your relocation request has been sent directly to <strong class="text-dark">{{ $company->name }}</strong>. 
                        A representative will review your inventory and parameters and reach out to you shortly.
                    </p>

                    @if($lead)
                    <div class="p-4 bg-light rounded-4 border text-start mb-5">
                        <h4 class="fw-800 mb-3 text-primary"><i class="fas fa-circle-info me-2 text-accent"></i> Move Parameter Summary</h4>
                        <div class="row small g-3">
                            <div class="col-sm-6">
                                <strong>Origin ZIP/City:</strong> 
                                <span class="text-muted d-block">{{ $lead->move_from }}</span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Destination ZIP/City:</strong> 
                                <span class="text-muted d-block">{{ $lead->move_to }}</span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Move Size:</strong> 
                                <span class="text-muted d-block">{{ $lead->move_size }}</span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Total Rooms:</strong> 
                                <span class="text-muted d-block">{{ $lead->num_rooms }}</span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Packing Choice:</strong> 
                                <span class="text-muted d-block">{{ $lead->packing_service }}</span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Storage Required:</strong> 
                                <span class="text-muted d-block">{{ $lead->storage_option }}</span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Requested Move Date:</strong> 
                                <span class="text-muted d-block">
                                    @if($lead->move_date instanceof \DateTimeInterface)
                                        {{ $lead->move_date->format('F d, Y') }}
                                    @else
                                        {{ date('F d, Y', strtotime($lead->move_date)) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('front.home') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">Return to Home</a>
                        <a href="{{ route('front.movers.directory') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold">Browse Other Movers</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
