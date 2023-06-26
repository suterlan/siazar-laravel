@extends('website.layout.main')
@section('content')
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
