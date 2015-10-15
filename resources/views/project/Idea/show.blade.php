@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="request">@lang('idea.request')</a>
            <a class="item" data-tab="submissions">@lang('idea.submissions')</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="request">
            <div class="ui segments">

                <div class="ui segment">
                    {{ $idea->title }}
                </div>

                <div class="ui secondary segment">
                    {{ $idea->description }}
                </div>

                <div class="ui secondary segment">
                    <h3>@lang('idea.reward') ${{ $idea->reward }}</h3>
                </div>

                <div class="ui segment">
                    @lang('idea.number-of-ideas') {{ $idea->submissions->count() }}
                </div>

                <div class="ui segment">
                    @lang('idea.number-of-bid') {{ $idea->bidders->count() }}
                </div>

                <div class="ui segment">
                    <div class="ui indicating progress active" data-percent="0">
                        <div class="bar" style="transition-duration: 300ms; width: 0%;">
                            <div class="progress">0%</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="ui segment">
                <form method="post" action="{{ route('project.idea.bid.store', $idea->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="ui olive button">
                        @lang('idea.bid-now')
                    </button>
                    <a id="idea-submit-open" href="#" class="ui primary button">
                        @lang('idea.submit-your-idea')
                    </a>
                </form>
            </div>

            @include('modals.idea-submit-modal')

        </div>

        <div class="ui bottom attached tab segment" data-tab="submissions">
            <div class="ui segment">

                <table class="ui celled table">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($idea->submissions as $submission)
                        <tr>
                            <td class="collapsing">
                                <h4 class="ui image header">
                                    <img src="{{ $submission->user->present()->avatar }}" class="ui mini rounded image">

                                    <div class="content">
                                        {{ $submission->user->present()->name }}
                                    </div>
                                </h4>
                            </td>
                            <td>
                                {{ $submission->description }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection