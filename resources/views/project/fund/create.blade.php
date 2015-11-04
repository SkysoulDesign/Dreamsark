@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segment">

            <form class="ui form" method="post" action="{{ route('project.fund.store', $project->id) }}">
                {{ csrf_field() }}
                <div class="field">
                    <label>Amount</label>
                    <input type="text" name="amount" placeholder="Amount">
                </div>
                <button class="ui button" type="submit">Back this Project</button>
            </form>

        </div>

    </div>

@endsection