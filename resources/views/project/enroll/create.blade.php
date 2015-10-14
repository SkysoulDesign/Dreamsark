@extends('layouts.master')

@section('content')


    <div class="column">

        <h3 class="ui dividing header">
            @lang('project.cast')
        </h3>
        <table class="ui unstackable table">
            <thead>
            <tr>
                <th>@lang('forms.role')</th>
                <th>@lang('project.description')</th>
                <th>@lang('project.number-of-candidates')</th>
                <th class="right aligned">@lang('forms.action')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($project->cast as $cast)
                <tr>
                    <td>{{ $cast->name }}</td>
                    <td>{{ $cast->description }}</td>
                    <td>{{ $cast->candidates->count() }}</td>
                    <td class="right aligned">
                        <form method="post" action="{{ route('project.enroll.cast.store', $cast->id) }}">
                            {{ csrf_field() }}
                            <button class="ui primary button" type="submit">@lang('forms.apply')</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <h3 class="ui dividing header">
            @lang('project.crew')
        </h3>
        <table class="ui unstackable table">
            <thead>
            <tr>
                <th>@lang('forms.role')</th>
                <th>@lang('project.description')</th>
                <th>@lang('project.number-of-candidates')</th>
                <th class="right aligned">@lang('forms.action')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($project->crew as $crew)
                <tr>
                    <td>{{ $crew->role }}</td>
                    <td>{{ $crew->description }}</td>
                    <td>{{ $crew->candidates->count() }}</td>
                    <td class="right aligned">
                        <form method="post" action="{{ route('project.enroll.crew.store', $crew->id) }}">
                            {{ csrf_field() }}
                            <button class="ui primary button" type="submit">@lang('forms.apply')</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@endsection