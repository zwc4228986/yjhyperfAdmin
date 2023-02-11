<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title','抖资源')</title>
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/app.css"/>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="bg-light">
<x-header :productCategoryPid="$product_category_pid"/>
@section('sidebar')
@show
<div class="container py-lg-4 py-sm-4">
    @yield('content')
</div>
<x-footer/>
</body>
</html>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        color: #333;
    }

    a {
        color: #333;
        cursor: pointer;
        text-decoration: none;
    }
</style>