@extends('layouts.master', ['topBar' => false])

@section('header')

    <div class="container-fluid small-header">

    </div>

    <div class="row">

        <section class="medium-8 column">
            <div class="segment">

            </div>
        </section>

        <section class="medium-4 column">

            <div class="segment">

                <div class="push-up">
                    <img src="{{ asset('dreamsark-assets/register-avatar.png') }}" alt="">
                </div>

                <div class="title modern center">
                    Member Register
                </div>

                <form action="{{ route('register.store') }}" method="post">

                    {{ csrf_field() }}

                    <div class="form-item">
                        <input name="username" type="text" placeholder="username">
                    </div>

                    <div class="form-item">
                        <input name="email" type="email" placeholder="e-mail">
                    </div>

                    <div class="form-item">
                        <input name="password" type="password" placeholder="password">
                    </div>

                    @include('partials.form-errors')

                    <div class="form-item">

                        <button type="submit" class="primary rippable">
                            Register

                            <svg>
                                <use width="4" height="4" xlink:href="#dreamsark-polygon" class="js-ripple"></use>
                            </svg>

                            @include('partials.button-ripple')

                        </button>

                    </div>

                </form>

                <div class="title simple center">
                    or register with
                </div>

                <div class="social center">
                    <ul>
                        <li><img src="{{ asset('dreamsark-assets/wechat.png') }}" alt=""></li>
                        <li><img src="{{ asset('dreamsark-assets/qq.png') }}" alt=""></li>
                        <li><img src="{{ asset('dreamsark-assets/weibo.png') }}" alt=""></li>
                        <li><img src="{{ asset('dreamsark-assets/facebook.png') }}" alt=""></li>
                    </ul>
                </div>

            </div>

        </section>

    </div>

@endsection

@section('contenta')

    <div class="nine wide column">

        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="user">@lang('layout.user')</a>
            <a class="item" data-tab="investor">@lang('layout.investor')</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="user">

            @include('forms.user-registration')

        </div>
        <div class="ui bottom attached tab segment" data-tab="investor">
            Investor Register Form
        </div>

    </div>

    <div class="seven wide column" style="margin-top: 41px">

        <div class="ui segment">
            <h3 class="ui header">@lang('layout.login-with-social-medias')</h3>
        </div>

    </div>

@endsection