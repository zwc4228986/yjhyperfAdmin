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
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">抖币</h5>
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
                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">推广用户</h5>
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
            <h1 class="h5 card-title">Account Settings</h1>
            <p class="mb-0">He moonlights difficult engrossed it, sportsmen. Interested has all
                Devonshire difficulty gay assistance joy. Unaffected at ye of compliment alteration
                to.</p>
        </div>
        <!-- Card header START -->
        <!-- Card body START -->
        <div class="card-body">
            <!-- Form settings START -->
            <form class="row g-3">
                <!-- First name -->
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" placeholder="" value="Sam">
                </div>
                <!-- Last name -->
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" placeholder="" value="Lanson">
                </div>
                <!-- Additional name -->
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">Additional name</label>
                    <input type="text" class="form-control" placeholder="">
                </div>
                <!-- User name -->
                <div class="col-sm-6">
                    <label class="form-label">User name</label>
                    <input type="text" class="form-control" placeholder="" value="@samlanson">
                </div>
                <!-- Birthday -->
                <div class="col-lg-6">
                    <label class="form-label">Birthday </label>
                    <input type="text" class="form-control flatpickr flatpickr-input" value="12/12/1990"
                           readonly="readonly">
                </div>
                <!-- Allow checkbox -->
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="allowChecked"
                               checked="">
                        <label class="form-check-label" for="allowChecked">
                            Allow anyone to add you to their team
                        </label>
                    </div>
                </div>
                <!-- Phone number -->
                <div class="col-sm-6">
                    <label class="form-label">Phone number</label>
                    <input type="text" class="form-control" placeholder="" value="(678) 324-1251">
                    <!-- Add new number -->
                    <a class="btn btn-sm btn-dashed rounded mt-2" href="#!"> <i
                                class="bi bi-plus-circle-dotted me-1"></i>Add new phone number</a>
                </div>
                <!-- Phone number -->
                <div class="col-sm-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" placeholder="" value="sam@webestica.com">
                    <!-- Add new email -->
                    <a class="btn btn-sm btn-dashed rounded mt-2" href="#!"> <i
                                class="bi bi-plus-circle-dotted me-1"></i>Add new email address</a>
                </div>
                <!-- Page information -->
                <div class="col-12">
                    <label class="form-label">Overview</label>
                    <textarea class="form-control" rows="4" placeholder="Description (Required)">Interested has all Devonshire difficulty gay assistance joy. Handsome met debating sir dwelling age material. As style lived he worse dried. Offered related so visitors we private removed. Moderate do subjects to distance.</textarea>
                    <small>Character limit: 300</small>
                </div>
                <!-- Button  -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-sm btn-primary mb-0">Save changes</button>
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
