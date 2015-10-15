<div class="ui menu">

    <div class="header item">@lang('navbar.dreamsark')</div>

    <a class="active item" href="{{ route('home') }}">@lang('navbar.home')</a>
    <a class="item" href="{{ route('intro') }}">@lang('navbar.intro')</a>

    <div id="showReport" class="item link">@lang('navbar.report')</div>
    <a class="item" href="{{ route('project.idea.create') }}">@lang('navbar.create-project')</a>
    <a class="item" href="{{ route('projects') }}">@lang('navbar.discover-project')</a>
    <a class="item" href="{{ route('project.ideas') }}">@lang('navbar.discover-idea')</a>
    <a class="item" href="{{ route('auditions') }}">@lang('navbar.audition')</a>

{{--    <a class="item" href="{{ route('translation') }}">@lang('navbar.translation')</a>--}}

    @if(!auth()->check())
        <div class="right menu">
            <a class="item" href="{{ route('login') }}"> @lang('navbar.login') </a>
            <a class="item" href="{{ route('register.create') }}"> @lang('navbar.register') </a>
        </div>
    @endif

    @if(auth()->check())

        <div class="right menu">
            <div class="item">@lang('navbar.coins', ['amount' => auth()->user()->bag->coins])</div>
            <div class="ui dropdown item">

                <div>
                    <img class="ui avatar image" src="{{ auth()->user()->present()->avatar }}">
                    {{ auth()->user()->present()->name }}
                </div>

                <i class="dropdown icon"></i>

                <div class="menu">
                    <a class="item" href="{{ route('profile') }}">@lang('navbar.profile')</a>
                    <a class="item" href="{{ route('coin.create') }}">@lang('navbar.purchase-coins')</a>
                    <a class="item" href="{{ route('user.projects') }}">@lang('navbar.my-projects')</a>

                    <div class="divider"></div>
                    <a class="item" href="{{ route('logout') }}">@lang('navbar.logout')</a>
                </div>
            </div>

        </div>
    @endif

</div>