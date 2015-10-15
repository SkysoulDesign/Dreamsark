@extends('layouts.master')

@section('content')

    <div class="column">

        @foreach($ideas as $idea)

            <div class="ui fluid card">
                <div class="content">
                    <i class="right floated like icon"></i>
                    <i class="right floated star icon"></i>

                    <a class="header" href="{{ route('idea.show', $idea->id) }}">{{ $idea->title }}</a>

                    <div class="description">
                        <p>{{ $idea->description }}</p>
                    </div>
                </div>
            </div>

        @endforeach

    </div>


@endsection