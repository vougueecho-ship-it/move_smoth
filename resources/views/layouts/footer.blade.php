<footer class="site-footer mt-auto">
    <div class="container">
        <div class="row g-5">
            <!-- Brand Section -->
            <div class="col-lg-4">
                <a href="{{ route('front.home') }}" class="text-white text-decoration-none d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="MoveSmooth" style="height: 40px; width: auto; object-fit: contain;">
                </a>
                <p class="mb-4" style="color: rgba(255,255,255,0.75); max-width: 300px; line-height: 1.8; font-size: 0.9rem;">
                    Your trusted moving partner for local and long-distance relocations. Licensed, insured, and committed to making every move stress-free.
                </p>
                <p class="mb-3" style="color: rgba(255,255,255,0.85); font-size: 0.9rem;">
                    <i class="fas fa-phone-alt me-2" style="color: var(--accent);"></i>
                    <a href="tel:+14065059198" class="text-white fw-bold">+1 406 505 9198</a>
                </p>
                <p class="mb-4" style="color: rgba(255,255,255,0.85); font-size: 0.9rem;">
                    <i class="fas fa-envelope me-2" style="color: var(--accent);"></i>
                    <!--email_off-->
                    <a href="mailto:contact@movesmooth.com">contact@movesmooth.com</a>
                    <!--/email_off-->
                </p>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-4 col-6">
                <div class="footer-heading">Services</div>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('front.service.local') }}">Local Moving</a></li>
                    <li class="mb-2"><a href="{{ route('front.service.long') }}">Long Distance</a></li>
                    <li class="mb-2"><a href="{{ route('front.service.commercial') }}">Commercial Moving</a></li>
                    <li class="mb-2"><a href="{{ route('front.service.residential') }}">Residential Moving</a></li>
                    <li class="mb-2"><a href="{{ route('front.service.packing') }}">Packing Services</a></li>
                    <li class="mb-2"><a href="{{ route('front.service.storage') }}">Storage Units</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="col-lg-2 col-md-4 col-6">
                <div class="footer-heading">Company</div>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('front.about') }}">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('front.contact') }}">Contact Us</a></li>
                    <li class="mb-2"><a href="{{ route('front.movers') }}">Find Movers</a></li>
                    <li class="mb-2"><a href="{{ route('front.calculator') }}">Cost Calculator</a></li>
                    <li class="mb-2"><a href="{{ route('front.blog') }}">Blog & Tips</a></li>
                    <li class="mb-2"><a href="{{ route('front.review.create') }}">Write a Review</a></li>
                </ul>
            </div>

            <!-- Quick Quote -->
            <div class="col-lg-4 col-md-4">
                <div class="footer-heading">Get a Free Quote</div>
                <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; margin-bottom: 1rem;">
                    Enter your locations to get started with a free moving estimate.
                </p>
                <form action="{{ route('front.calculator') }}" method="GET">
                    <div class="mb-2">
                        <div class="zip-input-wrapper">
                            <input type="text" name="zip_from" class="form-control zip-autocomplete" placeholder="Moving From (ZIP or City)" autocomplete="off" required style="background: white; border-color: rgba(255,255,255,0.15); color: white; padding-left: 1rem;">
                            <div class="zip-autocomplete-dropdown"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="zip-input-wrapper">
                            <input type="text" name="zip_to" class="form-control zip-autocomplete" placeholder="Moving To (ZIP or City)" autocomplete="off" required style="background: white; border-color: rgba(255,255,255,0.15); color: white; padding-left: 1rem;">
                            <div class="zip-autocomplete-dropdown"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-accent w-100 fw-700">Get Free Estimate <i class="fas fa-arrow-right ms-1"></i></button>
                </form>

                <div class="mt-3 p-3 rounded-3" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-shield-alt" style="color: var(--accent); font-size: 1.2rem;"></i>
                        <div>
                            <div class="small fw-bold text-white">Licensed & Insured</div>
                            <p class="extra-small mb-0" style="color: rgba(255,255,255,0.75);">Your belongings are protected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-top pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center" style="border-color: rgba(255,255,255,0.08) !important; margin-top: 60px;">
            <p class="mb-3 mb-md-0 small" style="color: rgba(255,255,255,0.75);">
                &copy; {{ date('Y') }} Move Smooth. All rights reserved.
            </p>
            <div class="d-flex gap-4">
                <a href="{{ route('front.privacy') }}" class="small">Privacy Policy</a>
                <a href="{{ route('front.terms') }}" class="small">Terms of Service</a>
                <a href="{{ route('front.cookies') }}" class="small">Cookies</a>
            </div>
        </div>
    </div>
</footer>
