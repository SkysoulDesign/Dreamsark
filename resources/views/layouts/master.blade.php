<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DreamsArk</title>

    <link rel="stylesheet" media="all" href="{{ asset('css/app.css') }}">

</head>
<body>

@include('layouts.top-bar')

@yield('header')

<div class="container-fluid">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>