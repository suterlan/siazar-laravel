@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <strong class="card-title">Edit Anggota Organisasi</strong>
                        </div>
                        <form action="/dashboard/struktur-organisasi/{{ $struktur->id }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                            @method('put')
                            @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="jabatan">Jabatan</label>
                                <input name="jabatan" id="jabatan" type="text" class="form-control {{$errors->first('name') ? "is-invalid" : "" }}" value="{{ old('jabatan', $struktur->jabatan) }}" maxlength="100" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <Label for="guru_id">Nama Anggota </Label>
                                <select id="guru_id" name="guru_id" class="form-control select2 {{$errors->first('guru_id') ? "is-invalid" : "" }}" required>
                                    <option value="">&nbsp;</option>
                                    @foreach ($gurus as $guru )
                                        @if (old('guru_id', $struktur->guru_id) == $guru->id)
                                            <option value="{{ $guru->id }}" selected>{{ $guru->nama }}</option>
                                        @else
                                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="keterangan">keterangan</label>
                                <input name="keterangan" id="keterangan" type="text" class="form-control {{$errors->first('keterangan') ? "is-invalid" : "" }}" value="{{ old('keterangan', $struktur->keterangan) }}" maxlength="100" required>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/dashboard/struktur-organisasi" class="btn btn-danger"><span class="fe fe-arrow-left fe-16"></span> Kembali</a>
                            <button type="submit" class="btn btn-primary float-right mb-3"><span class="fe fe-save fe-16"></span> Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
