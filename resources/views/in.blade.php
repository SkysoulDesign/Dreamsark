@extends('layouts.basic')

@section('content')

    <section class="start">

        <div class="body">
            <div class="logo">
                <img src="{{ asset('img/start/logo.png')  }}" alt="">
            </div>

            <svg class="svg-dreamsark" width="150" height="150">

                <path d="M113.9,20.4h-1.5H62.1H31.9H11.3h-1.1c-4.7,0-8.8-3.3-9.9-7.7C0.1,11.9,0,11.1,0,10.2v0
            c0-0.7,0.1-1.3,0.2-1.9C1.1,3.6,5.3,0,10.2,0l1.2,0l50.7,0l27.1,0l23.1,0l1.7,0c5,0,9.2,3.7,10.1,8.5c0.1,0.6,0.1,1.1,0.1,1.7v0
            c0,0.5,0,1-0.1,1.5C123.3,16.6,119.1,20.4,113.9,20.4z"/>

            </svg>

            <button class="white round medium trigger">Start Journey</button>
            <a href="{{ route('home') }}" class="button white round medium">Skip</a>
        </div>

    </section>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/start.js') }}"></script>
@endsection