@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Sidenav START -->
        <div class="col-lg-3">
            <!-- Advanced filter responsive toggler START -->
            <!-- Divider -->
            <div class="d-flex align-items-center mb-4 d-lg-none">
                <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <!-- Advanced filter responsive toggler END -->
            <nav class="navbar navbar-light navbar-expand-lg mx-0 p-0">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                    <!-- Offcanvas header -->
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <!-- Offcanvas body -->
                    <div class="offcanvas-body p-0">
                        <!-- Card START -->
                        <div class="card w-100">

                            <!-- Card body START -->
                            <div class="card-body">
                                <div class="d-none d-lg-block text-center mb-5">
                                    <div class="avatar avatar-xxl avatar-circle mb-3">
                                        <img src="https://github.com/mdo.png" alt="mdo" width="100" height="100" class="rounded-circle">
                                    </div>
                                    <h4 class="card-title mb-0">{{$userDetail['nickname']}}</h4>
                                    <p class="card-text small">ID：{{$userDetail['id']}}</p>
                                </div>

                                <!-- Side Nav START -->
                                <ul class="nav nav-tabs nav-pills nav-pills-soft flex-column fw-bold gap-2 border-0">
                                    <li class="nav-item" data-bs-dismiss="offcanvas">
                                        <a class="nav-link d-flex mb-0 {{$type=='info'?'active':''}}" href="{{url('/user/center/info')}}">
                                            <img class="me-2 h-20px fa-fw" alt=""><span>我的信息 </span></a>
                                    </li>
                                    <li class="nav-item" data-bs-dismiss="offcanvas">
                                        <a class="nav-link d-flex mb-0 {{$type=='order'?'active':''}}" href="{{url('/user/center/order')}}">
                                            <img class="me-2 h-20px fa-fw"
                                                 alt=""><span>我的下载</span></a>
                                    </li>
                                </ul>
                                <!-- Side Nav END -->

                            </div>
                            <!-- Card body END -->
                            <!-- Card footer -->
                            <div class="card-footer text-center py-2">
                                <a class="btn btn-link text-secondary btn-sm" href="#!">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                    <!-- Offcanvas body -->

                    <!-- Helper link START -->
                    <ul class="nav small mt-4 justify-content-center lh-1">
                        <li class="nav-item">
                            <a class="nav-link" href="my-profile-about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.html">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://support.webestica.com/login">Support </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="docs/index.html">Docs </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="help.html">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="privacy-and-terms.html">Privacy &amp; terms</a>
                        </li>
                    </ul>
                    <!-- Helper link END -->
                    <!-- Copyright -->
                    <p class="small text-center mt-1">©2022 <a class="text-body" target="_blank"
                                                               href="https://www.webestica.com/"> Webestica </a></p>

                </div>
            </nav>
        </div>
        <!-- Sidenav END -->

        <!-- Main content START -->
        <div class="col-lg-6 vstack gap-4">
            <!-- Setting Tab content START -->
            <div class="tab-content py-0 mb-0">

                @switch($type)
                    @case('info')
                        <x-user-info />
                        @break
                    @case('order')
                        <x-user-order />
                        @break
                    @default
                        Default case...
                @endswitch

{{--                <x-dynamic-component component="x-user-info" class="mt-4" />--}}
            </div>
            <!-- Setting Tab content END -->
        </div>

    </div> <!-- Row END -->
@endsection
