<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img
                        src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
                        height="15"
                        alt="MDB Logo"
                        loading="lazy"
                />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <div class="nav-item dropdown one-nav">
                    <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdownMenuLink1"
                            role="button"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                    >
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                        <li>
                            <a class="dropdown-item" href="#">Action</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another action</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
                @foreach ($nav as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{$item['name']}}</a>
                    </li>
                @endforeach
                    <li class="nav-item dropdown">
                        <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdownMenuLink"
                                role="button"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false"
                        >
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">

            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#LoginModal">
               登录
            </button>

{{--            <!-- Icon -->--}}
{{--            <a class="text-reset me-3" href="#">--}}
{{--                <i class="fas fa-shopping-cart"></i>--}}
{{--            </a>--}}

{{--            <!-- Notifications -->--}}
{{--            <div class="dropdown">--}}
{{--                <a--}}
{{--                        class="text-reset me-3 dropdown-toggle hidden-arrow"--}}
{{--                        href="#"--}}
{{--                        id="navbarDropdownMenuLink"--}}
{{--                        role="button"--}}
{{--                        data-mdb-toggle="dropdown"--}}
{{--                        aria-expanded="false"--}}
{{--                >--}}
{{--                    <i class="fas fa-bell"></i>--}}
{{--                    <span class="badge rounded-pill badge-notification bg-danger">1</span>--}}
{{--                </a>--}}
{{--                <ul--}}
{{--                        class="dropdown-menu dropdown-menu-end"--}}
{{--                        aria-labelledby="navbarDropdownMenuLink"--}}
{{--                >--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">Some news</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">Another news</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <!-- Avatar -->--}}
{{--            <div class="dropdown">--}}
{{--                <a--}}
{{--                        class="dropdown-toggle d-flex align-items-center hidden-arrow"--}}
{{--                        href="#"--}}
{{--                        id="navbarDropdownMenuAvatar"--}}
{{--                        role="button"--}}
{{--                        data-mdb-toggle="dropdown"--}}
{{--                        aria-expanded="false"--}}
{{--                >--}}
{{--                    <img--}}
{{--                            src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"--}}
{{--                            class="rounded-circle"--}}
{{--                            height="25"--}}
{{--                            alt="Black and White Portrait of a Man"--}}
{{--                            loading="lazy"--}}
{{--                    />--}}
{{--                </a>--}}
{{--                <ul--}}
{{--                        class="dropdown-menu dropdown-menu-end"--}}
{{--                        aria-labelledby="navbarDropdownMenuAvatar"--}}
{{--                >--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">My profile</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">Settings</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">Logout</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>

<!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LoginModalLabel">登录</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" class="rounded img-thumbnail wechat_qrcodes" alt="...">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar -->
<!-- Start your project here-->
<!-- End your project here-->
<!-- MDB -->
<script src="js/jquery-3.6.3.min.js"></script>
<script src="ws/socket.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript"></script>
<style>
    .one-nav{
        font-weight: bold;
        padding-right: 22px;
    }
</style>
<script>
$(function (){
    let websocketHeartbeatJs = new WebsocketHeartbeatJs({
        url: 'ws://127.0.0.1:9501/login'
    });
    websocketHeartbeatJs.onopen = function () {
        console.log('connect success');
        // websocketHeartbeatJs.send('text', {message:'hello server'});
    }
    websocketHeartbeatJs.onmessage = function (e) {
        console.log(`onmessage: ${e.data}`);
        const data = JSON.parse(e.data);
        if(data['event'] == 'create_wechat_qrcode'){

            $('.wechat_qrcodes').attr('src',data['data']['image'])
        }
    }
    websocketHeartbeatJs.onreconnect = function () {
        console.log('reconnecting...');
    }
    const myModalEl = document.getElementById('LoginModal')
    console.log(myModalEl)
    myModalEl.addEventListener('hidden.mdb.modal', (e) => {
        // do something...
    })
    myModalEl.addEventListener('show.mdb.modal', (e) => {
        websocketHeartbeatJs.send('create_wechat_qrcode')
        // do something...

    })

})



</script>
</body>
</html>
