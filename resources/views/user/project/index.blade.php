@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segment">

            @foreach($projects as $project)
                <div class="ui segment">
                    <a href="{{ route('project.show', $project->id) }}" class="title">{{ $project->title }}</a>
                    <div class="content">{{ $project->description }}</div>
                </div>
            @endforeach

        </div>

    </div>

@endsection