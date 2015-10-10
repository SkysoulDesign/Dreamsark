@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segment">
            @include('forms.project-creation', $user)
        </div>

    </div>

@endsection