<div>
    <form wire:submit.prevent="saveLocations" method="post" novalidate>
        @include('partials.alerts')
        @foreach ($locations as $i => $location)
            <div class="mb-3">
                <div class="w-100">
                    <div class="mb-3">
                        <x-form-label id="nama{{ $i }}" label='Nama Kantor ({{ $i + 1 }})' />
                        <x-form-input id="nama{{ $i }}" name="nama{{ $i }}"
                            wire:model.defer="locations.{{ $i }}.nama" />
                        <x-form-error key="locations.{{ $i }}.nama" />
                    </div>
                    <div class="mb-3">
                        <x-form-label id="alamat{{ $i }}" label='Alamat ({{ $i + 1 }})' />
                        <textarea id="alamat{{ $i }}" name="alamat{{ $i }}" class="form-control"
                            wire:model.defer="locations.{{ $i }}.alamat"></textarea>
                        <x-form-error key="locations.{{ $i }}.alamat" />
                    </div>
                    <div class="mb-3">
                        <x-form-label id="location{{ $i }}" label='Pilih Lokasi ({{ $i + 1 }})' />
                        <div id="map{{ $i }}" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Latitude -->
                                <x-form-label id="latitude{{ $i }}" label='Latitude ({{ $i + 1 }})' />
                                <x-form-input id="latitude{{ $i }}" name="latitude{{ $i }}" type="text"
                                    wire:model.defer="locations.{{ $i }}.latitude" />
                                <x-form-error key="locations.{{ $i }}.latitude" />
                            </div>
                    
                            <div class="col-md-6">
                                <!-- Longitude -->
                                <x-form-label id="longitude{{ $i }}" label='Longitude ({{ $i + 1 }})' />
                                <x-form-input id="longitude{{ $i }}" name="longitude{{ $i }}" type="text"
                                    wire:model.defer="locations.{{ $i }}.longitude" />
                                <x-form-error key="locations.{{ $i }}.longitude" />
                            </div>
                        </div>
                    </div>
                </div>
                @if ($i > 0)
                    <button class="btn btn-sm btn-danger mt-2" wire:click="removeLocationInput({{ $i }})"
                        wire:target="removeLocationInput({{ $i }})" type="button"
                        wire:loading.attr="disabled">Hapus</button>
                @endif
            </div>
            <hr>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
            <button class="btn btn-light" type="button" wire:click="addLocationInput" wire:loading.attr="disabled">
                Tambah Input
            </button>
        </div>
    </form>
    @push('scripts')
        @foreach ($locations as $i => $location)
            <script>
                var map{{ $i }} = L.map('map{{ $i }}').setView([-7.488679253144124, 112.46195241611329], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map{{ $i }});

                var marker{{ $i }} = L.marker([-7.488679253144124, 112.46195241611329], {
                    draggable: true
                }).addTo(map{{ $i }});

                marker{{ $i }}.on('dragend', function(event) {
                    var lat = event.target.getLatLng().lat;
                    var lng = event.target.getLatLng().lng;
                    document.getElementById('latitude{{ $i }}').value = lat;
                    document.getElementById('longitude{{ $i }}').value = lng;

                    // Koordinat marker
                    var markerCoordinates = [-7.488679253144124, 112.46195241611329];

                    // Buat marker lingkaran dengan warna hijau dan radius 10 meter
                    var circleMarker = L.circle(markerCoordinates, {
                        color: 'green',
                        fillColor: 'green',
                        fillOpacity: 0.5,
                        radius: 10
                    }).addTo(map);

                    // Tambahkan popup jika diperlukan
                    circleMarker.bindPopup('Ini adalah lingkaran marker dengan radius 10 meter').openPopup();
                });
            </script>
        @endforeach
    @endpush
</div>
