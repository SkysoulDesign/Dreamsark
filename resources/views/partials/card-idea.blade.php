<div class="ui fluid card">
    <div class="content">

        <i class="right floated like icon"></i>
        <i class="right floated star icon"></i>

        {!! $project->present()->ribbon !!}

        <p></p>
        <a href="#{{$project->type}}" class="ui yellow ribbon label"> {{ strtoupper(trans('project.' . $project->type)) }}</a>
        <a href="{{ route('project.idea.show', $project->id) }}">{{ $project->name }}</a>

    </div>
    <div class="extra content">
        <p>{{ $project->idea->content }}</p>
    </div>
</div>