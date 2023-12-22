@extends('layouts.home')

@push('style')
    @powerGridStyles
@endpush

@section('content')
    <div class="container py-5">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Data kehadiran</h3>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="#">Data kehadiran</a></li> -->
                    </ol>
                </div>
            </div>
        </div>

        <h2>Rekap Absensi {{ $user->name }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Absensi</th>
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
                        {{-- <td> --}}
                        {{-- @forelse ($presence->permissions as $permission)
                                {{ $permission->title }}
                    @if (!$loop->last)
                    <br>
                    @endif
                    @empty
                    N/A
                    @endforelse --}}
                        {{-- @forelse ($user->permissions as $permission)
                                Izin {{ $permission->title }}
                            @empty
                                Masuk
                            @endforelse --}}
                        {{-- </td> --}}
                        {{-- <td>
                            @php
                                $history = $notPresentData[$presence->presence_date] ?? null;
                            @endphp
                            @if ($history)
                                <div class="badge rounded-pill bg-danger">Tidak Hadir</div>
                            @else
                                @if ($presence->presence_date == now()->toDateString())
                                    <div class="badge rounded-pill bg-info">Hadir</div>
                                @else
                                    <!-- Tambahkan logika atau pesan lain sesuai kebutuhan -->
                                    <div class="badge rounded-pill bg-warning">Status lainnya</div>
                                @endif
                            @endif
                        </td> --}}
                        <td>{{ $presence->presence_enter_time }}</td>
                        <td>{{ $presence->presence_out_time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada data absensi untuk mahasiswa ini.</td>
                    </tr>
                @endforelse

                {{-- @foreach ($notPresentData as $data)
                    <tr>
                        <td>{{ $data['not_presence_date'] }}</td>
                        <td colspan="4">
                            <div class="badge rounded-pill bg-danger">Tidak Hadir</div>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    <!-- Menampilkan Rekapan Izin -->
    <div class="container py-5">
        <h2>Rekapan Izin {{ $user->name }}</h2>

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
        </table>
    </div>

    {{-- <div class="container py-5">
        <h2>Rekapan Tidak Hadir {{ $user->name }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal Izin</th>
                    <th>Deskripsi Izin</th>
                    <!-- Tambahkan kolom-kolom lain yang diperlukan -->
                </tr>
            </thead>
            <tbody>
                @foreach ($allDates as $date)
                    <tr>
                        <td>{{ $date }}</td>
                        <td colspan="4">
                            @if (in_array($date, $presentDates))
                                <div class="badge rounded-pill bg-info">Hadir</div>
                            @else
                                <div class="badge rounded-pill bg-danger">Tidak Hadir</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    {{-- 
    <h1 class="fs-2">{{ $user->name }}</h1>
    <p class="text-muted">Data Kehadiran Tidak Hadir</p> --}}

    {{-- <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <!-- Tambahkan kolom-kolom lain yang diperlukan -->
                </tr>
            </thead>
            <tbody>
                @foreach ($notPresentData as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->presence_date }}</td>
                        <!-- Tambahkan kolom-kolom lain yang diperlukan -->
                    </tr>
                @endforeach
                @foreach ($presences as $presence)
                    <tr>
                        <td>
                            @if ($presence->presence_enter_time)
                                <div class="badge rounded-pill bg-info">Hadir</div>
                            @else
                                <div class="badge rounded-pill bg-danger">Tidak Hadir</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

    {{-- <div class="col-md-6">
        <h5 class="mb-3">Histori 30 Hari Terakhir</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Pulang</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($priodDate as $date)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            @php
                                $histo = $history->where('presence_date', $date)->first();
                            @endphp
                            @if (!$histo)
                                <td>{{ $date }}</td>
                                <td colspan="3">
                                    @if ($date == now()->toDateString())
                                        <div class="badge rounded-pill bg-info">Belum Hadir</div>
                                    @else
                                        <div class="badge rounded-pill bg-danger">Tidak Hadir</div>
                                    @endif
                                </td>
                            @else
                                <td>{{ $histo->presence_date }}</td>
                                <td>{{ $histo->presence_enter_time }}</td>
                                <td>
                                    @if ($histo->presence_out_time)
                                        {{ $histo->presence_out_time }}
                                    @else
                                        <span class="badge rounded-pill bg-danger">Belum Absensi Pulang</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($histo->is_permission)
                                        <div class="badge rounded-pill bg-warning">Izin</div>
                                    @else
                                        <div class="badge rounded-pill bg-success">Hadir</div>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
@endsection


@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
@endpush
