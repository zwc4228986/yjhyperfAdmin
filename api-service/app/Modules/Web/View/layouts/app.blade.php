<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title','抖资源')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/navbar-top-fixed.css"/>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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