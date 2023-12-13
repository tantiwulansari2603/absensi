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
                    <th>Masuk</th>
                    <th>Pulang</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($presences as $presence)
                    <tr>
                        <td>{{ $presence->presence_date }}</td>
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
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
@endpush
