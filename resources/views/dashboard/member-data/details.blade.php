@extends('layouts.app')
@extends('layouts.navbar-dashboard')
@extends('layouts.sidebar')
@extends('layouts.footer-dashboard')

@section('content')
    <div class="container">
        <table class="table table-responsive table-hover" id="data-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Bisnis</th>
                    <th scope="col">Bisnis Kategori</th>
                    <th scope="col">Lama Usaha</th>
                    <th scope="col">Nama Pemilik</th>
                    <th scope="col">Nomor Hp</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Desa</th>
                    <th scope="col">NIK</th>
                    {{-- <th scope="col">Foto KTP</th>
                    <th scope="col">Selfie KTP</th> --}}
                    {{-- <th scope="col">Foto Produk</th> --}}
                    <th scope="col">Nama Rekening</th>
                    <th scope="col">Nomor Rekening</th>
                    <th scope="col">Pemegang Rekening</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($data_members as $data)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $data->business_name }}</td>
                        <td>{{ $data->business_category }}</td>
                        <td>{{ $data->business_duration }} Tahun</td>
                        <td>{{ $data->owner_name }}</td>
                        <td>{{ $data->phone_number }}</td>
                        <td>{{ $data->province }}</td>
                        <td>{{ $data->city }}</td>
                        <td>{{ $data->sub_district }}</td>
                        <td>{{ $data->village }}</td>
                        {{-- <td>{{ $data->id_card_number }}</td>
                        <td>
                            <img height="100" src="{{ route('photo', ['photo' => $data->id_card_photo]) }}"
                                alt="{{ route('photo', ['photo' => $data->id_card_photo]) }}">
                        </td>
                        <td>
                            <img height="100" src="{{ route('selfie', ['selfie' => $data->id_card_selfie]) }}"
                                alt="{{ route('selfie', ['selfie' => $data->id_card_selfie]) }}">
                        </td> --}}
                        {{-- <td>
                            <img height="100" src="{{ asset("product_photo/$data->product_photo") }}"
                                alt="{{ $data->product_photo }}">
                        </td> --}}
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
    </div>
@endsection