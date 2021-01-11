<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="text_black hover_blue navbar-brand " href="{{ route('site.index') }}"> {{__('site.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link rights" href="{{ route('site.news.index') }}">{{__('site.nav.protect') }}</a>
                    </li>
                    @auth
                        @if(in_array(Auth::user()->role->name, ['User']))
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                            class="fas fa-sign-out-alt"></i> Выйти из аккаунта ({{ mb_strimwidth(Auth::user()->email, 0, 30, "...") }})</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endif
                        @if(in_array(Auth::user()->role->name, ['Admin']))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ mb_strimwidth(Auth::user()->email, 0, 30, "...") }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('admin.index') }}">{{ __('site.nav.admin-panel') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                                class="fas fa-sign-out-alt"></i> {{ __('site.nav.logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>