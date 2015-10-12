<form class="ui form warning error" action="{{ route('project.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'title', 'label' => trans('forms.project-title')])

    @include('partials.textarea', ['name' => 'description', 'label' => trans('forms.description')])

    <div class="ui segments">

        <div class="ui segment">
            @if($user->bag->coins > 0)
                <div class="ui olive message">@lang('profile.current-coins', ['amount' => $user->bag->coins])</div>
            @else
                @include('partials.purchase-coins-alert')
            @endif
        </div>

        <div class="ui segment">
            @include('partials.field', ['name' => 'amount', 'label' => trans('forms.pledge-amount')])
            @include('partials.field', ['name' => 'budget', 'label' => trans('forms.pledge-budget')])
        </div>

    </div>

    <div class="ui segment">
        @include('partials.field', ['name' => 'end_date', 'type'=> 'date',  'label' => trans('forms.end-date')])
    </div>

    @if($user->bag->coins > 0)
        <button class="ui button" type="submit">@lang('forms.create')</button>
    @endif

</form>