@extends('layouts.app')

{{--@section('title', 'Page Title')--}}

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="album py-5 ">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($product as $item)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="{{$item->Image->path_format}}">
                                <div class="card-body">
                                    <p class="card-text">{{$item->name}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="row pt-5 ">
                <x-page :page="$product"/>
            </div>
        </div>
    </div>
@endsection