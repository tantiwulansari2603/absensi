<div>
    <form wire:submit.prevent="saveSchool" method="post" novalidate>
        @include('partials.alerts')
        @foreach ($school as $school)
            <div class="mb-3">
                <div class="w-100">
                    <div class="mb-3">
                        <x-form-label id="nama_sekolah{{ $school['id'] }}"
                            label="Nama Sekolah {{ $loop->iteration }} (ID: {{ $school['id'] }})" />
                        <x-form-input id="nama_sekolah{{ $school['id'] }}" name="nama_sekolah{{ $school['id'] }}"
                            wire:model.defer="school.{{ $loop->index }}.nama_sekolah" />
                        <x-form-error key="school.{{ $loop->index }}.nama_sekolah" />
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
