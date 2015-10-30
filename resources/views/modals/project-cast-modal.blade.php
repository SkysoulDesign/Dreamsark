<div id="project-cast-modal" class="ui form modal">
    <div class="header">
        @lang('project.add-cast')
    </div>
    <div class="content">
        <form id="project-cast-form" class="ui form" method="post"
              action="{{ route('committee.project.cast.store', $project->id) }}">

            {{ csrf_field() }}

            @include('partials.field', ['name' => 'name', 'label'=> trans('forms.name'), 'placeholder'=> trans('forms.optional'), 'type' => 'text'])
            @include('partials.field', ['name' => 'salary', 'label'=> trans('forms.salary'), 'placeholder'=> trans('forms.salary'), 'type' => 'text'])

            @include('partials.select',
            [
                'name' => 'position',
                'placeholder' => trans('forms.position'),
                'collection' => $positions->lists('name', 'id')

            ])

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