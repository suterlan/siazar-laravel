@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">Edit Klasifikasi Surat</div>
                    <div class="card-body">
                        <form action="/dashboard/surat/klasifikasi/{{ $klasifikasi->id }}" method="post" class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" >
                            @method('put')
                            @csrf
                            <div class="form-group mb-1">
                                <label for="kode" class="col-form-label">Kode Klasifikasi:</label>
                                <input name="kode" type="text" class="form-control" id="kode" maxlength="10" value="{{ old('kode', $klasifikasi->kode) }}" required>
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="nama" class="col-form-label">Nama Klasifikasi:</label>
                                <input name="nama" type="text" class="form-control" id="nama" value="{{ old('nama', $klasifikasi->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control" id="message-text" rows="4">{{ old('deskripsi', $klasifikasi->deskripsi) }}</textarea>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
