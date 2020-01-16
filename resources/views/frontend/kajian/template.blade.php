@extends('layouts.fe')

@section('title', 'Kumpulan Kajian')

@section('content')

@include('layouts.fe.navbar', ['kajian' => true])

<section class="blog-posts-area section-gap">
    <div class="container">
        <div class="row">
            @yield('konten')
            <div class="col-lg-4 sidebar">
                <div class="single-widget search-widget">
                    <form class="example" action="#" style="margin:auto;max-width:300px">
                        <input type="text" placeholder="Cari Kajian" name="search2">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                <div class="single-widget protfolio-widget">
                    <img src="{{ asset('assets/fe/robotics/img/blog/user1.jpg') }}" alt="">
                    <a href="#"><h4>Hasan Muhammad</h4></a>
                    <p>
                        MCSE boot camps have its supporters and
                        its detractors. Some people do not understand why you should have to spend money
                        on boot camp when you can get.
                    </p>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>

                <div class="single-widget category-widget">
                    <h4 class="title">Daftar Kajian Perkota</h4>
                    <ul>
                        <li><a href="#" class="justify-content-between align-items-center d-flex"><h6>Bandung</h6> <span>37</span></a></li>
                        <li><a href="#" class="justify-content-between align-items-center d-flex"><h6>Garut</h6> <span>24</span></a></li>
                        <li><a href="#" class="justify-content-between align-items-center d-flex"><h6>Jakarta</h6> <span>59</span></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
