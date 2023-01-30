@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <h1 class="d-none d-lg-block mb-3 pt-lg-3">Shopper – Multipurpose E-Commerce Template</h1>
                        <div class="row">
                            <div class="col-lg-8 mb-md-0 mb-3">
                                <img class="rounded" src="{{$detail->Image->path_format}}">
{{--                                {{$detail->Description->description}}--}}
                                {!! $detail->Description->description !!}
                            </div>
                            <div class="col-lg-4  d-lg-block pl-xs-0 pl-lg-5">

                                <div class="price-block p-3">
                                    所需积分：
                                    <strong class="h2">20积分</strong>
                                </div>
                                <div class="btn-block">
                                    <div class="container text-center">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="button">下载</button>
                                            <button class="btn btn-outline-primary" type="button">收藏</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tips p-3">
                                    <p class="fw-light">本站素材仅供学习研究使用，请勿用于商业用途。如有侵犯您的版权，请联系我们，我们会尽快处理。</p>
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

                        <div class="theme-cards-holder mt-5 pt-5" style="border-top: 1px solid #D5DCE5; border-bottom-width: 0; margin-bottom: -60px;">
                            <div class="theme-cards__heading">
                                <div>
                                    <h5 class="theme-cards__title">E-Commerce &amp; Retail Themes</h5>
                                    <p class="text-gray-soft">Related themes in the same category.</p>
                                </div>
                                <a class="theme-cards__heading__button btn btn-outline-brand btn-sm" href="https://themes.getbootstrap.com/product-category/ecommerce-retail/">View All</a>
                            </div>
                            <ul class="row">


                                <li class="col-md-4 col-6">
                                    <div class="theme-card">
                                        <div class="theme-card__body">
                                            <a class="d-block" href="https://themes.getbootstrap.com/product/freshcart-ecommerce-html-template/">
                                                <img width="400" height="300" src="https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-400x300.jpg" class="theme-card__img wp-post-image" alt="" srcset="https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-400x300.jpg 400w, https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-800x600.jpg 800w, https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template.jpg 1200w, https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-768x576.jpg 768w, https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-600x450.jpg 600w, https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-200x150.jpg 200w, https://themes.getbootstrap.com/wp-content/uploads/2022/07/FreshCart-eCommerce-HTML-Template-540x405.jpg 540w" sizes="(max-width: 400px) 100vw, 400px">            </a>

                                            <a class="theme-card__body__overlay btn btn-brand btn-sm" target="_blank" href="https://themes.getbootstrap.com/preview/?theme_id=113886">Live preview</a>
                                        </div>
                                        <div class="theme-card__footer">
                                            <div class="theme-card__footer__item"><a class="theme-card__title mr-1" href="https://themes.getbootstrap.com/product/freshcart-ecommerce-html-template/">FreshCart – eCommerce HTML Template</a>
                                                <p class="theme-card__info">
                                                </p><ul class="prod_cats_list"><li><a href="https://themes.getbootstrap.com/product-category/ecommerce-retail/">E-Commerce &amp; Retail</a></li></ul>                <p></p>
                                            </div>
                                            <div class="theme-card__footer__item">
                                                <p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>49.00</span></p>

                                                <ul class="rating">
                                                    <li class="rating__item "></li><li class="rating__item "></li><li class="rating__item "></li><li class="rating__item "></li><li class="rating__item "></li>                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>




                                <li class="col-md-4 col-6">
                                    <div class="theme-card">
                                        <div class="theme-card__body">
                                            <a class="d-block" href="https://themes.getbootstrap.com/product/cartzilla-bootstrap-e-commerce-template-ui-kit/">
                                                <img width="400" height="300" src="https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-400x300.jpg" class="theme-card__img wp-post-image" alt="" srcset="https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-400x300.jpg 400w, https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-800x600.jpg 800w, https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3.jpg 1200w, https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-768x576.jpg 768w, https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-600x450.jpg 600w, https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-200x150.jpg 200w, https://themes.getbootstrap.com/wp-content/uploads/2019/10/screenshot-3-540x405.jpg 540w" sizes="(max-width: 400px) 100vw, 400px">            </a>

                                            <a class="theme-card__body__overlay btn btn-brand btn-sm" target="_blank" href="https://themes.getbootstrap.com/preview/?theme_id=35287">Live preview</a>
                                        </div>
                                        <div class="theme-card__footer">
                                            <div class="theme-card__footer__item"><a class="theme-card__title mr-1" href="https://themes.getbootstrap.com/product/cartzilla-bootstrap-e-commerce-template-ui-kit/">Cartzilla – Multipurpose eCommerce Template</a>
                                                <p class="theme-card__info">
                                                </p><ul class="prod_cats_list"><li><a href="https://themes.getbootstrap.com/product-category/ecommerce-retail/">E-Commerce &amp; Retail</a></li></ul>                <p></p>
                                            </div>
                                            <div class="theme-card__footer__item">
                                                <p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>49.00</span></p>

                                                <ul class="rating">
                                                    <li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li>                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>




                                <li class="col-md-4 col-6">
                                    <div class="theme-card">
                                        <div class="theme-card__body">
                                            <a class="d-block" href="https://themes.getbootstrap.com/product/booking-multipurpose-booking-and-directory-theme/">
                                                <img width="400" height="300" src="https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-400x300.jpg" class="theme-card__img wp-post-image" alt="" srcset="https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-400x300.jpg 400w, https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-800x600.jpg 800w, https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme.jpg 1200w, https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-768x576.jpg 768w, https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-600x450.jpg 600w, https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-200x150.jpg 200w, https://themes.getbootstrap.com/wp-content/uploads/2022/10/Booking-Multipurpose-Online-Booking-Theme-540x405.jpg 540w" sizes="(max-width: 400px) 100vw, 400px">            </a>

                                            <a class="theme-card__body__overlay btn btn-brand btn-sm" target="_blank" href="https://themes.getbootstrap.com/preview/?theme_id=117868">Live preview</a>
                                        </div>
                                        <div class="theme-card__footer">
                                            <div class="theme-card__footer__item"><a class="theme-card__title mr-1" href="https://themes.getbootstrap.com/product/booking-multipurpose-booking-and-directory-theme/">Booking – Multipurpose Booking and Directory Theme</a>
                                                <p class="theme-card__info">
                                                </p><ul class="prod_cats_list"><li><a href="https://themes.getbootstrap.com/product-category/ecommerce-retail/">E-Commerce &amp; Retail</a></li></ul>                <p></p>
                                            </div>
                                            <div class="theme-card__footer__item">
                                                <p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>49.00</span></p>

                                                <ul class="rating">
                                                    <li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li><li class="rating__item rating__item--active"></li>                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                            </ul>
                        </div>

                    </main></div>
            </div><!-- end .col -->

        </div>
    </div>
@endsection

<style>
    img{
        width:100%;
    }
</style>