@extends('layouts.fe')

@section('title', 'Halaman Utama')

@section('content')

    @include('layouts.fe.navbar', ['kajian' => false])
     <!-- start banner Area -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content col-lg-6 col-md-6">
                    <h1>
                        Muslim Society
                    </h1>
                    <p class="text-white">
                        Muslim Society adalah sebuah aplikasi yang dapat menjadi tempat bertukarnya informasi antar kaum muslimin. dengan memberikan sebuah informasi rinci terkait suatu acara kajian, dll.
                    </p>
                    @guest
                        <a href="/register" class="primary-btn header-btn text-uppercase">Gabung Sekarang</a>
                    @endguest
                </div>
                <div class="banner-img col-lg-6 col-md-6">
                    <img class="img-fluid" src="{{ asset('assets/fe/robotics/img/banner-img.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start home-about Area -->
    <section class="home-about-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 home-about-left no-padding">
                    <img class="mx-auto d-block img-fluid" src="{{ asset('assets/fe/robotics/img/about-img.png') }}" alt="">
                </div>
                <div class="col-lg-6 home-about-right no-padding">
                    <h1>Jangkauan Informasi <br>
                        Yang Luas</h1>
                    <h5>
                        Memudahkan Muslimin/ah untuk mendapatkan informasi yang singkat, tepat & akurat
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.
                    </p>
                    {{-- <a class="primary-btn text-uppercase" href="#">Get Details</a> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- End home-about Area -->


    <!-- Start about-video Area -->
    <section class="about-video-area section-gap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 about-video-left">
                    <h6 class="text-uppercase">Download Aplikasi Kami Di SINI</h6>
                    <h1>
                        Muslim Society
                    </h1>
                    <p>
                        <span>Dari kita, untuk kita</span>
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed doeiusmo d tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <a class="primary-btn" href="https://play.google.com/store/apps/details?id=smk.assalaam.doaistighasah">Download</a>
                </div>
                <div class="col-lg-6 home-about-right no-padding justify-content-center align-items-center d-flex relative">
                    <div class="overlay overlay-bg"></div>
                    <a class="play-btn" href="#"><img class="img-fluid" src="
                        https://images.samsung.com/is/image/samsung/p5/uk/support/lucidcx/wherecanifindtheplaystore.png?$ORIGIN_PNG$
                        " alt="" style="width: 370px; height: 270px;">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-video Area -->


    <!-- Start jadwal sholat Area -->
    <section class="feature-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 pb-40 header-text text-center">
                    <h1 class="pb-10 text-white">Jadwal Sholat</h1>
                    <p class="text-white">
                        Jadwal sholat diambil langsung dari departemen agama [KEMENAG]
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="single-feature">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Kabupaten/Kota</label>
                                  <select name="" id="search_kabko" class="form-select"></select>
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
    <!-- End jadwal sholat Area -->

    @php
        use Illuminate\Support\Str;
        $posts = \App\Post::with('user', 'district', 'city')->take(2)->get();
    @endphp

    @if ($posts->count() > 0)
        <!-- Start post Area -->
            <section class="blog-area section-gap">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 pb-40 header-text text-center">
                            <h1 class="pb-10">Kajian Terbaru</h1>
                            <p>
                                Jadwal kajian terbaru!
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $side = ['left', 'right'];
                            $no = 0;
                        @endphp
                        @foreach ($posts as $data)
                        <div class="col-lg-6 col-md-6 blog-{{ $side[$no++] }}">
                            <div class="thumb">
                                @if ($data->image)
                                    <img class="img-fluid" src="{{ asset('assets/images/posts/'.$data->image) }}" alt="" style="height: 283.5px; width: 540px;">
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/images/posts/noimage.png') }}" alt="" style="height: 283.5px; width: 540px;">
                                @endif
                            </div>
                            <div class="detais">
                                @if ($data->city_id && $data->district_id)
                                    <ul class="tags">
                                        <li><a href="#">{{ $data->city->name }}</a></li> |
                                        <li><a href="#">{{ $data->district->name}}</a></li>
                                    </ul>
                                @elseif($data->city_id)
                                    <ul class="tags">
                                        <li><a href="#">{{ $data->city->name }}</a></li> |
                                    </ul>
                                @elseif($data->district_id)
                                    <ul class="tags">
                                        <li><a href="#">{{ $data->city->name }}</a></li> |
                                    </ul>
                                @else
                                <ul class="tags">
                                    <br><p></p>
                                </ul>
                                @endif
                                <a href="#">
                                    <h4>{{ $data->user->name }}</h4>
                                </a>
                                <p>
                                    {{ Str::words($data->description, '50', '...') }}
                                </p>
                                <p class="date">{{ $data->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        <!-- End blog Area -->
    @else

    @endif

@endsection

@push('js')
    @if(session()->get( 'notify' ))
        <script>
            $(document).ready(function() {
                iziToast.success({
                    title: 'Hello, {{ Auth::user()->name }}',
                    message: 'Kamu barusan login',
                    position: 'bottomLeft'
                });
            })
        </script>
    @endif
    <script src="{{ asset('js/jadwal_sholat.js') }}"></script>
@endpush
