@extends('layouts.master')

@section('content')

    <div class="column">

        @foreach($projects as $project)
            <div class="ui fluid card">
                <div class="content">
                    <i class="right floated edit icon"></i>

                    <a class="header" href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a>

                    <div class="description">
                        <p>{{ $project->description }}</p>
                    </div>
                </div>
                <div class="extra content">
                    <div class="ui indicating progress" data-percent="{{ $project->present()->progress }}">
                        <div class="bar"
                             style="transition-duration: 300ms; width: {{ $project->present()->progress }}%;">
                            <div class="progress">{{ $project->present()->progress }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection