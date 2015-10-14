@extends('layouts.master')

@section('content')

    <div class="column">

        @if($auditions->isEmpty())
            <div class="ui error message">
                <div class="header">@lang('project.no-audition')</div>
            </div>
        @else
            <div class="ui segments">
                @foreach($auditions as $audition)
                    <div class="ui segment">
                        <a href="{{ route('audition.show', $audition->id) }}">
                            {{ $audition->project->title }} - {{ $audition->project->budget }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection