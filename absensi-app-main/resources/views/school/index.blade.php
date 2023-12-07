@extends('layouts.app')

@push('style')
@powerGridStyles
@endpush

<!-- @section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
                    <div>
                        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">
                            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                            Tambah Data Karyawaan
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
                    <h3>Sekolah</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Sekolah</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="bookmark">
                        <div class="btn-toolbar justify-content-end">
                            <div>
                                <a href="{{ route('school.create') }}" class="btn btn-sm btn-primary">
                                    <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                                    Tambah Data Sekolah
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
    <livewire:employee-table />
</div>
@endsection

@push('script')
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
@powerGridScripts
@endpush