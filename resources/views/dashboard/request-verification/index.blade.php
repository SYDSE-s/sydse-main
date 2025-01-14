@extends('layouts.app')
@extends('layouts.navbar-dashboard')
@extends('layouts.sidebar')
@extends('layouts.footer-dashboard')

@section('content')
    <div class="card px-4 py-2 pb-3" style="background-color: var(--second);">
        <div class="row justify-content-center align-items-center gy-2">
            <div class="col-md-4">
                <div class="fw-bold mb-2 text-center">Permintaan Verifikasi</div>
            </div>
        </div>
        <div class="card-body px-5 py-2 scroll-card" style="height: 70vh">
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
                                    <a href="{{ "request-verification/{$data->id}" }}"
                                        class="btn btn-primary">Lihat Bukti</a>
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
    </div>
@endsection