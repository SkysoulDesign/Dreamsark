@extends('layouts.basic')

@section('content')

    <div id="container"></div>

    <section class="enter-page">

        <ul id="scene" class="enter-page__background">

            <li class="layer enter-page__background__planet" data-depth="0.20">
                <img src="{{ asset('assets/planet-assets/bg.png') }}">
            </li>
            <li class="layer enter-page__background__stars" data-depth="0.60">
                <img src="{{ asset('assets/planet-assets/stars.png') }}">
            </li>
            <li class="layer enter-page__background__rock" data-depth="1">
                <img src="{{ asset('assets/planet-assets/rock.png') }}">
            </li>
            <li class="layer enter-page__background__flare" data-depth="1.5">
                <img src="{{ asset('assets/planet-assets/flare.png') }}">
            </li>

        </ul>

        <div id="logo" class="enter-page__logo">
            <img src="{{ asset('enter-page-assets/logo.png') }}" alt="Logo">
        </div>

        <ul class="enter-page__controllers">

            <li>
                <a id="start" href="#">
                    <img src="{{ asset('enter-page-assets/start.png') }}" alt="Start Journey">
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('enter-page-assets/skip.png') }}" alt="Skip">
                </a>
            </li>

        </ul>

    </section>

    <section class="start">

        <div id="show-entry" class="show-entry">

            <div class="row box">

                <img id="miniature" src="{{ asset('lib/point-1.png') }}" alt="">

                <div class="medium-6 column info">

                    <h1 id="title">Project Title</h1>

                    <div id="description" class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        A ab, accusantium consequuntur dicta dignissimos.
                    </div>

                    <div class="row controls">

                        <div class="medium-6 column">
                            <button id="view-project" class="outlined colors dark primary">view project</button>
                        </div>

                        <div class="medium-6 column">

                            <div class="statistics">
                                30.0000
                                <span>Budget</span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="medium-6 column">

                    <section class="video-player">
                        <img id="cover" src="{{ asset('lib/cover.jpg') }}" alt="">
                    </section>

                </div>

            </div>

        </div>

        <div class="body" style="display:none">
            <div class="logo">
                {{--<img src="{{ asset('img/start/logo.png')  }}" alt="">--}}
            </div>

            <form id='skipForm' action="{{ route('intro.skip') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="skip" value="true">
                <a id="trigger" href="#" class="button white round medium">Start Journey</a>
                <button type="submit" href="{{ route('home') }}" class="white round medium">Skip</button>
            </form>

        </div>

    </section>

@endsection

@section('scripts')

    {{--<script type="text/javascript" src="{{ asset('js/intro.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/three.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/TrackballControls.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/OBJLoader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tsc.js') }}"></script>

    {{--<script type="text/javascript" src="{{ asset('js/tsc.js') }}"></script>--}}

@endsection