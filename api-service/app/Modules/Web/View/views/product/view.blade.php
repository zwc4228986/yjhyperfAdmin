@extends('layouts.app')

@section('content')
    <div class="container position-relative">
        <div class="row">
            <div class="col">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <h2 class="d-none d-lg-block mb-3 pt-lg-3">{{$detail->name}}</h2>
                        <div class="row">
                            <div class="col-lg-8 mb-md-0 mb-3">
                                <img class="rounded" src="{{$detail->Image->path_format}}">
                                {{--                                {{$detail->Description->description}}--}}
                                {!! $detail->Description->description !!}
                            </div>
                            <div class="col-lg-4  d-lg-block pl-xs-0 pl-lg-5">
                                <div class="price-block p-3">
                                    所需积分：
                                    <strong class="h2">{{$detail->price}}积分</strong>
                                </div>
                                <div class="btn-block">
                                    <div class="container text-center">
                                        <div class="d-grid gap-2">
                                            <button class="btn p-3 bg-purple-400 hover:bg-purple-500  text-white  border-purple-400 downloader" data-id="{{$detail->id}}"
                                                    type="button">立即兑换
                                            </button>
                                            <button class="btn btn-outline-primary" type="button">收藏</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tips p-3">
                                    <p class="fw-light">
                                        本站素材仅供学习研究使用，请勿用于商业用途。如有侵犯您的版权，请联系我们，我们会尽快处理。</p>
                                </div>

                                {{--                            --}}
                                {{--                                <div class="theme-description__list">--}}
                                {{--                                    <div class="theme-description__list__item"><span class="theme-description__item__title">Bootstrap</span><span>v5.1.3</span></div>--}}
                                {{--                                    <div class="theme-description__list__item"><span class="theme-description__item__title">Released</span><span>3 years ago</span></div>--}}

                                {{--                                    <div class="theme-description__list__item"><span class="theme-description__item__title">Updated</span><span>9 months ago</span></div>--}}
                                {{--                                    <div class="theme-description__list__item"><span class="theme-description__item__title">Version</span><span>2.0.0</span></div>--}}
                                {{--                                    <div class="theme-description__list__item"><span class="theme-description__item__title">Category</span>--}}
                                {{--                                        <a href="https://themes.getbootstrap.com/product-category/ecommerce-retail/">E-Commerce &amp; Retail</a>            </div>--}}
                                {{--                                    <div class="theme-description__list__item">--}}
                                {{--                                        <a class="profile-author" href="https://themes.getbootstrap.com/store/unvab-plus">--}}
                                {{--                                            <div class="profile-author__logo">--}}
                                {{--                                                <img class="profile-author__img" src="https://themes.getbootstrap.com/wp-content/uploads/2019/11/Ava.png" alt="">--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="profile-author__author__description">--}}
                                {{--                                                <p>Created by</p>--}}
                                {{--                                                <h6 class="profile-logo__author__title">Unvab Plus</h6>--}}
                                {{--                                            </div>--}}
                                {{--                                        </a>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                            </div>

                            <!-- Related Products -->
                            <!-- Note: It just didn't work at all. It doesn't show products in the same category when they exist, so I moved it all to "notes.txt" for reference so I can ship, but it needs to be fixed.  -->

                            <div class="theme-cards-holder mt-5 pt-5"
                                 style="border-top: 1px solid #D5DCE5; border-bottom-width: 0;">
                                <div class="theme-cards__heading">
                                    <div>
                                        <h5 class="theme-cards__title">猜你喜欢</h5>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @foreach ($product as $item)
                                            <a href="{{url("/product/view/".$item->id)}}" class="col">
                                                <div class="card shadow-sm">
                                                    <img src="{{$item->Image->path_format}}">
                                                    <div class="card-body">
                                                        <p class="card-text">{{$item->name}}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="">
                                                                <strong class="h3">{{$item->price}}</strong>
                                                                <strong class="fs-18 ml-1">积分</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
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
            //
            const myToast =new bootstrap.Toast(myToastEl)
            // console.log(myToast)
            // myToast.show();
            console.log(myToastEl,myToast)
            $('.downloader').click(function () {
                let product_id = $(this).data('id');
                axios.post('/web/api/order/create', {product_id: product_id}).then(res => {
                    if(res.data.status == 0){
                        // modal.show()
                        window.location.href= "{{url('/web/api/download')}}"+'/'+res.data.data.id
                    }else{
                        swal({
                            title: "积分不足!",
                            icon: "error",
                            buttons: ["取消", "去赚积分"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {

                                if (willDelete) {
                                    // swal("Poof! Your imaginary file has been deleted!", {
                                    //     icon: "success",
                                    // });

                                } else {
                                    // swal("Your imaginary file is safe!");
                                }
                        });
                    }

                })
            });
        });
    </script>
@endsection

