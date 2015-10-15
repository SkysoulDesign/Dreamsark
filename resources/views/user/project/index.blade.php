@extends('layouts.master')

@section('content')

    <div class="column">


        <div class="ui pointing secondary menu">
            <a class="item active" data-tab="active-bids">Active Bids</a>
            <a class="item" data-tab="second">Current Working</a>
            <a class="item" data-tab="third">Past Work</a>
            <a class="item" data-tab="third">Past Work</a>
        </div>


        <div class="ui tab  active" data-tab="active-bids">
            <table class="ui unstackable table">
                <thead>
                <tr>
                    <th>Idea</th>
                    <th>Idea Description</th>
                    <th>Idea Reward</th>
                    <th class="right aligned">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bids as $idea)
                    <tr>
                        <td class="collapsing">{{ $idea->title }}</td>
                        <td>{{ $idea->description }}</td>
                        <td>${{ $idea->reward }}</td>

                        <td class="right aligned">
                            <form action="">
                                <button class="ui primary button">
                                    Elaborate
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @foreach($projects as $project)
            <div class="ui fluid card">
                <div class="content">
                    <i class="right floated edit icon"></i>

                    <a class="header" href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a>

                    <div class="description">
                        <p>{{ $project->description }}</p>
                    </div>
                </div>
                <div class="extra content">
                    <div class="ui indicating progress" data-percent="{{ $project->present()->progress }}">
                        <div class="bar"
                             style="transition-duration: 300ms; width: {{ $project->present()->progress }}%;">
                            <div class="progress">{{ $project->present()->progress }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection