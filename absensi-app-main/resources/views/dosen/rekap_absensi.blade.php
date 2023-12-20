@extends('layouts.home')

@push('style')
    @powerGridStyles
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Data kehadiran</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data kehadiran</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <h2>Rekap Absensi Mahasiswa - {{ $user->name }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Absensi</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($presences as $presence)
                    <tr>
                        <td>{{ $presence->presence_date }}</td>
                        <td>{{ $presence->attendance->title }}</td>
                        {{-- <td>{{ $presence->permission->is_permission->title }}</td> --}}
                        {{-- {{ dd($presence) }} --}}
                        <td>
                            {{-- @forelse ($presence->permissions as $permission)
                                {{ $permission->title }}
                                @if (!$loop->last)
                                    <br>
                                @endif
                            @empty
                                N/A
                            @endforelse --}}
                            @forelse ($user->permissions as $permission)
                                Izin {{ $permission->title }}
                            @empty
                                Masuk
                            @endforelse
                        </td>
                        <td>{{ $presence->presence_enter_time }}</td>
                        <td>{{ $presence->presence_out_time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada data absensi untuk mahasiswa ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Menampilkan Rekapan Izin -->
    {{-- <div class="container py-5">
        <h2>Rekapan Izin Mahasiswa - {{ $user->name }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal Izin</th>
                    <th>Deskripsi Izin</th>
                    <!-- Tambahkan kolom-kolom lain yang diperlukan -->
                </tr>
            </thead>
            <tbody>
                @forelse ($user->permissions as $permission)
                    <tr>
                        <td>{{ $permission->permission_date }}</td>
                        <td>{{ $permission->description }}</td>
                        <!-- Tambahkan kolom-kolom lain yang diperlukan -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Belum ada data izin untuk mahasiswa ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table> --}}
    </div>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
@endpush
