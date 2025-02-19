@extends('layouts-test.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('navbar')
    @include('layouts-test.navbar')
@endsection

@section('content')
    {{-- header --}}
    <div class="container" style="margin-top: 15px;">
        <div class="wrap-header px-4">
            <h3 class="fw-bold mb-2">Selamat Datang di e-commerce sydse</h3>
            <h5 class="fw-bold">Jelajahi aneka produk yang disediakan dari teman-teman umkm Solo Raya</h5>
        </div>
    </div>

    {{-- search & filter --}}
    <div class="container wrap-product">
        <div class="feature row gy-3 gy-lg-0 my-2">
            <form action="{{ route('search-product') }}" method="POST" class="search col-lg-3">
                @csrf
                <input type="text" name="search-product" placeholder="cari">
                <button type="submit" class="btn btn-white">Search</button>
                {{-- <a href="{{ route('product') }}" class="btn btn-first">Clear Filter</a> --}}
            </form>
            <div class="filter-category col-lg-9">
                <button class="filter-btn btn btn-white  btn-active" data-value="semua">semua</button>
                <button class="filter-btn btn btn-white" data-value="kuliner kering">kuliner kering</button>
                <button class="filter-btn btn btn-white" data-value="kuliner basah">kuliner basah</button>
                <button class="filter-btn btn btn-white" data-value="fashion">Fashion</button>
                <button class="filter-btn btn btn-white" data-value="jasa">jasa</button>
                <button class="filter-btn btn btn-white" data-value="craft">craft</button>
                <button class="filter-btn btn btn-white" data-value="drink">drink</button>
                <button class="filter-btn btn btn-white" data-value="beauty">beauty</button>
                <button class="filter-btn btn btn-white" data-value="furniture">furniture</button>
            </div>
        </div>
        <div class="row gy-3 justify-content-between">
            <div class="col-md-12 scroll-card">
                <div class="row">
                    @if (isset($filtered_product))
                        <h5 class="text-center my-3">Menampilkan hasil pencarian untuk <span
                                class="text-violet">{{ $search_input }}.</span> <br> <a href="{{ route('product') }}"
                                class="text-violet">klik untuk kembali</a>
                        </h5>
                        @foreach ($filtered_product as $product)
                            <div class="product-item col-6 col-lg-3" data-category="{{ $product->product_category }}"
                                data-id="{{ $product->id }}">
                                <div class="card ">
                                    <div class="card-body p-2">
                                        <div class="product-img"
                                            style="background-image: url('{{ asset('product_photo/' . $product->product_photo) }}')">
                                        </div>
                                        <div class="px-2">
                                            <div class="my-3 d-flex justify-content-between align-items-start">
                                                <h5>{{ $product->name }}</h5>
                                                <h5>Rp.{{ $product->price }}</h5>
                                            </div>
                                            <a class="fs-small" href="{{ route('product-detail', [$product->id]) }}">Klik
                                                Untuk
                                                detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($products as $product)
                            <div class="product-item col-6 col-lg-3" data-category="{{ $product->product_category }}"
                                data-id="{{ $product->id }}">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="product-img"
                                            style="background-image: url('{{ asset('product_photo/' . $product->product_photo) }}')">
                                        </div>
                                        <div class="product-detail px-2">
                                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                                <h5>{{ $product->name }}</h5>
                                                <h5>Rp.{{ $product->price }}</h5>
                                            </div>
                                            <a class="fs-small" href="{{ route('product-detail', [$product->id]) }}">Klik
                                                Untuk
                                                detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- <div class="col-md-4 scroll-card">
                <div class="card">
                    <div class="card-body p-2">
                        <img src="{{ asset('product_photo/' . $test->product_photo) }}" class="img-fluid">
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold">{{ $test->name }}</h5>
                            <h5 class="fw-bold">Rp.{{ $test->price }}</h5>
                        </div>
                        <a class="fs-small" href="{{ route('product-detail', [$test->id]) }}">Klik
                            Untuk
                            detail</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts-test.footer')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
