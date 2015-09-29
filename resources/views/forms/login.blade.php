<form class="ui form error" action="{{ route('login.store') }}" method="post">

    {!! csrf_field() !!}

    <div class="field">
        <label>Email</label>
        @include('partials.field', ['name' => 'email', 'type' => 'email'])
    </div>

    <div class="field">
        <label>Password</label>
        @include('partials.field', ['name' => 'password', 'type' => 'password'])
    </div>

    @include('partials.errors')

    <button class="ui button" type="submit">Login</button>

</form>