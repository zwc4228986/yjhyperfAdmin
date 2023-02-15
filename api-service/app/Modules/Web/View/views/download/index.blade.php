@extends('layouts.app')

@section('content')
    <div class="container position-relative">
        <div class="row">
            <div class="col">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <h2 class="mb-3">{{$productResource->Product->name}}</h2>
                        <div class="row">
                            <div class="col-lg-8 mb-md-0 mb-3">
                                <img class="rounded" src="{{$productResource->Product->Image->path_format}}">
                            </div>
                            <div class="col-lg-4  d-lg-block pl-xs-0 pl-lg-5">
                                <div class="btn-block">
                                    <div class="container text-center">
                                        <div class="d-grid gap-2">
                                            <button class="btn p-3 bg-purple-400 hover:bg-purple-500  text-white  border-purple-400 downloader"
                                                    data-id="{{$order_product_id}}"
                                                    type="button">立即下载
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tips p-3">
                                    <p class="fw-light">
                                        本站素材仅供学习研究使用，请勿用于商业用途。如有侵犯您的版权，请联系我们，我们会尽快处理。
                                    </p>
                                </div>
                            </div>
                        </div>

                    </main>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="tipModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">兑换成功</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    正在下载中...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>



    <style>
        #main img {
            width: 100%;
        }
    </style>

    <script>
        $(function () {
            const tipModel = document.getElementById('tipModel')
            const modal = new bootstrap.Modal(tipModel)

            var myToastEl = document.getElementById('productToastEl')
            // var myToast = new bootstrap.Toast(myToastEl)
            //
            const myToast = new bootstrap.Toast(myToastEl)
            // console.log(myToast)
            // myToast.show();
            console.log(myToastEl, myToast)
            $('.downloader').click(function () {
                let order_product_id = $(this).data('id');
                window.location.href = "{{url('/download/order_product')}}" + '/' + order_product_id
            });
        });
    </script>
@endsection

