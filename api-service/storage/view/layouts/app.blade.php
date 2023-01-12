<html>
<head>
    <title>@yield('title','抖资源')</title>
</head>
<body>
<x-header/>
@section('sidebar')
@show
<div class="container">
    @yield('content')
</div>
<x-footer/>
</body>
</html>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    body{
        color: #333;
    }
    a{
        color: #333;
        cursor: pointer;
        text-decoration:none;
    }
</style>