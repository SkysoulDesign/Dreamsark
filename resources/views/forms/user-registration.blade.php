<form class="ui form error" action="{{ route('register.store') }}" method="post">

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

    @include('partials.field', ['name' => 'email', 'type' => 'email'])

    @include('partials.field', ['name' => 'password', 'type' => 'password'])

    @include('partials.field', ['name' => 'password_confirmation', 'type' => 'password'])

    @include('partials.errors')

    <button class="ui button" type="submit">Submit</button>

</form>