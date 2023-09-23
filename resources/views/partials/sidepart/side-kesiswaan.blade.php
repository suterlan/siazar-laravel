    <ul class="navbar-nav flex-fill w-100">
        <li class="nav-item dropdown">
            <a href="/dashboard" aria-expanded="false" class="nav-link {{ Request::is('dashboard') ? 'link-active' : '' }}">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
            </a>
        </li>
    </ul>

    <p class="text-muted nav-heading mt-2 mb-1">
        <span>Akademik</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="/dashboard/ppdb" aria-expanded="false" class="nav-link {{ Request::is('dashboard/ppdb') ? 'link-active' : '' }}">
            <i class="fe fe-flag fe-16"></i>
            <span class="ml-3 item-text">PPDB</span><span class="sr-only">(current)</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="#siswa" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard/siswa*') ? 'link-active collapsed' : '' }} ">
                <i class="fe fe-database fe-16"></i>
                <span class="ml-3 item-text">Data Siswa</span><span class="sr-only">(current)</span>
            </a>
            <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/siswa*') ? 'show' : '' }}" id="siswa" style="">
                <li class="nav-item dropdown">
                    <a class="nav-link pl-3 {{ Request::is('dashboard/siswa*') ? 'link-active' : '' }}" href="/dashboard/siswa"><span class="ml-1">Semua Siswa</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link pl-3 {{ Request::is('dashboard/rombel') ? 'link-active' : '' }}" href="/dashboard/rombel"><span class="ml-1">Siswa Rombel</span></a>
                </li>
            </ul>
        </li>
    </ul>

    <p class="text-muted nav-heading mt-2 mb-1">
        <span>Manajemen</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard/akun" aria-expanded="false" class="nav-link {{ Request::is('dashboard/akun*') ? 'link-active' : '' }}">
                <i class="fe fe-file-text fe-16"></i>
                <span class="ml-3 item-text">Akun Setting</span>
            </a>
        </li>
    </ul>
