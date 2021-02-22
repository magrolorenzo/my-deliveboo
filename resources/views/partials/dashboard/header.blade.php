<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-md-nowrap">

        <!-- brand logo -->
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
            Dashboard - Deliverboo
        </a>

        <!-- nav menu -->
        <ul class="navbar-nav px-3 ml-auto">

            <!-- link per visitare homepage guest -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home')}}">
                    Visita il sito
                </a>
            </li>

            <!-- link logout -> redirect -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</header>
