@extends('layouts.basic')

@section('content')

    <div id="container"></div>

    <section class="start">

        <div class="body">
            <div class="logo">
                <img src="{{ asset('img/start/logo.png')  }}" alt="">
            </div>

            <form action="{{ route('intro.skip') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="skip" value="true">
                <a id="trigger" href="#" class="button white round medium">Start Journey</a>
                <button type="submit" href="{{ route('home') }}" class="white round medium">Skip</button>
            </form>

        </div>

    </section>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/intro.js') }}"></script>
@endsection