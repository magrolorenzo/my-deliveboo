<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-nowrap">


        <!-- brand logo -->
        <a class="navbar-brand" href="#">
            Dashboard - {{Auth::user()->name}}
        </a>


        <!-- nav menu -->
        <ul class="navbar-nav flex-row ml-auto">

            <!-- link per visitare homepage guest -->
            <li class="nav-item ml-2">
                <a class="nav-link" href="{{ route('home')}}">
                    Visita il sito
                </a>
            </li>

            <!-- link logout -> redirect -->
            <li class="nav-item ml-2">
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
