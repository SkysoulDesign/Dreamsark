<div class="ui menu">

    <div class="header item">@lang('navbar.dreamsark')</div>

    <a class="active item" href="{{ route('home') }}">@lang('navbar.home')</a>
    <a class="item" href="{{ route('intro') }}">@lang('navbar.intro')</a>

    <div id="showReport" class="item link">@lang('navbar.report')</div>
    <a class="item" href="{{ route('projects') }}">@lang('navbar.discover-project')</a>
    <a class="item" href="{{ route('votes') }}">@lang('navbar.vote')</a>

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

                    @can('see-dashboard', auth()->user())
                    <a class="item" href="{{ route('dashboard') }}">@lang('navbar.dashboard')</a>
                    @endcan

                    @can('see-reports', auth()->user())
                    <a class="item" href="{{ route('reports') }}">@lang('navbar.reports')</a>
                    @endcan

                    @can('execute-artisan-commands', auth()->user())
                    <div class="item">
                        @lang('navbar.admin-tools')
                        <div class="left menu">
                            <div class="item">
                                @lang('navbar.database-commands')

                                <div class="left menu">
                                    <a class="item" href="{{ route('artisan', 'backup') }}">@lang('navbar.backup')</a>
                                    <a class="item" href="{{ route('artisan', 'refresh') }}">@lang('navbar.refresh')</a>
                                    <a class="item" href="{{ route('artisan', 'reset') }}">@lang('navbar.reset')</a>
                                    <a class="item" href="{{ route('artisan', 'migrate') }}">@lang('navbar.migrate')</a>
                                    <a class="item" href="{{ route('artisan', 'seed') }}">@lang('navbar.seed')</a>
                                    <a class="item"
                                       href="{{ route('artisan', 'rollback') }}">@lang('navbar.rollback')</a>
                                </div>

                            </div>
                            <div class="item">
                                @lang('navbar.queue-commands')

                                <div class="left menu">
                                    <a class="item"
                                       href="{{ route('artisan', 'queue') }}">@lang('navbar.queue-default')</a>
                                    <a class="item"
                                       href="{{ route('artisan', ['queue', 'voting']) }}">@lang('navbar.queue-voting')</a>
                                </div>

                            </div>
                            <a class="item" href="{{ route('translation') }}">@lang('navbar.translations')</a>

                        </div>
                    </div>
                    @endcan

                    <div class="divider"></div>
                    <a class="item" href="{{ route('logout') }}">@lang('navbar.logout')</a>
                </div>
            </div>

        </div>
    @endif

</div>