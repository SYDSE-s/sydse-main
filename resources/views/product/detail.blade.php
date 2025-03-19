@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkOut.css') }}">

@endsection

@section('navbar')
    @include('components.navbar')
@endsection
@php
$subtotal = $product->price *1000;
$ongkir = 5000;
$pajak = $subtotal * 0.05;
$total = $subtotal + $ongkir + $pajak;
@endphp
@section('content')
<div class="container mt-5" style="margin-top: 100px !important;">
    <div class="row gy-5 align-items-center">
        <div class="col-12">
            <div class="card">
                <div class="row g-0 justify-content-center align-items-center">
                    <div class="col-lg-5">
                        <img src="{{ asset('product_photo/' . $product->product_photo) }}"
                            class="img-fluid rounded-start">
                    </div>
                    <div class="col-lg-4">
                        <div class="card-body py-4 px-4 px-lg-5">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="fs-5 fw-bold" style="letter-spacing: 1px;">{{ $product->name }}</div>
                                    <div class="d-flex justify-content-start align-items-center mb-3"
                                        style="font-size: 15px;">
                                        {{-- <img src="/aset/icon/aqua-clock.png" height="20" class="me-2"> --}}
                                        {{ $product->description }}
                                    </div>
                                </div>
                                <div class="fs-5 fw-bold">Rp. {{ $product->price }}</div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center fw-bold my-3"
                                style="font-size: 15px;">
                                {{-- <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2"> --}}
                                {{ $product->member->business_name }}
                            </div>
                            <div class="fs-7">
                                <div class="fw-bold mt-3" style="font-size: 15px;">
                                    Alamat :
                                </div>
                                <div>
                                    {{-- <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2"> --}}
                                    {{ $product->member->province }}, {{ $product->member->city }},
                                    {{ $product->member->sub_district }}, {{ $product->member->village }} <br>
                                </div>
                                <div class="fw-bold mt-3" style="font-size: 15px;">
                                    whatsapp :
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    {{-- <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2"> --}}
                                    <img src="{{ asset('icon/whatsapp.png') }}" height="15">
                                    <div style="color: rgb(0, 201, 0)">
                                        {{ $product->member->phone_number }}
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    {{-- <img src="/aset/rating.png" height="23"> --}}
                                    <a href="#" class="btn btn-primary mt-3 px-4 py-2 w-100 test"
                                        id="beliSekarangBtn">Beli
                                        Sekarang</a>
                                </div>

                                <div class="checkout-modal" id="checkoutModal">
                                    <div class="checkout-container">
                                        <div class="checkout-header">
                                            <div class="checkout-title">Checkout</div>
                                            <button class="close-btn" id="closeModal">&times;</button>
                                        </div>
                                        <div class="checkout-body">
                                            <div class="checkout-steps">
                                                <div class="step active">
                                                    <div class="step-number">1</div>
                                                    <div class="step-label">Informasi</div>
                                                </div>
                                                <div class="step">
                                                    <div class="step-number">2</div>
                                                    <div class="step-label">Pengiriman</div>
                                                </div>
                                                <div class="step">
                                                    <div class="step-number">3</div>
                                                    <div class="step-label">Pembayaran</div>
                                                </div>
                                                <div class="step">
                                                    <div class="step-number">4</div>
                                                    <div class="step-label">Konfirmasi</div>
                                                </div>
                                            </div>
                                            <!-- Step 1 - Informasi -->
                                            <div class="checkout-content">
                                                <div class="checkout-form">
                                                    <div class="form-section">
                                                        <div class="form-title">Informasi Penerima</div>
                                                        <div class="form-group">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Masukkan nama lengkap" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control"
                                                                placeholder="email@example.com" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Nomor Telepon</label>
                                                            <input type="tel" class="form-control"
                                                                placeholder="08xxxxxxxxxx" />
                                                        </div>
                                                    </div>

                                                    <div class="form-section">
                                                        <div class="form-title">Alamat Pengiriman</div>
                                                        <div class="form-group">
                                                            <label class="form-label">Alamat Lengkap</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Jalan, No. Rumah, RT/RW" />
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-col">
                                                                <div class="form-group">
                                                                    <label class="form-label">Provinsi</label>
                                                                    <select class="form-control">
                                                                        <option>Pilih Provinsi</option>
                                                                        <option>DKI Jakarta</option>
                                                                        <option>Jawa Barat</option>
                                                                        <option>Jawa Tengah</option>
                                                                        <option>Jawa Timur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-col">
                                                                <div class="form-group">
                                                                    <label class="form-label">Kota/Kabupaten</label>
                                                                    <select class="form-control">
                                                                        <option>Pilih Kota/Kabupaten</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-col">
                                                                <div class="form-group">
                                                                    <label class="form-label">Kecamatan</label>
                                                                    <select class="form-control">
                                                                        <option>Pilih Kecamatan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-col">
                                                                <div class="form-group">
                                                                    <label class="form-label">Kode Pos</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Kode Pos" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="order-summary">
                                                    <div class="summary-title">Ringkasan Pesanan</div>
                                                    <div class="product-list">
                                                        <div class="product-item">
                                                            <div class="product-image">
                                                                <img src="{{ asset('product_photo/' . $product->product_photo) }}"
                                                                    alt="Product Image" />
                                                            </div>
                                                            <div class="product-details">
                                                                <div class="product-name">{{ $product->name }}</div>
                                                                <div class="product-variant">{{ $product->description }}
                                                                </div>
                                                                <div class="product-price">Rp. {{ $product->price }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="summary-details">
                                                        <div class="summary-row">
                                                            <div>Subtotal</div>
                                                            <div>Rp. {{ number_format($subtotal, 0, ',', '.') }}</div>
                                                        </div>
                                                        <div class="summary-row">
                                                            <div>Ongkos Kirim</div>
                                                            <div>Rp {{ number_format($ongkir, 0, ',', '.') }}</div>
                                                        </div>
                                                        <div class="summary-row">
                                                            <div>Pajak (5%)</div>
                                                            <div>Rp {{ number_format($pajak, 0, ',', '.') }}</div>
                                                        </div>
                                                        <div class="summary-row total">
                                                            <div>Total</div>
                                                            <div>Rp {{ number_format($total, 0, ',', '.') }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Kode Promo</label>
                                                        <div style="display: flex">
                                                            <input type="text" class="form-control"
                                                                placeholder="Masukkan kode promo"
                                                                style="border-radius: 4px 0 0 4px" />
                                                            <button class="btn btn-primary"
                                                                style="border-radius: 0 4px 4px 0; margin-left: -1px">
                                                                Pakai
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Step 2 - Pengiriman -->
                                            <div class="checkout-step" data-step="2" style="display: none">
                                                <div class="checkout-form">
                                                    <div class="form-section">
                                                        <div class="form-title">Metode Pengiriman</div>
                                                        <div class="form-group">
                                                            <div class="payment-option shipping-option">
                                                                <input type="radio" name="shipping" id="jne" checked />
                                                                <label class="payment-label" for="jne">
                                                                    <div>JNE Reguler</div>
                                                                    <div class="text-secondary">Estimasi 3-5 hari</div>
                                                                </label>
                                                                <div class="shipping-price">Rp 25.000</div>
                                                            </div>
                                                            <div class="payment-option shipping-option">
                                                                <input type="radio" name="shipping" id="tiki" />
                                                                <label class="payment-label" for="tiki">
                                                                    <div>TIKI ONS</div>
                                                                    <div class="text-secondary">Estimasi 1-2 hari</div>
                                                                </label>
                                                                <div class="shipping-price">Rp 35.000</div>
                                                            </div>
                                                            <div class="payment-option shipping-option">
                                                                <input type="radio" name="shipping" id="jnt" />
                                                                <label class="payment-label" for="jnt">
                                                                    <div>JNT Express</div>
                                                                    <div class="text-secondary">Estimasi 2-3 hari</div>
                                                                </label>
                                                                <div class="shipping-price">Rp 30.000</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Step 3 - Pembayaran -->
                                            <div class="checkout-step" data-step="3" style="display: none">
                                                <div class="checkout-form">
                                                    <div class="form-section">
                                                        <div class="form-title">Metode Pembayaran</div>

                                                        <div class="payment-option">
                                                            <input type="radio" name="payment" id="bca" checked />
                                                            <label class="payment-label" for="bca">
                                                                Transfer Bank BCA
                                                                <div class="text-secondary">PT. Contoh Company</div>
                                                                <div class="text-secondary">No. Rek: 1234567890</div>
                                                            </label>
                                                        </div>

                                                        <div class="payment-option">
                                                            <input type="radio" name="payment" id="mandiri" />
                                                            <label class="payment-label" for="mandiri">
                                                                Transfer Bank Mandiri
                                                                <div class="text-secondary">PT. Contoh Company</div>
                                                                <div class="text-secondary">No. Rek: 0987654321</div>
                                                            </label>
                                                        </div>

                                                        <div class="payment-option">
                                                            <input type="radio" name="payment" id="gopay" />
                                                            <label class="payment-label" for="gopay">
                                                                GoPay
                                                                <div class="text-secondary">Bayar menggunakan GoPay
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Step 4 - Konfirmasi -->
                                            <div class="checkout-step" data-step="4" style="display: none">
                                                <div class="checkout-form">
                                                    <div class="form-section">
                                                        <div class="form-title">Konfirmasi Pesanan</div>

                                                        <div class="confirmation-details">
                                                            <div class="confirmation-item">
                                                                <h4>Informasi Penerima</h4>
                                                                <div id="confirm-name"></div>
                                                                <div id="confirm-email"></div>
                                                                <div id="confirm-phone"></div>
                                                                <div id="confirm-address"></div>
                                                            </div>

                                                            <div class="confirmation-item">
                                                                <h4>Pengiriman</h4>
                                                                <div id="confirm-shipping"></div>
                                                                <div id="confirm-shipping-cost"></div>
                                                            </div>

                                                            <div class="confirmation-item">
                                                                <h4>Pembayaran</h4>
                                                                <div id="confirm-payment"></div>
                                                            </div>
                                                        </div>

                                                        <div class="terms">
                                                            <input type="checkbox" id="agreeTerms" />
                                                            <label for="agreeTerms">
                                                                Saya menyetujui Syarat & Ketentuan yang berlaku
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="checkout-footer">
                                            <div class="price-total">Total: Rp. {{ number_format($total, 0, ',', '.') }}
                                            </div>
                                            <div class="checkout-actions">
                                                <button class="btn btn-cancel" id="btnKembali">Kembali</button>
                                                <button class="btn btn-continue" id="btnLanjutkan">
                                                    Lanjutkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 bordered-card">
                        <div class="card-body">
                            <div class="fw-bold" style="font-size: 15px;">
                                Lisensi :
                            </div>
                            <div>
                                <style>
                                    th {
                                        font-weight: 100;
                                    }

                                </style>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>NIB</th>
                                            <th>: </th>
                                            <th>{{ $product->member->nib_license }}</th>
                                        </tr>
                                        <tr>
                                            <th>Halal</th>
                                            <th>: </th>
                                            <th>{{ $product->member->halal_license }} </th>
                                        </tr>
                                        <tr>
                                            <th>PIRT</th>
                                            <th>: </th>
                                            <th>{{ $product->member->pirt_license }}</th>
                                        </tr>
                                        <tr>
                                            <th>BPOM</th>
                                            <th>: </th>
                                            <th>{{ $product->member->bpom_license }}</th>
                                        </tr>
                                        <tr>
                                            <th>HKI</th>
                                            <th>: </th>
                                            <th>{{ $product->member->hki_license }}</th>
                                        </tr>
                                        <tr>
                                            <th>Nutritionest</th>
                                            <th>: </th>
                                            <th>{{ $product->member->nutrition_test_license }}</th>
                                        </tr>
                                        <tr>
                                            <th>HACCP</th>
                                            <th>: </th>
                                            <th>{{ $product->member->haccp_license }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-2 bordered-card">
                            <div class="card-body p-4">
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentStep = 1;
        const totalSteps = 4;

        function showStep(step) {
            if (step === 1) {
                document.querySelector('.checkout-content').style.display = 'flex';
                document.querySelectorAll('.checkout-step').forEach(el => {
                    el.style.display = 'none';
                });
            } else {
                document.querySelector('.checkout-content').style.display = 'none';
                document.querySelectorAll('.checkout-step').forEach(el => {
                    el.style.display = 'none';
                });
                document.querySelector(`.checkout-step[data-step="${step}"]`).style.display = 'block';
            }

            // Update current step
            currentStep = step;
            updateStepIndicator(step);
            updateStepNavigation();
        }

        function updateStepNavigation() {
            const btnLanjutkan = document.getElementById('btnLanjutkan');
            const btnKembali = document.getElementById('btnKembali');

            // Update tombol Lanjutkan
            if (currentStep === totalSteps) {
                btnLanjutkan.textContent = 'Konfirmasi Pesanan';
                btnLanjutkan.classList.remove('btn-continue');
                btnLanjutkan.classList.add('btn-primary');
            } else {
                btnLanjutkan.textContent = 'Lanjutkan';
                btnLanjutkan.classList.add('btn-continue');
                btnLanjutkan.classList.remove('btn-primary');
            }

            // Sembunyikan tombol Kembali di step pertama
            btnKembali.style.display = currentStep === 1 ? 'none' : 'block';
        }

        function updateStepIndicator(step) {
            document.querySelectorAll('.step').forEach((el, index) => {
                el.classList.remove('active', 'completed');
                if (index + 1 < step) el.classList.add('completed');
                if (index + 1 === step) el.classList.add('active');
            });
        }

        function validateStep1() {
            // Implement validasi sederhana
            const name = document.querySelector('input[placeholder="Masukkan nama lengkap"]').value;
            if (!name) {
                alert('Harap isi nama lengkap');
                return false;
            }
            return true;
        }

        function updateConfirmationData() {
            document.getElementById('confirm-name').textContent =
                `Nama: ${document.querySelector('input[placeholder="Masukkan nama lengkap"]').value}`;
            document.getElementById('confirm-email').textContent =
                `Email: ${document.querySelector('input[type="email"]').value}`;
            document.getElementById('confirm-phone').textContent =
                `Telepon: ${document.querySelector('input[type="tel"]').value}`;
            document.getElementById('confirm-address').textContent =
                `Alamat: ${document.querySelector('input[placeholder="Jalan, No. Rumah, RT/RW"]').value}`;
        }

        function updateShippingData() {
            const shippingMethod = document.querySelector('input[name="shipping"]:checked').parentNode;
            document.getElementById('confirm-shipping').textContent =
                `Metode: ${shippingMethod.querySelector('label div:first-child').textContent}`;
            document.getElementById('confirm-shipping-cost').textContent =
                `Biaya: ${shippingMethod.querySelector('.shipping-price').textContent}`;
        }

        function updatePaymentData() {
            const paymentMethod = document.querySelector('input[name="payment"]:checked').parentNode;
            document.getElementById('confirm-payment').textContent =
                `Metode: ${paymentMethod.querySelector('label').textContent.split('\n')[0].trim()}`;
        }

        // Fungsi untuk menampilkan modal
        function showCheckoutModal(e) {
            if (e) {
                e.preventDefault(); // Mencegah tindakan default link
            }
            const modal = document.getElementById("checkoutModal");
            modal.classList.add("show");
            document.body.style.overflow = "hidden"; // Mencegah scrolling pada body
        }

        // Fungsi untuk menutup modal
        function closeCheckoutModal() {
            const modal = document.getElementById("checkoutModal");
            modal.classList.remove("show");
            document.body.style.overflow = ""; // Mengembalikan scrolling pada body
        }

        // Event listener untuk tombol "Beli Sekarang"
        document
            .getElementById("beliSekarangBtn")
            .addEventListener("click", showCheckoutModal);

        // Event listener untuk tombol close pada modal
        document
            .getElementById("closeModal")
            .addEventListener("click", function (e) {
                e.stopPropagation(); // Mencegah event bubbling
                closeCheckoutModal();
            });

        // Event listener untuk background modal (hanya menutup jika yang diklik adalah background)
        document
            .getElementById("checkoutModal")
            .addEventListener("click", function (e) {
                // Hanya tutup jika yang diklik adalah modal background, bukan elemen di dalamnya
                if (e.target === this) {
                    closeCheckoutModal();
                }
            });

        // Mencegah event propagation dari container
        document
            .querySelector(".checkout-container")
            .addEventListener("click", function (e) {
                e.stopPropagation(); // Mencegah event klik merambat ke parent (modal background)
            });

        // Button untuk navigasi antar step
        document.getElementById('btnLanjutkan').addEventListener('click', function (e) {
            e.preventDefault();

            if (currentStep === totalSteps) {
                // Handle konfirmasi akhir
                if (document.getElementById('agreeTerms').checked) {
                    alert('Pesanan berhasil dikonfirmasi!');
                    closeCheckoutModal();
                } else {
                    alert('Anda harus menyetujui syarat & ketentuan');
                }
                return;
            }

            // Validasi form
            if (currentStep === 1 && !validateStep1()) return;

            // Update data konfirmasi
            if (currentStep === 1) updateConfirmationData();
            if (currentStep === 2) updateShippingData();
            if (currentStep === 3) updatePaymentData();

            // Show next step
            showStep(currentStep + 1);
        });

        document.getElementById("btnKembali").addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah tindakan default
            e.stopPropagation(); // Mencegah event bubbling

            if (currentStep > 1) {
                showStep(currentStep - 1);
            } else {
                closeCheckoutModal();
            }
        });

        // Initialize on page load
        updateStepNavigation();

    </script>
    @endsection
    @section('footer')
        @include('components.footer')
    @endsection
