<div>
    <form wire:submit.prevent="saveLocations" method="post" novalidate>
        @include('partials.alerts')
        <div class="mb-3">
            <div class="w-100">
                <div class="mb-3">
                    <x-form-label id="nama" label='Nama Kantor' />
                    <x-form-input id="nama" name="nama" wire:model.defer="locations.0.nama" />
                    <x-form-error key="locations.0.nama" />
                </div>
                <div class="mb-3">
                    <x-form-label id="alamat" label='Alamat' />
                    <textarea id="alamat" name="alamat" class="form-control" wire:model.defer="locations.0.alamat"></textarea>
                    <x-form-error key="locations.0.alamat" />
                </div>
                <div class="mb-3">
                    <x-form-label id="location" label='Pilih Lokasi' />
                    <div id="map" style="height: 500px;" wire:ignore></div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Latitude -->
                            <x-form-label id="latitude" label='Latitude' />
                            <x-form-input id="latitude" name="latitude" type="text" readonly
                                wire:model.defer="locations.0.latitude" />
                            <x-form-error key="locations.0.latitude" />
                        </div>

                        <div class="col-md-6">
                            <!-- Longitude -->
                            <x-form-label id="longitude" label='Longitude' />
                            <x-form-input id="longitude" name="longitude" type="text" readonly
                                wire:model.defer="locations.0.longitude" />
                            <x-form-error key="locations.0.longitude" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>
    <script>
        document.addEventListener('livewire:load', function() {
            var map = L.map('map').setView([-7.488679253144124, 112.46195241611329], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            var marker = L.marker([-7.488679253144124, 112.46195241611329], {
                draggable: true
            }).addTo(map);

            function updateMarker(lat, lng) {
                marker.setLatLng([lat, lng]);

                // Hapus semua marker sebelumnya
                map.eachLayer(function(layer) {
                    if (layer instanceof L.CircleMarker) {
                        layer.remove();
                    }
                });

                // Buat marker lingkaran dengan warna hijau dan radius 10 meter
                var circleMarker = L.circle([lat, lng], {
                    color: 'green',
                    fillColor: 'green',
                    fillOpacity: 0.5,
                    radius: 10
                }).addTo(map);

                // Tambahkan event hover
                circleMarker.on('mouseover', function(event) {
                    this.bindPopup('Area lokasi dengan radius 10 meter').openPopup();
                });

                circleMarker.on('mouseout', function(event) {
                    this.closePopup();
                });

                // Update nilai latitude dan longitude pada form Livewire
                @this.set('locations.0.latitude', lat);
                @this.set('locations.0.longitude', lng);
            }

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                // Panggil fungsi updateMarker dengan koordinat baru
                updateMarker(lat, lng);
            });

            marker.on('dragend', function(event) {
                var lat = event.target.getLatLng().lat;
                var lng = event.target.getLatLng().lng;

                // Panggil fungsi updateMarker dengan koordinat baru
                updateMarker(lat, lng);
            });
        });
    </script>
</div>
