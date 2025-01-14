@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('register[post]') }}" method="POST" name="register-member" enctype="multipart/form-data"
        class="wrapper">
        @csrf
        <div class="text-container">

            {{-- business profile --}}
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Profil Bisnis</i></h4>
                    <h6 class="title-desc">1 dari 7</h6>
                </div>
                <input type="text" required name="business_name" class="register-input business-profile form-control"
                    placeholder="Nama bisnis" autofocus>
                <select id="business_category" required name="business_category" class="register-input business-profile form-select">
                    <option value="null">Kategori Bisnis</option>
                    <option value="kuliner kering">kuliner kering</option>
                    <option value="kuliner basah">kuliner basah</option>
                    <option value="fashion">fashion</option>
                    <option value="jasa">jasa</option>
                    <option value="craft">craft</option>
                    <option value="drink">drink</option>
                    <option value="beauty">beauty</option>
                    <option value="furniture">furniture</option>
                </select>
                <select id="business_duration" required name="business_duration" class="register-input business-profile form-select">
                    <option value="null">Lama Usaha</option>
                    <option value="1">1 Tahun</option>
                    <option value="2">2 Tahun</option>
                    <option value="3-5">3-5 Tahun</option>
                    <option value="5-10">5-10 Tahun</option>
                </select>
                <input type="text" required name="owner_name" class="register-input business-profile form-control"
                    placeholder="Nama Pemilik Bisnis">
                <input type="email" required name="email" class="register-input business-profile form-control" placeholder="Email">
                <input type="number" required name="phone_number" class="register-input business-profile form-control"
                    placeholder="Nomor telpon / Nomor whatsapp">
                <div class="navigation-wrapper">
                    <div></div>
                    <button type="button" class="next register-input business-profile btn btn-primary"
                        style="width: 100%;">Selanjutnya</button>
                </div>
            </div>

            {{-- Business location --}}
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Lokasi Bisnis</i></h4>
                    <h6 class="title-desc">2 dari 7</h6>
                </div>
                @foreach ($regions as $region)
                    @if ($region['kode'] == '33')
                        <input type="text" required name="province"
                            value="{{ $region['nama'] }}"placeholder="{{ $region['nama'] }}"
                            class="register-input form-control" hidden>
                    @endif
                @endforeach
                <select required name="city" id="citySelect" class="register-input form-select">
                    @foreach ($regions as $region)
                        @if (count(explode('.', $region->kode)) === 2)
                            <option value="{{ $region->nama }}" data-code="{{ $region->kode }}">{{ $region->nama }}</option>
                        @endif
                    @endforeach
                </select>
                <select required name="sub_district" id="subDistrictSelect" class="register-input form-select">
                    <option value="">Pilih Kecamatan</option>
                </select>
                <select required name="village" id="villageSelect" class="register-input form-select">
                    <option value="">Pilih Desa</option>
                </select>
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="button" class="next register-input btn btn-primary">Selanjutnya</button>
                </div>
            </div>

            {{-- Documentation --}}
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Dokumentasi</i></h4>
                    <h6 class="title-desc">3 dari 7</h6>
                </div>
                <input type="number" name="id_card_number" required class="register-input form-control" placeholder="NIK">
                <div class="my-3">
                    <label for="id_card_photo">Foto KTP :</label>
                    <input type="file" required name="id_card_photo" class="register-input form-control"
                        id="id_card_photo">
                </div>
                <div class="my-3">
                    <label for="id_card_selfie">Selfie dengan KTP :</label>
                    <input type="file" required name="id_card_selfie" class="register-input form-control"
                        id="id_card_selfie">
                </div>
                {{-- <div class="my-3">
                    <label for="product_photo">Foto Produk :</label>
                    <input type="file" required name="product_photo" class="register-input form-control"
                        id="product_photo">
                </div> --}}
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="button" class="next register-input btn btn-primary">Selanjutnya</button>
                </div>
            </div>

            {{-- Bank Account --}}
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Akun bank</i></h4>
                    <h6 class="title-desc">4 dari 7</h6>
                </div>
                <select required name="bank_name" class="register-input form-select">
                    @foreach ($banks as $bank)
                        <option value="{{ $bank->name }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="bank_account_number" class="register-input form-control"
                    placeholder="Nomor Rekening">
                <input type="text" name="bank_holders_name" class="register-input form-control"
                    placeholder="Nama Pemilik Rekening">
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="button" class="next register-input btn btn-primary">Selanjutnya</button>
                </div>
            </div>

            {{-- Additional nformation --}}
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Berkas Tambahan</i></h4>
                    <h6 class="title-desc">5 dari 7</h6>
                </div>
                <h6 class="mb-3">Berkas bersifat opsional, isi field dibawah jika anda memilikinya. Jika tidak silahkan
                    klik <i><b>Selanjutnya</b></i></h6>
                {{-- NIB --}}
                <label for="nib_license">Nomor Induk Berusaha</label>
                <input type="number" name="nib_license" class="register-input form-control" placeholder="Masukan NIB">

                {{-- Lisensi Halal --}}
                <label for="halal_license">Lisensi Halal :</label>
                <input type="text" name="halal_license" class="register-input form-control"
                    placeholder="Masukan Nomor Sertifikat Halal">

                {{-- Lisensi PIRT --}}
                <label for="pirt_license">Lisensi PIRT :</label>
                <input type="text" name="pirt_license" class="register-input form-control" id="pirt_license"
                    placeholder="Masukan nomor P-IRT">

                {{-- Lisensi BPOM --}}
                <label for="bpom_license">Lisensi BPOM :</label>
                <input type="text" name="bpom_license" class="register-input form-control" id="bpom_license"
                    placeholder="Masukan nomor sertifikasi BPOM">
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="button" class="next register-input btn btn-primary">Selanjutnya</button>
                </div>
            </div>

            {{-- Additional information --}}
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Berkas Tambahan</i></h4>
                    <h6 class="title-desc">6 dari 7</h6>
                </div>
                <div class="my-3">
                    <label for="hki_license">Lisensi HKI :</label>
                    <input type="text" name="hki_license" class="register-input form-control" id="hki_license"
                        placeholder="Masukan nomor paten HKI">
                </div>
                <div class="my-3">
                    <label for="nutrition_test_license">Lisensi Uji Nutrisi :</label>
                    <input type="text" name="nutrition_test_license" class="register-input form-control"
                        id="nutrition_test_license" placeholder="Masukan nomor Lisensi Uji Nutrisi">
                </div>
                <div class="my-3">
                    <label for="haccp_license">Lisensi HACCP :</label>
                    <input type="text" name="haccp_license" class="register-input form-control" id="haccp_license"
                        placeholder="Masukan nomor sertifikasi HACCP">
                </div>
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="button" class="next register-input last-btn btn btn-primary">Selanjutnya</button>
                </div>
            </div>
            <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Konfirmasi</i></h4>
                    <h6 class="title-desc">7 dari 7</h6>
                </div>
                <h6 class="mb-3">Periksa Informasi yang anda masukan. Jika tidak kesalahan mengisi informasi silahkan
                    klik <i><b>Submit</b></i></h6>
                {{-- <div class="my-3" style="height: 60vh !important">
                    <div class="accordion accordion-flush" id="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="business-profile">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-business-profile" aria-expanded="false"
                                    aria-controls="flush-business-profile">
                                    Business Profile
                                </button>
                            </h2>
                            <div id="flush-business-profile" class="accordion-collapse collapse show"
                                aria-labelledby="business-profile" data-bs-parent="#accordion">
                                <div class="accordion-body ul-business-profile">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="submit" class="register-input btn btn-success"
                        style="width: 48%; margin-bottom: 0px;">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/region.js') }}"></script>
    <script src="{{ asset('js/register.js') }}"></script>
@endsection
