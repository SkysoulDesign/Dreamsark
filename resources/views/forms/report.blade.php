<div class="ui modal">
    <div class="header">
        Client Feedback Form
    </div>
    <div class="content">
        <form id="reportForm" class="ui form" method="post" action="{{ route('report.store') }}">

            <h4 class="ui dividing header">Give us your feedback</h4>

            {{ csrf_field() }}

            @include('partials.field', ['name' => 'url', 'label' => 'Page address:', 'id' => 'urlAddress'])

            <div class="field">
                <label>Feedback</label>
                <textarea name="feedback"></textarea>
            </div>

            @include('partials.select-with-icon',
            [
                'name' => 'type',
                'placeholder' => 'Report Feedback',
                'collection' => [
                    'bug' => ['Report Bug', 'bug icon'],
                    'suggestion' => ['Suggestion', 'ticket icon']
                ]
            ])

        </form>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button ok">OK</div>
    </div>
</div>