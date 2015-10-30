@extends('layouts.master')

@section('content')

    <div class="column">

        @if(!$project->stage->active)
            <div class="ui inverted red segment">
                @lang('project.project-failed')
            </div>
        @endif

        @if($project->stage->vote->active)
            <div class="ui inverted olive segment">
                <a class="ui header" href="{{ route('vote.show', $project->stage->vote->id) }}">
                    @lang('vote.is-open')
                </a>
            </div>
        @endif

        @if($project->stage instanceof \DreamsArk\Models\Project\Stages\Idea)
            @include('project.idea.show', $project)
        @endif

        @if($project->stage instanceof \DreamsArk\Models\Project\Stages\Synapse)
            @include('project.synapse.show', $project)
        @endif

        @if($project->stage instanceof \DreamsArk\Models\Project\Stages\Script)
            @include('project.script.show', $project)
        @endif

    </div>

@endsection