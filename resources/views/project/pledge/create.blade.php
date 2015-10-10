@extends('layouts.master')

@section('content')


    <div class="column">

        <div class="ui segments">

            <div class="ui segment">
                @if($user->bag->coins > 0)
                    <div class="ui olive message">You currently have: {{ $user->bag->coins }} coins</div>
                @else
                    @include('partials.purchase-coins-alert')
                @endif
            </div>

            @if($user->bag->coins > 0)
                <div class="ui segment">

                    @include('forms.pledge-project', $project)
                </div>
            @endif

        </div>

    </div>

@endsection