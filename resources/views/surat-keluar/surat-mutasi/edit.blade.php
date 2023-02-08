@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Edit surat mutasi </strong></h3>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/mutasi/{{ $surat->id }}" method="post" novalidate>
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
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input id="nama_siswa" type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa', $surat->nama_siswa) }}" required>
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label for="ttl">Tempat, Tgl Lahir</label>
                                <input id="ttl" type="text" name="ttl" class="form-control" value="{{ old('ttl', $surat->ttl) }}" placeholder="Cianjur, ...." required>
                                @error('ttl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nisn">NISN</label>
                            <input id="nisn" type="tel" name="nisn" class="form-control" value="{{ old('nisn', $surat->nisn) }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="jk">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="form-control select2" required>
                                <option value="">&nbsp;</option>
                                <option value="Laki-laki" @if ($surat->jk=='Laki-laki') selected @endif>Laki-laki</option>
                                <option value="Perempuan" @if ($surat->jk=='Perempuan') selected @endif>Perempuan</option>
                            </select>
                            @error('jk')
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
                            <label for="tahun_pelajaran">Tahun Pelajaran</label>
                            <input id="tahun_pelajaran" type="text" name="tahun_pelajaran" class="form-control" value="{{ $surat->tahun_pelajaran }}" placeholder="20xx/20xx" maxlength="9" required>
                            @error('tahun_pelajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="4" required>{{ old('alamat', $surat->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alasan_pindah">Alasan Pindah</label>
                            <input id="alasan_pindah" type="text" name="alasan_pindah" class="form-control" value="{{ old('alasan_pindah', $surat->alasan_pindah) }}" required>
                            @error('alasan_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h3>Data Orang Tua</h3>
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_ayah">Nama Ayah / Wali</label>
                                <input id="nama_ayah" type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $surat->nama_ayah) }}" required>
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label for="ttl_ayah">Tempat, Tgl Lahir Ayah</label>
                                <input id="ttl_ayah" type="text" name="ttl_ayah" class="form-control" value="{{ old('ttl_ayah', $surat->ttl_ayah) }}" placeholder="Cianjur, ...." required>
                                @error('ttl_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input id="pekerjaan" type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $surat->pekerjaan) }}" placeholder="....." required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input id="nama_ibu" type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $surat->nama_ibu) }}" required>
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label for="ttl_ibu">Tempat, Tgl Lahir Ibu</label>
                                <input id="ttl_ibu" type="text" name="ttl_ibu" class="form-control" value="{{ old('ttl_ibu', $surat->ttl_ibu) }}" placeholder="Cianjur, ...." required>
                                @error('ttl_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
