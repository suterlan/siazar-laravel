<nav class="topnav navbar navbar-light sticky-top bg-light shadow">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        {{-- <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form> --}}
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-1" href="#" id="modeSwitcher" data-mode="light">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
          <li class="nav-item">
            <div class="nav-link text-primary"><b>{{config('app.version')}}</b></div>
          </li>
          <li class="nav-item dropdown">
            @can('siswa')
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->name }}
                </a>
            @else
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->email }}
                </a>
            @endcan
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Settings</a>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="dropdown-item">Logout</button>
                </form>
            </div>
          </li>
        </ul>
      </nav>
