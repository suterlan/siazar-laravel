@can('admin')
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
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="#guru" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard/guru*') ? 'link-active collapsed' : '' }} ">
                <i class="fe fe-database fe-16"></i>
                <span class="ml-3 item-text">Data Guru</span><span class="sr-only">(current)</span>
            </a>
            <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/guru*') ? 'show' : '' }}" id="guru" style="">
                <li class="nav-item dropdown">
                    <a class="nav-link pl-3 {{ Request::is('dashboard/guru*') ? 'link-active' : '' }}" href="/dashboard/guru"><span class="ml-1">Semua Guru</span></a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="/dashboard/mapel" aria-expanded="false" class="nav-link {{ Request::is('dashboard/mapel*') ? 'link-active' : '' }}">
                <i class="fe fe-book fe-16"></i>
                <span class="ml-3 item-text">Mata Pelajaran</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="/dashboard/mengajar" aria-expanded="false" class="nav-link {{ Request::is('dashboard/mengajar*') ? 'link-active' : '' }}">
                <i class="fe fe-book-open fe-16"></i>
                <span class="ml-3 item-text">Mengajar</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="/dashboard/jurusan" aria-expanded="false" class="nav-link {{ Request::is('dashboard/jurusan') ? 'link-active' : '' }}">
                <i class="fe fe-map fe-16"></i>
                <span class="ml-3 item-text">Jurusan</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="/dashboard/kelas" aria-expanded="false" class="nav-link {{ Request::is('dashboard/kelas') ? 'link-active' : '' }}">
                <i class="fe fe-columns fe-16"></i>
                <span class="ml-3 item-text">Kelas</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard/struktur-organisasi" aria-expanded="false" class="nav-link {{ Request::is('dashboard/struktur*') ? 'link-active' : '' }}">
                <i class="fe fe-git-commit fe-16"></i>
                <span class="ml-3 item-text">Struktur Organisasi</span>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="/dashboard/galeri" aria-expanded="false" class="nav-link {{ Request::is('dashboard/galeri') ? 'link-active' : '' }}">
                <i class="fe fe-image fe-16"></i>
                <span class="ml-3 item-text">Galeri</span>
            </a>
        </li>
    </ul>

    <p class="text-muted nav-heading mt-2 mb-1">
        <span>Manajemen</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="#surat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard/surat*') ? 'link-active collapsed' : '' }} ">
                <i class="fe fe-mail fe-16"></i>
                <span class="ml-3 item-text">Surat</span><span class="sr-only">(current)</span>
            </a>
            <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/surat*') ? 'show' : '' }}" id="surat" style="">
                <a href="/dashboard/surat/klasifikasi" aria-expanded="false" class="nav-link pl-3 {{ Request::is('dashboard/surat/klasifikasi*') ? 'link-active' : '' }}">
                    {{-- <i class="fe fe-list fe-16"></i> --}}
                    <span class="ml-1 item-text">Klasifikasi</span><span class="sr-only">(current)</span>
                </a>
                <li class="nav-item dropdown">
                    <a href="#suratkeluar" class="dropdown-toggle nav-link pl-3 {{ Request::is('dashboard/suratkeluar*') ? 'link-active collapsed' : '' }}" data-toggle="collapse" aria-expanded="false"><span class="ml-1">Surat Keluar</span></a>
                    <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/suratkeluar*') ? 'show' : '' }}" id="suratkeluar" style="">
                        <a href="/dashboard/suratkeluar" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar') ? 'link-active' : '' }}"><span class="ml-1">Semua Surat</span></a>
                        <a href="/dashboard/suratkeluar/penerimaan" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/penerimaan*') ? 'link-active' : '' }}"><span class="ml-1"> Penerimaan Siswa</span></a>
                        <a href="/dashboard/suratkeluar/panggilan" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/panggilan*') ? 'link-active' : '' }}"><span class="ml-1"> Pemanggilan Siswa</span></a>
                        <a href="/dashboard/suratkeluar/mutasi" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/mutasi*') ? 'link-active' : '' }}"><span class="ml-1"> Mutasi Siswa</span></a>
                        <a href="/dashboard/suratkeluar/undangan" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/undangan*') ? 'link-active' : '' }}"><span class="ml-1"> Surat Undangan</span></a>
                        {{-- <a href="/dashboard/suratkeluar/umum" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/umum*') ? 'link-active' : '' }}"><span class="ml-1"> Surat Umum</span></a> --}}
                        <a href="/dashboard/suratkeluar/skbm" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/skbm*') ? 'link-active' : '' }}"><span class="ml-1"> Surat KBM</span></a>
                    </ul>
                </li>
                <a class="nav-link pl-3 {{ Request::is('dashboard/suratmasuk*') ? 'link-active' : '' }}" href="/dashboard/suratmasuk"><span class="ml-1">Surat Masuk</span></a>
            </ul>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard/user" aria-expanded="false" class="nav-link {{ Request::is('dashboard/user') ? 'link-active' : '' }}">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">User Settings</span><span class="sr-only">(current)</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard/arsip" aria-expanded="false" class="nav-link {{ Request::is('dashboard/arsip/*') ? 'link-active' : '' }}">
                <i class="fe fe-archive fe-16"></i>
                <span class="ml-3 item-text">Arsip</span>
            </a>
        </li>
    </ul>
    <p class="text-muted nav-heading mt-2 mb-1">
        <span>Website</span>
    </p>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard/pesan" aria-expanded="false" class="nav-link {{ Request::is('dashboard/pesan*') ? 'link-active' : '' }}">
                <i class="fe fe-file-text fe-16"></i>
                <span class="ml-3 item-text">Pesan Pengunjung</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="/dashboard/posts" aria-expanded="false" class="nav-link {{ Request::is('dashboard/posts*') ? 'link-active' : '' }}">
                <i class="fe fe-file-text fe-16"></i>
                <span class="ml-3 item-text">Blog Post</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item dropdown">
            <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard/settings*') ? 'link-active collapsed' : '' }} ">
                <i class="fe fe-settings fe-16"></i>
                <span class="ml-3 item-text">Settings</span><span class="sr-only">(current)</span>
            </a>
            <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/settings*') ? 'show' : '' }}" id="settings" style="">
                <li class="nav-item dropdown">
                    <a class="nav-link pl-3 {{ Request::is('dashboard/settings-iklan') ? 'link-active' : '' }}" href="/dashboard/settings-iklan"><span class="ml-1">Iklan</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link pl-3 {{ Request::is('dashboard/settings-tentang') ? 'link-active' : '' }}" href="/dashboard/settings-tentang"><span class="ml-1">Tentang</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link pl-3 {{ Request::is('dashboard/settings-slide') ? 'link-active' : '' }}" href="/dashboard/settings-slide"><span class="ml-1">Gambar Slide</span></a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-0">
        <li class="nav-item">
            <a href="{{route('sekolah')}}" aria-expanded="false" class="nav-link {{ Request::is('dashboard/sekolah') ? 'link-active' : '' }}">
                <i class="fe fe-grid fe-16"></i>
                <span class="ml-3 item-text">Profile Sekolah</span>
            </a>
        </li>
    </ul>
@endcan