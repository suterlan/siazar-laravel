@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-center"> Edit Calon Siswa</h4>
                    </div>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/ppdb/update" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card-body pb-0">
                        <h6><span class="fe fe-list text-primary"></span> JURUSAN YANG DIMINATI</h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jurusan_id">Jurusan</label>
                                <select class="custom-select {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" id="jurusan_id" name="jurusan_id" required>
                                    <option value="">==Pilih jurusan==</option>
                                    @foreach ($jurusan as $value)
                                        @if (old('jurusan_id', $ppdb->jurusan_id) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->kode . ' - ' . $value->nama }}</option>
                                        @else
                                        <option value="{{ $value->id }}">{{ $value->kode . ' - ' . $value->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kelas_id">Kelas</label>
                                <select class="custom-select {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                                    @foreach ($kelas as $value)
                                        @if (old('kelas_id', $ppdb->kelas_id) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->nama }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <h5><span class="fe fe-user text-primary"></span> PROFIL CALON SISWA</h5>
                                <div class="form-group mb-3 mt-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$ppdb->id}}">
                                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" value="{{ old('nama_siswa', $ppdb->nama_siswa) }}" id="nama_siswa" name="nama_siswa" required>
                                    @error('nama_siswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input id="nik" type="tel" name="nik" class="form-control {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{old('nik', $ppdb->nik) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Jenis Kelamin</label><br>
                                    <label class="radio-inline me-2" for="jk1">
                                        <input type="radio" name="jk" id="jk1" class="me-2" value="Laki-laki" {{{ (isset($ppdb->jk) && $ppdb->jk == 'Laki-laki') ? "checked" : "" }}}> Laki-laki
                                    </label>
                                    <label class="radio-inline" for="jk2">
                                        <input type="radio" name="jk" id="jk2" class="me-2" value="Perempuan" {{{ (isset($ppdb->jk) && $ppdb->jk == 'Perempuan') ? "checked" : "" }}}> Perempuan
                                        </label>
                                    @error('jk')
                                        <div class="error text-danger"><small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-6">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir </label>
                                        <input type="text" class="form-control {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $ppdb->tempat_lahir) }}">
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-6">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control {{$errors->first('tgl_lahir') ? "is-invalid" : "" }}" id="tgl_lahir" name="tgl_lahir" value="{{ \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('Y-m-d') }}">
                                        @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp">Nomor Hanphone</label>
                                    <input id="no_hp" type="tel" name="no_hp" class="form-control {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp', $ppdb->no_hp ) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2">{{old('alamat', $ppdb->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="custom-select form-control {{$errors->first('provinsi') ? "is-invalid" : "" }}" id="provinsi" name="provinsi">
                                        <option value="">==Pilih Provinsi==</option>
                                        @foreach ($provinces as $code => $name)
                                            @if (old('provinsi', $ppdb->provinsi) == $name)
                                            <option value="{{ $name }}" data-code="{{ $code }}" selected>{{ $name }}</option>
                                            @else
                                            <option value="{{ $name }}" data-code="{{ $code }}">{{ $name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kabupaten">Kabupaten / Kota</label>
                                    <select class="custom-select form-control {{$errors->first('kabupaten') ? "is-invalid" : "" }}" id="kabupaten" name="kabupaten">
                                        <option value="">==Pilih Kabupaten==</option>
                                        @if (isset($ppdb->kabupaten))
                                            <option value="{{ old('kabupaten', $ppdb->kabupaten)}}" selected>{{ $ppdb->kabupaten}}</option>
                                        @endif
                                        {{-- javascript code here --}}
                                    </select>
                                    @error('kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="custom-select form-control {{$errors->first('kecamatan') ? "is-invalid" : "" }}" id="kecamatan" name="kecamatan">
                                        <option value="">==Pilih Kecamatan==</option>
                                        @if (isset($ppdb->kecamatan))
                                            <option value="{{old('kecamatan', $ppdb->kecamatan)}}" selected>{{$ppdb->kecamatan}}</option>
                                        @endif
                                        {{-- javascript code here --}}
                                    </select>
                                    @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kelurahan">Desa</label>
                                    <select class="custom-select form-control {{$errors->first('kelurahan') ? "is-invalid" : "" }}" id="kelurahan" name="kelurahan">
                                        <option value="">==Pilih Kelurahan==</option>
                                        @if (isset($ppdb->kelurahan))
                                            <option value="{{old('kelurahan', $ppdb->kelurahan)}}" selected>{{$ppdb->kelurahan}}</option>
                                        @endif
                                        {{-- javascript code here --}}
                                    </select>
                                    @error('kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jml_saudara_kandung" class="form-label">Jumlah Saudara Kandung</label>
                                    <input type="tel" name="jml_saudara_kandung" class="form-control {{$errors->first('jml_saudara_kandung') ? "is-invalid" : "" }}" id="jml_saudara_kandung" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ old('jml_saudara_kandung', $ppdb->jml_saudara_kandung) }}">
                                    @error('jml_saudara_kandung')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5><span class="fe fe-file-text text-primary"></span> DATA PENDIDIKAN CALON SISWA</h5>
                                <div class="form-group mb-3 mt-3">
                                    <label for="asal_sekolah" class="form-label">Asal Sekolah </label>
                                    <input id="asal_sekolah" type="text" name="asal_sekolah" class="form-control {{$errors->first('asal_sekolah') ? "is-invalid" : "" }}" value="{{ old('asal_sekolah', $ppdb->asal_sekolah) }}" required>
                                    @error('asal_sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nisn">NISN</label>
                                    <input id="nisn" type="tel" name="nisn" class="form-control {{$errors->first('nisn') ? "is-invalid" : "" }}" value="{{ old('nisn', $ppdb->nisn) }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="10" required>
                                    @error('nisn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_ijazah">Nomor Ijazah SMPN/MTs</label>
                                    <input id="no_ijazah" type="text" name="no_ijazah" class="form-control {{$errors->first('no_ijazah') ? "is-invalid" : "" }}" value="{{ old('no_ijazah', $ppdb->no_ijazah) }}" maxlength="16">
                                    @error('no_ijazah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_skhun">Nomor SKHUN</label>
                                    <input id="no_skhun" type="text" name="no_skhun" class="form-control {{$errors->first('no_skhun') ? "is-invalid" : "" }}" value="{{ old('no_skhun', $ppdb->no_skhun) }}" maxlength="7">
                                    @error('no_skhun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_kip">Nomor KIP</label>
                                    <input id="no_kip" type="text" name="no_kip" class="form-control {{$errors->first('no_kip') ? "is-invalid" : "" }}" value="{{ old('no_kip', $ppdb->no_kip) }}" maxlength="7">
                                    @error('no_kip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_kip" class="form-label">Nama di KIP </label>
                                    <input id="nama_kip" type="text" name="nama_kip" class="form-control {{$errors->first('nama_kip') ? "is-invalid" : "" }}" value="{{old('nama_kip', $ppdb->nama_kip) }}">
                                    @error('nama_kip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <h6>UPLOAD DOKUMEN</h6>
                                <div class="form-group mb-3">
                                    <label for="">Kartu Keluarga @if(isset($ppdb->dokumen->kartu_keluarga)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_kartu_keluarga" value="{{$ppdb->dokumen->kartu_keluarga ?? ''}}">
                                        <input name="kartu_keluarga" type="file" class="custom-file-input {{$errors->first('kartu_keluarga') ? "is-invalid" : "" }}" id="kartu_keluarga" >
                                        <label class="custom-file-label" for="kartu_keluarga">Scan KK</label>
                                        @error('kartu_keluarga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Ijazah SMP @if(isset($ppdb->dokumen->ijazah)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_ijazah" value="{{$ppdb->dokumen->ijazah ?? ''}}">
                                        <input name="ijazah" type="file" class="custom-file-input {{$errors->first('ijazah') ? "is-invalid" : "" }}" id="ijazah" >
                                        <label class="custom-file-label" for="ijazah">Scan Ijazah</label>
                                        @error('ijazah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Akte Kelahiran @if(isset($ppdb->dokumen->akte)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_akte" value="{{$ppdb->dokumen->akte ?? ''}}">
                                        <input name="akte" type="file" class="custom-file-input {{$errors->first('akte') ? "is-invalid" : "" }}" id="akte" >
                                        <label class="custom-file-label" for="akte">Scan Akte Kelahiran</label>
                                        @error('akte')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">KTP Orang Tua @if(isset($ppdb->dokumen->ktp_ortu)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_ktp_ortu" value="{{$ppdb->dokumen->ktp_ortu ?? ''}}">
                                        <input name="ktp_ortu" type="file" class="custom-file-input {{$errors->first('ktp_ortu') ? "is-invalid" : "" }}" id="ktp_ortu" >
                                        <label class="custom-file-label" for="ktp_ortu">Scan KTP Ortu</label>
                                        @error('ktp_ortu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Berkas Lainnya @if(isset($ppdb->dokumen->berkas)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_berkas" value="{{$ppdb->dokumen->berkas ?? ''}}">
                                        <input name="berkas" type="file" class="custom-file-input {{$errors->first('berkas') ? "is-invalid" : "" }}" id="berkas" >
                                        <label class="custom-file-label" for="berkas">Scan berkas lainnya</label>
                                        @error('berkas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5><span class="fe fe-heart text-danger mb-3"></span> ORANG TUA CALON SISWA</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-group mb-3 mt-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input id="nama_ayah" name="nama_ayah" type="text" class="form-control {{$errors->first('nama_ayah') ? "is-invalid" : "" }}" value="{{old('nama_ayah', $ppdb->nama_ayah)}}">
                                    @error('nama_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nik_ayah">NIK Ayah</label>
                                    <input id="nik_ayah" type="tel" name="nik_ayah" class="form-control {{$errors->first('nik_ayah') ? "is-invalid" : "" }}" value="{{ old('nik_ayah', $ppdb->nik_ayah)}}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    @error('nik_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_lahir_ayah" class="form-label">Tanggal Lahir </label>
                                    <input id="tgl_lahir_ayah" name="tgl_lahir_ayah" type="date" class="form-control {{$errors->first('tgl_lahir_ayah') ? "is-invalid" : "" }}" value="{{ \Carbon\Carbon::parse($ppdb->tgl_lahir_ayah)->format('Y-m-d') }}">
                                    @error('tgl_lahir_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pendidikan_ayah">Pendidikan Terakhir</label>
                                    <select id="pendidikan_ayah" name="pendidikan_ayah" class="custom-select form-control form-control {{$errors->first('pendidikan_ayah') ? "is-invalid" : "" }}" >
                                        @if(isset($ppdb->pendidikan_ayah))
                                            <option value="{{old('pendidikan_ayah', $ppdb->pendidikan_ayah)}}" selected>{{$ppdb->pendidikan_ayah}}</option>
                                        @endif
                                        <option value="">&nbsp;</option>
                                        <option value="SD">SD</option>
                                        <option value="SLTP">SLTP</option>
                                        <option value="SLTA">SLTA</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    @error('pendidikan_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" class="form-control {{$errors->first('pekerjaan_ayah') ? "is-invalid" : "" }}" value="{{ old('pekerjaan_ayah', $ppdb->pekerjaan_ayah)}}">
                                    @error('pekerjaan_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                                    <input id="penghasilan_ayah" name="penghasilan_ayah" type="number" class="form-control {{$errors->first('penghasilan_ayah') ? "is-invalid" : "" }}" maxlength="11" value="{{old('penghasilan_ayah', $ppdb->penghasilan_ayah)}}">
                                    @error('penghasilan_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3 mt-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input id="nama_ibu" name="nama_ibu" type="text" class="form-control {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" value="{{old('nama_ibu', $ppdb->nama_ibu)}}">
                                    @error('nama_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nik_ibu">NIK ibu</label>
                                    <input id="nik_ibu" type="tel" name="nik_ibu" class="form-control {{$errors->first('nik_ibu') ? "is-invalid" : "" }}" value="{{ old('nik_ibu', $ppdb->nik_ibu)}}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    @error('nik_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_lahir_ibu" class="form-label">Tanggal Lahir </label>
                                    <input id="tgl_lahir_ibu" name="tgl_lahir_ibu" type="date" class="form-control {{$errors->first('tgl_lahir_ibu') ? "is-invalid" : "" }}" value="{{ \Carbon\Carbon::parse($ppdb->tgl_lahir_ibu)->format('Y-m-d') }}">
                                    @error('tgl_lahir_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                                    <select id="pendidikan_ibu" name="pendidikan_ibu" class="custom-select form-control form-control {{$errors->first('pendidikan_ibu') ? "is-invalid" : "" }}" >
                                        @if(isset($ppdb->pendidikan_ibu))
                                            <option value="{{old('pendidikan_ibu', $ppdb->pendidikan_ibu)}}" selected>{{$ppdb->pendidikan_ibu}}</option>
                                        @endif
                                        <option value="">&nbsp;</option>
                                        <option value="SD">SD</option>
                                        <option value="SLTP">SLTP</option>
                                        <option value="SLTA">SLTA</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    @error('pendidikan_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" class="form-control {{$errors->first('pekerjaan_ibu') ? "is-invalid" : "" }}" value="{{ old('pekerjaan_ibu', $ppdb->pekerjaan_ibu)}}">
                                    @error('pekerjaan_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                                    <input id="penghasilan_ibu" name="penghasilan_ibu" type="number" class="form-control {{$errors->first('penghasilan_ibu') ? "is-invalid" : "" }}" maxlength="11" value="{{old('penghasilan_ibu', $ppdb->penghasilan_ibu)}}">
                                    @error('penghasilan_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <a href="/dashboard/ppdb" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                            <button class="btn btn-primary" type="submit"><span class="fe fe-save mr-1"></span> Update</button>
                        </div>
                    </div>
                    </form>
                </div> {{-- /card --}}
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

        selectChange('/getKabupaten?code=', code, idSelect);
    });

    let kabupaten = document.querySelector('#kabupaten');
    kabupaten.addEventListener('change', () =>{
        let code = kabupaten.options[kabupaten.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kecamatan');

        selectChange('/getKecamatan?code=', code, idSelect);
    });

    let kecamatan = document.querySelector('#kecamatan');
    kecamatan.addEventListener('change', () =>{
        let code = kecamatan.options[kecamatan.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kelurahan');

        selectChange('/getKelurahan?code=', code, idSelect);
    });
</script>
@endsection
