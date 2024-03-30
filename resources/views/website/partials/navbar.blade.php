    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
      <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
        <a href="/" class="navbar-brand font-weight-bold text-secondary" style="font-size: 24px">
            <img src="{{ asset('storage/'. $setting->logo) }}" width="30">
            <span style="color: #0033CC">{{ strtoupper($setting->nama_sekolah)}}</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          <div class="navbar-nav font-weight-bold mx-auto py-0">
            <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('jurusan') }}" class="nav-item nav-link {{ Request::is('jurusan') ? 'active' : '' }}">Jurusan</a>
            <a href="{{ route('pendidik') }}" class="nav-item nav-link {{ Request::is('pendidik') ? 'active' : '' }}">Pendidik</a>
            <a href="{{ route('galeri') }}" class="nav-item nav-link {{ Request::is('galeri') ? 'active' : '' }}">Galeri</a>
            <a href="{{ route('blog') }}" class="nav-item nav-link {{ Request::is('blog*') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('tentang') }}" class="nav-item nav-link {{ Request::is('tentang') ? 'active' : '' }}">Tentang Kami</a>
            {{-- <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Akademik</a>
              <div class="dropdown-menu rounded-0 m-0">
                <a class="dropdown-item" href="https://cbtsmk.endesoft.id/panel" target="blank">Ujian</a>
                <a class="dropdown-item" href="http://103.150.60.29:8154/" target="blank">e-Raport</a>
              </div>
            </div> --}}
            <a href="{{ route('kontak') }}" class="nav-item nav-link {{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
          </div>
          <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4">Daftar Sekarang</a>
        </div>
      </nav>
    </div>
    <!-- Navbar End -->
