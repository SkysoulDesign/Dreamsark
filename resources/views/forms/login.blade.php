<form class="ui form error" action="{{ route('login.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'email', 'type' => 'email'])

    @include('partials.field', ['name' => 'password', 'type' => 'password'])

    @include('partials.errors')

    <button class="ui button" type="submit">Login</button>

</form>