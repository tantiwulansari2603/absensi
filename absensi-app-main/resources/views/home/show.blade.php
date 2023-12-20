@extends('layouts.home')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="mb-2" style="font-size: 16px;">
                @include('partials.attendance-badges')
            </div>
            @include('partials.alerts')

            <h1 class="fs-2">{{ $attendance->title }}</h1>
            <p class="text-muted">{{ $attendance->description }}</p>

            <div class="mb-4">
                <span class="badge rounded-pill bg-info" style="font-size: 12px;">Masuk : {{
                    substr($attendance->data->start_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_start_time,0,-3 )}}</span>
                <span class="badge rounded-pill bg-info" style="font-size: 12px;">Pulang : {{
                    substr($attendance->data->end_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_end_time,0,-3 )}}</span>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <span>Lokasi saat ini :</span>
                    <div id="map" style="height: 275px;" wire:ignore></div>
                </div>
            </div>

            @if (!$attendance->data->is_using_qrcode)
                <livewire:presence-form :attendance="$attendance" :data="$data" :holiday="$holiday">
            @else
                @include('home.partials.qrcode-presence')
            @endif

        </div>
        <div class="col-md-6">
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
                            {{-- not presence / tidak hadir --}}
                            @php
                            $histo = $history->where('presence_date', $date)->first();
                            @endphp
                            @if (!$histo)
                            <td>{{ $date }}</td>
                            <td colspan="3">
                                @if($date == now()->toDateString())
                                <div class="badge rounded-pill bg-info">Belum Hadir</div>
                                @else
                                <div class="badge rounded-pill bg-danger">Tidak Hadir</div>
                                @endif
                            </td>
                            @else
                            <td>{{ $histo->presence_date }}</td>
                            <td>{{ $histo->presence_enter_time }}</td>
                            <td>@if($histo->presence_out_time)
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
        </div>
    </div>
    <div class="modal" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Aktifkan Lokasi Anda</h5>
                </div>
                <div class="modal-body">
                    <p>Anda perlu mengaktifkan lokasi untuk menggunakan fitur ini dan melakukan absensi. Silakan aktifkan izin lokasi pada perangkat Anda.</p>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
@push('script')
<script>
document.addEventListener('livewire:load', function() {
    var map = L.map('map');
    var marker = L.marker([0, 0], { draggable: false, icon: CustomIcon() }).addTo(map);
    var locationCircle = L.circle([{{ $attendance->location->latitude }}, {{ $attendance->location->longitude }}], {
        color: 'green',
        fillColor: 'green',
        fillOpacity: 0.3,
        radius: 10 // Radius dalam meter
    }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Fungsi untuk membuat ikon kustom
    function CustomIcon() {
        return L.icon({
            iconUrl: '/assets/images/marker/user1.png', // Sesuaikan dengan path dan nama file ikon kantor Anda
            iconSize: [38, 56], // Sesuaikan dengan ukuran ikon
            iconAnchor: [19, 48], // Posisi "jatuh" dari ikon, misalnya ujung bawah tengah
            popupAnchor: [0, -56] // Posisi pop-up yang muncul, misalnya di atas ikon
        });
    }

    // Meminta izin pengguna untuk mengaktifkan lokasi
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Atur peta ke lokasi saat ini
            map.setView([lat, lng], 15);
            marker.setLatLng([lat, lng]);

            // Cek jarak antara koordinat pengguna dan lokasi
            if (isWithinMaxDistance(lat, lng)) {
                // Koordinat berada dalam radius 10 meter, izinkan akses ke form
                enableFormAccess();
            } else {
                // Koordinat berada di luar radius, nonaktifkan akses ke form
                disableFormAccess();
            }
        }, function(error) {
            console.error("Error getting geolocation:", error.message);
            // Tampilkan modal ketika izin lokasi tidak diaktifkan
            showLocationModal();
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
        showLocationModal();
    }
    
    // Fungsi untuk menampilkan modal terkunci
    function showLocationModal() {
        var locationModal = new bootstrap.Modal(document.getElementById('locationModal'), { backdrop: 'static', keyboard: false });
        locationModal.show();
    }
    
    // Menambahkan tooltip ke circle
    locationCircle.bindTooltip("Ini merupakan lokasi tempat magang").openTooltip();

    // Fungsi untuk memeriksa jarak maksimal
    function isWithinMaxDistance(userLat, userLng) {
        // Ambil koordinat lokasi dari tabel location
        var locationLat = {{ $attendance->location->latitude }};
        var locationLng = {{ $attendance->location->longitude }};

        // Hitung jarak menggunakan formula haversine
        var R = 6371; // Radius Bumi dalam kilometer
        var dLat = toRad(locationLat - userLat);
        var dLon = toRad(locationLng - userLng);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRad(userLat)) * Math.cos(toRad(locationLat)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var distance = R * c * 1000; // Dalam meter

        // Jarak harus kurang dari atau sama dengan 10 meter
        return distance <= 10;
    }

    // Fungsi untuk mengubah form menjadi tidak dapat diakses
    function disableFormAccess() {
        document.getElementById('attendance-form').style.display = 'none';
        showAlert('Anda tidak berada di lokasi tempat magang.', 'info');
    }

    // Fungsi untuk menampilkan alert dengan jenis tertentu
    function showAlert(message, type) {
        var alertClass = type === 'info' ? 'alert-info' : 'alert-danger';
        var alertElement = document.createElement('div');
        alertElement.className = 'alert ' + alertClass;
        alertElement.innerHTML = '<small class="fw-bold">' + message + '</small>';

        // Tambahkan alert ke dalam dokumen
        document.getElementById('map').parentNode.appendChild(alertElement);
    }

    // Fungsi untuk mengubah form menjadi dapat diakses
    function enableFormAccess() {
        document.getElementById('attendance-form').style.display = 'block';
    }

    // Konversi derajat menjadi radian
    function toRad(deg) {
        return deg * Math.PI / 180;
    }
});
</script>  
@endpush
