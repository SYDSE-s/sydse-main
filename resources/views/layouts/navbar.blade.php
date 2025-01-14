<!-- navigation bar -->
<div class="background-navbar animate__animated animate__fadeIn"></div>
<div class="container-md navigation-bar">
    <div class="brand-location-sosmed fixed d-flex justify-content-between position-relative">
        <div class="brand fs-4 fw-bold d-flex justify-content-center align-items-center mt-2 position-absolute start-0"
            style="cursor: pointer;">
            <img src="{{ asset('icon/sydse.png') }}" height="40" class="me-2"> SYDSE
        </div>
        <div class="location-sosmed-navbar ms-auto">
            <div class="location-sosmed d-flex justify-content-end mt-2">
                <div class="location-wrapper d-flex justify-content-end me-4 mt-1" style="cursor: pointer;">
                    <div class="d-flex justify-content-center ps-5" style="width: 50%;">
                        <img src="{{ asset('icon/aqua-location.png') }}" height="20" class="d-md-none d-xl-block">
                        <marquee class="ms-2 fw-bold text-dark d-md-none d-xl-block"
                            style="font-size: 13px; width: 250px;">
                            Jl. Raya Suradadi, Kec. Suradadi, Kabupaten Tegal</marquee>
                    </div>
                    <div class="d-flex justify-content-center ps-5" style="width: 40%;">
                        <img src="{{ asset('icon/aqua-phone.png') }}" height="20" class="d-md-none d-xl-block">
                        <marquee class="ms-2 fw-bold text-dark d-md-none d-xl-block"
                            style="font-size: 13px; width: 230px;">
                            082374352405
                        </marquee>
                    </div>
                </div>
                <div class="sosmed-wrapper d-flex justify-content-end" style="width: 20%;">
                    <div class="sosmed ms-sm-1">
                        <a href="https://www.tiktok.com" class="wrap" target="_blank">
                            <img src="{{ asset('icon/tik-tok.png') }}" height="18">
                        </a>
                    </div>
                    <div class="sosmed ms-sm-1">
                        <a href="https://facebook.com/" class="wrap" target="_blank">
                            <img src="{{ asset('icon/facebook.png') }}" height="18">
                        </a>
                    </div>
                    <div class="sosmed ms-sm-1">
                        <a href="https://www.instagram.com" class="wrap" target="_blank">
                            <img src="{{ asset('icon/instagram.png') }}" height="18">
                        </a>
                    </div>
                    <div class="sosmed ms-sm-1">
                        <a href="https://www.youtube.com/" class="wrap" target="_blank">
                            <img src="{{ asset('icon/youtube.png') }}" height="18">
                        </a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg pb-0 stikcy-top navbar-light mt-2">
                <div class="container-fluid px-0 navbar-wrap">
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="z-index: 10;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto px-0 mb-2 mb-lg-0 ms-auto">
                            <li class="nav-item change-mt">
                                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'nav-active' : '' }} fw-bold ms-3"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'product' ? 'nav-active' : '' }} fw-bold ms-3"
                                    href="{{ route('product') }}">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold ms-3" href="{{ route('home') }}">Event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'register-member' ? 'nav-active' : '' }} fw-bold ms-3"
                                    href="{{ route('register-member') }}">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
