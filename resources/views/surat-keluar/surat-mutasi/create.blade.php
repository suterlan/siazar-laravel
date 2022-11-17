@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Buat Surat Mutasi </strong></h3>
                    <p>Silahkan isi form dibawah untuk membuat surat mutasi siswa</p>
                    <form class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" action="/dashboard/surat/panggilan" method="post" novalidate>
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
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input id="nama_siswa" type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}" required>
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label for="ttl">Tempat, Tgl Lahir</label>
                                <input id="ttl" type="text" name="ttl" class="form-control" value="{{ old('ttl') }}" placeholder="Cianjur, ...." required>
                                @error('ttl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas">Kelas</label>
                            <input id="kelas" type="text" name="kelas" class="form-control" value="{{ old('kelas') }}" placeholder="X, XI, XII..." required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="jk">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="form-control select2" required>
                                <option value="">&nbsp;</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="4" required></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alasan_pindah">Alasan Pindah</label>
                            <input id="alasan_pindah" type="text" name="alasan_pindah" class="form-control" value="{{ old('alasan_pindah') }}" required>
                            @error('alasan_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h3>Data Orang Tua</h3>
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_ayah">Nama Ayah / Wali</label>
                                <input id="nama_ayah" type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" required>
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label for="ttl_ayah">Tempat, Tgl Lahir Ayah</label>
                                <input id="ttl_ayah" type="text" name="ttl_ayah" class="form-control" value="{{ old('ttl_ayah') }}" placeholder="Cianjur, ...." required>
                                @error('ttl_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input id="pekerjaan" type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" placeholder="....." required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input id="nama_ibu" type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label for="ttl_ibu">Tempat, Tgl Lahir Ibu</label>
                                <input id="ttl_ibu" type="text" name="ttl_ibu" class="form-control" value="{{ old('ttl_ibu') }}" placeholder="Cianjur, ...." required>
                                @error('ttl_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
    const kode = document.querySelector('#klasifikasi');
    const noSurat = document.querySelector('#no_surat');

    function nomorSurat(){
        // console.log(kode.value);
        fetch('/getCodeKlasifikasi?kode=' + kode.value)
        .then(response => response.json())
        .then(data => noSurat.value = data.no_surat)
    };

</script>
@endsection
