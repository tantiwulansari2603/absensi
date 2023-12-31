@extends('layouts.app')

<!-- @section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('holidays.index') }}" class="btn btn-sm btn-light">
            <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
            Kembali
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
                    <h3>Hari libur</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Hari libur</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="bookmark">
                        <div class="btn-toolbar justify-content-end">
                            <div>
                                <a href="{{ route('holidays.index') }}" class="btn btn-sm btn-light">
                                    <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <livewire:holiday-edit-form :holidays="$holidays" />
</div>
<!-- <div class="row">
    <div class="col-md-7">
    </div>
</div> -->
@endsection