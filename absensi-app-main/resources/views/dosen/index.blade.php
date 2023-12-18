@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        Daftar Kehadiran Peserta Magang
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            {{-- @foreach ($attendances as $attendance)
                                <a href="{{ route('home.show', $attendance->id) }}"
                                    class="list-group-item d-flex justify-content-between align-items-start py-3">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $attendance->title }}</div>
                                        <p class="mb-0">{{ $attendance->description }}</p>
                                    </div>
                                    @include('partials.attendance-badges')
                                </a>
                            @endforeach --}}
                            @include('partials.alerts')

                            <div class="row">
                                <div class="col-md-7">
                                    <ul class="list-group">
                                        @foreach ($usersWithSameSchool as $user)
                                            <a href="{{ route('dosen.show', $user->id) }}"
                                                class="list-group-item d-flex justify-content-between align-items-start py-3">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">{{ $user->name }}</div>
                                                    <p class="mb-0">{{ $user->email }}</p>
                                                </div>
                                                <a href="{{ route('dosen.rekap-absensi', $user->id) }}"
                                                    class="btn btn-primary">Rekap Absensi</a>
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- @foreach ($usersWithSameSchool as $user)
                                <div>
                                    <p>Nama: {{ $user->name }}</p>
                                    <p>Email: {{ $user->email }}</p>
                                    <!-- Tambahkan info pengguna lainnya sesuai kebutuhan -->
                                </div>
                            @endforeach --}}

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Informasi Dosen
                    </div>
                    <div class="card-body">
                        <ul class="ps-2">
                            <li class="mb-1">
                                <span class="fw-bold d-block">Nama : </span>
                                <span>{{ auth()->user()->name }}</span>
                            </li>
                            <li class="mb-1">
                                <span class="fw-bold d-block">Email : </span>
                                <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                            </li>
                            <li class="mb-1">
                                <span class="fw-bold d-block">No. Telp : </span>
                                <a href="tel:{{ auth()->user()->phone }}">{{ auth()->user()->phone }}</a>
                            </li>
                            <li class="mb-1">
                                <span class="fw-bold d-block">Bergabung Pada : </span>
                                <span>{{ auth()->user()->created_at->diffForHumans() }}
                                    ({{ auth()->user()->created_at->format('d M Y') }})</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
