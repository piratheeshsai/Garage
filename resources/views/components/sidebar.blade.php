<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" style="max-height: 100vh;" id="sidenav-main">
    {{-- <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>

        <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
    </div> --}}
    <hr class="horizontal dark mt-0">

    <ul class="navbar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link active" href="#">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i> {{-- Dashboard --}}
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>

        <!-- User Section -->
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">User Management</h6>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-info text-sm opacity-10"></i> {{-- Users --}}
                </div>
                <span class="nav-link-text ms-1">Users View</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('Permission.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-lock-circle-open text-warning text-sm opacity-10"></i> {{-- Permissions --}}
                </div>
                <span class="nav-link-text ms-1">Permissions</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('Role.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-badge text-danger text-sm opacity-10"></i> {{-- Roles --}}
                </div>
                <span class="nav-link-text ms-1">Role</span>
            </a>
        </li>

        <!-- Customer Section -->
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Customer Management</h6>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-circle-08 text-success text-sm opacity-10"></i> {{-- Customers --}}
                </div>
                <span class="nav-link-text ms-1">Customers</span>
            </a>
        </li>
    </ul>
</aside>
