<form class="ui form error" action="{{ route('register.store') }}" method="post">

    {!! csrf_field() !!}

    <div class="field">

        <label>Name</label>

        <div class="two fields">
            @include('partials.field', ['name' => 'first_name'])
            @include('partials.field', ['name' => 'last_name'])
        </div>

    </div>

    @include('partials.select', ['name' => 'gender', 'collection' => ['male' => 'Male', 'female' => 'Female']])

    <div class="field">
        <label>Email</label>
        @include('partials.field', ['name' => 'email', 'type' => 'email'])
    </div>

    <div class="field">
        <label>Password</label>
        @include('partials.field', ['name' => 'password', 'type' => 'password'])
    </div>

    <div class="field">
        <label>Confirm Password</label>
        @include('partials.field', ['name' => 'password_confirmation', 'type' => 'password'])
    </div>

    @include('partials.errors')

    <button class="ui button" type="submit">Submit</button>

</form>