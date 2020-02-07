<header id="{{ ($kajian) ? 'header-kajian' : 'header' }}" id="home">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="/"><h5 class="text-white text-uppercase">Muslim Society</h5></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="/">Home</a></li>
                    <li><a href="/jadwal-sholat">Jadwal Sholat</a></li>
                    <li><a href="/al-quran">Al-Quran</a></li>
                    <li><a href="/kajian">Kumpulan Kajian</a></li>
                    @guest
                    <li><a href="/login">Masuk</a></li>
                    @else
                    <li class="menu-has-children">
                        <a href="#">{{ Auth::user()->name }}</a>
                        <ul>
                            <li><a href="/profile">
                                <i class="fa fa-user"></i> &nbsp; Profilku
                            <li><a href="javascript:void(0)"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp; Keluar
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->
