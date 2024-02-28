@extends('website.layout.main')
@section('content')

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

    {{-- video kami --}}
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Video Tentang Kami</span>
          </p>
        </div>
        <div class="row text-center">
          <video src="{{asset('storage/'. $tentang->video)}}" class="col-sm-6 mx-auto mt-4 " type="video/mp4" controls></video>
        </div>
      </div>
    </div>
    {{-- video end --}}

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

    <!-- Pendidik Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Guru</span>
          </p>
          <h1 class="mb-4">Guru Tenaga Pendidik</h1>
        </div>
        <div class="row">
            @foreach ($gurus as $guru)
            <div class="col-md-3 col-lg-2 text-center team mb-5">
                <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
                     @isset($guru->dokumen->foto)
                    <img class="img-fluid w-100" src="{{ asset('storage/'. $guru->dokumen->foto) }}" />
                    @endisset
                    <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                    </div>
                </div>
                <h4>{{ $guru->nama }}</h4>
            </div>
            @endforeach
        </div>
      </div>
    </div>
    <!-- Pendidik End -->
@endsection
