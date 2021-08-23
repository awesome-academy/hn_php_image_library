<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <a>{{ __('lang') }}</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
                @if (\Illuminate\Support\Facades\App::getLocale() == 'vi')
                    <a class="dropdown-item" href="{{ route('locale.setting', ['en']) }}">
                        <i class="fas fa-language"></i>&nbsp{{ __('EN') }}
                    </a>
                @else
                    <a class="dropdown-item" href="{{ route('locale.setting', ['vi']) }}">
                        <i class="fas fa-language"></i>&nbsp{{ __('VI') }}
                    </a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>&nbsp{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
