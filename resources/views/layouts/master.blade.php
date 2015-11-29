<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DreamsArk</title>

    <link rel="stylesheet" media="all" href="{{ asset('css/app.css') }}">

</head>
<body>

@if(isset($topBar) ? $topBar : true)
    @include('layouts.top-bar')
@endif

@yield('header')

<div class="container-fluid">
    @yield('content')
    @yield('footer')
</div>

@yield('scripts')

<script src="{{ asset('js/app.js') }}"></script>

@yield('pos-scripts')

</body>
</html>