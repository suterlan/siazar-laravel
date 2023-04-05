@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <a href="/dashboard/posts" type="button" class="btn mb-2 btn-outline-secondary"><span class="fe fe-arrow-left fe-16 mr-2"></span>Kembali</a>
                            <div class="ml-auto float-right d-flex">
                                <a class="btn btn-warning btn-sm ml-1" href="/dashboard/posts/{{ $post->slug }}/edit"><span class="fe fe-edit"></span></a>
                                <form action="/dashboard/posts/{{ $post->slug }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm ml-1" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>{{$post->title}}</h5>
                            <p class="mb-0">{{$post->category->name ?? ''}}</p>
                            <small>{{\Carbon\Carbon::parse($post->created_at)->format('d F Y')}}</small>
                            <p class="mt-3">
                                {!! $post->body !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection