<nav class="navbar navbar-expand-md bg-primary py-3">
    <div class="container">
        <a class="navbar-brand bg-transparent fw-bold" href="#" style="color: white;">Absensi App</a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0">
                @php
                $userRole = auth()->user()->role_id ?? null; // Mendapatkan peran pengguna (role), jika ada
                @endphp
                <!-- Navbar Button -->
                @if($userRole === 3)
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link {{ request()->routeIs('dosen.*') ? 'active fw-bold' : '' }}" aria-current="page" href="{{ route('dosen.index') }}" style="color: white;">
                        Dashboard
                    </a>
                </li>
                @endif
                @if($userRole === 2)
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link {{ request()->routeIs('home.*') ? 'active fw-bold' : '' }}" aria-current="page" href="{{ route('home.index') }}" style="color: white;">
                        Dashboard
                    </a>
                </li>
                @endif
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <form action="{{ route('auth.logout') }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin keluar?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-danger-2x">Log out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>