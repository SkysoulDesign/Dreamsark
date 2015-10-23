<div class="ui menu">

    <div class="header item">@lang('navbar.dreamsark')</div>

    <a class="active item" href="{{ route('home') }}">@lang('navbar.home')</a>
    <a class="item" href="{{ route('intro') }}">@lang('navbar.intro')</a>

    <div id="showReport" class="item link">@lang('navbar.report')</div>
    <a class="item" href="{{ route('projects') }}">@lang('navbar.discover-project')</a>
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

                    @can('execute-artisan-commands', auth()->user())
                    <div class="item">
                        Admin Tools
                        <div class="left menu">
                            <div class="item">
                                Database Commands

                                <div class="left menu">
                                    <a class="item" href="{{ route('artisan', 'refresh') }}">Refresh Database</a>
                                    <a class="item" href="{{ route('artisan', 'reset') }}">Reset Database</a>
                                    <a class="item" href="{{ route('artisan', 'migrate') }}">Migrate Only</a>
                                    <a class="item" href="{{ route('artisan', 'seed') }}">Seed Only</a>
                                    <a class="item" href="{{ route('artisan', 'rollback') }}">Rollback</a>
                                </div>

                            </div>
                            <div class="item">
                                Queue Commands

                                <div class="left menu">
                                    <a class="item" href="{{ route('artisan', 'queue') }}">Default</a>
                                    <a class="item" href="{{ route('artisan', ['queue', 'audition']) }}">Audition</a>
                                </div>

                            </div>
                            <a class="item" href="{{ route('translation') }}">Translation</a>

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