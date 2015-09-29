@extends('layouts.master')

@section('content')

    <div class="nine wide column">

        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="user">User</a>
            <a class="item" data-tab="investor">Investor</a>
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
            <h3 class="ui header">login With Social Medias</h3>
        </div>

    </div>

@endsection