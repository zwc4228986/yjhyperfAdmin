@extends('layouts.app')

{{--@section('title', 'Page Title')--}}

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh">
            <div class="text-center">
                <h1 class="mb-3">抖资源</h1>
                <a
                        class="btn btn-primary btn-lg"
                        href="https://mdbootstrap.com/docs/standard/getting-started/"
                        target="_blank"
                        role="button"
                >Start MDB tutorial</a
                >
            </div>
        </div>
    </div>
@endsection