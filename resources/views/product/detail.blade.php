@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="container mt-5" style="margin-top: 100px !important;">
        <div class="row gy-5 align-items-center">
            <div class="col-12">
                <div class="card">
                    <div class="row g-0 justify-content-center align-items-center">
                        <div class="col-lg-5">
                            <img src="{{ asset('product_photo/' . $product->product_photo) }}"
                                class="img-fluid rounded-start">
                        </div>
                        <div class="col-lg-4">
                            <div class="card-body py-4 px-4 px-lg-5">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fs-5 fw-bold" style="letter-spacing: 1px;">{{ $product->name }}</div>
                                        <div class="d-flex justify-content-start align-items-center mb-3"
                                            style="font-size: 15px;">
                                            {{-- <img src="/aset/icon/aqua-clock.png" height="20" class="me-2"> --}}
                                            {{ $product->description }}
                                        </div>
                                    </div>
                                    <div class="fs-5 fw-bold">Rp. {{ $product->price }}</div>
                                </div>
                                <div class="d-flex justify-content-start align-items-center fw-bold my-3"
                                    style="font-size: 15px;">
                                    {{-- <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2"> --}}
                                    {{ $product->member->business_name }}
                                </div>
                                <div class="fs-7">
                                    <div class="fw-bold mt-3" style="font-size: 15px;">
                                        Alamat :
                                    </div>
                                    <div>
                                        {{-- <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2"> --}}
                                        {{ $product->member->province }}, {{ $product->member->city }},
                                        {{ $product->member->sub_district }}, {{ $product->member->village }} <br>
                                    </div>
                                    <div class="fw-bold mt-3" style="font-size: 15px;">
                                        whatsapp :
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        {{-- <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2"> --}}
                                        <img src="{{ asset('icon/whatsapp.png') }}" height="15">
                                        <div style="color: rgb(0, 201, 0)">
                                            {{ $product->member->phone_number }}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        {{-- <img src="/aset/rating.png" height="23"> --}}
                                        <a href="#" class="btn btn-primary mt-3 px-4 py-2 w-100 test" onclick="test()">Beli
                                            Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 bordered-card">
                            <div class="card-body">
                                <div class="fw-bold" style="font-size: 15px;">
                                    Lisensi :
                                </div>
                                <div>
                                    <style>
                                        th {
                                            font-weight: 100;
                                        }
                                    </style>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>NIB</th>
                                                <th>: </th>
                                                <th>{{ $product->member->nib_license }}</th>
                                            </tr>
                                            <tr>
                                                <th>Halal</th>
                                                <th>: </th>
                                                <th>{{ $product->member->halal_license }} </th>
                                            </tr>
                                            <tr>
                                                <th>PIRT</th>
                                                <th>: </th>
                                                <th>{{ $product->member->pirt_license }}</th>
                                            </tr>
                                            <tr>
                                                <th>BPOM</th>
                                                <th>: </th>
                                                <th>{{ $product->member->bpom_license }}</th>
                                            </tr>
                                            <tr>
                                                <th>HKI</th>
                                                <th>: </th>
                                                <th>{{ $product->member->hki_license }}</th>
                                            </tr>
                                            <tr>
                                                <th>Nutritionest</th>
                                                <th>: </th>
                                                <th>{{ $product->member->nutrition_test_license }}</th>
                                            </tr>
                                            <tr>
                                                <th>HACCP</th>
                                                <th>: </th>
                                                <th>{{ $product->member->haccp_license }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-2 bordered-card">
                            <div class="card-body p-4">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/qrcode.js') }}"></script>
    @endsection
    @section('footer')
        @include('layouts.footer')
    @endsection
