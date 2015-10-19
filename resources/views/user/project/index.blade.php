@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui pointing secondary tabular menu">
            <a class="item active" data-tab="unpublished">Unpublished Projects</a>
            <a class="item" data-tab="published">Published Projects</a>
        </div>

        <div class="ui tab active" data-tab="unpublished">
            <table class="ui unstackable table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Reward</th>
                    <th>Audition Date</th>
                    <th class="right aligned">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td class="collapsing">{{ $project->name }}</td>
                        <td>{{ $project->content }}</td>
                        <td>${{ $project->reward }}</td>
                        <td>{{ $project->audition_date }}</td>

                        <td class="right aligned">
                            <form action="{{ route('user.project.publish', $project->id) }}">
                                <a href="{{ route('user.project.edit', $project->id) }}" class="ui primary button">
                                    Edit
                                </a>
                                <button class="ui olive button">
                                    Publish
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="ui tab" data-tab="published">
            <table class="ui unstackable table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Reward</th>
                    <th>Audition Date</th>
                    <th class="right aligned">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($publishedProjects as $project)
                    <tr>
                        <td class="collapsing">{{ $project->name }}</td>
                        <td>{{ $project->content }}</td>
                        <td>${{ $project->reward }}</td>
                        <td>{{ $project->audition_date }}</td>

                        <td class="right aligned">
                            <form action="">
                                <button class="ui primary button">
                                    Publish
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection