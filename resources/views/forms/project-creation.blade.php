<form class="ui form warning error" action="{{ route('user.project.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'name', 'label' => trans('forms.project-name')])

    @include('partials.select', ['name' => 'type', 'collection' => ['idea' => trans('forms.seeking-idea')]])

    @include('partials.textarea', ['name' => 'content', 'label' => trans('forms.description')])

    <div class="ui segments">

        <div class="ui segment">
            @include('partials.field', ['name' => 'reward', 'label' => trans('forms.reward')])
        </div>

    </div>

    <div class="ui segment">
        @include('partials.field-multiple', array(
        'label' => trans('forms.due-date'),
        'fields' => [
                ['name' => 'audition_date', 'placeholder' => trans('forms.first-name'), 'type' => 'date'],
                ['name' => 'audition_time', 'placeholder' => trans('forms.last-name'), 'type' => 'time']
            ],
        'class' => 'two'
        ))
    </div>

    <button class="ui primary button" type="submit">@lang('forms.save-draft')</button>

    <a id="publish" href="#" class="ui olive button">@lang('forms.publish')</a>

    <script>
        document.getElementById('publish').addEventListener('click', function () {
            $form = this.parentElement;
            $form.action = '{{ route('project.store')  }}';
            $form.submit();
        })
    </script>

</form>