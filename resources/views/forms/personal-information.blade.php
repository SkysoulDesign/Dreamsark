<form class="ui form error" action="{{ route('register.update') }}" method="post">

    {!! csrf_field() !!}

    <div class="field">

        <label>Name</label>

        <div class="two fields">
            @include('partials.field', ['name' => 'first_name'])
            @include('partials.field', ['name' => 'last_name'])
        </div>

    </div>

    @include('partials.select', ['name' => 'gender', 'collection' => ['male' => 'Male', 'female' => 'Female']])

    @include('partials.errors')

    <button class="ui button" type="submit">Save</button>

</form>