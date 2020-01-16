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
                    Al - Quran
                </h1>
                <p class="text-white link-nav">
                    <a href="index.html">Home </a>
                    <span class="lnr lnr-arrow-right"></span>
                    <a href="services.html"> Al-Quran</a></p>
            </div>
        </div>
    </div>
</section>

<!-- Start price Area -->
<section class="price-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Quran Surat</h1>
                    <h5 class="_QSnama"></h5>
                    <div class="btnQS mt-10"></div>
                </div>
            </div>
        </div>
        <div class="row" id="list-qs">

        </div>
    </div>
</section>
<!-- End price Area -->

@endsection

@push('js')
    <script src="{{ asset('js/al-quran.js') }}"></script>
@endpush
