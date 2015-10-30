@include('modals.project-cast-modal')

<div class="ui menu">
    <a id="project-add-cast" class="item"> Add Cast </a>
    <a class="item"> Add Crew </a>
    <a class="item"> Add Expansive </a>
    <a class="ui dropdown item">
        Messages
        <i class="dropdown icon"></i>

        <div class="menu">
            <div class="item">
                <i class="dropdown icon"></i>
                <span class="text">Categories</span>

                <div class="menu">
                    <div class="item">Unread</div>
                    <div class="item">Promotions</div>
                    <div class="item">Updates</div>
                </div>
            </div>
            <div class="item">Archive</div>
        </div>
    </a>
    <a class="item">
        Browse
    </a>
</div>

<table class="ui celled table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Salary</th>
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
                {{ $expenditure->expenditurable->salary }}
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
        <th colspan="1">
            <div class="ui header">{{ $expenditure->expenditurable->sum('salary') }}</div>
        </th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
</table>
