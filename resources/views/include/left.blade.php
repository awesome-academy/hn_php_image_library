<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ __('Admin') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $route = request()
                        ->route()
                        ->getName();
                @endphp
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if ($route=='dashboard'
                        ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link @if (str_starts_with($route, 'categories' )) active @endif">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            {{ __('Categories') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link @if (str_starts_with($route, 'products' )) active @endif">
                        <i class="nav-icon fas fa-battery-half"></i>
                        <p>
                            {{ __('Products') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
