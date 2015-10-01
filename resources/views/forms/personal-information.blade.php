<form class="ui form error" action="{{ route('register.update') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field-multiple', array(
    'label' => 'Full Name',
    'fields' => [
            ['name' => 'first_name'],
            ['name' => 'last_name']
        ],
    'class' => 'two'
    ))

    @include('partials.select', ['name' => 'gender', 'collection' => ['male' => 'Male', 'female' => 'Female']])

    @include('partials.errors')

    <button class="ui button" type="submit">Save</button>

</form>