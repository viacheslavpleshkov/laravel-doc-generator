<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{ route('admin.index') }}">{{ __('admin.admin-panel') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ url()->current() == route('admin.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}"><i
                            class="fas fa-home"></i> {{ __('admin.nav.home') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-edit"></i> {{ __('admin.nav.templates') }}</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ Request::is('*types*') ? 'active' : '' }}"
                       href="{{ route('types.index') }}"><i class="fas fa-list"></i> {{ __('admin.nav.types') }}</a>
                    <a class="dropdown-item {{ Request::is('*situations*') ? 'active' : '' }}"
                       href="{{ route('situations.index') }}"><i class="fas fa-adjust"></i> {{ __('admin.nav.situations') }}</a>
                    <a class="dropdown-item {{ Request::is('*documents-files*') ? 'active' : '' }}"
                       href="{{ route('documents-files.index') }}"><i class="fas fa-file-word"></i> {{ __('admin.nav.documents-keys-files') }}</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users-cog"></i> {{ __('admin.nav.user-manager') }}</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ Request::is('*users*') ? 'active' : '' }}"
                       href="{{ route('users.index') }}"><i class="fas fa-users"></i> {{ __('admin.nav.users') }}</a>
                    <a class="dropdown-item {{ Request::is('*roles*') ? 'active' : '' }}"
                       href="{{ route('roles.index') }}"><i class="fas fa-user-shield"></i> {{ __('admin.nav.roles') }}
                    </a>
                </div>
            </li>
            <li class="nav-item {{ url()->current() == route('orders.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-chart-area"></i> {{ __('admin.nav.orders') }}</a>
            </li>
            <li class="nav-item {{ url()->current() == route('settings.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i> {{ __('admin.nav.settings') }}</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ Auth::user()->email }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="fas fa-sign-out-alt"></i> {{ __('admin.nav.logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>