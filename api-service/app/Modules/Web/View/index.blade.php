@extends('layouts.app')

{{--@section('title', 'Page Title')--}}

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="album">
        <div class="container">
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
            <div class="row pt-5 ">
                <x-page :page="$product"/>
            </div>
        </div>
    </div>
@endsection