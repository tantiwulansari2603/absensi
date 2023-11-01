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

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3" style="max-width: min-content">
                <div class="card-body">
                    <img src="{{ $qrcode }}" alt="" id="qrcode">
                </div>
            </div>
            <div class="mb-3">
                <a href="{{ route('presences.qrcode.download-pdf', ['code' => $code]) }}" class="btn btn-primary">Download
                    PDF</a>
            </div>
            <div><small class="text-muted">Untuk mendownload QrCode SVG (agar bisa diedit) silahkan klik kiri pada
                    gambar qrcode, lalu download.</small></div>
        </div>
    </div>
</div>
@endsection