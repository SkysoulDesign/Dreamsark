<div class="ui menu">

    <div class="header item">DreamsArk</div>

    <a class="active item" href="{{ route('home') }}">Home</a>
    <a class="item" href="{{ route('intro') }}">Intro</a>

    @if(!auth()->check())
        <div class="right menu">
            <a class="item" href="{{ route('login') }}"> Login </a>
            <a class="item" href="{{ route('register.create') }}"> Register </a>
        </div>
    @endif

    @if(auth()->check())

        <div class="right menu">

            <div class="ui dropdown item">

                <div>
                    <img class="ui avatar image" src="{{ auth()->user()->present()->avatar }}">
                    {{ auth()->user()->present()->name }}
                </div>

                <i class="dropdown icon"></i>

                <div class="menu">
                    <a class="item" href="{{ route('profile') }}">Profile</a>

                    <div class="divider"></div>
                    <a class="item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>

        </div>
    @endif

</div>