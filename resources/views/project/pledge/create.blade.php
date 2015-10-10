@extends('layouts.master')

@section('content')


    <div class="column">

        @if($user->coins <= 0)
            <div class="ui warning message">
                <i class="close icon"></i>
                <div class="header">
                    You don't have enough coins to proceed, please purchase some clicking here:
                    <a href="{{ route('coin.create') }}">Purchase Coins</a>
                </div>
            </div>
        @endif

        <div class="ui segments">
            <div class="ui segment">
                Your Current Amount of Coins: {{ $user->coins }}
            </div>
            <div class="ui segment">
                @include('forms.pledge-project', $project)
            </div>
        </div>

    </div>

@endsection