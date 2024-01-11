@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <strong class="card-title">Detail Mapel {{ $mapel->nama }}</strong>
                        </div>
                        <form action="/dashboard/mapel/{{ $mapel->id }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                            @method('put')
                            @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="kode">Kode</label>
                                <input name="kode" id="kode" type="text" class="form-control {{$errors->first('kode') ? "is-invalid" : "" }}" value="{{ old('kode', $mapel->kode) }}" maxlength="32" required>
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama">Nama</label>
                                <input name="nama" id="nama" type="text" class="form-control {{$errors->first('name') ? "is-invalid" : "" }}" value="{{ old('nama', $mapel->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="jenis" class="form-label">Jenis</label>
                                <input type="text" list="jenis" name="jenis" value="{{ old('jenis', $mapel->jenis) }}" class="form-control {{$errors->first('jenis') ? "is-invalid" : "" }}" required />
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
                            <div class="card-deck my-2">
                                <div class="card shadow">
                                    <div class="card-header">Capaian Pembelajaran (CP) / KD </div>
                                    <div class="card-body text-center mb-2 pt-0">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($mapel->dokumen_ajar->cp))
                                                <iframe src="{{ asset('storage/' . $mapel->dokumen_ajar->cp) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                            <label for="cp">Ubah Capaian Pembelajaran (CP) / KD <small><i class="text-warning">(File harus format PDF)</i></small></label>
                            <div class="custom-file mb-2">
                                <input type="hidden" name="old_cp" value="{{ $mapel->dokumen_ajar->cp }}">
                                <input name="cp" type="file" class="custom-file-input" id="cp">
                                <label class="custom-file-label" for="file">Pilih File</label>
                                @error('cp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="card-deck my-2">
                                <div class="card shadow">
                                    <div class="card-header">Alur Tujuan Pembelajaran (ATP) / Silabus </div>
                                    <div class="card-body text-center pt-0">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($mapel->dokumen_ajar->atp))
                                                <iframe src="{{ asset('storage/' . $mapel->dokumen_ajar->atp) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                            <label for="atp">Ubah Alur Tujuan Pembelajaran (ATP) / Silabus <small><i class="text-warning">(File harus format PDF)</i></small></label>
                            <div class="custom-file mb-2">
                                <input type="hidden" name="old_atp" value="{{ $mapel->dokumen_ajar->atp }}">
                                <input name="atp" type="file" class="custom-file-input" id="atp">
                                <label class="custom-file-label" for="file">Pilih File</label>
                                @error('atp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="card-deck my-2">
                                <div class="card shadow">
                                    <div class="card-header">Modul Ajar / RPP </div>
                                    <div class="card-body text-center pt-0">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($mapel->dokumen_ajar->ma))
                                                <iframe src="{{ asset('storage/' . $mapel->dokumen_ajar->ma) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                            <label for="ma">Ubah Modul Ajar / RPP <small><i class="text-warning">(File harus format PDF)</i></small></label>
                            <div class="custom-file mb-0">
                                <input type="hidden" name="old_ma" value="{{ $mapel->dokumen_ajar->ma }}">
                                <input name="ma" type="file" class="custom-file-input" id="ma">
                                <label class="custom-file-label" for="file">Pilih File</label>
                                @error('ma')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/dashboard/mapel" class="btn btn-danger"><span class="fe fe-arrow-left fe-16"></span> Kembali</a>
                            <button type="submit" class="btn btn-success float-right mb-3"><span class="fe fe-save fe-16"></span> Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
