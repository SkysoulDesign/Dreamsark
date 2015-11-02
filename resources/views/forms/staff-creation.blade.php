@include('modals.project-cast-modal')
@include('modals.project-crew-modal')
@include('modals.project-expense-modal')

<div class="ui menu">
    <a id="project-add-cast" class="item"> Add Cast </a>
    <a id="project-add-crew" class="item"> Add Crew </a>
    <a id="project-add-expense" class="item"> Add Expansive </a>
</div>

<table class="ui celled table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach($project->expenditures as $expenditure)

        <tr>
            <td>
                <h4 class="ui image header">
                    <img src="{{ asset('img/avatar/male.png') }}" class="ui mini rounded image">

                    <div class="content">
                        {{ $expenditure->expenditurable->name }}
                        <div class="sub header">{{ $expenditure->expenditurable->position->name }}</div>
                    </div>
                </h4>
            </td>

            <td>
                {{ class_basename($expenditure->expenditurable) }}
            </td>

            <td>
                {{ $expenditure->expenditurable->amount }}
            </td>
            <td>
                {{ $expenditure->expenditurable->description }}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot class="full-width">
    <tr>
        <th></th>
        <th></th>
        <th colspan="1">
            @if($expenditures)

                <div class="ui header">
                    {{
                        collect($expenditures)->pluck('expenditurable')->sum(function($hi){
                            return isset($hi['amount']) ? $hi['amount'] : $hi['salary'];
                        })
                    }}
                </div>
            @endif
        </th>
        <th></th>
    </tr>
    </tfoot>
</table>
