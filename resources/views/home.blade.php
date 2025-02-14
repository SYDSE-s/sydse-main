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
                        <img src="{{ asset('img/pukis.png') }}" class="carousel-image">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image carousel-active">
                        <img src="{{ asset('img/mie-ayam.png') }}" class="carousel-image">
                        <img src="{{ asset('img/pukis.png') }}" class="carousel-image">
                        <img src="{{ asset('img/sate.png') }}" class="carousel-image">
                        <img src="{{ asset('img/mie-ayam.png') }}" class="carousel-image">
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
    <div class="container mt-container">
        <div class="wrap-about">
            <div class="bg"></div>
            <img src="{{ asset('icon/coma-up.png') }}" height="30">
            <h5 class="fw-bold my-3">
                SYDSE merupakan platform digital inovatif yang dirancang untuk mendukung <br>pertumbuhan UMKM di Solo Raya
                melalui solusi pemasaran, program pelatihan, dan <br>pendampingan bisnis, sehingga membantu UMKM berkembang
                lebih optimal di era digital.
            </h5>
            <img src="{{ asset('icon/coma-down.png') }}" height="30">
        </div>
    </div>


    {{-- product --}}
    <div class="container mt-container">
        <h4 class="mb-3 text-center fw-bold">Produk UMKM</h4>
        <div class="wrap-product">
            <div class="product-slider">
                @foreach ($products as $product)
                    @if ($product->id < 10)
                        <div class="card">
                            <div class="card-body p-2">
                                <div class="product-img"
                                    style="background-image: url('{{ asset('product_photo/' . $product->product_photo) }}')">
                                </div>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <h5>{{ $product->name }}</h5>
                                    <h5>Rp.{{ $product->price }}</h5>
                                </div>
                                <a class="fs-small" href="{{ route('product-detail', [$product->id]) }}">Klik Untuk
                                    detail</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="product-slider">
                @foreach ($products as $product)
                    @if ($product->id < 10)
                        <div class="card">
                            <div class="card-body p-2">
                                <div class="product-img"
                                    style="background-image: url('{{ asset('product_photo/' . $product->product_photo) }}')">
                                </div>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <h5>{{ $product->name }}</h5>
                                    <h5>Rp.{{ $product->price }}</h5>
                                </div>
                                <a class="fs-small" href="{{ route('product-detail', [$product->id]) }}">Klik Untuk
                                    detail</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="wrap-product">
            <div class="product-slider-2">
                @foreach ($products as $product)
                    @if ($product->id > 10 && $product->id < 20)
                        <div class="card">
                            <div class="card-body p-2">
                                <div class="product-img"
                                    style="background-image: url('{{ asset('product_photo/' . $product->product_photo) }}')">
                                </div>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <h5>{{ $product->name }}</h5>
                                    <h5>Rp.{{ $product->price }}</h5>
                                </div>
                                <a class="fs-small" href="{{ route('product-detail', [$product->id]) }}">Klik Untuk
                                    detail</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="product-slider-2">
                @foreach ($products as $product)
                    @if ($product->id > 10 && $product->id < 20)
                        <div class="card">
                            <div class="card-body p-2">
                                <div class="product-img"
                                    style="background-image: url('{{ asset('product_photo/' . $product->product_photo) }}')">
                                </div>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <h5>{{ $product->name }}</h5>
                                    <h5>Rp.{{ $product->price }}</h5>
                                </div>
                                <a class="fs-small" href="{{ route('product-detail', [$product->id]) }}">Klik Untuk
                                    detail</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('product') }}" class="text-violet fw-bold">
                Lihat Selengkapnya <img src="{{ asset('icon/right-arrow.svg') }}"height="15" class="ms-2">
            </a>
        </div>
    </div>


    {{-- berita --}}
    <div class="container mt-container">
        <h4 class="mb-3 text-center fw-bold">Berita</h4>
        <div class="row gy-2">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('img/news.png') }}" class="img-fluid"
                            style="border-radius: 20px 20px 0px 0px">
                    </div>
                    <div class="card-body">
                        <h6>4 Januari 2025</h6>
                        <h5 class="fw-bold my-3">UMKM Solo Raya </h5>
                        <h6 class="mb-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt esse facilis
                            sequi ab ut libero fugit, modi repellat molestiae earum. Unde mollitia facilis dolores
                            aspernatur ratione harum dolorum esse veniam!</h6>
                        <a href="{{ route('product') }}" class="text-violet fw-bold">
                            Lihat Selengkapnya <img src="{{ asset('icon/right-arrow.svg') }}"height="15" class="ms-2">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('img/news.png') }}" class="img-fluid"
                            style="border-radius: 20px 20px 0px 0px">
                    </div>
                    <div class="card-body">
                        <h6>4 Januari 2025</h6>
                        <h5 class="fw-bold my-3">UMKM Solo Raya </h5>
                        <h6 class="mb-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt esse facilis
                            sequi ab ut libero fugit, modi repellat molestiae earum. Unde mollitia facilis dolores
                            aspernatur ratione harum dolorum esse veniam!</h6>
                        <a href="{{ route('product') }}" class="text-violet fw-bold">
                            Lihat Selengkapnya <img src="{{ asset('icon/right-arrow.svg') }}"height="15" class="ms-2">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('img/news.png') }}" class="img-fluid"
                            style="border-radius: 20px 20px 0px 0px">
                    </div>
                    <div class="card-body">
                        <h6>4 Januari 2025</h6>
                        <h5 class="fw-bold my-3">UMKM Solo Raya </h5>
                        <h6 class="mb-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt esse facilis
                            sequi ab ut libero fugit, modi repellat molestiae earum. Unde mollitia facilis dolores
                            aspernatur ratione harum dolorum esse veniam!</h6>
                        <a href="{{ route('product') }}" class="text-violet fw-bold">
                            Lihat Selengkapnya <img src="{{ asset('icon/right-arrow.svg') }}"height="15" class="ms-2">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts-test.footer')
    <script src="{{ asset('js/part/carousel.js') }}"></script>
@endsection
