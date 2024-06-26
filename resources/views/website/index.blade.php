@extends('website.layout.main')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
      <div class="row align-items-center px-3">
        <div class="col-lg-6 text-center text-lg-left">
          <h4 class="text-white mb-4 mt-5 mt-lg-1">{{$setting->nama_sekolah}}</h4>
          <h2 class="display-3 font-weight-bold text-white">
            {{ $iklan->judul }}
          </h2>
          <p class="text-white mb-4">
            {{ $iklan->informasi }}
          </p>
          <a href="{{ route('pendaftaran') }}" class="btn btn-secondary mt-1 mb-2 py-3 px-5">Daftar Sekarang</a></a>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
          <img class="img-fluid mt-5" src="{{ asset('storage/'. $iklan->gambar) }}" alt="" />
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Facilities Start -->
    {{-- <div class="container-fluid pt-5">
      <div class="container pb-3">
        <div class="row">
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i
                class="flaticon-050-fence h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="pl-4">
                <h4>Play Ground</h4>
                <p class="m-0">
                  Kasd labore kasd et dolor est rebum dolor ut, clita dolor vero
                  lorem amet elitr vero...
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i
                class="flaticon-022-drum h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="pl-4">
                <h4>Music and Dance</h4>
                <p class="m-0">
                  Kasd labore kasd et dolor est rebum dolor ut, clita dolor vero
                  lorem amet elitr vero...
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i
                class="flaticon-030-crayons h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="pl-4">
                <h4>Arts and Crafts</h4>
                <p class="m-0">
                  Kasd labore kasd et dolor est rebum dolor ut, clita dolor vero
                  lorem amet elitr vero...
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i
                class="flaticon-017-toy-car h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="pl-4">
                <h4>Safe Transportation</h4>
                <p class="m-0">
                  Kasd labore kasd et dolor est rebum dolor ut, clita dolor vero
                  lorem amet elitr vero...
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i
                class="flaticon-025-sandwich h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="pl-4">
                <h4>Healthy food</h4>
                <p class="m-0">
                  Kasd labore kasd et dolor est rebum dolor ut, clita dolor vero
                  lorem amet elitr vero...
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 30px"
            >
              <i
                class="flaticon-047-backpack h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="pl-4">
                <h4>Educational Tour</h4>
                <p class="m-0">
                  Kasd labore kasd et dolor est rebum dolor ut, clita dolor vero
                  lorem amet elitr vero...
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- Facilities Start -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <img
            class="img-fluid rounded mb-5 mb-lg-0"
            src="{{asset('storage/'. $tentang->gambar_1)}}"
            alt=""
          />
        </div>
        <div class="col-lg-8">
          <p class="section-title pr-5">
            <span class="pr-2">Tentang Kami</span>
          </p>
          <h2 class="mb-4">Sambutan Kepala Sekolah</h2>
          <p class="text-justify">
            {!! $tentang->sambutan !!}
          </p>
        </div>
        <div class="row col-12 pt-2">
          <div class="col-12">
            <img class="rounded" height="300px" width="100%" style="object-fit: cover" src="{{asset('storage/'. $tentang->gambar_2)}}" alt="" />
          </div>
        </div>
      </div>
    </div>
</div>
<!-- About End -->

  {{-- Visi --}}
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2"><b>VISI</b></span>
            </p>
        </div>
    <div class="row justify-content-center">
        "{{$tentang->visi}}"
    </div>
</div>

  {{-- Misi --}}
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2"><b>Misi</b></span>
            </p>
        </div>
    <div class="row justify-content-center">
        <ul class="list-inline m-0">
            {!! $tentang->misi !!}
        </ul>
    </div>
</div>

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
                            {{-- <div class="card-footer border-0 bg-light text-center">
                                <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4 mx-auto mb-4">Detail</a>
                            </div> --}}
                        </div>
                    {{-- </div> --}}
                @endforeach
            </div>
        </div>
      </div>
    </div>
    <!-- Jurusan End -->

    {{-- <!-- Pendidik Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Our Teachers</span>
          </p>
          <h1 class="mb-4">Meet Our Teachers</h1>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-3 text-center team mb-5">
            <div
              class="position-relative overflow-hidden mb-4"
              style="border-radius: 100%"
            >
              <img class="img-fluid w-100" src="{{ asset('front') }}/img/team-1.jpg" alt="" />
              <div
                class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute"
              >
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
              </div>
            </div>
            <h4>Julia Smith</h4>
            <i>Music Teacher</i>
          </div>
          <div class="col-md-6 col-lg-3 text-center team mb-5">
            <div
              class="position-relative overflow-hidden mb-4"
              style="border-radius: 100%"
            >
              <img class="img-fluid w-100" src="{{ asset('front') }}/img/team-2.jpg" alt="" />
              <div
                class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute"
              >
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
              </div>
            </div>
            <h4>Jhon Doe</h4>
            <i>Language Teacher</i>
          </div>
          <div class="col-md-6 col-lg-3 text-center team mb-5">
            <div
              class="position-relative overflow-hidden mb-4"
              style="border-radius: 100%"
            >
              <img class="img-fluid w-100" src="{{ asset('front') }}/img/team-3.jpg" alt="" />
              <div
                class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute"
              >
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
              </div>
            </div>
            <h4>Mollie Ross</h4>
            <i>Dance Teacher</i>
          </div>
          <div class="col-md-6 col-lg-3 text-center team mb-5">
            <div
              class="position-relative overflow-hidden mb-4"
              style="border-radius: 100%"
            >
              <img class="img-fluid w-100" src="{{ asset('front') }}/img/team-4.jpg" alt="" />
              <div
                class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute"
              >
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center mr-2 px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  class="btn btn-outline-light text-center px-0"
                  style="width: 38px; height: 38px"
                  href="#"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
              </div>
            </div>
            <h4>Donald John</h4>
            <i>Art Teacher</i>
          </div>
        </div>
      </div>
    </div>
    <!-- Pendidik End --> --}}

    <!-- Kegiatan Start -->
    <div class="container-fluid py-5">
      <div class="container p-0">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Kegiatan</span>
          </p>
          {{-- <h3 class="mb-4">Kegiatan Belajar Mengajar</h3> --}}
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

    <!-- Blog Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Berita Terbaru</span>
          </p>
        </div>
        <div class="row pb-3 justify-content-center">
            @foreach ($posts as $post)
            <div class="card-deck col-lg-4">
                <div class="card border-0 shadow-sm mb-2">
                    <img class="card-img-top mb-2 w-100" height="250px" style="object-fit: cover" src="{{ asset('storage/'. $post->image) }}"/>
                    <div class="card-body bg-light text-center p-4">
                        <a href="/blog/{{$post->slug}}">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </a>
                        <small class="mr-3 card-text"><i class="fa fa-user text-primary"></i> Admin</small>
                        <small class="mr-3 card-text"><i class="fa fa-folder text-primary"></i><a href="/blog/categories/{{$post->category->slug ?? ''}}"> {{ $post->category->name ?? '' }} </a></small>
                        <p class="card-text"> {{ $post->excerpt }} </p>
                    </div>
                    <div class="card-footer border-0 bg-light text-center">
                        <a href="/blog/{{$post->slug}}" class="btn btn-primary px-4 mx-auto my-2">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
    <!-- Blog End -->
@endsection
