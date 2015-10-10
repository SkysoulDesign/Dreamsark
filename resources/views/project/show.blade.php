@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="project">Project</a>
            <a class="item" data-tab="backers">Backers</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="project">
            <div class="ui segments">

                <div class="ui segment">
                    {{ $project->title }}
                </div>

                <div class="ui segment">
                    Details: {{ $project->description }}
                </div>

                <div class="ui segment">
                    <a class="ui button" href="{{ route('project.pledge.create', $project->id) }}">back this idea</a>
                </div>


            </div>

            <div class="ui tall stacked segment">

                <div class="ui three statistics">
                    <div class="olive statistic">
                        <div class="value">
                            {{ $project->budget - $backers->sum('pivot.amount') }}
                        </div>
                        <div class="label">
                            Remaining
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ $project->budget }}
                        </div>
                        <div class="label">
                            Goal
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            <img src="{{ asset('img/avatar/male.png') }}" class="ui circular inline image">
                            {{ $backers->count() }}
                        </div>
                        <div class="label">
                            Supporters
                        </div>
                    </div>
                </div>

            </div>

            <div class="ui segment">
                <div class="ui indicating progress active"
                     data-percent="{{ round(($backers->sum('pivot.amount') * 100) / $project->budget) }}">
                    <div class="bar"
                         style="transition-duration: 300ms; width: {{ round(($backers->sum('pivot.amount') * 100) / $project->budget) }}%;"></div>
                    <div class="label">{{ round(($backers->sum('pivot.amount') * 100) / $project->budget) }}% Funded
                    </div>
                </div>
            </div>

        </div>

        <div class="ui bottom attached tab segment" data-tab="backers">
            <table class="ui celled striped table">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($backers as $baker)
                    <tr>
                        <td>
                            <h4 class="ui image header">
                                <img src="{{ $baker->present()->avatar }}" class="ui mini rounded image">

                                <div class="content">
                                    {{ $baker->present()->name }}
                                </div>
                            </h4>
                        </td>
                        <td>
                            {{ $baker->pivot->amount }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection