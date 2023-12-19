<header class="main-nav">
    <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="{{ asset('assets/images/dashboard/1.png') }}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary"></span></div><a href="#">
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
                    @if (auth()->user()->isAdmin())
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard.index') }}">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}" href="{{ route('positions.index') }}">
                            <span data-feather="tag" class="align-text-bottom"></span>
                            Posisi
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                            <span data-feather="users" class="align-text-bottom"></span>
                            User
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}" href="{{ route('holidays.index') }}">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            Hari Libur
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('school.*') ? 'active' : '' }}" href="{{ route('school.index') }}">
                            <span data-feather="briefcase" class="align-text-bottom"></span>
                            Sekolah
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ request()->routeIs('location.*') ? 'active' : '' }}" href="{{ route('location.index') }}">
                            <span data-feather="map-pin" class="align-text-bottom"></span>
                            Lokasi
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