@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid general-widget">
            <div class="row">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                <div class="media-body"><span class="m-0">Data Jabatan</span>
                                    <h4 class="mb-0 counter">{{ $positionCount }}</h4><i class="icon-bg"
                                        data-feather="database"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-secondary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="user"></i></div>
                                <div class="media-body"><span class="m-0">Data Peserta Magang</span>
                                    <h4 class="mb-0 counter">{{ $userCount }}</h4><i class="icon-bg"
                                        data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                                <div class="media-body"><span class="m-0">Data Kehadiran</span>
                                    <h4 class="mb-0 counter">{{ $presenceCount }}</h4><i class="icon-bg"
                                        data-feather="message-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                                <div class="media-body"><span class="m-0">Data Absensi</span>
                                    <h4 class="mb-0 counter">{{ $attendanceCount }}</h4><i class="icon-bg"
                                        data-feather="user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 xl-100 box-col-12">
                    <div class="card">
                        <div class="cal-date-widget card-body">
                            <div class="row">
                                <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                                    <div class="cal-info text-center mobile-clock-widget">
                                        <div>
                                            <div class="media">
                                                <svg class="climacon climacon_cloudRainMoon" id="cloudRainMoon"
                                                    version="1.1" viewbox="15 15 70 70">
                                                    <clippath id="cloudFillClip1">
                                                        <path
                                                            d="M15,15v70h70V15H15z M59.943,61.639c-3.02,0-12.381,0-15.999,0c-6.626,0-11.998-5.371-11.998-11.998c0-6.627,5.372-11.999,11.998-11.999c5.691,0,10.434,3.974,11.665,9.29c1.252-0.81,2.733-1.291,4.334-1.291c4.418,0,8,3.582,8,8C67.943,58.057,64.361,61.639,59.943,61.639z">
                                                        </path>
                                                    </clippath>
                                                    <clippath id="moonCloudFillClip1">
                                                        <path
                                                            d="M0,0v100h100V0H0z M60.943,46.641c-4.418,0-7.999-3.582-7.999-7.999c0-3.803,2.655-6.979,6.211-7.792c0.903,4.854,4.726,8.676,9.579,9.58C67.922,43.986,64.745,46.641,60.943,46.641z">
                                                        </path>
                                                    </clippath>
                                                    <g class="climacon_iconWrap climacon_iconWrap-cloudRainMoon">
                                                        <g clip-path="url(#cloudFillClip1)">
                                                            <g class="climacon_wrapperComponent climacon_wrapperComponent-moon climacon_componentWrap-moon_cloud"
                                                                clip-path="url(#moonCloudFillClip1)">
                                                                <path
                                                                    class="climacon_component climacon_component-stroke climacon_component-stroke_sunBody"
                                                                    d="M61.023,50.641c-6.627,0-11.999-5.372-11.999-11.998c0-6.627,5.372-11.999,11.999-11.999c0.755,0,1.491,0.078,2.207,0.212c-0.132,0.576-0.208,1.173-0.208,1.788c0,4.418,3.582,7.999,8,7.999c0.614,0,1.212-0.076,1.788-0.208c0.133,0.717,0.211,1.452,0.211,2.208C73.021,45.269,67.649,50.641,61.023,50.641z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g class="climacon_wrapperComponent climacon_wrapperComponent-rain">
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- left"
                                                                d="M41.946,53.641c1.104,0,1.999,0.896,1.999,2v15.998c0,1.105-0.895,2-1.999,2s-2-0.895-2-2V55.641C39.946,54.537,40.842,53.641,41.946,53.641z">
                                                            </path>
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- middle"
                                                                d="M49.945,57.641c1.104,0,2,0.896,2,2v15.998c0,1.104-0.896,2-2,2s-2-0.896-2-2V59.641C47.945,58.535,48.841,57.641,49.945,57.641z">
                                                            </path>
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- right"
                                                                d="M57.943,53.641c1.104,0,2,0.896,2,2v15.998c0,1.105-0.896,2-2,2c-1.104,0-2-0.895-2-2V55.641C55.943,54.537,56.84,53.641,57.943,53.641z">
                                                            </path>
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- left"
                                                                d="M41.946,53.641c1.104,0,1.999,0.896,1.999,2v15.998c0,1.105-0.895,2-1.999,2s-2-0.895-2-2V55.641C39.946,54.537,40.842,53.641,41.946,53.641z">
                                                            </path>
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- middle"
                                                                d="M49.945,57.641c1.104,0,2,0.896,2,2v15.998c0,1.104-0.896,2-2,2s-2-0.896-2-2V59.641C47.945,58.535,48.841,57.641,49.945,57.641z">
                                                            </path>
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- right"
                                                                d="M57.943,53.641c1.104,0,2,0.896,2,2v15.998c0,1.105-0.896,2-2,2c-1.104,0-2-0.895-2-2V55.641C55.943,54.537,56.84,53.641,57.943,53.641z">
                                                            </path>
                                                        </g>
                                                        <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud"
                                                            clip-path="url(#cloudFillClip1)">
                                                            <path
                                                                class="climacon_component climacon_component-stroke climacon_component-stroke_cloud"
                                                                d="M59.943,41.642c-0.696,0-1.369,0.092-2.033,0.205c-2.736-4.892-7.961-8.203-13.965-8.203c-8.835,0-15.998,7.162-15.998,15.997c0,5.992,3.3,11.207,8.177,13.947c0.276-1.262,0.892-2.465,1.873-3.445l0.057-0.057c-3.644-2.061-6.106-5.963-6.106-10.445c0-6.626,5.372-11.998,11.998-11.998c5.691,0,10.433,3.974,11.666,9.29c1.25-0.81,2.732-1.291,4.332-1.291c4.418,0,8,3.581,8,7.999c0,3.443-2.182,6.371-5.235,7.498c0.788,1.146,1.194,2.471,1.222,3.807c4.666-1.645,8.014-6.077,8.014-11.305C71.941,47.014,66.57,41.642,59.943,41.642z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <!-- cloudRainMoon-->
                                                <div class="media-body align-self-center text-white">
                                                    <h4 class="m-0 f-w-600 num">{{ $temperature }} °C.</h4>
                                                    <p class="m-0 f-14">{{ $city }}</p>
                                                </div>
                                            </div>
                                            <div class="date f-24 mb-2 d-inline-block" id="date">
                                                <span class="b-r-dark pe-3" id="monthDay"></span>
                                                <span class="ps-3" id="year"></span>
                                            </div>
                                            <div>
                                                <p class="m-0 f-14 text-light">Indonesia </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                                    <div class="cal-datepicker">
                                        <div class="datepicker-here float-sm-end" data-language="en"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
