@extends('layouts.master')

@section('content')

    <div class="column">

        @if(!$project->stage->active)
            <div class="ui inverted red segment">
                @lang('project.project-failed')
            </div>
        @endif

        @if($project->stage->audition->active)
            <div class="ui inverted olive segment">
                <a class="ui header" href="{{ route('audition.show', $project->stage->audition->id) }}">
                    @lang('audition.is-open')
                </a>
            </div>
        @endif

        @if($project->stage instanceof \DreamsArk\Models\Project\Idea\Idea)
            @include('project.idea.show', $project)
        @endif

        @if($project->stage instanceof \DreamsArk\Models\Project\Script\Script)
            @include('project.script.show', $project)
        @endif

        @if($project->stage instanceof \DreamsArk\Models\Project\Synapse\Synapse)
            @include('project.synapse.show', $project)
        @endif

    </div>

@endsection