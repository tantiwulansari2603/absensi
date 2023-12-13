<div>
    <form wire:submit.prevent="saveSchool" method="post" novalidate>
        @include('partials.alerts')
        @foreach ($school as $i => $school)
            <div class="mb-3">
                <div class="w-100">
                    <div class="mb-3">
                        <x-form-label id="nama_sekolah{{ $i }}" label='Nama Sekolah {{ $i + 1 }}' />
                        <x-form-input id="nama_sekolah{{ $i }}" name="nama_sekolah{{ $i }}"
                            wire:model.defer="school.{{ $i }}.nama_sekolah" />
                        <x-form-error key="school.{{ $i }}.nama_sekolah" />
                    </div>
                </div>
                @if ($i > 0)
                    <button class="btn btn-sm btn-danger mt-2" wire:click="removeSchoolInput({{ $i }})"
                        wire:target="removeSchoolInput({{ $i }})" type="button"
                        wire:loading.attr="disabled">Hapus</button>
                @endif
            </div>
            <hr>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
            <button class="btn btn-light" type="button" wire:click="addSchoolInput" wire:loading.attr="disabled">
                Tambah Input
            </button>
        </div>
    </form>
</div>
