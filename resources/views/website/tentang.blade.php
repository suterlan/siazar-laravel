@extends('website.layout.main')
@section('content')

    <!-- About Start -->
    <div class="container-fluid py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <img
              class="img-fluid rounded mb-5 mb-lg-0"
              src="{{asset('storage/'. $tentang->gambar_1)}}"
              alt=""
            />
          </div>
          <div class="col-lg-7">
            <p class="section-title pr-5">
              <span class="pr-2">Tentang Kami</span>
            </p>
            <h2 class="mb-4">Sambutan Kepala Sekolah</h2>
            <p>
              {!! $tentang->sambutan !!}
            </p>
            <div class="row pt-2 pb-4">
              <div class="col-6 col-md-4">
                <img class="img-fluid rounded" src="{{asset('storage/'. $tentang->gambar_2)}}" alt="" />
              </div>
              <div class="col-6 col-md-8">
                <h5 class="mb-2 text-primary">Visi</h5>
                <ul class="list-inline mb-4">
                  {{$tentang->visi}}
                </ul>

                <h5 class="mb-4 text-primary">Misi</h5>
                <ul class="list-inline m-0">
                  {!! $tentang->misi !!}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About End -->

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
            <div class="col-md-6 col-lg-3 text-center team mb-5">
                <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
                    <img class="img-fluid w-100" src="{{ asset('storage/'. $guru->dokumen->foto) }}" alt="" />
                    <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                    </div>
                </div>
                <h4>{{ $guru->nama }}</h4>
                <i>Music Teacher</i>
            </div>
            @endforeach
        </div>
      </div>
    </div>
    <!-- Pendidik End -->
@endsection
