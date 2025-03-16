@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/manage-product.css') }}">
@endsection

@section('content')
    <!-- Wrapper untuk Sidebar dan Konten -->

    <div class="container-flex">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Konten Utama -->
        <div class="d-flex flex-column flex-grow-1">
            @include('components.navbar-dashboard')
            <div id="content" class="content pe-0 pe-sm-5 ms-4 mt-4">
                <h5 class="fw-bold mb-4">Manage Product</h5>

                {{-- main feature card --}}
                <div class="card">
                    <div class="card-body">

                        {{-- check if user has added product --}}
                        @if (count($products) == 0)
                            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 50vh;">
                                <h4>Anda belum menambahkan <span class="blue-highlight">produk</span>, klik tombol dibawah
                                    untuk menambahkan <span class="blue-highlight">produk</span></h4>
                                <a href="{{ route('add-product-v') }}" class="btn add-product">Tambah Produk</a>
                            </div>
                        @else
                            {{-- add and search product --}}
                            <div class="d-flex gap-2" style="margin-bottom: 18px">
                                <div>
                                    <a href="{{ route('add-product-v') }}" class="btn add-product">Tambah Produk</a>
                                </div>
                                <div class="flex-grow-1">
                                    <form action="{{ route('search-product') }}" method="POST" class="search">
                                        @csrf
                                        <input type="text" name="search-product" placeholder="Cari Produk">
                                        {{-- <button type="submit" class="btn btn-white">Search</button> --}}
                                        {{-- <a href="{{ route('product') }}" class="btn btn-first">Clear Filter</a> --}}
                                    </form>
                                </div>
                            </div>

                            {{-- product table --}}
                            <div class="wrap-table">
                                <table class="table table-responsive table-striped table-borderless table-hover">
                                    <colgroup>
                                        <col style="width: 50px; text-align: center;">
                                        <col style="width: 100px;">
                                        <col style="width: 200px;">
                                        <col style="width: 200px;">
                                        <col style="width: 300px;">
                                        <col style="width: 130px;">
                                    </colgroup>
                                    <thead class="table-head">
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th scope="col">Foto Produk</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga Produk</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($products as $item)
                                            <tr>
                                                <th class="text-center" scope="row">{{ $no }}</th>
                                                <td>
                                                    <div class="product-photo"
                                                        style="background-image: url({{ asset('product_photo/' . $item->product_photo) }})">
                                                    </div>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>Rp{{ $item->price }}</td>
                                                <td style="overflow: hidden">{{ $item->description }}</td>
                                                <td>
                                                    <a href="{{ route('edit-product-v', [$item->id]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('delete-product', $item->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="#" onclick="confirmDelete({{ $item->id }})"
                                                        class="btn btn-danger mt-2 mt-sm-0">Hapus</a>
                                                </td>
                                            </tr>
                                            @php
                                                $no = $no + 1;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Hapus Produk?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
@endsection
