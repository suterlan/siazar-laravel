@extends('website.layout.main')
@section('content')
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">PENERIMAAN PESERTA DIDIK BARU</span>
          </p>
          <h4 class="mb-4">Form Pendaftaran</h4>
          @if (session()->has('success'))
            <div class="alert alert-success col-12" role="alert">
                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
            </div>
          @endif
        </div>
        <div class="row">
            <div class="card shadow col-md-12">
                <form action="{{ route('pendaftaran.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama Lengkap <small class="text-danger">(*)</small></label>
                            <input type="text" class="form-control {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa') }}" required>
                            @error('nama_siswa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nik">NIK <small class="text-danger">(*)</small></label>
                            <input id="nik" type="tel" name="nik" class="form-control {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{ old('nik') }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nisn">NISN <small class="text-danger">(*)</small></label>
                            <input id="nisn" type="tel" name="nisn" class="form-control {{$errors->first('nisn') ? "is-invalid" : "" }}" value="{{ old('nisn') }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="10" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp">Nomor Handphone <small class="text-danger">(*)</small></label>
                            <input id="no_hp" type="tel" name="no_hp" class="form-control {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp') }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin <small class="text-danger">(*)</small></label><br>
                            <label class="radio-inline me-2" for="jk1">
                                <input type="radio" name="jk" id="jk1" class="me-2" value="Laki-laki"> Laki-laki
                            </label>
                            <label class="radio-inline" for="jk2">
                                <input type="radio" name="jk" id="jk2" class="me-2" value="Perempuan"> Perempuan
                                </label>
                            @error('jk')
                                <div class="error text-danger"><small>{{ $message }}</small> </div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="mb-3 col-sm-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">(*)</small></label>
                                <input type="text" class="form-control {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir')}}" required>
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir <small class="text-danger">(*)</small></label>
                                <input type="date" class="form-control {{$errors->first('tgl_lahir') ? "is-invalid" : "" }}" id="tgl_lahir" name="tgl_lahir" required>
                                @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="provinsi">Provinsi</label>
                            <select class="custom-select {{$errors->first('provinsi') ? "is-invalid" : "" }}" id="provinsi" name="provinsi" required>
                                <option value="">==Pilih Provinsi==</option>
                                @foreach ($provinces as $code => $name)
                                    <option value="{{ $name }}" data-code="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kabupaten">Kabupaten / Kota</label>
                            <select class="custom-select {{$errors->first('kabupaten') ? "is-invalid" : "" }}" id="kabupaten" name="kabupaten" required>
                                {{-- javascript code here --}}
                            </select>
                            @error('kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kecamatan">Kecamatan</label>
                            <select class="custom-select {{$errors->first('kecamatan') ? "is-invalid" : "" }}" id="kecamatan" name="kecamatan" required>
                                {{-- javascript code here --}}
                            </select>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="kelurahan">Desa</label>
                            <select class="custom-select {{$errors->first('kelurahan') ? "is-invalid" : "" }}" id="kelurahan" name="kelurahan" required>
                                {{-- javascript code here --}}
                            </select>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h6>DATA ORANG TUA</h6>
                        <div class="mb-3 mt-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input id="nama_ayah" name="nama_ayah" type="text" class="form-control {{$errors->first('nama_ayah') ? "is-invalid" : "" }}" value="{{old('nama_ayah')}}">
                            @error('nama_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="custom-select {{$errors->first('pekerjaan_ayah') ? "is-invalid" : "" }}" >
                                <option value="">&nbsp;</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Petani">Petani</option>
                                <option value="Pedagang">Pedagang</option>
                                <option value="Pengusaha">Pengusaha</option>
                                <option value="Buruh">Buruh</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Guru">Guru</option>
                                <option value="PNS">PNS</option>
                            </select>
                            @error('pekerjaan_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input id="nama_ibu" name="nama_ibu" type="text" class="form-control {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" value="{{old('nama_ibu')}}">
                            @error('nama_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="custom-select {{$errors->first('pekerjaan_ibu') ? "is-invalid" : "" }}" >
                                <option value="">&nbsp;</option>
                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Pedagang">Pedagang</option>
                                <option value="Pengusaha">Pengusaha</option>
                                <option value="Buruh">Buruh</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Guru">Guru</option>
                                <option value="PNS">PNS</option>
                            </select>
                            @error('pekerjaan_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah <small class="text-danger">(*)</small></label>
                            <input id="asal_sekolah" type="text" name="asal_sekolah" class="form-control {{$errors->first('asal_sekolah') ? "is-invalid" : "" }}" value="{{ old('asal_sekolah') }}" required>
                            @error('asal_sekolah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="jurusan_id">Jurusan</label>
                                <select class="custom-select {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" id="jurusan_id" name="jurusan_id" required>
                                    <option value="">==Pilih jurusan==</option>
                                    @foreach ($jurusan as $value)
                                        <option value="{{ $value->id }}">{{ $value->kode . ' - ' . $value->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kelas_id">Kelas</label>
                                <select class="custom-select {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" disabled required>
                                    {{-- from js --}}
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer mb-3 ">
                        <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function selectChange(url, code, idSelect){
        fetch(url + code)
        .then(response => response.json())
        .then(response => {
            let options = '';
            options += `<option value="">==Pilih==</option>`;
            response.forEach(i => {
                options += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`;
            });

            idSelect.innerHTML = options;
        });
    }

    let provinsi = document.querySelector('#provinsi');
    provinsi.addEventListener('change', () =>{
        let code = provinsi.options[provinsi.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kabupaten');

        selectChange('/pendaftaran/getKabupaten?code=', code, idSelect);
    });

    let kabupaten = document.querySelector('#kabupaten');
    kabupaten.addEventListener('change', () =>{
        let code = kabupaten.options[kabupaten.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kecamatan');

        selectChange('/pendaftaran/getKecamatan?code=', code, idSelect);
    });

    let kecamatan = document.querySelector('#kecamatan');
    kecamatan.addEventListener('change', () =>{
        let code = kecamatan.options[kecamatan.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kelurahan');

        selectChange('/pendaftaran/getKelurahan?code=', code, idSelect);
    });
</script>
<script>
    const selectJurusan = document.querySelector('#jurusan_id');
    const selectKelas = document.querySelector('#kelas_id');

    selectJurusan.addEventListener('change', async function() {
        const jurusanId = selectJurusan.value;

        const response = await fetch('/pendaftaran/get-kelas?jurusan_id=' + jurusanId);
        const kelas = await response.json();

        selectKelas.innerHTML = `<option value="${kelas.id}" selected>${kelas.nama}</option>`;
    });
</script>
@endsection
