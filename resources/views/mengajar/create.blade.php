@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <strong class="card-title">Tambah Jam Mengajar</strong>
                        </div>
                        <form action="/dashboard/mengajar" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                            @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <select id="guru_id" name="guru_id" class="custom-select {{$errors->first('guru_id') ? "is-invalid" : "" }}" required>
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($gurus as $guru )
                                        @if (old('guru_id') == $guru->id)
                                            <option value="{{ $guru->id }}" data-id="{{ $guru->id }}" selected>{{ $guru->nama }}</option>
                                        @else
                                            <option value="{{ $guru->id }}" data-id="{{ $guru->id }}">{{ $guru->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <select id="mapel_id" name="mapel_id" class="form-control select2 {{$errors->first('mapel_id') ? "is-invalid" : "" }}" required>
                                    <option value="">-- Pilih Mapel --</option>
                                    @foreach ($mapels as $mapel)
                                        <option value="{{ $mapel->id }}" @selected(old('mapel_id') == $mapel->id)>{{ $mapel->nama }}</option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <select class="form-control select2 {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $value)
                                        @if (old('kelas_id') == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                        @endif
                                     @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control {{$errors->first('jam') ? "is-invalid" : "" }}" id="jam" type="number" name="jam" value="{{ old('jam') }}" min="0" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="jam">Jam</span>
                                </div>
                                @error('jam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input class="form-control input-tahun-ajaran {{$errors->first('tahun_ajaran') ? "is-invalid" : "" }}" id="tahun_ajaran" type="text" name="tahun_ajaran" placeholder="____/____" maxlength="9" required>
                                    @error('tahun_ajaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="form-control {{$errors->first('semester') ? "is-invalid" : "" }}" required>
                                        <option value="">-- Semester --</option>
                                        <option value="Ganjil">Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    </select>
                                    @error('semester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/dashboard/mengajar" class="btn btn-danger"><span class="fe fe-arrow-left fe-16"></span> Kembali</a>
                            <button type="submit" class="btn btn-primary float-right mb-3"><span class="fe fe-save fe-16"></span> Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

