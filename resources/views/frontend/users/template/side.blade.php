<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="" id="profile-sidebar-image" style="height: 45px; width: 45px;">
            </div>
            <div class="pull-left info">
                <p id="profile-sidebar-name"></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview  {{ Request::segment(1) == 'myposts' ? 'active' : Request::segment(1) == 'info' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {{ Request::segment(1) == 'info' ? 'class=active' : '' }}><a href="/info"><i class="fa fa-circle-o"></i>Info</a></li>
                    <li {{ Request::segment(1) == 'myposts' ? 'class=active' : '' }}><a href="/myposts"><i class="fa fa-circle-o"></i>Postinganku</a></li>
                </ul>
            </li>
            <li class="{{ Request::segment(1) == 'profile' ? 'active' : '' }}"><a href="/profile"><i class="fa fa-user"></i> <span>Profil</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
