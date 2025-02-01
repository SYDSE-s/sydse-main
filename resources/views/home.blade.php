@extends('layouts-test.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('navbar')
    @include('layouts-test.navbar')
@endsection

@section('content')
    {{-- header --}}
    <div class="container-fluid px-3 py-2">
        <div class="wrap-header position-relative">
            <div class="container d-flex flex-column justify-content-center align-items-center pt-5">
                <div class="carousel-header">
                    <div class="carousel-wrapper">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image carousel-active">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image">
                    </div>
                </div>
            </div>
            <div class="position-absolute bottom-0 w-100 text-center pb-3">
                <h4 class="fw-bold">SYDSE - Solusi Digital untuk UMKM Solo Raya</h4>
                <div class="fw-bold">
                    Platform digital untuk mendukung pertumbuhan UMKM Solo Raya melalui pemasaran, <br>
                    pelatihan, dan pendampingan bisnis.
                </div>
            </div>
        </div>
    </div>


    {{-- category-card --}}
    <div class="container mt-container">
        <div class="row justify-content-center">
            <div class="col-md-2 flex-fill">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/fries.png') }}" height="35">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Kuliner Kering</h5>
                            <h6>{{ count($kuliner_kering) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 flex-fill">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/bowl.png') }}" height="35">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Kuliner basah</h5>
                            <h6>{{ count($kuliner_basah) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 flex-fill">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/clothes.png') }}" height="35">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Pakaian</h5>
                            <h6>{{ count($fashion) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 flex-fill">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/headphone.png') }}" height="35">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Jasa</h5>
                            <h6>{{ count($jasa) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 flex-fill">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/craft.png') }}" height="35">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Kerajinan</h5>
                            <h6>{{ count($craft) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-2" style="width: 20%;">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/drink.png') }}" height="30">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Minuman</h5>
                            <h6>{{ count($drink) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="width: 20%;">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/beauty.png') }}" height="30">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Kecantikan</h5>
                            <h6>{{ count($beauty) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="width: 20%;">
                <div class="card">
                    <div class="card-body d-flex justify-content-start align-items-center gap-3">
                        <div class="category-icon">
                            <img src="{{ asset('icon/furniture.png') }}" height="25">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Furnitur</h5>
                            <h6>{{ count($furniture) }}00 Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- about --}}
    <div class="container">
        .
    </div>

    <script src="{{ asset('js/part/carousel.js') }}"></script>
@endsection

@section('footer')
    @include('layouts-test.footer')
@endsection
