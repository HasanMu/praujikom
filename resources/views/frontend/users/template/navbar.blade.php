<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
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
                        <img src="" class="user-image" alt="" id="profile-navbar-image" style="height: 25px; width: 25px;">
                        <span class="hidden-xs" id="profile-navbar-name"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="" class="img-circle" alt="" id="profile-navbar-dropdown-image">

                            <p id="profile-navbar-dropdown-name">
                                <small id="profile-navbar-dropdown-email"></small>
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
