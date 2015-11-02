<div id="project-crew-modal" class="ui modal">
    <div class="header">
        @lang('project.add-crew')
    </div>
    <div class="content">
        <form id="project-crew-form" class="ui form" method="post"
              action="{{ route('committee.project.crew.store', $review->project->id) }}">

            {{ csrf_field() }}

            @include('partials.select',
            [
                'name' => 'position',
                'placeholder' => trans('forms.position'),
                'collection' => $positions->where('type.name', 'crew')->lists('name', 'id')

            ])

            @include('partials.field', ['name' => 'cost', 'label'=> trans('forms.amount'), 'placeholder'=> trans('forms.amount'), 'type' => 'text'])

            @include('partials.textarea', ['name' => 'description', 'label' => trans('project.description')])

        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button">
            @lang('forms.cancel')
        </div>
        <div class="ui positive right labeled icon button">
            @lang('forms.add')
            <i class="checkmark icon ok"></i>
        </div>
    </div>
</div>