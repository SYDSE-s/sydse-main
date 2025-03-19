@extends('layouts.app')
@extends('layouts.navbar-dashboard')
@extends('layouts.sidebar')
@extends('layouts.footer-dashboard')

@section('content')
    <!-- Add CSRF token meta tag for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                                    <button class="qr-generate-btn" data-id="{{ $data->id }}">Generate QR</button>
                                    <div class="qrcode-container">
                                        @if($data->qrcode)
                                            <div style="padding: 10px; background: #fff; display: inline-block; margin: 10px 0;">
                                                <img src="{{ asset($data->qrcode) }}" alt="QR Code" width="128" height="128">
                                                <a href="{{ asset($data->qrcode) }}" download="qrcode-{{ $data->id }}.png" class="btn btn-sm btn-info mt-2 d-block">Download QR Code</a>
                                            </div>
                                        @endif
                                    </div>
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
        <!-- Rest of your code remains the same -->
    </div>

    <!-- Hidden table for export -->
    <table class="table table-responsive table-hover" id="data-table" style="display: none">
        <!-- Your existing hidden table code -->
    </table>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/qrcode_generator.js') }}"></script>
@endsection
