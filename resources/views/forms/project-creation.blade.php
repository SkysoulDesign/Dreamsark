<form class="ui form warning error" action="{{ route('project.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'name', 'label' => trans('forms.project-name')])

    @include('partials.select', ['name' => 'type', 'collection' => ['idea' => trans('forms.idea'), 'synapse' => trans('forms.synapse'), 'script' => trans('forms.script')]])

    @include('partials.textarea', ['name' => 'content', 'label' => trans('forms.description')])

    <div class="ui segments">

        <div class="ui segment">
            @if($user->bag->coins > 0)
                <div class="ui olive message">@lang('profile.current-coins', ['amount' => $user->bag->coins])</div>
            @else
                @include('partials.purchase-coins-alert')
            @endif
        </div>

        <div class="ui segment">
            @include('partials.field', ['name' => 'reward', 'label' => trans('forms.reward')])
        </div>

    </div>


    <div class="ui segment">
        @include('partials.field-multiple', array(
        'label' => trans('forms.due-date'),
        'fields' => [
                ['name' => 'audition_date', 'placeholder' => trans('forms.first-name'), 'type' => 'date'],
                ['name' => 'audition_time', 'placeholder' => trans('forms.last-name'), 'type' => 'time']
            ],
        'class' => 'two'
        ))
    </div>

    @if($user->bag->coins > 0)
        <button class="ui button" type="submit">@lang('forms.create')</button>
    @endif

</form>