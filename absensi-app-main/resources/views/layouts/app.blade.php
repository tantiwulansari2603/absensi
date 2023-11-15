@extends('layouts.base')

@push('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('base')
<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <div class="page-main-header">
        <div class="main-header-right row m-0">
            <div class="main-header-left">
                <div class="logo-wrapper"><a href="{{ route('home.index') }}"><img class="img" src="{{ asset('assets/images/logonatusi.png') }}" alt="" height="50px"></a></div>
                <div class="dark-logo-wrapper"><a href="{{ route('home.index') }}"><img class="img" src="{{ asset('assets/images/logonatusi.png') }}" alt="" height="50px"></a></div>
                <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
            </div>
            <!-- Page Header Start-->
            @include('partials.navbar')
            <!-- Page Header Ends-->
        </div>
    </div>
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        @include('partials.sidebar')
        <!-- Page Sidebar Ends-->

        <!-- Container-fluid starts-->
        @yield('content')
        <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->
    @include('partials.footer')
    <!-- footer Ends-->
</div>
@endsection