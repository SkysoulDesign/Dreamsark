@extends('layouts.master')

@section('content')

    <div class="three wide column">

        <div class="ui fluid vertical menu">
            <a class="item"> Home </a>
            <a class="item"> Project Review </a>
            <a class="item"> Help </a>
        </div>

    </div>

    <div class="thirteen wide column">

        <div class="ui segments">
            <div class="ui segment">
                <p>Pending Projects To Review</p>
            </div>
            <div class="ui secondary segment">
                <table class="ui celled striped table">
                    <thead>
                    <tr>
                        <th colspan="5">
                            Projects
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td class="collapsing">
                                <i class="folder icon"></i> {{ $review->project->name }}
                            </td>
                            <td>
                                <div class="ui three fluid small steps">
                                    <div class="@if(!$review->project->idea) disabled @endif step">

                                        <a id="project-idea-show" class="content">
                                            <div class="title">Idea</div>
                                        </a>

                                    </div>
                                    <div class="@if(!$review->project->synapse) disabled @endif step">

                                        <a id="project-synapse-show" href="" class="content">
                                            <div class="title">Synapse</div>
                                        </a>

                                    </div>
                                    <div class="@if(!$review->project->script) disabled @endif step">

                                        <a id="project-script-show" href="#" class="content">
                                            <div class="title">Script</div>
                                        </a>

                                    </div>

                                    @if($review->project->idea) @include('modals.project-idea-show-modal', ['project' => $review->project ]) @endif
                                    @if($review->project->synapse) @include('modals.project-synapse-show-modal', ['project' => $review->project ]) @endif
                                    @if($review->project->script) @include('modals.project-script-show-modal', ['project' => $review->project ]) @endif

                                </div>
                            </td>
                            <td class="right aligned collapsing">
                                <form method="post" action="{{ route('committee.project.publish', $review->id) }}"
                                      class="ui form">

                                    <a href="{{ route('committee.project.staff.create', $review->id) }}"
                                       class="ui primary button">
                                        Review
                                    </a>

                                    {{ csrf_field() }}

                                    <button class="ui olive button">Publish</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection