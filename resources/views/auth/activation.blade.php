@extends('layouts.app')

@section('content')
    @if (session('stored_userdata'))
        {{-- <div class="wrapper">
            <div>
                <h1>Selamat! UMKM kamu telah terdaftar</h1>
                <h3>Untuk mengikuti event UMKM solo yang diadakan oleh PUS, silahkan klik <b><i>aktivasi akun</i></b></h3>
                <form action="{{ route('activation') }}" method="post">
                    @csrf
                    <button class="request_activation" type="submit">Aktivasi Akun</button>
                </form>
            </div>
        </div> --}}
        <div class="table-responsive">
            <table class="table table-hover sales-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nama Bisnis</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nomor handphone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['business_name'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td>{{ $item['no_whatsapp'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
