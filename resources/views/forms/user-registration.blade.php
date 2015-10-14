<form class="ui form error" action="{{ route('register.store') }}" method="post">

    {!! csrf_field() !!}


    @include('partials.field-multiple', array(
    'label' => trans('forms.full-name'),
    'fields' => [
            ['name' => 'first_name', 'placeholder'=> trans('forms.first-name')],
            ['name' => 'last_name', 'placeholder'=> trans('forms.last-name')]
        ],
    'class' => 'two'
    ))

    @include('partials.select', ['name' => 'gender', 'label' => trans('forms.gender'), 'placeholder'=> trans('forms.gender'), 'collection' => ['male' => trans('forms.male'), 'female' => trans('forms.female')]])

    @include('partials.field', ['name' => 'birthday', 'label' => trans('forms.birthday'), 'placeholder'=> trans('forms.birthday'), 'type' => 'date'])

    @include('partials.field', ['name' => 'email', 'label' => trans('forms.email'), 'placeholder'=> trans('forms.email'), 'type' => 'email'])

    @include('partials.field', ['name' => 'password', 'label' => trans('forms.password'), 'placeholder'=> trans('forms.password'), 'type' => 'password'])

    @include('partials.field', ['name' => 'password_confirmation', 'label' => trans('forms.password-confirmation'), 'placeholder'=> trans('forms.password-confirmation'), 'type' => 'password'])

    <button class="ui button" type="submit">@lang('forms.submit')</button>

</form>