<ul class="nav justify-content-center bg-white border-bottom shadow-sm p-3 px-md-4 mb-3 align-items-center">
    <li class="nav-item">
        <a class="nav-link text-dark" href="{{ route('site.index') }}">{{__('site.name') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark" href="{{ route('site.protect') }}">{{__('site.nav.protect') }}</a>
    </li>
    @auth
        @if(in_array(Auth::user()->role->name, ['Admin']))
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->email }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.index') }}"><i
                                    class="fas fa-sign-out-alt"></i> {{ __('site.nav.admin-panel') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="fas fa-sign-out-alt"></i> {{ __('site.nav.logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endif
    @endif
</ul>
