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
        </div>
        <hr>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>
</div>