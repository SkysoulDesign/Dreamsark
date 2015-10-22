@extends('layouts.master')

@section('content')

    @if($project->stage instanceof \DreamsArk\Models\Project\Idea\Idea)
        @include('project.idea.show', $project)
    @endif

    @if($project->stage instanceof \DreamsArk\Models\Project\Script\Script)
        @include('project.script.show', $project)
    @endif

    @if($project->stage instanceof \DreamsArk\Models\Project\Synapse\Synapse)
        @include('project.synapse.show', $project)
    @endif

@endsection