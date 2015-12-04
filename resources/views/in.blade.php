@extends('layouts.basic')

@section('content')

    <section class="start">

        <div class="body">
            <div class="logo">
                <img src="{{ asset('img/start/logo.png')  }}" alt="">
            </div>

            <form action="{{ route('intro.skip') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="skip" value="true">
                <a href="#" class="button white round medium trigger">Start Journey</a>
                <button type="submit" href="{{ route('home') }}" class="white round medium">Skip</button>
            </form>

        </div>

    </section>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/start.js') }}"></script>
@endsection