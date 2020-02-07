<header class="main-header">
    <!-- Logo -->
    <a href="assets/fe/AdminLTE/index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>MS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>M</b>uslim <b>S</b>ociety</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user()->image)
                            <img src="{{ asset('assets/images/users/default-avatar.png') }}" class="user-image" alt="{{ Auth::user()->name }}">
                        @else
                            <img src="{{ asset('assets/images/users/default-avatar.png') }}" class="user-image" alt="{{ Auth::user()->name }}">
                        @endif
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if (Auth::user()->image)
                                <img src="{{ asset('assets/images/users/default-avatar.png') }}" class="img-circle" alt="{{ Auth::user()->name }}">
                            @else
                                <img src="{{ asset('assets/images/users/default-avatar.png') }}" class="img-circle" alt="{{ Auth::user()->name }}">
                            @endif

                            <p>
                                {{ Auth::user()->name }}
                                <small>Member since {{ Auth::user()->created_at->diffForHumans() }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="javascript:void(0)" class="btn btn-default btn-flat"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Sign out</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
