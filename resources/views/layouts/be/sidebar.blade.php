<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ config('app.name', 'Muslim Society') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">{{ config('app.nick', 'MS') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ (request()->is('admin/home')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home.admin') }}">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Pengaturan</li>
            {{-- Menus --}}

            <li class="{{ (request()->is('admin/users')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <i class="fas fa-users"></i> <span>Pengguna</span>
                </a>
            </li>

            <li class="{{ (request()->is('admin/task-scheduller')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.task') }}">
                    <i class="fas fa-clipboard-list"></i> <span>Info untuk Member</span>
                </a>
            </li>

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}
        </ul>

    </aside>
</div>
