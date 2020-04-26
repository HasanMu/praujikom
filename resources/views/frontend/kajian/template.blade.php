@extends('layouts.fe')

@section('title', 'Kumpulan Kajian')

@section('content')

@include('layouts.fe.navbar', ['kajian' => true])

<section class="blog-posts-area section-gap">
    <div class="container">
        <div class="row">
            @yield('konten')
            <div class="col-lg-4 sidebar order-last">
                @if (Request::segment(99))
                    <div class="single-widget search-widget">
                        <form class="example" action="#" style="margin:auto;max-width:300px">
                            <input type="text" placeholder="Cari Kajian" name="search2">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                @endif

                <div class="single-widget protfolio-widget">
                    @if (Auth::check())
                        @if (Auth::user()->image)
                            <img src="{{ asset('assets/images/users/'.Auth::user()->image) }}" class="img-fluid" alt="{{ Auth::user()->name }}" style="height: 125px; width: 125px;">
                        @else
                            <img src="{{ asset('assets/images/users/default-avatar.jpg') }}" class="img-fluid" alt="{{ Auth::user()->name }}" style="height: 125px; width: 125px;">
                        @endif
                        <a href="/profile"><h4>{{ Auth::user()->name }}</h4></a>
                        <p>
                            {{ Auth::user()->bio ? Auth::user()->bio : 'Belum ada bio' }}
                        </p>
                        @if (!Request::segment(2))
                            <a id="" class="primary-btn post-add" href="javascript:void(0);" role="button">Buat Kajian</a>
                        @endif
                        <a id="" class="primary-btn" href="/profile" role="button">Profil</a>
                    @else
                        <h4>Hai! Selamat Datang</h4>
                        <p>
                            Mari bergabung bersama kami di Muslim Society!
                        </p>
                        <a href="/register" class="primary-btn">Daftar</a>
                    @endif
                </div>

                @php
                    $cityPost = \App\City::withCount('post')->get();
                @endphp
                <div class="single-widget category-widget">
                    <h4 class="title">Daftar Kajian Perkota</h4>
                    <ul>
                        @foreach ($cityPost as $item)
                            @if ($item->post_count > 0)
                                <li><a class="justify-content-between align-items-center d-flex"><h6>{{ $item->name }}</h6> <span>{{ $item->post_count }}</span></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
    @stack('scripts')
@endpush

@section('css')
    <link rel="stylesheet" href="{{ asset('css/input.min.css') }}">
@endsection
