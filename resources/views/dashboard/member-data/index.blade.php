@extends('layouts.app')
@extends('layouts.sidebar')
@extends('layouts.navbar')
@extends('layouts.footer')

@section('content')
    <div class="card px-4 py-2 pb-3" style="background-color: var(--second);">
        <div class="row justify-content-center align-items-center gy-2">
            <div class="col-md-4">
                <div class="fw-bold mb-2 text-center">Data Anggota PUS Terdaftar</div>
            </div>
        </div>
        <div class="card-body px-5 py-2 scroll-card" style="height: 67vh">
            <div class="table-responsive">
                <table class="table table-hover sales-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Usaha</th>
                            <th scope="col">Nama Pemilik</th>
                            <th scope="col">Kategori Usaha</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($data_member as $data)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $data->business_name }}</td>
                                <td>{{ $data->owner_name }}</td>
                                <td>{{ $data->business_category }}</td>
                                <td>{{ $data->phone_number }}</td>
                                <td>
                                    <a href="{{ "dashboard/details{$data->id}" }}"
                                        class="btn btn-primary">Details</a>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div style="width: 100%; text-align:center;">
            <button class="btn btn-success export-btn w-25 mt-3">Export to Excel</button>
        </div>
    </div>

    <table class="table table-responsive table-hover" id="data-table" style="display: none">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Bisnis</th>
                <th scope="col">Bisnis Kategori</th>
                <th scope="col">Lama Usaha</th>
                <th scope="col">Nama Pemilik</th>
                <th scope="col">email</th>
                <th scope="col">Nomor Hp</th>
                <th scope="col">Provinsi</th>
                <th scope="col">Kota</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Desa</th>
                <th scope="col">NIK</th>
                <th scope="col">Foto KTP</th>
                <th scope="col">Selfie KTP</th>
                <th scope="col">Foto Produk</th>
                <th scope="col">Nama Rekening</th>
                <th scope="col">Nomor Rekening</th>
                <th scope="col">Pemegang Rekening</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @foreach ($data_member as $data)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $data->business_name }}</td>
                    <td>{{ $data->business_category }}</td>
                    <td>{{ $data->business_duration }}</td>
                    <td>{{ $data->owner_name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone_number }}</td>
                    <td>{{ $data->province }}</td>
                    <td>{{ $data->city }}</td>
                    <td>{{ $data->sub_district }}</td>
                    <td>{{ $data->village }}</td>
                    <td>{{ $data->id_card_number }}</td>
                    <td>
                        <img height="100" src="{{ route('photo', ['photo' => $data->id_card_photo]) }}"
                            alt="{{ route('photo', ['photo' => $data->id_card_photo]) }}">
                    </td>
                    <td>
                        <img height="100" src="{{ route('selfie', ['selfie' => $data->id_card_selfie]) }}"
                            alt="{{ route('selfie', ['selfie' => $data->id_card_selfie]) }}">
                    </td>
                    <td>
                        <img height="100" src="{{ asset("product_photo/$data->product_photo") }}"
                            alt="{{ $data->product_photo }}">
                    </td>
                    <td>{{ $data->bank_name }}</td>
                    <td>{{ $data->bank_account_number }}</td>
                    <td>{{ $data->bank_holders_name }}</td>
                </tr>
                @php
                    $count++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection