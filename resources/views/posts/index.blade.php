@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-10">
                @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-info col-12" role="alert">
                    <span class="fe fe-info fe-16 mr-2"></span> {{ session('error') }}
                </div>
                @endif
                <div class="card shadow">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" >Posts</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="kategori-tab" data-toggle="tab" href="#kategori" role="tab" aria-controls="kategori">Kategori</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{-- Tab Posts --}}
                            <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <h5 class="card-title">Postingan Blog</h5>
                                <!-- table -->
                                <a href="/dashboard/posts/create" class="btn btn-primary mt-3"><span class="fe fe-plus"></span> Post</a>
                                <table id="tbPost" class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <td>
                                                <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="all2">
                                                <label class="custom-control-label" for="all2"></label>
                                                </div>
                                            </td> --}}
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->name ?? '' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-info btn-sm ml-1" href="/dashboard/posts/{{ $post->slug }}"><span class="fe fe-eye"></span></a>
                                                    <a class="btn btn-warning btn-sm ml-1" href="/dashboard/posts/{{ $post->slug }}/edit"><span class="fe fe-edit"></span></a>
                                                    <form action="/dashboard/posts/{{ $post->slug }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm ml-1" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav aria-label="Table Paging" class="mb-0 text-muted mt-3">
                                    <ul class="pagination justify-content-center mb-0">
                                        {{$posts->links()}}
                                    </ul>
                                </nav>
                            </div>
                            {{-- Tab Category --}}
                            <div class="tab-pane fade" id="kategori" role="tabpanel" aria-labelledby="kategori-tab"> 
                                <h5>Kategori</h5>
                                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#newCategory"><span class="fe fe-plus"></span> Kategori</button>
                                <table id="tbCategory" class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Slug</th>
                                            <th>Nama</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorys as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-warning btn-sm ml-1 btn-edit-category" data-id="{{$category->slug}}"><span class="fe fe-edit"></span></a>
                                                    <form action="/dashboard/category/{{$category->slug}}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm ml-1" type="submit" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav aria-label="Table Paging" class="mb-0 text-muted mt-3">
                                    <ul class="pagination justify-content-center mb-0">
                                        {{$categorys->links()}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal new Category --}}
<div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="newCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCategoryLabel">Tambah Kategori Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/dashboard/category" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                @csrf
            <div class="modal-body m-3 pt-0">
                <div class="form-group mb-2">
                    <label for="name">Nama</label>
                    <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="slug">Slug</label>
                    <input name="slug" id="slug" type="text" class="form-control" value="{{ old('slug') }}" required>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- modal edit Category --}}
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editKategori" method="post" class="needs-validation @if ($errors->any()) was-validated @endif">
                @method('put')
                @csrf
            <div class="modal-body m-3 pt-0">
                <div class="form-group mb-2">
                    <label for="_name">Nama</label>
                    <input name="_name" id="_name" type="text" class="form-control" value="{{ old('_name') }}" required>
                    @error('_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="_slug">Slug</label>
                    <input name="_slug" id="_slug" type="text" class="form-control" value="{{ old('_slug') }}" required>
                    @error('_slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function changeSlug(title, setSlug){
        fetch('/dashboard/category/setSlug?name=' + title.value)
        .then(response => response.json())
        .then(data => setSlug.value = data.slug);
    }

    // in modal add
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    name.addEventListener('keyup', () => {
        changeSlug(name, slug);
    });
    // in modal edit
    const _name = document.querySelector('#_name');
    const _slug = document.querySelector('#_slug');
    _name.addEventListener('keyup', () => {
        changeSlug(_name, _slug);
    });
</script>
@endsection