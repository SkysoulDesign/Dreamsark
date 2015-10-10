<form class="ui form error" action="{{ route('project.pledge.store', $project->id) }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'amount', 'label'=> 'Helping Amount'])

    @include('partials.errors')

    <button class="ui button" type="submit">Pledge</button>

</form>