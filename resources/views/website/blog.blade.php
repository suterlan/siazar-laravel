@extends('website.layout.main')
@section('content')
    <!-- Header Start -->
    <div class="container pt-5">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">{{ $title }}</span>
            </p>
            {{-- <h1 class="mb-4">{{ $title }}</h1> --}}
        </div>
    @if ($posts->count())
      <div class="card text-center rounded">
        <img src="{{ asset('storage/'. $posts[0]->image) }}" class="card-img-top mb-2 w-100" height="350px" style="object-fit: cover">
        <div class="card-body bg-light text-center">
            <a href="/blog/{{$posts[0]->slug}}">
                <h4 class="card-title">{{ $posts[0]->title }}</h4>
            </a>
            <small class="mr-3 card-text"><i class="fa fa-user text-primary"></i> Admin</small>
            <small class="mr-3 card-text"><i class="fa fa-folder text-primary"></i><a href="/blog/categories/{{$posts[0]->category->slug ?? ''}}"> {{ $posts[0]->category->name ?? '' }} </a></small>
            <small class="mr-3 card-text" style="color: lightgrey"> {{ \Carbon\Carbon::parse($posts[0]->created_at)->diffForHumans() }}</small>
            <p class="card-text"> {{ $posts[0]->excerpt }} </p>
        </div>
        <div class="card-footer border-0 bg-light text-center">
            <a href="/blog/{{$posts[0]->slug}}" class="btn btn-primary px-4 mb-2 mx-auto">Read More</a>
        </div>
      </div>
    </div>
    @else
        <p class="text-center">-Tidak ada postingan-</p>
    @endif
    <!-- Header End -->

    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row pb-3">
                <div class="row pb-3 justify-content-center">
                    @foreach ($posts->skip(1) as $post)
                    <div class="card-deck col-lg-4 mb-3">
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
                <div class="col-md-12 mb-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0">
                            {{$posts->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
