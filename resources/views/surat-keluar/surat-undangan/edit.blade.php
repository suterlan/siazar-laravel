@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Edit Surat Undangan </strong></h3>
                    <form class="needs-validation  @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/undangan/{{ $surat->id }}" method="post" novalidate>
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                {{-- <input type="hidden" name="jenis" id="jenis" value="{{ $jenis }}"> --}}
                                <Label for="klasifikasi">Pilih Klasifikasi</Label>
                                <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" onchange="changeKlasifikasi()" required>
                                    <option value="">&nbsp;</option>
                                    @foreach ($klasifikasi as $klasifikasi )
                                        @if (old('klasifikasi_id', $surat->suratkeluar->klasifikasi_id) == $klasifikasi->id)
                                            <option value="{{ $klasifikasi->id }}" data-kode="{{ $klasifikasi->kode }}" selected>{{ $klasifikasi->nama }}</option>
                                        @else
                                            <option value="{{ $klasifikasi->id }}" data-kode="{{ $klasifikasi->kode }}">{{ $klasifikasi->nama }}</option>
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
                                    <input name="tanggal_surat" type="text" class="form-control drgpicker" id="tanggal_surat" value="{{ $surat->suratkeluar->tanggal_surat }}" aria-describedby="button-addon-date" required>
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
                                <input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat', $surat->no_surat) }}" readonly required>
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kegiatan">Kegiatan / Acara</label>
                            <input id="kegiatan" type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan', $surat->kegiatan) }}" required>
                            @error('kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="ketua_panitia">Ketua Panitia <span class="text-danger">(Kosongkan jika tidak ada!)</span></label>
                            <input id="ketua_panitia" type="text" name="ketua_panitia" class="form-control" value="{{ old('ketua_panitia', $surat->ketua_panitia) }}" required>
                            @error('ketua_panitia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <div class="form-group mb-3">
                                    <label for="tanggal_acara">Hari/Tanggal</label>
                                    <div class="input-group">
                                        <input name="tanggal_acara" type="text" class="form-control drgpicker" id="tanggal_acara" value="{{ \Carbon\Carbon::parse($surat->tanggal_acara)->translatedFormat('Y/m/d') }}" aria-describedby="button-addon-date" required>
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
                                        <input name="waktu" type="time" value="{{ \Carbon\Carbon::parse($surat->waktu)->translatedFormat('H:i') }}" class="form-control" id="waktu" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="tempat">Tempat</label>
                                    <input id="tempat" type="text" name="tempat" class="form-control" value="{{ old('tempat', $surat->tempat) }}" required>
                                    @error('tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="penerima">Penerima</label>
                            <input id="penerima" type="text" name="penerima" class="form-control" value="{{ old('penerima', $surat->penerima) }}" required>
                            @error('penerima')
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
    function changeKlasifikasi(){
        const klasifikasi = document.querySelector('#klasifikasi');
        const noSurat = document.querySelector('#no_surat');
        // split no surat untuk menghilangkan simbol '/' dan mengubahnya jadi array
        arrSurat = noSurat.value.split('/');
        // ganti array no surat index ke-1 yang merupakan id dari klasifikasi
        arrSurat[1] = klasifikasi.options[klasifikasi.selectedIndex].dataset.kode;
        // simpan perubahan pada variabel newNoSurat
        const newNoSurat = arrSurat.join('/');
        // ganti isi nomor surat dengan no surat baru
        noSurat.value = newNoSurat;
    }

</script>
@endsection
