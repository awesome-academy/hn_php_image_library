<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    @if (app()->getLocale() == 'en')
        <a>{{ ucfirst(__('english')) }}</a>
    @elseif(app()->getLocale()=='en')
        <a>{{ __('vie') }}</a>
    @endif
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}" id="logout_btn">
                    <i class="fas fa-sign-out-alt"></i>&nbsp{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
@push('script')
    <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>
@endpush
