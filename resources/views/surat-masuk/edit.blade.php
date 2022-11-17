@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <strong>Edit Surat masuk</strong>
                    <p>Silahkan edit data surat yang masuk</p>
                    <form class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" action="/dashboard/suratmasuk/{{ $surat->id }}" method="post" enctype="multipart/form-data" novalidate>
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <Label for="klasifikasi">Pilih Klasifikasi</Label>
                                <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" onchange="nomorSurat()" required>
                                    @foreach ($klasifikasi as $klasifikasi )
                                        @if (old('klasifikasi_id', $surat->klasifikasi_id) == $klasifikasi->id)
                                            <option value="{{ $klasifikasi->id }}" selected>{{ $klasifikasi->nama }}</option>
                                        @else
                                            <option value="{{ $klasifikasi->id }}">{{ $klasifikasi->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('klasifikasi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal_surat">Tanggal Surat</label>
                                <div class="input-group">
                                    <input name="tanggal_surat" type="text" class="form-control drgpicker" id="tanggal_surat" aria-describedby="button-addon-date" value="{{ $surat->tanggal_surat }}" required>
                                    <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="no_surat">Nomor Surat</label>
                                    <input name="no_surat" id="no_surat" type="text" class="form-control" value="{{ old('no_surat', $surat->no_surat) }}" required>
                                    @error('no_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal_diterima">Tanggal Diterima</label>
                                <div class="input-group">
                                    <input name="tanggal_diterima" type="text" class="form-control drgpicker" id="tanggal_diterima" value="{{ $surat->tanggal_diterima }}" aria-describedby="button-addon-date2" required>
                                    <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date2"><span class="fe fe-calendar fe-16"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="asal_surat">Asal Surat</label>
                            <input id="asal_surat" type="text" name="asal_surat" class="form-control" value="{{ old('asal_surat', $surat->asal_surat) }}" required>
                            @error('asal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi / Isi surat</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control" maxlength="255" rows="4"> {{ old('deskripsi', $surat->deskripsi) }} </textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>Preview File</div>
                        <iframe class="d-block" src="{{ asset('storage/' . $surat->file) }}" frameborder="0"></iframe><br>
                        <input type="hidden" name="oldFile" value="{{ $surat->file }}">
                        <label for="file">Ganti File Hasil Scan</label>
                        <p class="text-danger" style="font-size: 80%">* Jika diganti file sebelumnya akan terhapus!, * file harus format PDF!</p>
                        <div class="custom-file mb-3">
                            <input name="file" type="file" class="custom-file-input" id="file" @error('file') required @enderror>
                            <label class="custom-file-label" for="file"></label>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input id="keterangan" type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $surat->keterangan) }}">
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
