@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Edit Surat Panggilan </strong></h3>
                    <form class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" action="/dashboard/surat/panggilan/{{ $surat->id }}" method="post" novalidate>
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
                            <label for="nama_siswa">Nama Siswa</label>
                            <input id="nama_siswa" type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa', $surat->nama_siswa) }}" required>
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas">Kelas</label>
                            <input id="kelas" type="text" name="kelas" class="form-control" value="{{ old('kelas', $surat->kelas) }}" placeholder="X, XI, XII..." required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="wali_kelas">Wali Kelas</label>
                            <input id="wali_kelas" type="text" name="wali_kelas" class="form-control" value="{{ old('wali_kelas', $surat->wali_kelas) }}" required>
                            @error('wali_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="hari_tgl">Hari, Tanggal</label>
                            <input id="hari_tgl" type="text" name="hari_tgl" class="form-control" value="{{ old('hari_tgl', $surat->hari_tgl) }}" required>
                            @error('hari_tgl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="waktu">Waktu</label>
                            <input id="waktu" type="text" name="waktu" class="form-control" value="{{ old('waktu', $surat->waktu) }}" required>
                            @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="masalah">Masalah</label>
                            <input id="masalah" type="text" name="masalah" class="form-control" value="{{ old('masalah', $surat->masalah) }}" required>
                            @error('masalah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <button class="btn btn-success" type="submit"><span class="fe fe-save"></span> Update</button>
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
