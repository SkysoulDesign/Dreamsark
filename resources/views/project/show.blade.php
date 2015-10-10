@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segments">

            <div class="ui segment">
                {{ $project->title }}
            </div>

            <div class="ui segment">
                {{ $project->description }}
            </div>

            <div class="ui segment">
                {{ $project->budget }}
            </div>

            <div class="ui segment">
                <a class="ui button" href="{{ route('project.pledge.create', $project->id) }}">back this idea</a>
            </div>

        </div>

    </div>

@endsection