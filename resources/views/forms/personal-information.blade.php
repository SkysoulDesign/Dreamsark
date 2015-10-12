<form class="ui form error" action="{{ route('register.update') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field-multiple', array(
    'label' => trans('forms.full-name'),
    'fields' => [
            ['name' => 'first_name', 'placeholder' => trans('forms.first-name')],
            ['name' => 'last_name', 'placeholder' => trans('forms.last-name')]
        ],
    'class' => 'two'
    ))

    @include('partials.select', ['name' => 'gender', 'collection' => ['male' => trans('forms.male'), 'female' => trans('forms.female')]])

    <button class="ui button" type="submit">@lang('forms.save')</button>

</form>