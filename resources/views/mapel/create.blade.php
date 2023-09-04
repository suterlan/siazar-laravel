@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <strong class="card-title">Tambah Mapel Baru</strong>
                        </div>
                        <form action="/dashboard/mapel" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                            @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="kode">Kode</label>
                                <input name="kode" id="kode" type="text" class="form-control {{$errors->first('kode') ? "is-invalid" : "" }}" value="{{ old('kode') }}" maxlength="32" required>
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama">Nama</label>
                                <input name="nama" id="nama" type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : "" }}" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="jenis" class="form-label">Jenis</label>
                                <input type="text" list="jenis" name="jenis" class="form-control {{$errors->first('jenis') ? "is-invalid" : "" }}" required />
                                    <datalist id="jenis">
                                        <option>Kurikulum Merdeka</option>
                                        <option>Kurikulum 13</option>
                                    </datalist>
                                @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <Label for="guru_id">Guru Mapel </Label>
                                <select id="guru_id" name="guru_id" class="form-control select2 {{$errors->first('guru_id') ? "is-invalid" : "" }}" required>
                                    <option value="">&nbsp;</option>
                                    @foreach ($gurus as $guru )
                                        @if (old('guru_id') == $guru->id)
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
                            <label for="cp">Capaian Pembelajaran (CP) / KD <small><i class="text-warning">(File harus format PDF)</i></small></label>
                            <div class="custom-file mb-2">
                                <input name="cp" type="file" class="custom-file-input" id="cp">
                                <label class="custom-file-label" for="file">Pilih File</label>
                                @error('cp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="atp">Alur Tujuan Pembelajaran (ATP) / Silabus <small><i class="text-warning">(File harus format PDF)</i></small></label>
                            <div class="custom-file mb-2">
                                <input name="atp" type="file" class="custom-file-input" id="atp">
                                <label class="custom-file-label" for="file">Pilih File</label>
                                @error('atp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="ma">Modul Ajar / RPP <small><i class="text-warning">(File harus format PDF)</i></small></label>
                            <div class="custom-file mb-0">
                                <input name="ma" type="file" class="custom-file-input" id="ma">
                                <label class="custom-file-label" for="file">Pilih File</label>
                                @error('ma')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/dashboard/mapel" class="btn btn-danger"><span class="fe fe-arrow-left fe-16"></span> Kembali</a>
                            <button type="submit" class="btn btn-primary float-right mb-3"><span class="fe fe-save fe-16"></span> Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
