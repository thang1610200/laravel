<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{ asset('almasaeed2010/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @auth
                <div class="image">
                    <img src="{{ Auth::user()->image }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div> 
            @endauth

            {{-- @guest
                <div class="info">
                    <a href="/admin/auth/login" class="d-block btn-lg btn-primary">Login</a>
                </div>
                <div class="info">
                    <a href="/admin/auth/register" class="d-block btn-lg btn-success">Register</a>
                </div> 
            @endguest --}}
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/management-user" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Management User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/management-order" class="nav-link">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>
                            Management Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/ticket" class="nav-link">
                        <i class="fas fa-ticket-alt nav-icon"></i>
                        <p>
                            Management Ticket
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/sell-ticket" class="nav-link">
                        <i class="fas fa-trademark nav-icon"></i>
                        <p>
                            Management Sell Ticket
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/management-withdraw" class="nav-link">
                        <i class="fas fa-trademark nav-icon"></i>
                        <p>
                            Management Withdraw
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/commission" class="nav-link">
                        <i class="fas fa-tags nav-icon"></i>
                        <p>
                            Management Commission
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
