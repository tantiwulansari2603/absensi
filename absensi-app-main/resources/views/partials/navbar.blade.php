<!-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 py-3 px-3 fs-6" href="">Absensi App</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed border-0" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
        aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form action="{{ route('auth.logout') }}" method="post">
                @method('DELETE')
                @csrf
                <button class="bg-transparent border-0 nav-link text-danger px-3" href="#">Keluar</button>
            </form>
        </div>
    </div> --}}
</header> -->


<div class="left-menu-header col">
    <ul>
        <li>
            <form class="form-inline search-form">
                <div class="search-bg"><i class="fa fa-search"></i>
                    <input class="form-control-plaintext" placeholder="Search here.....">
                </div>
            </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
    </ul>
</div>
<div class="nav-right col pull-right right-menu p-0">
    <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li>
            <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>
        <li class="onhover-dropdown">
            <form action="{{ route('auth.logout') }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin keluar?')">
                @method('DELETE')
                @csrf
                <button class="btn btn-primary-light"><a><i data-feather="log-out"></i>Log out</a></button>
            </form>
            <!-- <button class="btn btn-primary-light" type="button"><a href="login_two.html"><i data-feather="log-out"></i>Log out</a></button> -->
        </li>
    </ul>
</div>
<div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>