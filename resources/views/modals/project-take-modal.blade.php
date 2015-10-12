<div id="project-take-modal" class="ui modal">
    <div class="header">
        @lang('project.add-take')
    </div>
    <div class="content">
        <form id="project-take-form" class="ui error form" method="post"
              action="{{ route('project.take.store', $project->script->id) }}">

            {{ csrf_field() }}

            @include('partials.field', ['name' => 'title', 'label'=> trans('forms.title'), 'placeholder'=> trans('forms.title')])
            @include('partials.field', ['name' => 'length', 'label'=> trans('forms.length'), 'placeholder'=> trans('forms.length')])
            @include('partials.field', ['name' => 'location', 'label'=> trans('forms.location'), 'placeholder'=> trans('forms.location')])
            @include('partials.field', ['name' => 'shot', 'label'=> trans('forms.shot'), 'placeholder'=> trans('forms.shot')])

            @include('partials.textarea', ['name' => 'description', 'label' => trans('forms.description')])

        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button">
            @lang('forms.cancel')
        </div>
        <div class="ui positive right labeled icon button">
            @lang('forms.create')
            <i class="checkmark icon ok"></i>
        </div>
    </div>
</div>