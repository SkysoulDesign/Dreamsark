@extends('layouts.master')

@section('content')

    <div class="column">

        @if($projects->isEmpty())
            <div class="ui error message">
                <div class="header">@lang('project.no-project')</div>
            </div>
        @else

            @foreach($projects as $project)

                @if($project->stage() instanceof \DreamsArk\Models\Project\Idea\Idea)
                    @include('partials.card-idea')
                @endif

                @if($project->type == 'synapse')
                    @include('partials.card-idea')
                @endif

                @if($project->type == 'script')
                    @include('partials.card-idea')
                @endif

            @endforeach

        @endif
    </div>


@endsection