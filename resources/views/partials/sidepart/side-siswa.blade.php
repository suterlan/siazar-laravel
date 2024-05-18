@can('siswa')
    <ul class="navbar-nav flex-fill w-100">
        <li class="nav-item dropdown">
            <a href="/dashboard-siswa" aria-expanded="false" class="nav-link {{ Request::is('dashboard') ? 'link-active' : '' }}">
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
            <a href="{{ route('nilai') }}" aria-expanded="false" class="nav-link {{ Request::is('dashboard-siswa/nilai') ? 'link-active' : '' }}">
                <i class="fe fe-award fe-16"></i>
                <span class="ml-3 item-text">Nilai</span>
            </a>
        </li>
    </ul>

    <p class="text-muted nav-heading mt-2 mb-1">
        <span>Keuangan</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="#pembayaran" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard-siswa/pembayaran*') ? 'link-active collapsed' : '' }} ">
                <i class="fe fe-dollar-sign fe-16"></i>
                <span class="ml-3 item-text">Iuran</span><span class="sr-only">(current)</span>
            </a>
        </li>
    </ul>

    <p class="text-muted nav-heading mt-2 mb-1">
        <span>Manajemen</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard-siswa/akun" aria-expanded="false" class="nav-link {{ Request::is('dashboard/akun*') ? 'link-active' : '' }}">
                <i class="fe fe-file-text fe-16"></i>
                <span class="ml-3 item-text">Akun Setting</span>
            </a>
        </li>
    </ul>
@endcan
