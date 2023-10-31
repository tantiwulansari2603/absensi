@extends('layouts.app')

@push('style')
@powerGridStyles
@endpush

<!-- @section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('attendances.create') }}" class="btn btn-sm btn-primary">
            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
            Tambah Data Absensi
        </a>
    </div>
</div>
@endsection -->

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Absensi</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Absensi</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="bookmark">
                        <div class="btn-toolbar justify-content-end">
                            <div>
                                <a href="{{ route('attendances.create') }}" class="btn btn-sm btn-primary">
                                    <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                                    Tambah Data Absensi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    @include('partials.alerts')
    <livewire:attendance-table />
</div>
@endsection

@push('script')
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
@powerGridScripts
@endpush