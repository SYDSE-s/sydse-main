<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('icon/logo-horizontal.svg') }}" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
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
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="btn btn-violet {{ Route::currentRouteName() == 'register-member' ? 'nav-active' : '' }}"
                        href="{{ route('register-member') }}">Join Member Now</a>
                </li>
            </ul>
        </div>
    </div>
</nav>