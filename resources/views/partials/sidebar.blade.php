<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-3 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="">
                <img src="{{ asset('logo_smk.png') }}" width="50px" alt="">
            </a>
        </div>

        @can('admin')
            @include('partials.sidepart.side-admin')
        @elsecan('guru')
            @include('partials.sidepart.side-guru')
        @elsecan('siswa')
            @include('partials.sidepart.side-siswa')
        @endcan

    </nav>
</aside>
