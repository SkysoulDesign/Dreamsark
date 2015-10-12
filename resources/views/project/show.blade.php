@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="project">@lang('project.project')</a>
            <a class="item" data-tab="script">@lang('project.script')</a>
            <a class="item" data-tab="backers">@lang('project.backers')</a>
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
                    <a class="ui button"
                       href="{{ route('project.pledge.create', $project->id) }}">@lang('project.pledge-idea')</a>
                </div>


            </div>

            <div class="ui tall stacked segment">

                <div class="ui three statistics">
                    <div class="olive statistic">
                        <div class="value">
                            {{ $project->budget - $backers->sum('pivot.amount') }}
                        </div>
                        <div class="label">
                            @lang('project.remaining')
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ $project->budget }}
                        </div>
                        <div class="label">
                            @lang('project.goal')
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            <img src="{{ asset('img/avatar/male.png') }}" class="ui circular inline image">
                            {{ $backers->count() }}
                        </div>
                        <div class="label">
                            @lang('project.backers')
                        </div>
                    </div>
                </div>

            </div>

            <div class="ui segment">
                <div class="ui indicating progress active"
                     data-percent="{{ $project->present()->progress }}">
                    <div class="bar"
                         style="transition-duration: 300ms; width: {{ round(($backers->sum('pivot.amount') * 100) / $project->budget) }}%;"></div>
                    <div class="label">@lang('project.funded', ['percentage' => $project->present()->progress ])
                    </div>
                </div>
            </div>

        </div>

        <div class="ui bottom attached tab segment" data-tab="script">

            <div class="ui segment">
                <button id="project-add-take" class="ui button">
                    @lang('project.add-take')
                </button>
            </div>

            @include('modals.project-take-modal')

            @if($project->script->takes->isEmpty())
                <div class="ui warning message">
                    <i class="close icon"></i>

                    <div class="header">
                        @lang('project.no-take')
                    </div>
                </div>

            @else

                <div class="ui styled fluid accordion">
                    @foreach($project->script->takes as $key => $take)
                        <div class="title">
                            <i class="dropdown icon"></i>
                            {{ $take->title }}
                        </div>
                        <div class="content">
                            <div class="transition hidden">
                                <div class="ui segments">
                                    <div class="ui segment">

                                        <table class="ui celled padded table">
                                            <thead>
                                            <tr>
                                                <th>@lang('project.length')</th>
                                                <th>@lang('project.location')</th>
                                                <th>@lang('project.shot')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> {{ $take->length }}</td>
                                                <td> {{ $take->location }}</td>
                                                <td> {{ $take->shot }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="ui bottom attached success message">
                                        <div class="header">
                                            @lang('project.description')
                                        </div>
                                        <p>{{ $take->description }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif

        </div>

        <div class="ui bottom attached tab segment" data-tab="backers">
            <table class="ui celled striped table">
                <thead>
                <tr>
                    <th>@lang('project.user')</th>
                    <th>@lang('project.amount')</th>
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