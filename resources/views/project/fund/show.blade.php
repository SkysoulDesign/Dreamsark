<div class="column">

    <div class="ui two column">

        <div class="ui horizontal segments">
            <div class="ui segment">
                <div class="ui embed" data-source="youtube" data-id="HcgJRQWxKnw" style="width: 2500px"></div>
            </div>
            <div class="ui segment" style="width: 1500px">

                <h1 class="ui header">{{ $project->name }}</h1>

                <p class="ui sub header ">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus autem est ex labore laudantium
                    mollitia nihil possimus, provident. Alias at laborum odio odit possimus ratione, repellat velit.
                    Fugiat, laborum perspiciatis?</p>

                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui horizontal list">
                            <div class="item">
                                <img class="ui mini circular image" src="{{ $project->creator->present()->avatar }}">

                                <div class="content">
                                    <h4 class="ui  header"><b>{{ $project->creator->present()->name }}</b></h4>
                                    Lorem ipsum dolor sit amet.
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="ui segment">
                        <div class="ui three item menu">
                            <a class="item @if(!$project->idea) disabled @endif">
                                <i class="icon mail"></i> Idea
                            </a>
                            <a class="item @if(!$project->synapse) disabled @endif">
                                <i class="icon users"></i> Synapse
                            </a>
                            <a class="item @if(!$project->script) disabled @endif">
                                <i class="icon users"></i> Script
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ui two inverted green item menu">
                    <a href="{{ route('project.fund.create', $project->id) }}" class="item">Back this Project</a>
                    <a class="item">Enroll</a>
                </div>

            </div>
        </div>

        <div class="ui stacked segments">
            <div class="ui segment">

                <div class="ui four wide column statistics">
                    <div class="olive statistic">
                        <div class="value">
                            <i class="yen icon"></i> {{ $project->expenditures->pluck('expenditurable')->sum('cost') }}
                        </div>
                        <div class="label">
                            {{ trans('project.pledged') }}
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            321
                        </div>
                        <div class="label">
                            {{ trans('project.backers') }}
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            69
                        </div>
                        <div class="label">
                            {{ trans('project.hours-to-go') }}
                        </div>
                    </div>

                    <div class="statistic">
                        <div class="value">
                            <img src="{{ asset('img/03.png') }}" class="ui circular inline image">
                            42
                        </div>
                        <div class="label">
                            {{ trans('project.crew-members') }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="ui segment">

                <div class="ui indicating progress active" data-percent="20">
                    <div class="bar" style="transition-duration: 300ms; width: 20%;"></div>
                    <div class="label">{{ trans('project.amount-funded') }}</div>
                </div>

            </div>
        </div>

    </div>
</div>
