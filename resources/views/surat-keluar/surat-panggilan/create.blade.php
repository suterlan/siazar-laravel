@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Buat Surat Panggilan </strong></h3>
                    <p>Silahkan isi form dibawah untuk membuat surat panggilan baru</p>
                    <form class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" action="/dashboard/suratkeluar/panggilan" method="post" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                {{-- <input type="hidden" name="jenis" id="jenis" value="{{ $jenis }}"> --}}
                                <Label for="klasifikasi">Pilih Klasifikasi</Label>
                                <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" onchange="nomorSurat()" required>
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
                                <p class="text-info" style="font-size: 80%"><span class="fe fe-info"></span> Nomor surat akan diisi otomatis saat memilih klasifikasi</p>
                                <input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat') }}" readonly required>
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input id="nama_siswa" type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}" required>
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas">Kelas</label>
                            <input id="kelas" type="text" name="kelas" class="form-control" value="{{ old('kelas') }}" placeholder="X, XI, XII..." required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="wali_kelas">Wali Kelas</label>
                            <input id="wali_kelas" type="text" name="wali_kelas" class="form-control" value="{{ old('wali_kelas') }}" required>
                            @error('wali_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="hari_tgl">Hari, Tanggal</label>
                            <input id="hari_tgl" type="text" name="hari_tgl" class="form-control" value="{{ old('hari_tgl') }}" required>
                            @error('hari_tgl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="waktu">Waktu</label>
                            <input id="waktu" type="text" name="waktu" class="form-control" value="{{ old('waktu') }}" required>
                            @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="masalah">Masalah</label>
                            <input id="masalah" type="text" name="masalah" class="form-control" value="{{ old('masalah') }}" required>
                            @error('masalah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <button class="btn btn-primary" type="submit"><span class="fe fe-save"></span> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function nomorSurat(){
        const kode = document.querySelector('#klasifikasi');
        const noSurat = document.querySelector('#no_surat');
        // console.log(kode.value);
        fetch('/getCodeKlasifikasi?kode=' + kode.value)
        .then(response => response.json())
        .then(data => noSurat.value = data.no_surat)
    };

</script>
@endsection
