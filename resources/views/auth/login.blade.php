@extends('layouts.master')

@section('content')

    <div class="nine wide column">
        <div class="ui segment">
            @include('forms.login')
        </div>
    </div>

    <div class="seven wide column" >
        <div class="ui segment">
            <h3 class="ui header">login With Social Medias</h3>
        </div>

    </div>

@endsection