@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Buat Surat Mutasi </strong></h3>
                    <p>Silahkan isi form dibawah untuk membuat surat mutasi siswa</p>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/mutasi" method="post" novalidate>
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
                        <div class="alert alert-warning" role="alert">
                        <span class="fe fe-alert-triangle fe-16 mr-2"></span> <b>Pastikan Siswa yang dipilih sudah benar!</b> karena setelah surat mutasi dibuat, data Siswa yang dipilih akan di mutasikan dan dihapus dari data Siswa!</div>
                        <div class="form-group mb-3">
                            <label for="kelas">Kelas</label>
                            <select class="form-control {{$errors->first('kelas') ? "is-invalid" : "" }}" id="kelas" name="kelas" required>
                                <option value="">==Pilih Kelas==</option>
                                @foreach ($kelas as $value)
                                    @if (old('kelas') == $value->nama . '-' . $value->jurusan->nama)
                                        <option value="{{ $value->nama . '-' . $value->jurusan->nama }}" data-id="{{ $value->id }}" selected>{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                    @else
                                        <option value="{{ $value->nama . '-' . $value->jurusan->nama }}" data-id="{{ $value->id }}">{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group mb-3 col-lg-6">
                                <label for="nama_siswa">Nama Siswa</label>
                                <select class="form-control {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" id="nama_siswa" name="nama_siswa" required>
                                    @if(old('nama_siswa'))
                                        <option value="{{ old('nama_siswa') }}">{{ old('nama_siswa') }}</option>
                                    @endif
                                    {{-- render from js --}}
                                </select>
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
                        <div class="form-row">
                            <div class="form-group mb-3 col-md-6">
                                <label for="nisn">NISN</label>
                                <input id="nisn" type="tel" name="nisn" class="form-control" value="{{ old('nisn') }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' readonly required>
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label for="jk">Jenis Kelamin</label>
                                <input id="jk" type="text" name="jk" class="form-control" value="{{ old('jk') }}" required>
                                @error('jk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="4" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun_pelajaran">Tahun Pelajaran</label>
                            <input id="tahun_pelajaran" type="text" name="tahun_pelajaran" class="form-control" value="{{ date('Y') . '/' . date('Y')+1 }}" placeholder="20xx/20xx" maxlength="9" required>
                            @error('tahun_pelajaran')
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
                                <label for="ttl_ayah">Tgl Lahir Ayah</label>
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
                                <label for="ttl_ibu">Tgl Lahir Ibu</label>
                                <input id="ttl_ibu" type="text" name="ttl_ibu" class="form-control" value="{{ old('ttl_ibu') }}" placeholder="Cianjur, ...." required>
                                @error('ttl_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alasan_pindah">Alasan Pindah</label>
                            <input id="alasan_pindah" type="text" name="alasan_pindah" class="form-control" value="{{ old('alasan_pindah') }}" required>
                            @error('alasan_pindah')
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

     function getFetch(link, id) {
        return fetch(link + id)
            .then((response) => response.json())
            .then((response) => response);
    }

    const selectKelas = document.querySelector('#kelas');
    const selectSiswa = document.querySelector('#nama_siswa');

    selectKelas.addEventListener('change', async (e) => {
        let idKelas = e.target.options[e.target.selectedIndex].dataset.id;
        // console.log(idKelas);
        const siswa = await getFetch("/get-siswa-mutasi?kelas_id=", idKelas);
        // console.log(siswa);
        setOptionSiswa(siswa, selectSiswa);
    });

    function setOptionSiswa(siswa, selectSiswa){
        let options = "";
        options += `<option value="">-- Pilih Siswa --</option>`;
        siswa.forEach(
            (i) => (options += `<option value="${i.nama_siswa}" data-id="${i.id}">${i.nama_siswa}</option>`)
        );
        selectSiswa.innerHTML = options;
    }

    selectSiswa.addEventListener('change', async (e) => {
        const nisn = document.querySelector('#nisn');
        const jk = document.querySelector('#jk');
        const alamat = document.querySelector('#alamat');
        const ttl = document.querySelector('#ttl');
        const nama_ayah = document.querySelector('#nama_ayah');
        const ttl_ayah = document.querySelector('#ttl_ayah');
        const pekerjaan = document.querySelector('#pekerjaan');
        const nama_ibu = document.querySelector('#nama_ibu');
        const ttl_ibu = document.querySelector('#ttl_ibu');

        let idSiswa = e.target.options[e.target.selectedIndex].dataset.id;
        // console.log(idSiswa);
        const detailSiswa = await getFetch("/get-detail-siswa-mutasi?id=", idSiswa);
        // console.log(detailSiswa);
        const format_options = { year: 'numeric', month: 'long', day: '2-digit' };
        const tgl_lahir_format = new Date(detailSiswa.tgl_lahir).toLocaleDateString('id', format_options);
        const tgl_lahir_ayah_format = new Date(detailSiswa.tgl_lahir_ayah).toLocaleDateString('id', format_options);
        const tgl_lahir_ibu_format = new Date(detailSiswa.tgl_lahir_ibu).toLocaleDateString('id', format_options);

        ttl.value = detailSiswa.tempat_lahir + ', ' + tgl_lahir_format;
        nisn.value = detailSiswa.nisn;
        alamat.innerHTML = detailSiswa.alamat;
        jk.value = detailSiswa.jk;
        nama_ayah.value = detailSiswa.nama_ayah;
        ttl_ayah.value = tgl_lahir_ayah_format;
        pekerjaan.value = detailSiswa.pekerjaan_ayah;
        nama_ibu.value = detailSiswa.nama_ibu;
        ttl_ibu.value = tgl_lahir_ibu_format;
    });

</script>
@endsection
