<div class="container-fluid top-bar">
    <div class="row">

        <section class="medium-3 column logo">
            <img src="{{ asset('dreamsark-assets/logo.png') }}" alt="">
        </section>

        <section class="medium-5 column menu">
            <ul>
                <li><a href="{{ route('home') }}">首页</a></li>

                <li id="extra-trigger">
                    <a href="#">More</a>
                </li>

                <li><a href="#">Discover</a></li>
                {{--<li><a href="{{ route('intro') }}">Intro</a></li>--}}
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

        <section class="medium-12 column extra-container">

            <div class="extra">

                <nav class="medium-3 column">
                    <ul id="tabs">
                        <li class="title">Main Menu</li>
                        <li data-tab="one" class="active">乘客</li>
                        <li data-tab="two">任务</li>
                        <li data-tab="three">小说</li>
                        <li>剧本</li>
                        <li>设备</li>
                        <li>影视基地</li>
                        <li>追梦学院</li>
                        <li>微博</li>
                        <li>素材库</li>
                        <li>积分商城</li>
                        <li>投资委员会</li>
                    </ul>
                </nav>

                <div id="tabs-content" class="medium-9 column body">

                    <section data-tab="one" class="active">

                        <div class="medium-8 column">

                            <div class="row">

                                <div class="medium-12 column">
                                    Active Users
                                </div>

                                <div class="medium-3 column">
                                    <img src="{{ asset('img/avatar/male.png') }}" alt="">
                                </div>
                                <div class="medium-3 column">
                                    <img src="{{ asset('img/avatar/male.png') }}" alt="">
                                </div>
                                <div class="medium-3 column">
                                    <img src="{{ asset('img/avatar/male.png') }}" alt="">
                                </div>
                                <div class="medium-3 column">
                                    <img src="{{ asset('img/avatar/male.png') }}" alt="">
                                </div>

                            </div>

                        </div>

                        <aside class="medium-4 column">
                            <ul>
                                <li class="title">Category</li>
                                <li>sub category</li>
                                <li>sub category</li>
                                <li>sub category</li>
                                <li>sub category</li>
                            </ul>
                        </aside>

                    </section>

                    <section data-tab="two">
                        <div class="medium-8 column">Oh My God</div>
                        <aside class="medium-4 column">
                            <ul>
                                <li class="title">Category</li>
                                <li>sub category</li>
                                <li>sub category</li>
                                <li>sub category</li>
                                <li>sub category</li>
                            </ul>
                        </aside>
                    </section>

                    <section data-tab="three">
                        <div class="medium-8 column">Jesus Crist</div>
                    </section>

                </div>

            </div>

        </section>

    </div>
</div>