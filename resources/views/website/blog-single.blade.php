@extends('website.layout.main')
@section('content')
    <!-- Detail Start -->
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-3">
                    <p class="section-title pr-5">
                        <span class="pr-2">Blog Detail Page</span>
                    </p>
                    <h1 class="mb-3">{{$post->title}}</h1>
                    <div class="d-flex">
                        <p class="mr-3"><i class="fa fa-user text-primary"></i> Admin</p>
                        <p class="mr-3">
                            <a href=""><i class="fa fa-folder text-primary"></i> {{$post->category->name ?? ''}}</a>
                        </p>
                    </div>
                </div>
                <div class="mb-5">
                    <img class="img-fluid rounded w-100 mb-4" src="{{ asset('storage/'. $post->image) }}" alt="Image"/>
                    <p>
                        {!! $post->body !!}
                    </p>
                </div>
            </div>
  
            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Profil Sekolah -->
                <div class="d-flex flex-column text-center bg-primary rounded mb-5 py-5 px-4">
                    <img
                        src="{{ asset('storage/'. $setting->logo) }}"
                        class="img-fluid rounded bg-danger mx-auto mb-3"
                        style="width: 100px"
                    />
                    <h3 class="text-white mb-3">{{ $setting->nama_sekolah }}</h3>
                    <p class="text-white m-0">
                        {{ $tentang->visi }}
                    </p>
                </div>
  
                <!-- Category List -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <ul class="list-group list-group-flush">
                        @foreach ($kategoris as $kategori)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="">{{ $kategori->category->name ?? '' }}</a>
                            <span class="badge badge-primary badge-pill">{{ $kategori->jml_kategori }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
    
                <!-- Recent Post -->
                {{-- <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                        <img
                        class="img-fluid"
                        src="img/post-1.jpg"
                        style="width: 80px; height: 80px"
                        />
                        <div class="pl-3">
                            <h5 class="">Diam amet eos at no eos</h5>
                            <div class="d-flex">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                                <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                            </div>
                        </div>
                    </div>
                </div> --}}
    
                <!-- Tag Cloud -->
                <div class="mb-5">
                    <h2 class="mb-4">Tag Cloud</h2>
                    <div class="d-flex flex-wrap m-n1">
                        @foreach ($kategoris as $kategori)
                        <a href="" class="btn btn-outline-primary m-1">{{ $kategori->category->name  ?? ''}}</a>
                        @endforeach
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    <!-- Detail End -->
@endsection