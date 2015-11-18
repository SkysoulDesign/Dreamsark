<div class="container-fluid top-bar">
    <div class="row">

        <section class="medium-3 column logo">
            <img src="{{ asset('dreamsark-assets/logo.png') }}" alt="">
        </section>

        <section class="medium-5 column menu">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Discover</a></li>
                <li><a href="#">Start Project</a></li>
            </ul>
        </section>

        @if(auth()->check())

            <section class="medium-4 column settings">
                <ul>
                    <li>
                        <div class="avatar">
                            <img src="{{ asset('dreamsark-assets/avatar.png') }}" alt="Avatar">
                            <nav class="menu">
                                <ul>
                                    <li class="title">My Stuff</li>
                                    <li><a href="{{ route('profile') }}">Profile</a></li>
                                    <li><a href="#">Messages</a></li>
                                    <li><a href="#">Activity</a></li>
                                    <li class="title">Backed Projects</li>
                                    <li><a href="#">Settings</a></li>
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Notifications</a></li>
                                </ul>

                                <div class="side-menu">
                                    <ul>
                                        <li><a href="{{ route('profile') }}">Profile</a></li>
                                        <li><a href="#">Settings</a></li>
                                        <li><a href="#">Account</a></li>
                                        <li><a href="#">Notifications</a></li>
                                    </ul>
                                </div>

                                <div class="footer">
                                    <div class="left">
                                        You're logged in as
                                        <a href="{{ route('profile') }}">
                                            <b>{{ auth()->user()->username }}</b>
                                        </a>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('logout') }}">Logout</a>
                                    </div>
                                </div>

                            </nav>
                        </div>
                    </li>
                </ul>

            </section>

        @else

            {{--If the user is not Logged in --}}
            <section class="medium-4 column menu">

                <ul class="right">
                    <li><a href="{{ route('register') }}">Sing up</a></li>
                    <li><a href="{{ route('login') }}"><b>Login</b></a></li>
                </ul>

            </section>

        @endif

    </div>
</div>