<div id="headerc">
    <div id="header">
        <a href="/"><img id="logo" src="{{ asset('img/logo.png') }}" width="160" height="39"></a>
        <span id="mobile-search"></span>
        <img id="mobile-menu" src="{{ asset('img/menu-mobile.png') }}" width="38" height="35">
        <form method="get" action="{{ route('home.search') }}" id="search">
            <input type="text" placeholder="{{ ucfirst(__('searchfor', ['name' => __('images')])) }}..."
                value="{{ request()->get('q') }}" id="q" name="q">
            <button id="submitsearch" title="{{ ucfirst(__('search')) }}"
                type="submit">{{ ucfirst(__('search')) }}</button>
        </form>
        <ul id="menu">
            @if (Auth::check())
                <li id="useractions"><img src="{{ asset('img/down.svg') }}" width="12">
                    <ul>
                        <li><a
                                href="{{ route('profile.edit') }}">{{ ucfirst(__('edit', ['name' => __('profile')])) }}</a>
                        </li>
                        <li><a href="{{ route('profile.favorites') }}">{{ ucfirst(__('my favorites')) }}</a></li>
                        <li>
                            <a href="#" id="logout_btn">
                                <i class="fas fa-sign-out-alt"></i>{{ ucfirst(__('logout')) }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li id="signedin">
                    <a class="username" href="{{ route('home.user', ['id' => Auth::user()->getAuthIdentifier()]) }}">
                        <span>
                            <img class="avatar-inline" src="{{ asset(Auth::user()->avatar) }}"
                                onerror="this.src= '{{ asset('img/no-avatar.png') }}'" width="22"
                                height="22">{{ Auth::user()->name }}</span>
                    </a>
                </li>
                <li id="upload"><a
                        href="{{ route('profile.upload') }}">{{ ucfirst(__('upload', ['name' => ''])) }}</a></li>
            @else
                <li id="signup"><a
                        href="{{ route('register') }}">{{ ucfirst(__('create', ['name' => __('account')])) }}</a>
                </li>
                <li id="signin"><a href="{{ route('login') }}">{{ ucfirst(__('sign in')) }}</a></li>
            @endif
            <li id="catsm"><a href="{{ route('home.category') }}">{{ ucfirst(__('categories')) }}</a>
                <ul>
                    @if (count($categories) > 0)
                        @foreach ($categories as $value)
                            <li>
                                <a
                                    href="{{ route('home.subcategory', ['slug' => $value['slug']]) }}">{{ $value['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
        </ul>
        <br class="clear">
    </div>
</div>
