@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                    @endif
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <strong class="card-title">Ubah Postingan</strong>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/posts/{{$post->slug}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control {{$errors->first('title') ? "is-invalid" : "" }}" id="title" name="title" value="{{old('title', $post->title)}}" maxlength="255" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control {{$errors->first('slug') ? "is-invalid" : "" }}" id="slug" name="slug" value="{{old('slug', $post->slug)}}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select class="custom-select {{$errors->first('category_id') ? "is-invalid" : "" }}" id="category_id" name="category_id" required>
                                        <option value="">==Pilih==</option>
                                        @foreach ($kategori as $value)
                                            @if (old('category_id', $post->category_id ?? '') == $value->id)
                                                <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                            @endif
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="body">Isi Postingan</label>
                                    @error('body')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" name="body" value="{{ old('body', $post->body) }}" required>
                                    <div id="body" style="min-height: 100px">{!! old('body', $post->body) !!}</div>
                                </div>

                                <label>Gambar </label>
                                @if($post->image)
                                    <input type="hidden" name="oldImage" value="{{$post->image}}">
                                    <img src="{{asset('storage/'. $post->image)}}" class="img-preview img-fluid mb-3 col-sm-4">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-4">
                                @endif
                                <div class="custom-file mb-3">
                                    <input name="image" type="file" class="custom-file-input {{$errors->first('image') ? "is-invalid" : "" }}" id="image" onchange="previewImage()" required>
                                    <label class="custom-file-label" for="file">Browse</label>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <button class="btn btn-primary float-right" type="submit"><span class="fe fe-save"></span> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }

    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', () => {
        fetch('/dashboard/posts/setSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });
</script>
@endsection