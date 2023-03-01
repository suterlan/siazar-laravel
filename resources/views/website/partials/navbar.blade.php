    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
      <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
        <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 30px">
            <img src="{{ asset('logo_smk.png') }}" alt="" width="30">
            <span class="text-primary">SMK AZ-ZARKASYIH</span>
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
            <a href="{{ route('blog') }}" class="nav-item nav-link {{ Request::is('blog') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('tentang') }}" class="nav-item nav-link {{ Request::is('tentang') ? 'active' : '' }}">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="nav-item nav-link {{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
          </div>
          <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4">Daftar Sekarang</a>
        </div>
      </nav>
    </div>
    <!-- Navbar End -->
