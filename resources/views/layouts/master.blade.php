<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DreamsArk</title>

    <link rel="stylesheet" media="all" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" media="all" href="{{ asset('css/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" media="all" href="{{ asset('css/flipclock.css') }}">

</head>
<body>

<div class="ui container" style="margin-top: 20px">

    @include('modals.report-modal')

    <div class="ui grid">

        <div class="row">
            <div class="sixteen wide column">
                @include('partials.navbar')
            </div>
        </div>

        @if($errors->any())
            <div class="ui row error">
                <div class="sixteen wide column">
                    @include('partials.errors')
                </div>
            </div>
        @endif

        <div class="row">
            @yield('content')
        </div>

    </div>

</div>

<script src="{{ asset('js/dev.js') }}"></script>
<script src="{{ asset('js/semantic.min.js') }}"></script>
<script src="{{ asset('js/flipclock.min.js') }}"></script>

</body>
</html>