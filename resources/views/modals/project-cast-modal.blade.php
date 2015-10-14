<div id="project-cast-modal" class="ui modal">
    <div class="header">
        @lang('project.add-cast')
    </div>
    <div class="content">
        <form id="project-cast-form" class="ui error form" method="post"
              action="{{ route('project.cast.store', $project->id) }}">

            {{ csrf_field() }}

            @include('partials.field', ['name' => 'role', 'label'=> trans('forms.role'), 'placeholder'=> trans('forms.role')])
            @include('partials.field', ['name' => 'name', 'label'=> trans('forms.name'), 'placeholder'=> trans('forms.name')])

            @include('partials.textarea', ['name' => 'description', 'label' => trans('cast.description')])

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