@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Buat Surat Undangan </strong></h3>
                    <p>Silahkan isi form dibawah untuk membuat surat undangan baru</p>
                    @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                    @endif
                    <form class="needs-validation  @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/undangan" method="post" novalidate>
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
                            <label for="kegiatan">Kegiatan / Acara</label>
                            <input id="kegiatan" type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan') }}" required>
                            @error('kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="ketua_panitia">Ketua Panitia <span class="text-danger">(Kosongkan jika tidak ada!)</span></label>
                            <input id="ketua_panitia" type="text" name="ketua_panitia" class="form-control" value="{{ old('ketua_panitia') }}">
                            @error('ketua_panitia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <div class="form-group mb-3">
                                    <label for="tanggal_acara">Hari/Tanggal</label>
                                    <div class="input-group">
                                        <input name="tanggal_acara" type="text" class="form-control drgpicker" id="tanggal_acara" value="{{ date('Y/m/d') }}" aria-describedby="button-addon-date" required>
                                        <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <div class="form-group mb-3">
                                    <label for="waktu">Waktu</label>
                                    <div class="input-group">
                                        <input name="waktu" type="time" class="form-control" id="waktu" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="tempat">Tempat</label>
                                    <input id="tempat" type="text" name="tempat" class="form-control" value="{{ old('tempat') }}" required>
                                    @error('tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="penerima">Penerima</label>
                            <input id="penerima" type="text" name="penerima" class="form-control" value="{{ old('penerima') }}" required>
                            @error('penerima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label mt-2 mb-0">Aktifkan E-Sign 
                            <span class="text-info"><i class="fe fe-info" title="Tanda tangan elektronik menggunakan qrcode"></i></span>
                        </label>
                        <div class="form-group mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="qr_active" name="qr_active">
                                <label class="custom-control-label" for="qr_active">Aktif</label>
                            </div>
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <a href="/dashboard/suratkeluar/undangan" class="btn btn-danger"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <button class="btn btn-primary float-right" type="submit"><span class="fe fe-save"></span> Simpan</button>
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
