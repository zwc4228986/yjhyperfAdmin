<body>
<main>
    <header class="shadow">
        <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Fourth navbar example">
            <div class="container">
                <div class="dropdown navbar-brand">
                    <div class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown"
                         aria-expanded="false">抖资源
                    </div>
                    <ul class="dropdown-menu z-9999" aria-labelledby="dropdown04">
                        @foreach ($nav as $item)
                            <li><a class="dropdown-item"
                                   href="{{url('/?product_category_pid='.$item['id'])}}">{{$item['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>

                <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{url("/")}}">首页</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">赚金币</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">论坛</a>
                        </li>
                    </ul>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <ul class="navbar-nav mb-2 mb-md-0">
                        @if(!$isLogin)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#loginModel">
                                Login
                            </button>
                        @else
                            <li class="nav-item   dropdown z-9999">
                                <a href="#" class="d-block  link-light text-decoration-none dropdown-toggle"
                                   id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                         class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown04">
                                    <li><a class="dropdown-item" href="{{url('/user/center/info')}}">我的信息</a></li>
                                    <li><a class="dropdown-item" href="{{url('/user/center/order')}}">我的订单</a></li>
                                    {{--                                    <li><a class="dropdown-item" href="{{url('/user/center/')}}">抖币记录</a></li>--}}
                                    {{--                                    <li><a class="dropdown-item" href="{{url('user/center')}}">设置</a></li>--}}
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</main>

<nav class="navbar navbar-light bg-white  sticky-top shadow-sm" id="second_nav">
    <div class="container">
        <ul class="nav  justify-content-center">
            <li class="nav-item {{$product_category_pid==0?"active":""}}">
                <a class="nav-link nav-custom-link " aria-current="page" href="{{url('/')}}">首页</a>
            </li>
            @foreach ($nav as $item)
                <li class="nav-item {{$product_category_pid==$item['id']?"active":""}}">
                    <a class="nav-link nav-custom-link " aria-current="page" href="{{url('/?product_category_pid='.$item['id'])}}">{{$item['name']}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

<nav class="navbar navbar-light bg-white  sticky-top shadow-sm" id="second_nav">
    <div class="container">
        <ul class="nav  justify-content-center">
            <li class="nav-item {{$product_category_pid==0?"active":""}}">
                <a class="nav-link nav-custom-link " aria-current="page" href="{{url('/')}}">首页</a>
            </li>
            @foreach ($nav as $item)
                <li class="nav-item {{$product_category_pid==$item['id']?"active":""}}">
                    <a class="nav-link nav-custom-link " aria-current="page" href="{{url('/?product_category_pid='.$item['id'])}}">{{$item['name']}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

<div class="modal fade" id="loginModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">公众号扫码登录</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" style="width: 200px;height: 200px;" class="rounded img-thumbnail wechat_qrcodes"
                         alt="...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<!-- Start your project here-->
<!-- End your project here-->
<!-- MDB -->
<script src="/js/jquery-3.6.3.min.js"></script>
<script src="/ws/socket.js"></script>
{{--<script type="text/javascript" src="js/mdb.min.js"></script>--}}
<script type="text/javascript" src="/js/js.cookie.js"></script>
<style>
    .one-nav {
        font-weight: bold;
        padding-right: 22px;
    }

    .z-9999 {
        z-index: 9999;
    }
</style>
<script>
    $(function () {
        const myModalEl = document.getElementById('loginModel')
        console.log(myModalEl)
        const modal = new bootstrap.Modal(myModalEl)
        console.log(modal)
        let websocketHeartbeatJs = new WebsocketHeartbeatJs({
            url: 'ws://127.0.0.1:9501/login'
        });
        websocketHeartbeatJs.onopen = function () {
            console.log('connect success');
            // websocketHeartbeatJs.send('text', {message:'hello server'});
        }

        websocketHeartbeatJs.onclose = function () {
            modal.hide();
        }

        websocketHeartbeatJs.onmessage = function (e) {
            console.log(`onmessage: ${e.data}`);
            const data = JSON.parse(e.data);
            if (data['event'] == 'create_wechat_qrcode') {
                $('.wechat_qrcodes').attr('src', data['data']['image'])
            }
            if (data['event'] == 'login_success') {
                axios.post('/web/api/set_token', {token: data['data']['token']}).then(res => {
                    console.log(res);
                    window.location.reload();
                })
            }
        }

        websocketHeartbeatJs.onreconnect = function () {
            console.log('reconnecting...');
        }


        console.log(myModalEl)
        myModalEl.addEventListener('hidden.bs.modal', (e) => {
            // do something...
        })
        myModalEl.addEventListener('show.bs.modal', (e) => {
            websocketHeartbeatJs.send('create_wechat_qrcode')
            // do something...

        })

    })


</script>