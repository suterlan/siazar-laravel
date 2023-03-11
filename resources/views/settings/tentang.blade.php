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
                            <strong class="card-title">Pengaturan Tentang</strong>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/settings-tentang/{{$tentang->id}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="sambutan">Sambutan</label>
                                    @error('sambutan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" name="sambutan" value="{{ old('sambutan', $tentang->sambutan) }}">
                                    <div id="sambutan" style="min-height: 150px">{!! old('sambutan', $tentang->sambutan) !!}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="visi">Visi</label>
                                    <textarea class="form-control {{$errors->first('visi') ? "is-invalid" : "" }}" id="visi" name="visi" rows="2" maxlength="255" required>{{old('visi', $tentang->visi) }}</textarea>
                                    @error('visi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="misi">Misi</label>
                                    @error('misi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" name="misi" value="{{ old('misi', $tentang->misi) }}">
                                    <div id="misi" style="min-height: 120px">{!! old('misi', $tentang->misi) !!}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control {{$errors->first('deskripsi') ? "is-invalid" : "" }}" id="deskripsi" name="deskripsi" rows="2" maxlength="255">{{old('deskripsi', $tentang->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label>Gambar 1</label>
                                @if ($tentang->gambar_1)
                                    <img src="{{asset('storage/'. $tentang->gambar_1)}}" class="img-preview-1 img-fluid mb-3 col-sm-4 d-block">
                                @else
                                    <img class="img-preview-1 img-fluid mb-3 col-sm-4">
                                @endif
                                <div class="custom-file mb-3">
                                    <input type="hidden" name="oldGambar1" class="form-control" value="{{$tentang->gambar_1}}">
                                    <input name="gambar_1" type="file" class="custom-file-input {{$errors->first('gambar_1') ? "is-invalid" : "" }}" id="gambar_1" onchange="previewImage('#gambar_1', 'img-preview-1')">
                                    <label class="custom-file-label" for="file">Pilih Gambar</label>
                                    @error('gambar_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label>Gambar 2</label>
                                @if ($tentang->gambar_2)
                                    <img src="{{asset('storage/'. $tentang->gambar_2)}}" class="img-preview-2 img-fluid mb-3 col-sm-4 d-block">
                                @else
                                    <img class="img-preview-2 img-fluid mb-3 col-sm-4">
                                @endif
                                <div class="custom-file mb-3">
                                    <input type="hidden" name="oldGambar2" class="form-control" value="{{$tentang->gambar_2}}">
                                    <input name="gambar_2" type="file" class="custom-file-input {{$errors->first('gambar_2') ? "is-invalid" : "" }}" id="gambar_2" onchange="previewImage('#gambar_2', 'img-preview-2')">
                                    <label class="custom-file-label" for="file">Pilih Gambar</label>
                                    @error('gambar_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label>Video</label>
                                @if ($tentang->video)
                                    <video src="{{asset('storage/'. $tentang->video)}}" class="video-preview col-sm-5 d-block mb-3" type="video/mp4" controls></video>
                                @else
                                    <video class="video-preview col-sm-5 d-block mb-3" type="video/mp4" controls></video>
                                @endif
                                <div class="custom-file mb-3">
                                    <input type="hidden" name="oldVideo" class="form-control" value="{{$tentang->video}}">
                                    <input name="video" type="file" class="custom-file-input {{$errors->first('video') ? "is-invalid" : "" }}" id="video" onchange="previewImage('#video', 'video-preview')">
                                    <label class="custom-file-label" for="file">Pilih Video Mp4</label>
                                    @error('video')
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
    function previewImage(id, preview){
        const image = document.querySelector(id);
        const imgPreview = document.querySelector('.'+preview);

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection