<!-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (auth()->user()->isAdmin() or auth()->user()->isOperator())
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('dashboard.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}"
                    href="{{ route('positions.index') }}">
                    <span data-feather="tag" class="align-text-bottom"></span>
                    Jabatan / Posisi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}"
                    href="{{ route('employees.index') }}">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Karyawaan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}"
                    href="{{ route('holidays.index') }}">
                    <span data-feather="calendar" class="align-text-bottom"></span>
                    Hari Libur
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}"
                    href="{{ route('attendances.index') }}">
                    <span data-feather="clipboard" class="align-text-bottom"></span>
                    Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('presences.*') ? 'active' : '' }}"
                    href="{{ route('presences.index') }}">
                    <span data-feather="clipboard" class="align-text-bottom"></span>
                    Data Kehadiran
                </a>
            </li>
            @endif
        </ul>

        <form action="{{ route('auth.logout') }}" method="post"
            onsubmit="return confirm('Apakah anda yakin ingin keluar?')">
            @method('DELETE')
            @csrf
            <button class="w-full mt-4 d-block bg-transparent border-0 fw-bold text-danger px-3">Keluar</button>
        </form>
    </div>
</nav> -->

<header class="main-nav">
    <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="../assets/images/dashboard/1.png" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="#">
            <h6 class="mt-3 f-14 f-w-600">Hai, <b>{{ Auth::user()->name }}</h6>
            <small class="font-w400" style="font-weight: lighter;">{{ Auth::user()->email }}</small>
        </a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    @if (auth()->user()->isAdmin() or auth()->user()->isOperator())
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard.index') }}">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}" href="{{ route('positions.index') }}">
                            <span data-feather="tag" class="align-text-bottom"></span>
                            Jabatan / Posisi
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Karyawan
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}" href="{{ route('holidays.index') }}">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            Hari Libur
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}" href="{{ route('attendances.index') }}">
                            <span data-feather="clipboard" class="align-text-bottom"></span>
                            Absensi
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('presences.*') ? 'active' : '' }}" href="{{ route('presences.index') }}">
                            <span data-feather="clipboard" class="align-text-bottom"></span>
                            Data Kehadiran
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>