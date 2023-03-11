    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
      <div class="row pt-5">
        <div class="col-lg-3 col-md-6 mb-5">
          <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px">
            <img src="{{ asset('storage/'. $setting->pavicon) }}" width="40">
            <span class="text-white">{{$setting->nama_sekolah}}</span>
          </a>
          <p>Mendidik dengan sepenuh hati untuk menciptakan lulusan yang berakhlakul karimah</p>
          <div class="d-flex justify-content-start mt-4">
            {{-- <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#">
              <i class="fab fa-twitter"></i>
            </a> --}}
            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="{{$setting->link_facebook}}">
              <i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="{{$setting->link_youtube}}">
              <i class="fab fa-youtube"></i>
            </a>
            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="{{$setting->link_instagram}}">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Informasi Sekolah</h3>
          <div class="d-flex">
            <h4 class="fa fa-map-marker-alt text-primary"></h4>
            <div class="pl-3">
              <h5 class="text-white">Alamat</h5>
              <p>{{$setting->alamat}}</p>
            </div>
          </div>
          <div class="d-flex">
            <h4 class="fa fa-envelope text-primary"></h4>
            <div class="pl-3">
              <h5 class="text-white">Email</h5>
              <p>{{$setting->email}}</p>
            </div>
          </div>
          <div class="d-flex">
            <h4 class="fa fa-phone-alt text-primary"></h4>
            <div class="pl-3">
              <h5 class="text-white">Telepon</h5>
              <p>{{$setting->no_telepon}}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Quick Links</h3>
          <div class="d-flex flex-column justify-content-start">
            <a href="/" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Home</a>
            <a href="{{ route('jurusan') }}" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Jurusan</a>
            <a href="{{ route('pendidik') }}" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Pendidik</a>
            <a href="{{ route('galeri') }}" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Galeri</a>
            <a href="{{ route('blog') }}" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Blog</a>
            <a href="{{ route('tentang') }}" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="text-white mb-2"><i class="fa fa-angle-right mr-2"></i>Kontak</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Newsletter</h3>
          <form action="">
            <div class="form-group">
              <input
                type="text"
                class="form-control border-0 py-4"
                placeholder="Your Name"
                required="required"
              />
            </div>
            <div class="form-group">
              <input
                type="email"
                class="form-control border-0 py-4"
                placeholder="Your Email"
                required="required"
              />
            </div>
            <div>
              <button
                class="btn btn-primary btn-block border-0 py-3"
                type="submit">
                Submit Now
              </button>
            </div>
          </form>
        </div>
      </div>
      <div
        class="container-fluid pt-5"
        style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;">
        <p class="m-0 text-center text-white">
          &copy;
          <a class="text-primary font-weight-bold" href="#">{{$setting->nama_sekolah}}</a>.
          All Rights Reserved.

          <br>
          <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
          <small style="font-size: 10px"> Designed by
            <a class="text-primary font-weight-bold" href="https://htmlcodex.com" target="_blank">HTML Codex </a>
            Distributed By:
            <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
          </small>
        </p>
      </div>
    </div>
    <!-- Footer End -->
