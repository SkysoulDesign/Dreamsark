@extends('layouts.master')

@section('content')

    <div class="column">

        @foreach($ideas as $idea)

            <div class="ui fluid card">
                <div class="content">
                    <i class="right floated like icon"></i>
                    <i class="right floated star icon"></i>

                    <a class="header" href="{{ route('project.idea.show', $idea->id) }}">{{ $idea->project->name }}</a>

                    <div class="description">
                        <p>{{ $idea->content }}</p>
                    </div>
                </div>
            </div>

        @endforeach

    </div>


@endsection