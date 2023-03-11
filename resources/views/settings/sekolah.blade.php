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
                            <strong class="card-title">Pengaturan Sekolah</strong>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/sekolah/{{$sekolah->id}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control {{$errors->first('nama_sekolah') ? "is-invalid" : "" }}" id="nama_sekolah" name="nama_sekolah" value="{{ $sekolah->nama_sekolah }}" required>
                                    @error('nama_sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kepala_sekolah" class="form-label">Nama Kepala Sekolah</label>
                                    <input type="text" class="form-control {{$errors->first('kepala_sekolah') ? "is-invalid" : "" }}" id="kepala_sekolah" name="kepala_sekolah" value="{{ $sekolah->kepala_sekolah }}" required>
                                    @error('kepala_sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat Sekolah</label>
                                    <textarea class="form-control {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2" required>{{old('alamat', $sekolah->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-row mb-3">
                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="email-add">Email</span>
                                        </div>
                                        <input value="{{old('email', $sekolah->email)}}" type="email" name="email" class="form-control {{$errors->first('email') ? "is-invalid" : "" }}" placeholder="user@example.com" aria-label="Email" aria-describedby="email-add" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="telepon-add">Telepon</span>
                                        </div>
                                        <input id="no_telepon" type="tel" name="no_telepon" class="form-control {{$errors->first('no_telepon') ? "is-invalid" : "" }}" value="{{ old('no_telepon', $sekolah->no_telepon ) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' aria-describedby="telepon-add" required>
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <h6>Link Media Sosial</h6>
                                <div class="input-group mb-3 mt-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="ig-add"><i class="fe fe-instagram text-warning"></i></span>
                                    </div>
                                    <input type="text" name="link_instagram" class="form-control {{$errors->first('link_instagram') ? "is-invalid" : "" }}" placeholder="https://" aria-label="Instagram" aria-describedby="ig-add" value="{{old('link_instagram', $sekolah->link_instagram)}}" required>
                                    @error('link_instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="fb-add"><i class="fe fe-facebook text-primary"></i></span>
                                    </div>
                                    <input type="text" name="link_facebook" class="form-control {{$errors->first('link_facebook') ? "is-invalid" : "" }}" placeholder="https://" aria-label="Facebook" aria-describedby="fb-add" value="{{old('link_facebook', $sekolah->link_facebook)}}" required>
                                    @error('link_facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="yt-add"><i class="fe fe-youtube text-danger"></i></span>
                                    </div>
                                    <input type="text" name="link_youtube" class="form-control {{$errors->first('link_youtube') ? "is-invalid" : "" }}" placeholder="https://" aria-label="Youtube" aria-describedby="yt-add" value="{{old('link_youtube', $sekolah->link_youtube)}}" required>
                                    @error('link_youtube')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-row mb-3 mt-5">
                                    <div class="col-sm-3">
                                        <input name="oldLogo" type="hidden" class="form-control" value="{{$sekolah->logo}}">
                                        <img src="{{asset('storage/' . $sekolah->logo)}}" class="img-thumbnail" width="150">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file mb-3">
                                            <input name="logo" type="file" class="custom-file-input {{$errors->first('logo') ? "is-invalid" : "" }}" id="logo">
                                            <label class="custom-file-label" for="file">Ganti Logo</label>
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-sm-3">
                                        <input name="oldPavicon" type="hidden" class="form-control" value="{{$sekolah->pavicon}}">
                                        <img id="paviconView" src="{{asset('storage/' . $sekolah->pavicon)}}" class="img-thumbnail" width="150">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file mb-3">
                                            <input name="pavicon" type="file" class="custom-file-input {{$errors->first('pavicon') ? "is-invalid" : "" }}" id="pavicon">
                                            <label class="custom-file-label" for="file">Ganti Pavicon</label>
                                            @error('pavicon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit"><span class="fe fe-save"></span> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection