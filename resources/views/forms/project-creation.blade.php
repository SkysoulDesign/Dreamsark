<form class="ui form error" action="{{ route('project.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'title', 'label' => 'Project Title'])

    @include('partials.textarea', ['name' => 'description', 'label' => 'Describe your Idea'])

    @include('partials.field', ['name' => 'budget', 'label' => 'Budget'])

    @include('partials.errors')

    <button class="ui button" type="submit">Create</button>

</form>