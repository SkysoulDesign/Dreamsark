@extends('layouts.master')

@section('content')

    <div class="column">


        @foreach($projects as $project)

            {{--<div class="ui fluid card">--}}
                {{--<div class="content">--}}
                    {{--<i class="right floated like icon"></i>--}}
                    {{--<i class="right floated star icon"></i>--}}

                    {{--<div class="header">Cute Dog</div>--}}
                    {{--<div class="description">--}}
                        {{--<p></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="extra content">--}}
                    {{--<span class="left floated like"><i class="like icon"></i>Like</span>--}}
                    {{--<span class="right floated star"><i class="star icon"></i>Favorite</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="ui segment">
            <a href="{{ route('project.show', $project->id) }}" class="title">{{ $project->title }}</a>

            <div class="ui right floated">
            <div class="ui heart rating" data-rating="1" data-max-rating="3"></div>
            </div>
            <div class="content">{{ $project->description }}</div>
            </div>
        @endforeach

    </div>


@endsection