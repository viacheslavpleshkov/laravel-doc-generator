<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a class="text-dark"
                                                      href="{{ route('site.index') }}">{{__('site.name') }}</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('site.index') }}">{{__('site.nav.home') }}</a>
        <a class="p-2 text-dark" href="{{ route('site.about') }}">{{__('site.nav.about') }}</a>
    </nav>
    @auth
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ Auth::user()->email }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('site.index') }}"><i
                                class="fas fa-sign-out-alt"></i> {{ __('site.nav.orders') }}</a>
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

</div>
