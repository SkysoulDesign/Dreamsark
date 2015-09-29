@extends('layouts.master')

@section('content')

    <div class="sixteen wide column" style="margin-bottom: 20px">

        <div class="ui tall stacked segment">
            <img class="ui small circular image" src="{{ auth()->user()->present()->avatar }}">
        </div>

    </div>

    <div class="three wide column">

        <div class="ui vertical menu">
            <div class="item">
                <div class="header">Profile</div>
                <div class="menu">
                    <a class="item">Personal Information</a>
                </div>
            </div>
            <div class="item">
                <div class="header">Account</div>
                <div class="menu">
                    <a class="item">Change Password</a>
                    <a class="item">Bind Social Media</a>
                </div>
            </div>
            <div class="item">
                <div class="header">Settings</div>
                <div class="menu">
                    <a class="item">Language</a>
                </div>
            </div>
        </div>

    </div>

    <div class="thirteen wide column">

        <div class="ui segment">
            <div class="ui small header">Personal Information</div>
            @include('forms.personal-information')
        </div>

    </div>

@endsection