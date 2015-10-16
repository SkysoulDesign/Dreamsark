@extends('layouts.master')

@section('content')

    <div class="column">

        @if($auditions->isEmpty())
            <div class="ui error message">
                <div class="header">@lang('project.no-audition')</div>
            </div>
        @else
            @foreach($auditions->groupBy('project.stage') as $stage=>$auditions)
                <div class="ui segments">
                    <div class="ui segment">
                        <p>{{ $stage }} stage </p>
                    </div>
                    @foreach($auditions as $audition)
                        <div class="ui secondary segment">
                            <a href="{{ route('audition.show', $audition->id) }}">
                                {{ $audition->project->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

@endsection