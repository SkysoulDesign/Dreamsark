@extends('layouts.master')

@section('content')

    @if($project->stage instanceof \DreamsArk\Models\Project\Idea\Idea)
        @include('project.idea.show', $project)
    @endif

@endsection