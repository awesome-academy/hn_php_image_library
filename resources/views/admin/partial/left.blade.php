<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset(Auth::user()->avatar) }}" onerror="this.src= '{{ asset('img/no-avatar.png') }}'"
            alt="{{ asset(Auth::user()->name) }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ ucfirst(__('admin')) }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php $route = request()->route()->getName(); @endphp
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if ($route=='dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ ucfirst(__('dashboard')) }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link @if (str_starts_with($route, 'categories' )) active @endif">
                        <p>
                            {{ ucfirst(__('category')) }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subcategories.index') }}" class="nav-link @if (str_starts_with($route, 'subcategories' )) active @endif">
                        <p>
                            {{ ucfirst(__('subcategory')) }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('images.index') }}" class="nav-link @if (str_starts_with($route, 'images' )) active @endif">
                        <p>
                            {{ ucfirst(__('image')) }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link @if (str_starts_with($route, 'users' )) active @endif">
                        <p>
                            {{ ucfirst(__('user')) }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link @if (str_starts_with($route, 'roles' )) active @endif">
                        <p>
                            {{ ucfirst(__('role')) }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link @if (str_starts_with($route, 'permissions' )) active @endif">
                        <p>
                            {{ ucfirst(__('permission')) }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
