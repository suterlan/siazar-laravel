@extends('website.layout.main')
@section('content')
    {{-- <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Jurusan</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">About Us</p>
        </div>
      </div>
    </div>
    <!-- Header End --> --}}

    <!-- Jurusan Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">PROGRAM STUDI</span>
          </p>
          <h1 class="mb-4">Jurusan Pilihan</h1>
        </div>
        <div class="row">
            <div class="card-deck">
                @foreach ($jurusans as $jurusan )
                    {{-- <div class="col-lg-4 mb-5"> --}}
                        <div class="card border-0 bg-light shadow-sm">
                            <div class="card-header text-center"><b>{{ strtoupper($jurusan->kode) }}</b></div>
                            <div class="card-body text-center">
                                <img class="mb-2 mt-3 img-fluid mx-auto p-5" src="{{ asset('storage/'. $jurusan->logo) }}" />
                                <h4 class="card-title">{{ $jurusan->nama }}</h4>
                                <p class="card-text">{{ $jurusan->deskripsi }}</p>
                            </div>
                            <div class="card-footer border-0 bg-light text-center">
                                <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4 mx-auto mb-4">Daftar Sekarang</a>
                            </div>
                        </div>
                    {{-- </div> --}}
                @endforeach
            </div>
        </div>
      </div>
    </div>
    <!-- Jurusan End -->

    <!-- Kegiatan Start -->
    <div class="container-fluid py-5">
      <div class="container p-0">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Kegiatan</span>
          </p>
          <h1 class="mb-4">Kegiatan Praktek Jurusan</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
          @foreach ($slides as $slide)
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-2 p-2">
              <div style="max-height: 200px; overflow: hidden;">
                <img class="card-img-top" src="{{ asset('storage/'. $slide->gambar) }}" alt="Gambar" />
              </div>
            </div>
            <div class="d-flex align-items-center">
                <i>{{$slide->caption}}</i>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <!-- Kegiatan End -->
@endsection
