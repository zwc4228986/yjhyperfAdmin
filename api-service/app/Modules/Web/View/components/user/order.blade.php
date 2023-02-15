<!-- Privacy and safety tab START -->
<div class="tab-pane active show" id="nav-setting-tab-3">
    <!-- Privacy and safety START -->
    <div class="card">
        <!-- Card header START -->
        <div class="card-header border-0 pb-0">
            <h4 class="card-title">我的下载</h4>
        </div>
        <!-- Card header START -->
        <!-- Card body START -->
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">产品信息</th>
                    <th scope="col">下载次数</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order as $item)
                    <tr>
                        <th scope="row">
                            <a href="#">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{$item->OrderProduct->Product?->Image?->path_format}}"
                                                 class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$item->OrderProduct?->Product?->name}}</h5>
                                                <p class="card-text"><small
                                                            class="text-muted">ID: {{$item->OrderProduct?->Product?->id}}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </th>
                        <td style="width: 100px;">
                            {{$item->OrderProduct?->download}}
                        </td>
                        <td style="width: 100px;"><a href="{{url('/download/'.$item->OrderProduct?->id)}}"
                                                     class="btn bg-purple-400 hover:bg-purple-500  text-white  border-purple-400"
                                                     tabindex="-1" role="button">下载</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Card body END -->
        <!-- Button save -->
        <div class="card-footer pt-0 text-end border-0">
            <button type="submit" class="btn btn-sm btn-primary mb-0">Save changes</button>
        </div>
    </div>
    <!-- Privacy and safety END -->
</div>
<!-- Privacy and safety tab END -->
