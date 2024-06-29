@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Tambah Surat masuk</strong></h4>
                    <p>Silahkan input data surat yang masuk sesuai form di bawah</p>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/suratmasuk" method="post" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <Label for="klasifikasi">Pilih Klasifikasi</Label>
                                <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" required>
                                    <option value="">&nbsp;</option>
                                    @foreach ($klasifikasi as $klasifikasi )
                                        @if (old('klasifikasi_id') == $klasifikasi->id)
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
                                    <input name="tanggal_surat" type="text" class="form-control drgpicker" id="tanggal_surat" value="{{ date('Y/m/d') }}" aria-describedby="button-addon-date" required>
                                    <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="no_surat">Nomor Surat</label>
                                <input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat') }}" required>
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal_diterima">Tanggal Diterima</label>
                                <div class="input-group">
                                    <input name="tanggal_diterima" type="text" class="form-control drgpicker" id="tanggal_diterima" value="{{ date('Y/m/d') }}" aria-describedby="button-addon-date" required>
                                    <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="asal_surat">Asal Surat</label>
                            <input id="asal_surat" type="text" name="asal_surat" class="form-control" value="{{ old('asal_surat') }}" required>
                            @error('asal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi / Isi surat</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control" maxlength="255" rows="4" required>{{ old('deskripsi') }} </textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="file">File Hasil Scan</label>
                        <p class="text-danger" style="font-size: 80%">*Type file harus format PDF!</p>
                        <div class="custom-file mb-3">
                            <input name="file" type="file" class="custom-file-input" id="file" @error('file') required @enderror>
                            <label class="custom-file-label" for="file">Pilih File</label>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input id="keterangan" type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}">
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    const kode = document.querySelector('#klasifikasi');
    const noSurat = document.querySelector('#no_surat');

    function nomorSurat(){
        // console.log(kode.value);
        fetch('/getCodeKlasifikasi?kode=' + kode.value)
        .then(response => response.json())
        .then(data => noSurat.value = data.no_surat)
    };

</script> --}}
@endsection
