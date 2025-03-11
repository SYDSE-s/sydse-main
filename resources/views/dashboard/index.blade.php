@extends('layouts-test.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css') }}">
@endsection

@section('navbar')
@endsection

@section('content')
    <!-- Wrapper untuk Sidebar dan Konten -->

    <div class="container-flex">
        <!-- Sidebar -->
        @include('layouts-test.sidebar')

        <!-- Konten Utama -->
        <div class="d-flex flex-column flex-grow-1">
            @include('layouts-test.navbar-dashboard')
            <div id="content" class="content pe-0 pe-sm-5 ms-4 mt-4">
                <h5 class="fw-bold mb-4">Dashboard</h5>

                {{-- main feature card --}}
                <div class="row gy-3 pe-0 pe-sm-5">
                    <div class="col-md-6">
                        <a class="card" href="">
                            <div class="card-body">
                                <div class="card-inner">
                                    <h5 class="fw-bold">Download KTA</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="card" href="{{ route('manage-product') }}">
                            <div class="card-body">
                                <div class="card-inner">
                                    <div>
                                        <h5 class="fw-bold mb-3">Produk Terdaftar</h5>
                                        <h5>999 Produk</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="card" href="">
                            <div class="card-body">
                                <div class="card-inner">
                                    <div>
                                        <h5 class="fw-bold mb-3">Produk Online Terjual (e-commerce)</h5>
                                        <h5>999 Produk</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="card" href="">
                            <div class="card-body">
                                <div class="card-inner">
                                    <div>
                                        <h5 class="fw-bold mb-3">Produk Online Terjual (Kasir Dashboard)</h5>
                                        <h5>999 Produk</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {{-- @include('layouts-test.footer') --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
