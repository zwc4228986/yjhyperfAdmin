<!-- Account setting tab START -->
<div class="tab-pane fade active show" id="nav-setting-tab-1">
    <!-- Change your password START -->


    <div class="row mb-4" >
        <div class="col-sm-6">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-account-multiple widget-icon"></i>
                    </div>
                    <h6 class=" fw-normal mt-0" title="Number of Customers">抖币</h6>
                    <h3 class="mt-3 mb-3">{{$userDetail['integral']}}</h3>
                    <p class="mb-0 text-muted">
{{--                        <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>--}}
{{--                        <span class="text-nowrap">Since last month</span>--}}
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-sm-6">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-cart-plus widget-icon"></i>
                    </div>
                    <h6 class=" fw-normal mt-0" title="Number of Orders">推广用户</h6>
                    <h3 class="mt-3 mb-3">0</h3>
                    <p class="mb-0 text-muted">
{{--                        <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>--}}
{{--                        <span class="text-nowrap">Since last month</span>--}}
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

    <!-- Account settings START -->
    <div class="card ">

        <!-- Title START -->
        <div class="card-header border-0 pb-0">
            <h1 class="h5 card-title">账号设置</h1>
        </div>
        <!-- Card header START -->
        <!-- Card body START -->
        <div class="card-body">
            <!-- Form settings START -->
            <form class="row g-3">
                <!-- First name -->
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">昵称</label>
                    <input type="text" class="form-control" placeholder="请输入你的昵称" value="{{$userDetail['nickname']}}">
                </div>
                <!-- Button  -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-sm btn-primary mb-0">保存</button>
                </div>
            </form>
            <!-- Settings END -->
        </div>
        <!-- Card body END -->
    </div>
    <!-- Account settings END -->


    <!-- Card END -->
</div>
<!-- Account setting tab END -->
