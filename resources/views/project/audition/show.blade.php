@extends('layouts.master')

@section('content')

    <div class="column">
        <div class="ui segment">

            <div class="ui header">{{ $audition->project->name }}</div>

            <div class="ui segment">
                {{ $audition->project->idea->content }}
            </div>

            <div class="ui  segment">
                Reward: {{ $audition->project->idea->reward }}
            </div>

            <div class="ui segment">
                Audition Ends at: {{ $audition->close_date }}
            </div>

            <table class="ui celled table">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Content</th>
                    <th class="collapsing">Votes</th>
                    <th class="collapsing">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($audition->project->submissions as $submission)
                    <tr>
                        <td class="collapsing">
                            <h4 class="ui image header">
                                <img src="{{ $submission->user->present()->avatar }}"
                                     class="ui mini rounded image">

                                <div class="content">
                                    {{ $submission->user->present()->name }}
                                </div>
                            </h4>
                        </td>
                        <td>
                            {{ $submission->content }}
                        </td>
                        <td>
                            {{ $submission->votes->count() }}
                        </td>
                        <td class="collapsing">
                            <form method="post"
                                  action="{{ route('project.idea.submission.vote.store', $submission->id) }}">
                                {{ csrf_field() }}
                                <button class="olive circular ui icon button">
                                    <i class="icon thumbs up"></i>
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