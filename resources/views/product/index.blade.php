@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row gy-3 mt-1">
            <div class="col-md-8">
                <div class="card" style="background-color: var(--second);">
                    <div class="card-body p-4 scroll-card">
                        <div
                            class="filter-category desktop d-flex flex-wrap justify-content-start align-items-center gap-1 mb-4">
                            <button class="filter-btn btn  filter-btn-active" data-value="semua">semua</button>
                            <button class="filter-btn btn" data-value="kuliner kering">kuliner kering</button>
                            <button class="filter-btn btn" data-value="kuliner basah">kuliner basah</button>
                            <button class="filter-btn btn" data-value="fashion">Fashion</button>
                            <button class="filter-btn btn" data-value="jasa">jasa</button>
                            <button class="filter-btn btn" data-value="craft">craft</button>
                            <button class="filter-btn btn" data-value="drink">drink</button>
                            <button class="filter-btn btn" data-value="beauty">beauty</button>
                            <button class="filter-btn btn" data-value="furniture">furniture</button>
                        </div>
                        <div class="filter-category phone">
                            <div class="accordion" id="filter-category">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="filter-heading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#filter" aria-expanded="true" aria-controls="filter">
                                            Filter Kategori Produk
                                        </button>
                                    </h2>
                                    <div id="filter" class="accordion-collapse collapse" aria-labelledby="filter-heading"
                                        data-bs-parent="#filter-category">
                                        <div class="accordion-body">
                                            <div
                                                class="d-flex flex-wrap justify-content-start align-items-center gap-1 mb-4">
                                                <button class="filter-btn btn  filter-btn-active"
                                                    data-value="semua">semua</button>
                                                <button class="filter-btn btn" data-value="kuliner kering">kuliner
                                                    kering</button>
                                                <button class="filter-btn btn" data-value="kuliner basah">kuliner
                                                    basah</button>
                                                <button class="filter-btn btn" data-value="fashion">Fashion</button>
                                                <button class="filter-btn btn" data-value="jasa">jasa</button>
                                                <button class="filter-btn btn" data-value="craft">craft</button>
                                                <button class="filter-btn btn" data-value="drink">drink</button>
                                                <button class="filter-btn btn" data-value="beauty">beauty</button>
                                                <button class="filter-btn btn" data-value="furniture">furniture</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 desktop">
                            @foreach ($product as $item)
                                <div class="col-md-4 item-col"
                                    data-category="{{ $item->member->business_category }}">
                                    <div class="item"
                                        style="background-image: url({{ asset('product_photo/' . $item['product_photo']) }})"
                                        data-photo="{{ $item->product_photo }}" data-name="{{ $item->name }}"
                                        data-desc="{{ $item->description }}"
                                        data-owner_name="{{ $item->member->owner_name }}"
                                        data-province="{{ $item->member->province }}" data-city="{{ $item->member->city }}"
                                        data-sub_district="{{ $item->member->sub_district }}"
                                        data-village="{{ $item->member->village }}"
                                        data-phone_number="{{ $item->member->phone_number }}"
                                        data-price="{{ $item->price }}" data-nib="{{ $item->member->nib_license }}"
                                        data-halal="{{ $item->member->halal_license }}"
                                        data-pirt="{{ $item->member->pirt_license }}"
                                        data-bpom="{{ $item->member->bpom_license }}"
                                        data-hki="{{ $item->member->hki_license }}"
                                        data-nutrition="{{ $item->member->nutrition_test_license }}"
                                        data-haccp="{{ $item->member->haccp_license }}">
                                        <div class="item-info">
                                            <div>
                                                <div class="fs-6">{{ $item['name'] }}</div>
                                            </div>
                                            <div class="price">
                                                <div class="fs-6">Rp. {{ $item['price'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row gy-4 phone">
                            @foreach ($product as $item)
                                <a class="col-md-4 item-col"
                                    data-category="{{ $item->member->business_category }}"
                                    href="{{ "/product/details{$item['id']}" }}">
                                    <div class="item" style="background-image: url({{ asset('product_photo/' . $item['product_photo']) }})">
                                        <div class="item-info">
                                            <div>
                                                <div class="fs-6">{{ $item['name'] }}</div>
                                            </div>
                                            <div class="price">
                                                <div class="fs-6">Rp. {{ $item['price'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="product-detail">
                <div class="card p-4" style="background-color: var(--second);">
                    <div class="card-body p-0 scroll-card">
                        <div class="img-product"></div>
                        <div class="detail-product">
                            <div class="d-flex flex-column gap-1">
                                <h6><strong class="name"></strong></h6>
                                <div class="description mb-2 fs-7"></div>
                                <div class="owner_name fs-7"></div>
                                <div class="location fs-7"></div>
                                <div class="phone_number fs-7"></div>
                            </div>
                            <div class="d-flex flex-column justify-content-between">
                                <h6 class="price"><strong>Rp.25.000</strong></h6>
                            </div>
                        </div>
                        <a href="" class="btn btn-primary w-100 mb-3">Beli Produk</a>
                        <div class="accordion accordion-flush" id="accordion-license">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="license-heading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#license" aria-expanded="true" aria-controls="license">
                                        Lisensi UMKM
                                    </button>
                                </h2>
                                <div id="license" class="accordion-collapse collapse" aria-labelledby="license-heading"
                                    data-bs-parent="#accordion-license">
                                    <div class="accordion-body">
                                        <ul>
                                            <li class="nib"></li>
                                            <li class="halal"></li>
                                            <li class="pirt"></li>
                                            <li class="bpom"></li>
                                            <li class="hki"></li>
                                            <li class="nutrition"></li>
                                            <li class="haccp"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
