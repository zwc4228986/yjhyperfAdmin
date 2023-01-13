<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/css/navbar-top-fixed.css"></script>

</head>

<body>

<main>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" aria-label="Fourth navbar example">
        <div class="container-fluid">
                <div class="dropdown navbar-brand">
                    <div class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">DOUZIYUAN</div>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown04">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item   dropdown">
                        <a href="#" class="d-block  link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown04">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</main>

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
<script type="text/javascript" src="js/js.cookie.js"></script>
<style>
    .one-nav{
        font-weight: bold;
        padding-right: 22px;
    }
</style>
<script>
$(function (){

    const myModalEl = document.getElementById('LoginModal')
    const modal = new mdb.Modal(myModalEl)

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
        if(data['event'] == 'create_wechat_qrcode'){
            $('.wechat_qrcodes').attr('src',data['data']['image'])
        }
        if(data['event'] == 'login_success'){
            axios.post('/web/api/set_token',{token:data['data']['token']}).then(res=>{
                console.log(res);
                window.location.reload();
            })
        }
    }

    websocketHeartbeatJs.onreconnect = function () {
        console.log('reconnecting...');
    }


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
