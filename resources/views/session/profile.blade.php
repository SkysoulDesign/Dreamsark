@extends('layouts.master')

@section('header')
    @include('layouts.mini-header')
@endsection

@section('content')

    <div class="row">
        <section class="medium-6 segment">

            <div class="title">
                General Information
            </div>

            <div class="content">
                <div class="head">
                   <h1>{{ auth()->user()->username }}</h1>
                </div>
                <div class="description">
                    <i class="fa fa-map-marker"></i> Sao Paulo, Brasil
                </div>
            </div>

            <hr>

            <div class="title">
                Backed projects
            </div>

            <div class="content">

                <div class="description">
                    There is nothing here at the moment
                </div>
            </div>

        </section>
    </div>

@endsection

@section('contenta')

    <div class="sixteen wide column" style="margin-bottom: 20px">

        <div class="ui tall stacked segment">
            <img class="ui small circular image" src="{{ auth()->user()->present()->avatar }}">
        </div>

    </div>

    <div class="three wide column">

        <div id="menu" class="ui vertical menu">
            <div class="item">
                <div class="header">@lang('profile.profile')</div>
                <div class="menu">
                    <a class="item" data-tab="home">@lang('profile.personal-information')</a>
                </div>
            </div>
            <div class="item">
                <div class="header">@lang('profile.account')</div>
                <div class="menu">
                    <a class="item">@lang('profile.change-password')</a>
                    <a class="item">@lang('profile.bind-social-media')</a>
                </div>
            </div>
            <div class="item">
                <div class="header">Position</div>
                <div class="menu">
                    <a class="item" data-tab="position">Positions</a>
                </div>
            </div>
            <div class="item">
                <div class="header">@lang('profile.settings')</div>
                <div class="menu">
                    <a class="item" data-tab="language">@lang('profile.language')</a>
                </div>
            </div>
        </div>

    </div>

    <div class="thirteen wide column">

        <div class="ui tab active" data-tab="home">
            <div class="ui segment">
                <div class="ui small header">@lang('profile.personal-information')</div>
                @include('forms.personal-information')
            </div>
        </div>

        <div class="ui tab" data-tab="position">
            <div class="ui segment">
                <div class="ui small header">@lang('profile.positions')</div>
                @include('forms.human-positions')
            </div>
        </div>

        <div class="ui tab" data-tab="language">
            <div class="ui segment">
                <div class="ui small header">@lang('profile.language')</div>
                @include('forms.settings-language')
            </div>
        </div>

    </div>

@endsection