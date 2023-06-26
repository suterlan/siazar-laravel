@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                 @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger col-12" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row align-items-center my-3">
                    <div class="col">
                        <h2 class="page-title">Galeri Foto</h2>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addFotoModal"><span class="fe fe-plus fe-16 mr-3"></span>New</button>
                    </div>
                </div>
                <div class="file-container border-top">
                    <div class="file-panel mt-4">
                        <hr class="my-4">
                        <h6 class="mb-3">Foto</h6>
                        <div class="row my-4 pb-4 show-detail">
                            @foreach ($galeris as $galeri )
                            <div class="col-md-3">
                                <div class="card shadow text-center mb-4 @if ($galeri->slide_aktif == true) bg-primary-lighter @endif">
                                    <div class="card-body file galeri">
                                        <div class="file-action">
                                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <form action="/dashboard/galeri/{{$galeri->id}}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    @if ($galeri->slide_aktif == false)
                                                        <input type="hidden" name="aksi" value="set">
                                                        <button class="dropdown-item" type="submit"><i class="fe fe-image fe-12 mr-4"></i>Jadikan Slide</button>
                                                    @else
                                                        <input type="hidden" name="aksi" value="remove">
                                                        <button class="dropdown-item" type="submit"><i class="fe fe-image fe-12 mr-4"></i>Hapus Slide</button>
                                                    @endif
                                                </form>
                                                <a class="dropdown-item" href="/dashboard/galeri/download/{{ $galeri->id }}"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                                                <form action="/dashboard/galeri/{{ $galeri->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fe fe-delete fe-12 mr-4"></i>Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="mb-3 px-2" style="max-height: 150px; overflow: hidden;">
                                            <img src="{{ asset('storage/'. $galeri->gambar) }}" class="img-fluid gambar" data-size="{{ number_format($galeri->gambar_size / 1048576,2); }}" data-type="{{ $galeri->gambar_type }}" data-caption="{{ $galeri->caption }}" data-created="{{ $galeri->created_at }}" data-updated="{{ $galeri->updated_at }}">
                                        </div>
                                        <div class="file-info">
                                            <span class="badge badge-light text-muted mr-2">{{ number_format($galeri->gambar_size / 1048576,2); }} MB</span>
                                            <span class="badge badge-pill badge-light text-muted">{{ $galeri->gambar_type }}</span>
                                        </div>
                                    </div> <!-- .card-body -->
                                    <div class="card-footer bg-transparent border-0 fname">
                                        <strong>{{ $galeri->caption }}</strong>
                                    </div> <!-- .card-footer -->
                                </div> <!-- .card -->
                            </div> <!-- .col -->
                            @endforeach
                        </div> <!-- .row -->
                    </div> <!-- .file-panel -->
                    <div class="info-panel">
                        <div class="info-content p-3 border-left hasStickOnScroll">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-fill">
                                    <span class="circle circle-sm bg-white mr-2">
                                        <span class="fe fe-image fe-12 text-success"></span>
                                    </span>
                                    {{-- <span class="h6">Creative Logo.PNG</span> --}}
                                </div>
                                <span class="btn close-info">
                                    <i class="fe fe-x"></i>
                                </span>
                            </div>
                            <div class="tab-content" id="file-tabs">
                                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="tab-detail">
                                    <img src="" alt="..." class="img-fluid rounded gambar-detail">
                                    <dl class="row my-4 small">
                                        <dt class="col-6 text-muted">Caption</dt>
                                        <dd class="col-6 gambar-caption"></dd>
                                        <dt class="col-6 text-muted">Type</dt>
                                        <dd class="col-6 gambar-type"></dd>
                                        <dt class="col-6 text-muted">Size</dt>
                                        <dd class="col-6 gambar-size"></dd>
                                        <dt class="col-6 text-muted">Created at</dt>
                                        <dd class="col-6 gambar-created"></dd>
                                        <dt class="col-6 text-muted">Last update</dt>
                                        <dd class="col-6 gambar-updated"></dd>
                                    </dl>
                                </div>
                            </div> <!-- .tab-content -->
                        </div>
                    </div>
                </div> <!-- .file-container -->
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div>

<div class="modal fade" id="addFotoModal" tabindex="-1" role="dialog" aria-labelledby="addFotoModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFotoModalLabel">Upload Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/galeri" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="jurusan_id">Kategori Gambar Jurusan</label>
                    <select class="custom-select {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" id="jurusan_id" name="jurusan_id" required>
                        <option value="">==Pilih==</option>
                        @foreach ($jurusan as $value)
                            @if (old('jurusan_id') == $value->id)
                                <option value="{{ $value->id }}" selected>{{ $value->nama }}</option>
                            @endif
                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <label for="gambar">Gambar <small><i class="text-danger">(Gambar harus format PNG/JPG)</i></small></label>
                <div class="custom-file mb-3">
                    <input name="gambar" type="file" class="custom-file-input {{$errors->first('gambar') ? "is-invalid" : "" }}" id="gambar" required>
                    <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="caption" class="col-form-label">Caption</label>
                    <input name="caption" type="text" class="form-control {{$errors->first('caption') ? "is-invalid" : "" }}" id="caption" maxlength="32" required>
                    @error('caption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="close" class="btn mb-2 btn-secondary" data-dismiss="modal"><span class="fe fe-x"></span> Tutup</button>
                <button type="submit" class="btn mb-2 btn-primary"><span class="fe fe-save"></span> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    let showDetail = document.querySelector('.show-detail');

    const imgDetail = document.querySelector('.gambar-detail');
    const imgCaption = document.querySelector('.gambar-caption');
    const imgType = document.querySelector('.gambar-type');
    const imgSize = document.querySelector('.gambar-size');
    const imgCreated = document.querySelector('.gambar-created');
    const imgUpdated = document.querySelector('.gambar-updated');

        showDetail.addEventListener('click', (e) =>{
            if(e.target.classList.contains('galeri') || e.target.classList.contains('gambar')){
                imgDetail.src = e.target.src;
                imgCaption.innerHTML = e.target.dataset.caption;
                imgType.innerHTML = e.target.dataset.type;
                imgSize.innerHTML = e.target.dataset.size + ' MB';
                imgCreated.innerHTML = e.target.dataset.created;
                imgUpdated.innerHTML = e.target.dataset.updated;
            }
        });
</script>
@endsection
