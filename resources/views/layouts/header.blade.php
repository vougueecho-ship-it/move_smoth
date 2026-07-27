<nav class="navbar navbar-expand-lg fixed-top navbar-light navbar-glass py-3" id="mainNavbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('front.home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="MoveSmooth" style="height: 40px; width: auto; object-fit: contain;">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Navigation Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('front.movers') }}">Find Movers</a></li>
                <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('front.compare-movers') }}">Compare Movers</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold px-3" href="#" role="button" data-bs-toggle="dropdown">Resources</a>
                    <ul class="dropdown-menu border-0 shadow-xl mt-lg-3 p-2">
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('front.service.local') }}"><i class="fas fa-map-marker-alt text-accent me-2"></i> Local Moving</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('front.service.long') }}"><i class="fas fa-route text-accent me-2"></i> Long Distance</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('front.service.commercial') }}"><i class="fas fa-building text-accent me-2"></i> Commercial Moving</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('front.service.residential') }}"><i class="fas fa-home text-accent me-2"></i> Residential Moving</a></li>
                        <li><hr class="dropdown-divider mx-2"></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('front.service.packing') }}"><i class="fas fa-box text-accent me-2"></i> Packing Services</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('front.service.storage') }}"><i class="fas fa-warehouse text-accent me-2"></i> Storage Units</a></li>
                    </ul>
                </li>
                
                
                
                <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('front.blog') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('front.about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('front.calculator') }}">Calculator</a></li>
                <!-- <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('front.contact') }}">Contact</a></li> -->
            </ul>

            <!-- Actions -->
            <div class="d-flex align-items-center gap-3">
                <!-- Phone -->
                <!-- <a href="tel:+14065059198" class="nav-phone d-none d-xl-flex">
                    <i class="fas fa-phone-alt"></i>
                    <span>+1 406 505 9198</span>
                </a> -->

                @auth
                    <div class="dropdown">
                        <button class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border shadow-sm" type="button" data-bs-toggle="dropdown">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.8rem;">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="fw-bold small d-none d-sm-inline">{{ explode(' ', auth()->user()->name)[0] }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2">
                            @if(auth()->user()->is_admin)
                                <li><a class="dropdown-item rounded-3 py-2" href="{{ route('admin.dashboard') }}"><i class="fas fa-cog me-2"></i> Admin Panel</a></li>
                            @elseif(auth()->user()->role === 'company')
                                <li><a class="dropdown-item rounded-3 py-2" href="{{ route('company.dashboard') }}"><i class="fas fa-chart-line me-2"></i> Dashboard</a></li>
                            @endif
                            <li><hr class="dropdown-divider mx-2"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-bold"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                <a href="{{ route('front.review.create') }}" class="btn btn-accent btn-pill px-4 py-2 fw-800 shadow-lg">
                    <i class="fas fa-star me-1"></i> WRITE A REVIEW
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
</script>
