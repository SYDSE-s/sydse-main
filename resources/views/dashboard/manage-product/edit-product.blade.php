@extends('layouts-test.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/add-edit-product.css') }}">
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
                <h5 class="fw-bold mb-4">Edit Produk</h5>

                {{-- main feature card --}}
                <div class="card add-product-card">
                    <div class="card-body">
                        <form action="{{ route('edit-product', [$product->id]) }}" enctype="multipart/form-data" method="POST"
                            name="add-product">
                            @csrf
                            <div class="row mb-3">
                                <label for="product_photo" class="col-sm-2 col-form-label">Foto Produk</label>
                                <div class="col-sm-10">
                                    <input type="file" name="product_photo"
                                        class="form-control @error('product_photo') is-invalid @enderror" id="product_photo" autofocus>
                                    @error('product_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name" required
                                        value="{{ $product->name ?? old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Harga Produk</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror" id="price" required
                                        value="{{ $product->price ?? old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="product_category" class="col-sm-2 col-form-label">Kategori Produk</label>
                                <div class="col-sm-10">
                                    <select id="product_category" name="product_category"
                                        class="register-input @error('product_category') is-invalid @enderror form-select">
                                        @if ($product->product_category)
                                            <option value="{{ $product->product_category }}">
                                                {{ $product->product_category }}
                                            </option>
                                        @elseif (old('product_category'))
                                            <option value="{{ old('product_category') }}">{{ old('product_category') }}
                                            </option>
                                        @else
                                            <option value=""></option>
                                        @endif
                                        <option value="kuliner kering">kuliner kering</option>
                                        <option value="kuliner basah">kuliner basah</option>
                                        <option value="fashion">fashion</option>
                                        <option value="jasa">jasa</option>
                                        <option value="craft">craft</option>
                                        <option value="drink">drink</option>
                                        <option value="beauty">beauty</option>
                                        <option value="furniture">furniture</option>
                                    </select>
                                    @error('product_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                        style="height: 140px;" required>{{ $product->description ?? old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('manage-product') }}" class="btn btn-aqua">Kembali</a>
                                <button type="submit" class="btn btn-outline-aqua">Simpan</button>
                            </div>
                        </form>
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
