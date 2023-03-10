<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/dashboard">
                <img src="{{ asset('logo_smk.png') }}" width="50px" alt="">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="/dashboard" aria-expanded="false" class="nav-link {{ Request::is('dashboard') ? 'link-active' : '' }}">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Akademik</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="/dashboard/ppdb" aria-expanded="false" class="nav-link {{ Request::is('dashboard/ppdb') ? 'link-active' : '' }}">
                <i class="fe fe-flag fe-16"></i>
                <span class="ml-3 item-text">PPDB</span><span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
        
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#siswa" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard/siswa*') ? 'link-active collapsed' : '' }} ">
                    <i class="fe fe-database fe-16"></i>
                    <span class="ml-3 item-text">Data Siswa</span><span class="sr-only">(current)</span>
                </a>
                <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/siswa*') ? 'show' : '' }}" id="siswa" style="">
                    <li class="nav-item dropdown">
                        <a class="nav-link pl-3 {{ Request::is('dashboard/siswa*') ? 'link-active' : '' }}" href="/dashboard/siswa"><span class="ml-1">Semua Siswa</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="/dashboard/jurusan" aria-expanded="false" class="nav-link {{ Request::is('dashboard/jurusan') ? 'link-active' : '' }}">
                    <i class="fe fe-map fe-16"></i>
                    <span class="ml-3 item-text">Jurusan</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="/dashboard/kelas" aria-expanded="false" class="nav-link {{ Request::is('dashboard/kelas') ? 'link-active' : '' }}">
                    <i class="fe fe-columns fe-16"></i>
                    <span class="ml-3 item-text">Kelas</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Manajemen</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#surat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{ Request::is('dashboard/surat*') ? 'link-active collapsed' : '' }} ">
                    <i class="fe fe-mail fe-16"></i>
                    <span class="ml-3 item-text">Surat</span><span class="sr-only">(current)</span>
                </a>
                <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/surat*') ? 'show' : '' }}" id="surat" style="">
                    <li class="nav-item dropdown">
                        <a href="#suratkeluar" class="dropdown-toggle nav-link pl-3 {{ Request::is('dashboard/suratkeluar*') ? 'link-active collapsed' : '' }}" data-toggle="collapse" aria-expanded="false"><span class="ml-1">Surat Keluar</span></a>
                        <ul class="list-unstyled pl-4 w-100 collapse {{ Request::is('dashboard/suratkeluar*') ? 'show' : '' }}" id="suratkeluar" style="">
                            <a href="/dashboard/suratkeluar" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar') ? 'link-active' : '' }}"><span class="ml-1">Semua Surat</span></a>
                            <a href="/dashboard/suratkeluar/penerimaan" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/penerimaan*') ? 'link-active' : '' }}"><span class="ml-1"> Penerimaan Siswa</span></a>
                            <a href="/dashboard/suratkeluar/panggilan" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/panggilan*') ? 'link-active' : '' }}"><span class="ml-1"> Pemanggilan Siswa</span></a>
                            <a href="/dashboard/suratkeluar/mutasi" class="nav-link pl-3 {{ Request::is('dashboard/suratkeluar/mutasi*') ? 'link-active' : '' }}"><span class="ml-1"> Mutasi Siswa</span></a>
                        </ul>
                    </li>
                    <a class="nav-link pl-3 {{ Request::is('dashboard/suratmasuk*') ? 'link-active' : '' }}" href="/dashboard/suratmasuk"><span class="ml-1">Surat Masuk</span></a>
                </ul>
            </li>
        </ul>

        @can('admin')
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a href="/dashboard/klasifikasi" aria-expanded="false" class="nav-link {{ Request::is('dashboard/klasifikasi') ? 'link-active' : '' }}">
                    <i class="fe fe-list fe-16"></i>
                    <span class="ml-3 item-text">Klasifikasi</span><span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a href="/dashboard/user" aria-expanded="false" class="nav-link {{ Request::is('dashboard/user') ? 'link-active' : '' }}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">User Settings</span><span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Website</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
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
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a href="{{route('sekolah')}}" aria-expanded="false" class="nav-link {{ Request::is('dashboard/sekolah') ? 'link-active' : '' }}">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Profile Sekolah</span>
                </a>
            </li>
        </ul>
        @endcan

    </nav>
</aside>
