<header>
    <nav id="guest-navbar" class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <!-- Left Side Of Navbar - Brand Logo -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand logo-brand m-0 p-0 d-flex align-items-center" href="{{ url('/') }}">
                    {{-- <img src="" alt="Logo"> --}}
                    <h5 class="m-0 ml-2">DeliveBoo</h5>
                </a>
            </div>


            <div class="right-links">
                <ul class="navbar-nav ml-auto flex-row">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <!-- Visible -> username -->
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <!-- DropdownMenu -->
                            <div class="dropdown-menu dropdown-menu-right  position-absolute" aria-labelledby="navbarDropdown">
                                <!-- Link to dashboard -->
                                <a class="dropdown-item" href="{{ route('admin.home') }}">
                                    Dashboard
                                </a>

                                <!-- Logout -->
                                <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <!-- END Logout -->
                        </div>

                    </li>                    
                @endguest
            </ul>


        </div>

        <!-- Right Side Of Navbar MOBILE - Hamburger menu -->



    </div> {{-- Fine Container --}}
</nav>
</header>
