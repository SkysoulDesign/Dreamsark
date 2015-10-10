<form class="ui form warning error" action="{{ route('project.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'title', 'label' => 'Project Title'])

    @include('partials.textarea', ['name' => 'description', 'label' => 'Describe your Idea'])

    <div class="ui segments">

        <div class="ui segment">
            @if($user->bag->coins > 0)
                <div class="ui olive message">You currently have: {{ $user->bag->coins }} coins</div>
            @else
                @include('partials.purchase-coins-alert')
            @endif
        </div>

        <div class="ui segment">
            @include('partials.field', ['name' => 'amount', 'label' => 'Pledge (Minimum 1 yuan)'])
            @include('partials.field', ['name' => 'budget', 'label' => 'Project Total Budget'])
        </div>

    </div>

    <div class="ui segment">
        @include('partials.field', ['name' => 'end_date', 'type'=> 'date',  'label' => 'Due Date'])
    </div>

    @include('partials.errors')

    @if($user->bag->coins > 0)
        <button class="ui button" type="submit">Create</button>
    @endif

</form>