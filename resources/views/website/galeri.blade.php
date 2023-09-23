@extends('website.layout.main')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 200px">
        <h3 class="display-3 font-weight-bold text-white">Gallery</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Gallery</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Gallery Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5">
                    <span class="px-2">Galeri Kami</span>
                </p>
                <h1 class="mb-4">Galeri Kegiatan Sekolah Kami</h1>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <ul class="list-inline mb-4" id="portfolio-flters">
                        <li class="btn btn-outline-primary m-1 active" data-filter="*">
                            All
                        </li>
                        @foreach ($kategoris as $kategori)
                        <li class="btn btn-outline-primary m-1 active" data-filter=".{{ $kategori->kode }}">
                            {{ $kategori->kode }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row portfolio-container">
                @foreach ($gambars as $gambar)
                <div class="col-lg-4 col-md-6 mb-4 portfolio-item {{ $gambar->jurusan->kode }}">
                    <div class="position-relative overflow-hidden mb-2">
                        <div style="max-height: 200px; overflow: hidden;">
                            <img class="img-fluid w-100" src="{{ asset('storage/'. $gambar->gambar) }}" />
                        </div>
                        {{-- <div class="portfolio-btn bg-primary d-flex align-items-center justify-content-center">
                            <a href="{{ asset('storage/'. $gambar->gambar) }}" data-lightbox="portfolio">
                                <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Gallery End -->
@endsection
