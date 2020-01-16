@extends('frontend.kajian.template')

@section('konten')
    <div class="col-lg-8 post-list blog-post-list">
        <div class="single-post">
            <img class="img-fluid" src="{{ asset('assets/fe/robotics/img/blog/p1.jpg') }}" alt="">
            <ul class="tags">
                <li><a href="#">Bandung, </a></li>
                <li><a href="#">Baleendah </a></li>
            </ul>
            <a href="blog-single.html">
                <h1>
                    Cartridge Is Better Than Ever
                    A Discount Toner
                </h1>
            </a>
                <p>
                    MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training. who has the willpower to actually sit through a self-imposed MCSE training.
                </p>
            <div class="bottom-meta">
                <div class="user-details row align-items-center">
                    <div class="comment-wrap col-lg-6">
                        <ul>
                            <li><a href="#"><span class="lnr lnr-bubble"></span> 06 Comments</a></li>
                        </ul>
                    </div>
                    {{-- <div class="social-wrap col-lg-6">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection