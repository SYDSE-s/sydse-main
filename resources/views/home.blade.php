@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide animate__animated animate__fadeIn animate__slow"
        data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/people-work.jpg') }}" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/people.jpg') }}" class="d-block w-100">
            </div>
            {{-- <div class="carousel-item">
                <img src="aset/used/photo (43).jpg" class="d-block w-100">
            </div> --}}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon left-icon-carousel" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon right-icon-carousel" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- content 1 -->
    <div class="container mt-5" id="profile-card">
        <div class="row gy-2">
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="card border-0">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="icon me-3">
                            <img src="aset/icon/aqua-location.png" width="35">
                        </div>
                        <div>
                            <h6 class="fw-bold">Our<span style="color: #30c2fd;"> Location</span></h6>
                            <div class="smaller-text">Jl. Raya Suradadi, Area Sawah/Kebun, Suradadi, Kec. Suradadi,
                                Kabupaten Tegal, Jawa Tengah 52182</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__fadeInUp animate__slow">
                <div class="card border-0">
                    <div class="card-body d-flex align-items-center justify-content-start">
                        <div class="icon me-3">
                            <img src="/aset/icon/aqua-phone.png" width="35">
                        </div>
                        <div>
                            <h6 class="fw-bold">Contact<span style="color: #30c2fd;"> Person</span></h6>
                            <div class="smaller-text">
                                Booking : 087710279797 <br>
                                Informasi : 082374352405 <br>
                                Gmail : csa84tegal@gmail.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__fadeInUp animate__slower">
                <div class="card border-0">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="icon me-3">
                            <img src="/aset/icon/aqua-serve.png" width="35">
                        </div>
                        <div>
                            <h6 class="fw-bold">What We<span style="color: #30c2fd;"> Serve</span></h6>
                            <div class="smaller-text">Tersedia kafe, kolam renang anak yang seru, dan mini playground
                                yang menyenangkan!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content 2 (width 570 keatas / tampilan laptop) -->
    <div class="container mt-5 tampilan-laptop">
        <div class="row gy-5" id="collapseParent">
            <!-- collapse -->
            <div class="col-md-6 animate__animated animate__fadeInUp animate__slow">
                <div class="row gy-2">
                    <a data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="true"
                        aria-controls="collapseExample" style="text-decoration: none; color: rgb(1, 1, 37);">
                        <div class="card border-0 card-content-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div style="width: 40px; height: max-content;">
                                        <i class="fa-solid fa-coffee" style="color: #30c2fd; font-size: 30px;"></i>
                                    </div>
                                    <div class="fw-bold fs-6 ms-4">
                                        Kangen kafe
                                    </div>
                                </div>
                                <div>
                                    <img src="aset/icon/aqua-down-arrow.png" height="20">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false"
                        aria-controls="collapseExample" style="text-decoration: none; color: rgb(1, 1, 37);">
                        <div class="card border-0 card-content-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div style="width: 40px; height: max-content;">
                                        <i class="fa-solid fa-bowl-rice" style="color: #30c2fd; font-size: 30px;"></i>
                                    </div>
                                    <div class="fw-bold fs-6 ms-4">
                                        Kuliner Mafia Pentol
                                    </div>
                                </div>
                                <div>
                                    <img src="aset/icon/aqua-down-arrow.png" height="20">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false"
                        aria-controls="collapseExample" style="text-decoration: none; color: rgb(1, 1, 37);">
                        <div class="card border-0 card-content-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div style="width: 40px; height: max-content;">
                                        <i class="fa-solid fa-utensils" style="color: #30c2fd; font-size: 30px;"></i>
                                    </div>
                                    <div class="fw-bold fs-6 ms-4">
                                        Rumah Makan Mas Ipul
                                    </div>
                                </div>
                                <div>
                                    <img src="aset/icon/aqua-down-arrow.png" height="20">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false"
                        aria-controls="collapseExample" style="text-decoration: none; color: rgb(1, 1, 37);">
                        <div class="card border-0 card-content-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div style="width: 40px; height: max-content;">
                                        <i class="fa-solid fa-water-ladder" style="color: #30c2fd; font-size: 30px;"></i>
                                    </div>
                                    <div class="fw-bold fs-6 ms-4">
                                        Kolam Renang Anak
                                    </div>
                                </div>
                                <div>
                                    <img src="aset/icon/aqua-down-arrow.png" height="20">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false"
                        aria-controls="collapseExample" style="text-decoration: none; color: rgb(1, 1, 37);">
                        <div class="card border-0 card-content-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div style="width: 40px; height: max-content;">
                                        <i class="fa-solid fa-campground" style="color: #30c2fd; font-size: 30px;"></i>
                                    </div>
                                    <div class="fw-bold fs-6 ms-4">
                                        Playground
                                    </div>
                                </div>
                                <div>
                                    <img src="aset/icon/aqua-down-arrow.png" height="20">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false"
                        aria-controls="collapseExample" style="text-decoration: none; color: rgb(1, 1, 37);">
                        <div class="card border-0 card-content-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div style="width: 40px; height: max-content;">
                                        <i class="fa-solid fa-microphone-lines"
                                            style="color: #30c2fd; font-size: 30px;"></i>
                                    </div>
                                    <div class="fw-bold fs-6 ms-4">
                                        Panggung
                                    </div>
                                </div>
                                <div>
                                    <img src="aset/icon/aqua-down-arrow.png" height="20">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- collapsed -->
            <div class="col-md-6 animate__animated animate__fadeInUp animate__slower">
                <div class="collapse show" id="collapseExample1" data-bs-parent="#collapseParent">
                    <div class="card card-collapse border-0">
                        <div class="card-body">
                            <img src="aset/used/photo (43).jpg" class="img-fluid rounded-top"
                                style="border-radius: 3px;">
                            <div class="mt-3 fs-6 fw-bold">Kangen <span style="color: #30c2fd;"> Kafe</span></div>
                            <div class="smaller-text">
                                Rasakan Suasana yang Hangat dan Temukan Kopi Terbaik di Hati Anda di Kafe Kangen Kafe,
                                Tempat Ideal untuk Berbagi Cerita
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample3" data-bs-parent="#collapseParent">
                    <div class="card card-collapse border-0">
                        <div class="card-body">
                            <img src="aset/used/photo (2).jpg" class="img-fluid rounded-top" style="border-radius: 3px;">
                            <div class="mt-3 fs-6 fw-bold">Kuliner <span style="color: #30c2fd;"> Mafia Pentol</span>
                            </div>
                            <div class="smaller-text">
                                Temukan Pengalaman Kuliner Jalanan yang Menggoda di Mafia Pentol, yang Menyajikan
                                Hidangan yang Memikat Hati dan Menggoda Selera Anda.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample4" data-bs-parent="#collapseParent">
                    <div class="card card-collapse border-0">
                        <div class="card-body">
                            <img src="aset/used/photo (82).jpg" class="img-fluid rounded-top"
                                style="border-radius: 3px;">
                            <div class="mt-3 fs-6 fw-bold">Rumah Makan <span style="color: #30c2fd;"> Mas Ipul</span>
                            </div>
                            <div class="smaller-text">
                                Nikmati Kelezatan Masakan Tradisional dengan Sentuhan Modern di Kedai Mas Ipul, Suguhan
                                Kuliner yang Menggoda Selera
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample5" data-bs-parent="#collapseParent">
                    <div class="card card-collapse border-0">
                        <div class="card-body">
                            <img src="aset/used/photo (11).jpg" class="img-fluid rounded-top"
                                style="border-radius: 3px;">
                            <div class="mt-3 fs-6 fw-bold">Kolam Renang <span style="color: #30c2fd;"> Anak</span></div>
                            <div class="smaller-text">
                                Biarkan Si Kecil Bermain Bebas dan Aman di Kolam Renang Anak-Anak Kami, Tempat Mereka
                                Berkembang dengan Penuh Keamanan dan Kesenangan.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample6" data-bs-parent="#collapseParent">
                    <div class="card card-collapse border-0">
                        <div class="card-body">
                            <img src="aset/used/photo (3).jpg" class="img-fluid rounded-top" style="border-radius: 3px;">
                            <div class="mt-3 fs-6 fw-bold">Playground</div>
                            <div class="smaller-text">
                                Berikan Anak-Anak Anda Pengalaman Bermain yang Kreatif dan Menggembirakan di Playground,
                                Tempat Mereka Tumbuh dengan Gembira.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample7" data-bs-parent="#collapseParent">
                    <div class="card card-collapse border-0" style="height: max-content;">
                        <div class="card-body">
                            <img src="aset/used/panggung.jpg" class="img-fluid rounded-top" style="border-radius: 3px;">
                            <div class="mt-3 fs-6 fw-bold">Panggung</div>
                            <div class="smaller-text">
                                Nikmati Pertunjukan Live yang Menghibur untuk Meningkatkan Pengalaman Hiburan Anda, di
                                Panggung yang Menawarkan Kesenangan Tanpa Batas.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content 2 (width 570 kebawah / tampilan handphone) -->
    <div class="container mt-5 tampilan-handphone animate__animated animate__fadeInUp animate__slow">
        <div class="heading-text tampilan-handphone mb-5">
            <h2 class="text-center" style="color: #30c2fd;">MAIN FACILITIES</h2>
            <h6 class="text-center text-dark my-2">CULINARY SURADADI ALIVE</h6>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item accordion-content-2 mt-2">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button accordion-button-content-2 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne">
                        <div class="d-flex justify-content-start align-items-center">
                            <div style="width: 45px; height: max-content;">
                                <i class="fa-solid fa-coffee" style="color: #30c2fd; font-size: 30px;"></i>
                            </div>
                            <div class="fw-bold fs-6 ms-2">
                                Kangen Kafe
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <img src="aset/used/photo (43).jpg" class="img-fluid rounded" style="border-radius: 3px;">
                        <div class="smaller-text mt-3">
                            <span class="fw-bold">Kangen Kafe</span> Rasakan Suasana yang Hangat dan Temukan Kopi
                            Terbaik di Hati Anda di Kafe Kangen Kafe, Tempat Ideal untuk Berbagi Cerita dan Merasakan
                            Kenyamanan Sejati.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-content-2 mt-2">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button accordion-button-content-2 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        <div class="d-flex justify-content-start align-items-center">
                            <div style="width: 45px; height: max-content;">
                                <i class="fa-solid fa-bowl-rice" style="color: #30c2fd; font-size: 30px;"></i>
                            </div>
                            <div class="fw-bold fs-6 ms-2">
                                Mafia Pentol
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <img src="aset/used/photo (2).jpg" class="img-fluid rounded" style="border-radius: 3px;">
                        <div class="smaller-text mt-3">
                            <span class="fw-bold">Mafia Pentol</span> Temukan Pengalaman Kuliner Jalanan yang Menggoda
                            di Mafia Pentol, yang Menyajikan Hidangan yang Memikat Hati dan Menggoda Selera Anda.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-content-2 mt-2">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button accordion-button-content-2 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        <div class="d-flex justify-content-start align-items-center">
                            <div style="width: 45px; height: max-content;">
                                <i class="fa-solid fa-utensils" style="color: #30c2fd; font-size: 30px;"></i>
                            </div>
                            <div class="fw-bold fs-6 ms-2">
                                Rumah Makan Mas Ipul
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <img src="aset/used/photo (82).jpg" class="img-fluid rounded" style="border-radius: 3px;">
                        <div class="smaller-text mt-3">
                            <span class="fw-bold">Rumah Makan Mas Ipul</span> Nikmati Kelezatan Masakan
                            Tradisional dengan Sentuhan Modern di Kedai Mas Ipul, Suguhan Kuliner yang Menggoda Selera
                            dan
                            Menyediakan Kenyamanan Tak Terlupakan.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-content-2 mt-2">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button accordion-button-content-2 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                        aria-controls="collapseFour">
                        <div class="d-flex justify-content-start align-items-center">
                            <div style="width: 45px; height: max-content;">
                                <i class="fa-solid fa-water-ladder" style="color: #30c2fd; font-size: 30px;"></i>
                            </div>
                            <div class="fw-bold fs-6 ms-2">
                                Kolam Renang Anak
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <img src="aset/used/photo (11).jpg" class="img-fluid rounded" style="border-radius: 3px;">
                        <div class="smaller-text mt-3">
                            <span class="fw-bold">Kolam Renang Anak</span> Biarkan Si Kecil Bermain Bebas dan Aman di
                            Kolam Renang Anak-Anak Kami, Tempat Mereka Berkembang dengan Penuh Keamanan dan Kesenangan.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-content-2 mt-2">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button accordion-button-content-2 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                        aria-controls="collapseFive">
                        <div class="d-flex justify-content-start align-items-center">
                            <div style="width: 45px; height: max-content;">
                                <i class="fa-solid fa-campground" style="color: #30c2fd; font-size: 30px;"></i>
                            </div>
                            <div class="fw-bold fs-6 ms-2">
                                Playground
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <img src="aset/used/photo (3).jpg" class="img-fluid rounded" style="border-radius: 3px;">
                        <div class="smaller-text mt-3">
                            <span class="fw-bold">Playground</span> Berikan Anak-Anak Anda Pengalaman Bermain yang
                            Kreatif dan Menggembirakan di Playground, Tempat Mereka Belajar dan Tumbuh dengan Canda
                            Gembira.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-content-2 mt-2">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button accordion-button-content-2 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        <div class="d-flex justify-content-start align-items-center">
                            <div style="width: 45px; height: max-content;">
                                <i class="fa-solid fa-microphone-lines" style="color: #30c2fd; font-size: 30px;"></i>
                            </div>
                            <div class="fw-bold fs-6 ms-2">
                                Panggung
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <img src="aset/used/panggung.jpg" class="img-fluid rounded" style="border-radius: 3px;">
                        <div class="smaller-text mt-3">
                            <span class="fw-bold">Panggung</span> Nikmati Pertunjukan Live yang Menghibur untuk
                            Meningkatkan Pengalaman Hiburan Anda, di Panggung yang Menawarkan Kesenangan Tanpa Batas.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content 3 ) -->
    <div class="container mt-5 animate__animated animate__fadeInUp animate__slow" style="margin-top: 100px !important;">
        <div class="heading-text tampilan-handphone mb-5">
            <h2 class="text-center" style="color: #30c2fd;">OUR PACKAGES</h2>
            <h6 class="text-center text-dark my-2">THE BEST RECOMENDATION</h6>
        </div>
        <div class="row gy-5">
            <div class="col-12">
                <div class="card">
                    <div class="row g-0 justify-content-center align-items-center">
                        <div class="col-lg-4">
                            <img src="aset/used/photo (47).jpg" class="img-fluid rounded-start">
                        </div>
                        <div class="col-lg-5">
                            <div class="card-body p-4">
                                <h5 class="fw-bold" style="letter-spacing: 1px;">PAKET MEETING / GATHERING</h5>
                                <div class="d-flex justify-content-start align-items-center fw-bold my-3"
                                    style="font-size: 15px;">
                                    <img src="/aset/icon/aqua-clock.png" height="20" class="me-2">
                                    3-5 jam
                                </div>
                                <div class="d-flex justify-content-start align-items-center fw-bold my-3"
                                    style="font-size: 15px;">
                                    <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2">
                                    Availability : Konfirmasi
                                </div>
                                <div class="fs-7">
                                    Free ruang meeting | Free 1 x screen & 1 x LCD | Free standard sound system | Free 1
                                    x microphone | Free perlengkapan meeting (notes, bolpoint, permen & air mineral)
                                    kecuali coffee break.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card-body p-4">
                                <div class="bordered-card d-flex flex-column justify-content-center align-items-center">
                                    <div style="letter-spacing: 1px;">Mulai dari</div>
                                    <h3 class="fw-bold my-2">50.000/pack</h3>
                                    <img src="/aset/rating.png" height="23">
                                    <a href="https://wa.me/+6282374352405" class="btn btn-primary mt-3 px-4 py-2"
                                        target="_blank">HUBUNGI KAMI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="row g-0 justify-content-center align-items-center">
                        <div class="col-lg-4">
                            <img src="aset/used/photo (54).jpg" class="img-fluid rounded-start">
                        </div>
                        <div class="col-lg-5">
                            <div class="card-body p-4">
                                <h5 class="fw-bold" style="letter-spacing: 1px;">PAKET WEDDING</h5>
                                <div class="d-flex justify-content-start align-items-center fw-bold my-3"
                                    style="font-size: 15px;">
                                    <img src="/aset/icon/aqua-clock.png" height="20" class="me-2">
                                    1 Hari
                                </div>
                                <div class="d-flex justify-content-start align-items-center fw-bold my-3"
                                    style="font-size: 15px;">
                                    <img src="/aset/icon/aqua-calendar.png" height="20" class="me-2">
                                    Availability : Konfirmasi
                                </div>
                                <div class="fs-7">
                                    Prasmanan | Menu Indonesia | Free Pondokan | Simple Dekor | Standard Sound System.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card-body p-4">
                                <div class="bordered-card d-flex flex-column justify-content-center align-items-center">
                                    <div style="letter-spacing: 1px;">Mulai dari</div>
                                    <h3 class="fw-bold my-2">15.000.000</h3>
                                    <img src="/aset/rating.png" height="23">
                                    <a href="https://wa.me/+6282374352405" class="btn btn-primary mt-3 px-4 py-2"
                                        target="_blank">HUBUNGI KAMI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content 4 (FAQ) -->
    <div class="container animate__animated animate__fadeInUp animate__slow" style="margin-top: 200px;">
        <h2 class="fw-bold text-center mb-5">FAQ</h2>
        <div class="accordion accordion-flush faq" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Pukul berapa Culinary Suradadi Alive buka ?
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Jam Operasional : Weekday <code>Pkl 09.00 – 18.00 WIB</code> | Weekend
                        <code>Pkl 08.00 – 19.00 WIB</code>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Apakah saya perlu membuat reservasi sebelum mengunjungi tempat Anda?
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Meskipun reservasi <code>tidak wajib</code>, disarankan untuk membuat
                        reservasi terutama pada hari-hari sibuk atau untuk kelompok besar, agar kami dapat memberikan
                        pelayanan terbaik kepada Anda dan memastikan Anda mendapatkan pengalaman yang memuaskan.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Apakah tersedia area untuk anak anak ?
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Tentu saja, kami menyediakan <code>Playground</code> tersendiri khusus
                        untuk anak anak</div>
                </div>
            </div>
        </div>
    </div>
@endsection    

@section('footer')
    @include('layouts.footer')
@endsection
