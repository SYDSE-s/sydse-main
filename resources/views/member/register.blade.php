@extends('layouts-test.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

{{-- @section('navbar')
    @include('layouts-test.navbar')
@endsection --}}

@section('content')
    <form action="{{ route('register[post]') }}" method="POST" name="register-member" enctype="multipart/form-data"
        class="wrapper">
        @csrf
        <div class="text-container">

            {{-- business profile --}}
            @if (Session::get('step', 1) == 1)
                <input type="hidden" class="jsjsj" name="step" id="step" value="1">
                <div class="text-item">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i>Profil Bisnis</i></h4>
                        <h6 class="title-desc">1 dari 5</h6>
                    </div>
                    <div class="form-group">
                        <input type="text" name="business_name"
                            class="register-input @error('business_name') is-invalid @enderror form-control" autofocus
                            placeholder="Nama bisnis"
                            value="{{ Session::get('step1.business_name') ?? old('business_name') }}">
                        @error('business_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select id="business_category" name="business_category"
                            class="register-input @error('business_category') is-invalid @enderror form-select">
                            @if (old('business_category'))
                                <option value="{{ old('business_category') }}">{{ old('business_category') }}</option>
                            @elseif (Session::has('step1.business_category'))
                                <option value="{{ session::get('step1.business_category') }}">
                                    {{ session::get('step1.business_category') }}</option>
                            @else
                                <option value="">Pilih Kategori</option>
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
                        @error('business_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select id="business_duration" name="business_duration"
                            class="register-input @error('business_duration') is-invalid @enderror form-select">
                            @if (old('business_duration'))
                                <option value="{{ old('business_duration') }}">{{ old('business_duration') }} </option>
                            @elseif (Session::has('step1.business_duration'))
                                <option value="{{ session::get('step1.business_duration') }}">
                                    {{ session::get('step1.business_duration') }}</option>
                            @else
                                <option value="">Lama Usaha</option>
                            @endif
                            <option value="1">1 Tahun</option>
                            <option value="2">2 Tahun</option>
                            <option value="3-5">3-5 Tahun</option>
                            <option value="5-10">5-10 Tahun</option>
                        </select>
                        @error('business_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="owner_name"
                            class="register-input @error('owner_name') is-invalid @enderror form-control"
                            placeholder="Nama Pemilik Bisnis"
                            value="{{ Session::get('step1.owner_name') ?? old('owner_name') }}">
                        @error('owner_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" name="phone_number"
                            class="register-input @error('phone_number') is-invalid @enderror form-control"
                            placeholder="Nomor telpon / Nomor whatsapp"
                            value="{{ Session::get('step1.phone_number') ?? old('phone_number') }}">
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="navigation-wrapper">
                        <button type="submit" class="next register-input btn btn-primary"
                            style="width: 100%;">Selanjutnya</button>
                    </div>
                </div>
            @endif


            {{-- Business location --}}
            @if (Session::get('step') == 2)
                <input type="hidden" name="step" id="step" value="2">
                <div class="text-item">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i>Lokasi Bisnis</i></h4>
                        <h6 class="title-desc">2 dari 5</h6>
                    </div>
                    <div class="form-group">
                        @foreach ($regions as $region)
                            @if ($region['kode'] == '33')
                                <input type="text" required name="province"
                                    value="{{ $region['nama'] }}"placeholder="{{ $region['nama'] }}"
                                    class="register-input @error('province') is-invalid @enderror form-control" hidden>
                            @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <select name="city" id="citySelect"
                            class="register-input @error('city') is-invalid @enderror form-select">

                            {{-- if old value exist --}}
                            @if (old('city'))
                                <option value="{{ old('city') }}">{{ old('city') }}</option>

                                @foreach ($regions as $region)
                                    @if (count(explode('.', $region->kode)) === 2)
                                        <option value="{{ $region->nama }}" data-code="{{ $region->kode }}">
                                            {{ $region->nama }}
                                        </option>
                                    @endif
                                @endforeach

                                {{-- if session value exist --}}
                            @elseif (Session::has('step2.city'))
                                <option value="{{ session::get('step2.city') }}">
                                    {{ session::get('step2.city') }}</option>

                                @foreach ($regions as $region)
                                    @if (count(explode('.', $region->kode)) === 2)
                                        <option value="{{ $region->nama }}" data-code="{{ $region->kode }}">
                                            {{ $region->nama }}
                                        </option>
                                    @endif
                                @endforeach

                                {{-- if old value / session value doesn't exist --}}
                            @else
                                <option>Pilih Kota / Kabupaten</option>

                                @foreach ($regions as $region)
                                    @if (count(explode('.', $region->kode)) === 2)
                                        <option value="{{ $region->nama }}" data-code="{{ $region->kode }}">
                                            {{ $region->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select name="sub_district" id="subDistrictSelect"
                            class="register-input @error('sub_district') is-invalid @enderror form-select">

                            {{-- if old value exist --}}
                            @if (old('sub_district'))
                                <option value="{{ old('sub_district') }}">{{ old('sub_district') }}</option>

                            {{-- if session value exist --}}
                            @elseif (Session::has('step2.sub_district'))
                                <option value="{{ session::get('step2.sub_district') }}">{{ session::get('step2.sub_district') }}</option>

                            {{-- if old value / session value doesn't exist --}}
                            @else
                                <option>Pilih Kecamatan</option>
                            @endif
                        </select>
                        @error('sub_district')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select name="village" id="villageSelect"
                            class="register-input @error('village') is-invalid @enderror form-select">

                            {{-- if old value exist --}}
                            @if (old('village'))
                                <option value="{{ old('village') }}">{{ old('village') }}</option>

                            {{-- if session value exist --}}
                            @elseif (Session::has('step2.village'))
                                <option value="{{ session::get('step2.village') }}">{{ session::get('step2.village') }}</option>

                            {{-- if old value / session value doesn't exist --}}
                            @else
                                <option>Pilih Desa</option>
                            @endif
                        </select>
                        @error('village')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="register-input @error('address') is-invalid @enderror form-control" style="height: 100px">{{ Session::get('step2.address') ?? (old('address')) ?? "Alamat Lengkap"}}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="navigation-wrapper">
                        <button type="submit" name="back" value="1"
                            class="back register-input btn btn-secondary">Kembali</button>
                        <button type="submit" class="next register-input btn btn-primary">Selanjutnya</button>
                    </div>
                </div>
            @endif

            {{-- account --}}
            @if (Session::get('step') == 3)
                <input type="hidden" name="step" id="step" value="3">
                <div class="text-item">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i>Akun</i></h4>
                        <h6 class="title-desc">3 dari 5</h6>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name"
                            class="register-input @error('name') is-invalid @enderror form-control" placeholder="Nama"
                            value="{{ Session::get('step3.name') ?? old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="username"
                            class="register-input @error('username') is-invalid @enderror form-control"
                            placeholder="Username" value="{{ Session::get('step3.username') ?? old('username') }}">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email"
                            class="register-input @error('email') is-invalid @enderror form-control" placeholder="Email"
                            value="{{ Session::get('step3.email') ?? old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="password-input">
                            <input type="password" name="password"
                                class="register-input @error('password') is-invalid @enderror form-control"
                                id="input-password" placeholder="Password"
                                value="{{ Session::get('step3.password') ?? old('password') }}">
                                <img src="{{ asset('icon/eyes-on.png') }}" height="25" class="eyes-on" onclick="showPassword()">
                                <img src="{{ asset('icon/eyes-off.png') }}" height="25" class="eyes-off" onclick="showPassword()">
                            {{-- <input type="checkbox" onclick="showPassword()">Show Password --}}
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="navigation-wrapper">
                        <button type="submit" name="back" value="2"
                            class="back register-input btn btn-secondary">Kembali</button>
                        <button type="submit" class="next register-input btn btn-primary">Selanjutnya</button>
                    </div>
                </div>
            @endif

            {{-- Documentation --}}
            {{-- <div class="text-item">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4><i>Dokumentasi</i></h4>
                    <h6 class="title-desc">3 dari 7</h6>
                </div>
                <input type="number" name="id_card_number" class="register-input form-control" placeholder="NIK">
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
                <div class="my-3">
                    <label for="product_photo">Foto Produk :</label>
                    <input type="file" required name="product_photo" class="register-input form-control"
                        id="product_photo">
                </div>
                <div class="navigation-wrapper">
                    <button type="button" class="back register-input btn btn-secondary">Kembali</button>
                    <button type="button" class="next register-input btn btn-primary">Selanjutnya</button>
                </div>
            </div> --}}

            {{-- Bank Account --}}
            {{-- <div class="text-item">
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
            </div> --}}

            {{-- Additional information --}}
            @if (Session::get('step') == 4)
                <input type="hidden" name="step" id="step" value="4">
                <div class="text-item">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i>Berkas Tambahan</i></h4>
                        <h6 class="title-desc">3 dari 5</h6>
                    </div>
                    <h6 class="mb-3">Berkas bersifat opsional, isi field dibawah jika anda memilikinya. Jika tidak
                        silahkan
                        klik <i><b>Selanjutnya</b></i></h6>

                    {{-- NIB --}}
                    <div class="form-group">
                        <label for="nib_license">Nomor Induk Berusaha</label>
                        <input type="number" name="nib_license"
                            class="register-input @error('nib_license') is-invalid @enderror form-control"
                            placeholder="Masukan NIB"
                            value="{{ Session::get('step4.nib_license') ?? old('nib_license') }}">
                        @error('nib_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Lisensi Halal --}}
                    <div class="form-group">
                        <label for="halal_license">Lisensi Halal :</label>
                        <input type="text" name="halal_license"
                            class="register-input @error('halal_license') is-invalid @enderror form-control"
                            placeholder="Masukan Nomor Sertifikat Halal"
                            value="{{ Session::get('step4.halal_license') ?? old('halal_license') }}">
                        @error('halal_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Lisensi PIRT --}}
                    <div class="form-group">
                        <label for="pirt_license">Lisensi PIRT :</label>
                        <input type="text" name="pirt_license"
                            class="register-input @error('pirt_license') is-invalid @enderror form-control"
                            id="pirt_license" placeholder="Masukan nomor P-IRT"
                            value="{{ Session::get('step4.pirt_license') ?? old('pirt_license') }}">
                        @error('pirt_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Lisensi BPOM --}}
                    <div class="form-group">
                        <label for="bpom_license">Lisensi BPOM :</label>
                        <input type="text" name="bpom_license"
                            class="register-input @error('bpom_license') is-invalid @enderror form-control"
                            id="bpom_license" placeholder="Masukan nomor sertifikasi BPOM"
                            value="{{ Session::get('step4.bpom_license') ?? old('bpom_license') }}">
                        @error('bpom_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="navigation-wrapper">
                        <button type="submit" name="back" value="3"
                            class="back register-input btn btn-secondary">Kembali</button>
                        <button type="submit" class="next register-input btn btn-primary">Selanjutnya</button>
                    </div>
                </div>
            @endif

            {{-- Additional information --}}
            @if (Session::get('step') == 5)
                <input type="hidden" name="step" id="step" value="5">

                <div class="text-item">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i>Berkas Tambahan</i></h4>
                        <h6 class="title-desc">4 dari 5</h6>
                    </div>

                    <div class="form-group">
                        <label for="hki_license">Lisensi HKI :</label>
                        <input type="text" name="hki_license"
                            class="register-input @error('hki_license') is-invalid @enderror form-control"
                            id="hki_license" placeholder="Masukan nomor paten HKI"
                            value="{{ Session::get('step5.hki_license') ?? old('hki_license') }}">
                        @error('hki_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nutrition_test_license">Lisensi Uji Nutrisi :</label>
                        <input type="text" name="nutrition_test_license"
                            class="register-input @error('nutrition_test_license') is-invalid @enderror form-control"
                            id="nutrition_test_license" placeholder="Masukan nomor Lisensi Uji Nutrisi"
                            value="{{ Session::get('step5.nutrition_test_license') ?? old('nutrition_test_license') }}">
                        @error('nutrition_test_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="haccp_license">Lisensi HACCP :</label>
                        <input type="text" name="haccp_license"
                            class="register-input @error('haccp_license') is-invalid @enderror form-control"
                            id="haccp_license" placeholder="Masukan nomor sertifikasi HACCP"
                            value="{{ Session::get('step5.haccp_license') ?? old('haccp_license') }}">
                        @error('haccp_license')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="navigation-wrapper">
                        <button type="submit" name="back" value="4"
                            class="back register-input btn btn-secondary">Kembali</button>
                        <button type="submit" class="next register-input btn btn-primary">Selanjutnya</button>
                    </div>
                </div>
            @endif

            {{-- confirm --}}
            @if (Session::get('step') == 6)
                <input type="hidden" name="step" id="step" value="6">

                <div class="text-item">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i>Konfirmasi</i></h4>
                        <h6 class="title-desc">Finalisasi</h6>
                    </div>
                    <h6 class="mb-3">Periksa Informasi yang anda masukan. Jika tidak kesalahan mengisi informasi silahkan
                        klik <i><b>Submit</b></i></h6>
                    <div class="navigation-wrapper">
                        <button type="submit" name="back" value="5"
                            class="back register-input btn btn-secondary">Kembali</button>
                        <button type="submit" class="register-input btn btn-success"
                            style="width: 48%; margin-bottom: 0px;">Submit</button>
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection

{{-- @section('footer')
    @include('layouts-test.footer')
@endsection --}}

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/region.js') }}"></script>
    <script src="{{ asset('js/register.js') }}"></script>
@endsection

{{-- @if (Session::has('step_back'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showPrevForm({{ Session::get('step_back') }});
        });
    </script>
{{-- @endif --}}

{{-- @if (Session::get('step') == 2)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showNextForm();
        });
    </script>
@endif

@if (Session::get('step') == 3)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showNextForm();
        });
    </script>
@endif --}}
