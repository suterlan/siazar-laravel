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
                                    <option value="">== Pilih Guru ==</option>
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
                                <select id="kode_mapel" name="kode_mapel" class="form-control select2 {{$errors->first('kode_mapel') ? "is-invalid" : "" }}" required>
                                    @if (old('kode_mapel'))
                                        <option value="{{ old('kode_mapel')}}" selected>{{ old('kode_mapel')}}</option>
                                    @endif
                                </select>
                                @error('kode_mapel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <select class="form-control select2 {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                                    <option value="">== Pilih Kelas ==</option>
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
                                <input class="form-control" id="jam" type="number" name="jam" placeholder="0" min="0">
                                <div class="input-group-append">
                                <span class="input-group-text" id="jam">Jam</span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input class="form-control input-tahun-ajaran col-lg-6" id="tahun_ajaran" type="text" name="tahun_ajaran" placeholder="____/____" maxlength="9" required>
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

