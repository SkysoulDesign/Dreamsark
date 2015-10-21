<div class="column">

    <div class="ui top attached tabular menu">
        <a class="item active" data-tab="request">@lang('idea.request')</a>
        <a class="item" data-tab="submissions">@lang('idea.submissions')</a>
    </div>

    <div class="ui bottom attached tab segment active" data-tab="request">
        <div class="ui segments">

            <div class="ui segment">
                {{ $project->name }}
            </div>

            <div class="ui secondary segment">
                {{ $project->stage->content }}
            </div>

            <div class="ui secondary segment">
                <h3>@lang('idea.reward') ${{ $project->stage->reward }}</h3>
            </div>

            <div class="ui segment">
                @lang('idea.number-of-ideas') {{ $project->submissions->count() }}
            </div>

        </div>

        @if($project->stage->active)
            <div class="ui segment">
                <a id="idea-submit-open" href="#" class="ui primary button">
                    @lang('idea.submit-your-idea')
                </a>
            </div>
        @endif

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

                @foreach($submissions as $submission)
                   
                    <tr>
                        <td class="collapsing">
                            <h4 class="ui image header">
                                <img src="" class="ui mini rounded image">

                                <div class="content">

                                </div>
                            </h4>
                        </td>
                        <td>
                            {{ $submission->content }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
