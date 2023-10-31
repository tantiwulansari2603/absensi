@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Data kehadiran</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Data kehadiran</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    @include('partials.alerts')

    <div class="row">
        <div class="col-md-7">
            <ul class="list-group">
                @foreach ($attendances as $attendance)
                <a href="{{ route('presences.show', $attendance->id) }}" class="list-group-item d-flex justify-content-between align-items-start py-3">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $attendance->title }}</div>
                        <p class="mb-0">{{ $attendance->description }}</p>
                    </div>
                    @include('partials.attendance-badges')
                </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection