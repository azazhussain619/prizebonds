<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('vendor/adminlte-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Prize Bonds</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('vendor/adminlte-3.2.0/dist/img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{--        <div class="form-inline">--}}
        {{--            <div class="input-group" data-widget="sidebar-search">--}}
        {{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
        {{--                <div class="input-group-append">--}}
        {{--                    <button class="btn btn-sidebar">--}}
        {{--                        <i class="fas fa-search fa-fw"></i>--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--                <li class="nav-item menu-open">--}}
                {{--                    <a href="#" class="nav-link active">--}}
                {{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
                {{--                        <p>--}}
                {{--                            Dashboard--}}
                {{--                            <i class="right fas fa-angle-left"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="./index.html" class="nav-link active">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Dashboard v1</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                @can('view denominations')
                    <li class="nav-item">
                        <a href="{{ url('admin/denominations') }}" class="nav-link">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Denominations
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view prizes')
                    <li class="nav-item">
                        <a href="{{ url('admin/prizes') }}" class="nav-link">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>
                                Prizes
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view draws')
                    <li class="nav-item">
                        <a href="{{ url('admin/draws') }}" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Draws
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view draw-results')
                    <li class="nav-item">
                        <a href="{{ url('admin/draw-results') }}" class="nav-link">
                            <i class="nav-icon fas fa-draw-polygon"></i>
                            <p>
                                Draw Results
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view draw-categories')
                    <li class="nav-item">
                        <a href="{{ url('admin/categories') }}" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Categories
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view draw-posts')
                    <li class="nav-item">
                        <a href="{{ url('admin/posts') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>
                                Posts
                                <span class="right badge badge-success">New</span>
                            </p>
                        </a>
                    </li>
                @endcan
                {{--                <li class="nav-header">LABELS</li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
