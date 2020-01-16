@extends('layouts.fe')

@section('title', 'Jadwal Sholat')

@section('content')

@include('layouts.fe.navbar', ['kajian' => false])

<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Jadwal Sholat
                </h1>
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="services.html"> Services</a></p>
            </div>
        </div>
    </div>
</section>

<!-- Start jadwal sholat Area -->
<section class="feature-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="single-feature">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kabupaten/Kota</label>
                                <select id="semua-kota" class="form-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Waktu</label>
                            <input type="date" name="" class="form-control radius" id="waktu-jadwal-sholat" placeholder="">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br>
                                <button type="button" class="genric-btn primary radius w-100 mt-1" id="cari-jadwal-sholat">CARI</button>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center" id="keterangan-jadwal-sholat"></div>
                </div>
            </div>
        </div>
        <div class="row jadwal-sholat-sekarang">
        </div>
    </div>
</section>

@endsection

@push('js')
    <script src="{{ asset('js/jadwal_sholat.js') }}"></script>
@endpush
