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
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Iklan</strong>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/settings-iklan/{{ $iklan->id }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control {{$errors->first('judul') ? "is-invalid" : "" }}" value="{{ $iklan->judul }}" maxlength="64">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="informasi">Informasi</label>
                                    <textarea class="form-control {{$errors->first('informasi') ? "is-invalid" : "" }}" id="informasi" name="informasi" rows="4" maxlength="250">{{old('informasi', $iklan->informasi) }}</textarea>
                                    @error('informasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label class="d-flex mt-2" for="gambar">Gambar Banner</label>
                                <div class="form-group">
                                    <input name="oldGambar" type="hidden" class="form-control" value="{{ $iklan->gambar }}">
                                    <img src="{{ asset('storage/'. $iklan->gambar) }}" class="img-thumbnail">
                                </div>
                                <div class="form-group">
                                    <div class="custom-file mb-3">
                                        <input name="gambar" type="file" class="custom-file-input {{$errors->first('gambar') ? "is-invalid" : "" }}" id="gambar" >
                                        <label class="custom-file-label" for="file">Ganti Gambar</label>
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
