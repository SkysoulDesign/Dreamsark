@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segment">
            <table class="ui celled table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Expected Salary</th>
                    <th>Description</th>
                    <th>Number of Candidates</th>
                    <th>Enroll</th>
                </tr>
                </thead>
                <tbody>

                @foreach($expenditures as $expenditure)

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
                            {{ $expenditure->expenditurable->cost }}
                        </td>

                        <td>
                            {{ $expenditure->expenditurable->description }}
                        </td>

                        <td>
                            {{ $expenditure->enrollers->count() }}
                        </td>

                        <td class="collapsing">
                            @if($expenditure->users->contains('id', auth()->user()->id))
                                <form method="post" action="{{ route('project.unroll.store', $expenditure->id) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="red ui icon button"> Unroll</button>
                                </form>
                            @else
                                <form method="post" action="{{ route('project.enroll.store', $expenditure->id) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="olive ui icon button"> Enroll</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>

@endsection