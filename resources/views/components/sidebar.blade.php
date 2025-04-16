<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start  ms-4"style="max-height: 100vh;"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>

        <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100"
            alt="main_logo">
    </div>
    <hr class="horizontal dark mt-0">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="#">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('user.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('Permission.index') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Permissions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="../pages/virtual-reality.html">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-app text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Role</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="../pages/rtl.html">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">RTL</span>
            </a>
        </li>
       
    </ul>
    </div>

</aside>
