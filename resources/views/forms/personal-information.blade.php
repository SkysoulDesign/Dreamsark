<form class="ui form error" action="{{ route('register.update') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field-multiple', array(
    'label' => trans('forms.full-name'),
    'fields' => [
            ['name' => 'first_name'],
            ['name' => 'last_name']
        ],
    'class' => 'two'
    ))

    @include('partials.field', ['name' => 'birthday', 'type' => 'date'])

    @include('partials.select', ['name' => 'gender', 'collection' => ['male' => 'male', 'female' => 'female']])

    <button class="ui button" type="submit">@lang('forms.save')</button>

</form>