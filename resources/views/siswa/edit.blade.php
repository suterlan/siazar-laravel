@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h4 class="text-center"> Edit Siswa</h4>
                            </div>
                            <form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/siswa/{{$siswa->id}}" method="POST" enctype="multipart/form-data" novalidate>
                                @method('PUT')
                                @csrf
                            <div class="card-body pb-0">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <h6><span class="fe fe-user text-primary"></span> PROFIL SISWA</h6>
                                        <div class="form-group mb-3 mt-3">
                                            <label for="">NIS</label>
                                            <input type="text" class="form-control" value="{{$siswa->nis}}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                            <input type="text" class="form-control {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" id="nama_siswa" name="nama_siswa" required>
                                            @error('nama_siswa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input id="nik" type="tel" name="nik" class="form-control {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{old('nik', $siswa->nik) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required>
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jenis Kelamin</label><br>
                                            <label class="radio-inline me-2" for="jk1">
                                                <input type="radio" name="jk" id="jk1" class="me-2" value="Laki-laki" {{{ (isset($siswa->jk) && $siswa->jk == 'Laki-laki') ? "checked" : "" }}}> Laki-laki
                                            </label>
                                            <label class="radio-inline" for="jk2">
                                                <input type="radio" name="jk" id="jk2" class="me-2" value="Perempuan" {{{ (isset($siswa->jk) && $siswa->jk == 'Perempuan') ? "checked" : "" }}}> Perempuan
                                                </label>
                                            @error('jk')
                                                <div class="error text-danger"><small>{{ $message }}</small> </div>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir </label>
                                                <input type="text" class="form-control {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
                                                @error('tempat_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control {{$errors->first('tgl_lahir') ? "is-invalid" : "" }}" id="tgl_lahir" name="tgl_lahir" value="{{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('Y-m-d') }}" required>
                                                @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_hp">Nomor Hanphone</label>
                                            <input id="no_hp" type="tel" name="no_hp" class="form-control {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp', $siswa->no_hp ) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2">{{old('alamat', $siswa->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="provinsi">Provinsi</label>
                                            <select class="custom-select form-control {{$errors->first('provinsi') ? "is-invalid" : "" }}" id="provinsi" name="provinsi">
                                                <option value="">==Pilih Provinsi==</option>
                                                @foreach ($provinces as $code => $name)
                                                    @if (old('provinsi', $siswa->provinsi) == $name)
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
                                            <select class="custom-select form-control {{$errors->first('kabupaten') ? "is-invalid" : "" }}" id="kabupaten" name="kabupaten" >
                                                <option value="">==Pilih Kabupaten==</option>
                                                @if (isset($siswa->kabupaten))
                                                    <option value="{{ old('kabupaten', $siswa->kabupaten)}}" selected>{{ $siswa->kabupaten}}</option>
                                                @endif
                                                {{-- javascript code here --}}
                                            </select>
                                            @error('kabupaten')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kecamatan">Kecamatan</label>
                                            <select class="custom-select form-control {{$errors->first('kecamatan') ? "is-invalid" : "" }}" id="kecamatan" name="kecamatan" >
                                                <option value="">==Pilih Kecamatan==</option>
                                                @if (isset($siswa->kecamatan))
                                                    <option value="{{old('kecamatan', $siswa->kecamatan)}}" selected>{{$siswa->kecamatan}}</option>
                                                @endif
                                                {{-- javascript code here --}}
                                            </select>
                                            @error('kecamatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kelurahan">Desa</label>
                                            <select class="custom-select form-control {{$errors->first('kelurahan') ? "is-invalid" : "" }}" id="kelurahan" name="kelurahan" >
                                                <option value="">==Pilih Kelurahan==</option>
                                                @if (isset($siswa->kelurahan))
                                                    <option value="{{old('kelurahan', $siswa->kelurahan)}}" selected>{{$siswa->kelurahan}}</option>
                                                @endif
                                                {{-- javascript code here --}}
                                            </select>
                                            @error('kelurahan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="jml_saudara_kandung" class="form-label">Jumlah Saudara Kandung</label>
                                            <input type="tel" name="jml_saudara_kandung" class="form-control {{$errors->first('jml_saudara_kandung') ? "is-invalid" : "" }}" id="jml_saudara_kandung" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ old('jml_saudara_kandung', $siswa->jml_saudara_kandung) }}">
                                            @error('jml_saudara_kandung')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6><span class="fe fe-file-text text-primary"></span> DOKUMEN SEKOLAH SISWA</h6>
                                        <div class="form-group mb-3 mt-3">
                                            <label for="asal_sekolah" class="form-label">Asal Sekolah <small class="text-danger">(*)</small></label>
                                            <input type="text" list="asal" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" class="form-control {{$errors->first('asal_sekolah') ? "is-invalid" : "" }}" required />
                                                <datalist id="asal">
                                                    <option>SMPN 1 Leles</option>
                                                    <option>SMPN 2 Leles</option>
                                                    <option>SMPN 5 Leles</option>
                                                    <option>SMPN 1 Agrabinta</option>
                                                    <option>SMP Parungkeusik</option>
                                                    <option>SMP PGRI</option>
                                                    <option>SMP Lugina</option>
                                                    <option>SMP Purabaya</option>
                                                    <option>SMP Sukamulya</option>
                                                    <option>MTs Leles</option>
                                                    <option>MTs Puncakwangi</option>
                                                    <option>MTs Almutmainah</option>
                                                    <option>MTs Albayan</option>
                                                </datalist>
                                            @error('asal_sekolah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nisn">NISN</label>
                                            <input id="nisn" type="text" name="nisn" class="form-control {{$errors->first('nisn') ? "is-invalid" : "" }}" value="{{ old('nisn', $siswa->nisn) }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="10" required>
                                            @error('nisn')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="no_ijazah">Nomor Ijazah SMPN/MTs</label>
                                            <input id="no_ijazah" type="text" name="no_ijazah" class="form-control {{$errors->first('no_ijazah') ? "is-invalid" : "" }}" value="{{ old('no_ijazah', $siswa->no_ijazah) }}" maxlength="16">
                                            @error('no_ijazah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="no_skhun">Nomor SKHUN</label>
                                            <input id="no_skhun" type="text" name="no_skhun" class="form-control {{$errors->first('no_skhun') ? "is-invalid" : "" }}" value="{{ old('no_skhun', $siswa->no_skhun) }}" maxlength="7">
                                            @error('no_skhun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="no_kip">Nomor KIP</label>
                                            <input id="no_kip" type="text" name="no_kip" class="form-control {{$errors->first('no_kip') ? "is-invalid" : "" }}" value="{{ old('no_kip', $siswa->no_kip) }}" maxlength="7">
                                            @error('no_kip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="nama_kip" class="form-label">Nama di KIP </label>
                                            <input id="nama_kip" type="text" name="nama_kip" class="form-control {{$errors->first('nama_kip') ? "is-invalid" : "" }}" value="{{old('nama_kip', $siswa->nama_kip) }}">
                                            @error('nama_kip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Foto @if(isset($siswa->dokumen->kartu_keluarga)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="old_foto" value="{{$siswa->dokumen->foto ?? ''}}">
                                                <input name="foto" type="file" class="custom-file-input {{$errors->first('foto') ? "is-invalid" : "" }}" id="foto" >
                                                <label class="custom-file-label" for="foto">Upload Foto</label>
                                                @error('foto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Kartu Keluarga @if(isset($siswa->dokumen->kartu_keluarga)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="old_kartu_keluarga" value="{{$siswa->dokumen->kartu_keluarga ?? ''}}">
                                                <input name="kartu_keluarga" type="file" class="custom-file-input {{$errors->first('kartu_keluarga') ? "is-invalid" : "" }}" id="kartu_keluarga" >
                                                <label class="custom-file-label" for="kartu_keluarga">Scan KK</label>
                                                @error('kartu_keluarga')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Ijazah SMP @if(isset($siswa->dokumen->ijazah)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="old_ijazah" value="{{$siswa->dokumen->ijazah ?? ''}}">
                                                <input name="ijazah" type="file" class="custom-file-input {{$errors->first('ijazah') ? "is-invalid" : "" }}" id="ijazah" >
                                                <label class="custom-file-label" for="ijazah">Scan Ijazah</label>
                                                @error('ijazah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Akte Kelahiran @if(isset($siswa->dokumen->akte)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="old_akte" value="{{$siswa->dokumen->akte ?? ''}}">
                                                <input name="akte" type="file" class="custom-file-input {{$errors->first('akte') ? "is-invalid" : "" }}" id="akte" >
                                                <label class="custom-file-label" for="akte">Scan Akte Kelahiran</label>
                                                @error('akte')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">KTP Orang Tua @if(isset($siswa->dokumen->ktp_ortu)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="old_ktp_ortu" value="{{$siswa->dokumen->ktp_ortu ?? ''}}">
                                                <input name="ktp_ortu" type="file" class="custom-file-input {{$errors->first('ktp_ortu') ? "is-invalid" : "" }}" id="ktp_ortu" >
                                                <label class="custom-file-label" for="ktp_ortu">Scan KTP Ortu</label>
                                                @error('ktp_ortu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Berkas Lainnya @if(isset($siswa->dokumen->berkas)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="old_berkas" value="{{$siswa->dokumen->berkas ?? ''}}">
                                                <input name="berkas" type="file" class="custom-file-input {{$errors->first('berkas') ? "is-invalid" : "" }}" id="berkas" >
                                                <label class="custom-file-label" for="berkas">Scan berkas lainnya</label>
                                                @error('berkas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6><span class="fe fe-list text-primary"></span> PROGRAM STUDI</h6>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="jurusan_id">Jurusan</label>
                                        <select class="form-control select2 {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" id="jurusan_id" name="jurusan_id" required>
                                            @foreach ($jurusan as $value)
                                                @if (old('jurusan_id', $siswa->jurusan_id) == $value->id)
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
                                        <select class="form-control select2 {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                                            @foreach ($kelas as $value)
                                                @if (old('kelas_id', $siswa->kelas_id) == $value->id)
                                                    <option value="{{ $value->id }}" selected>{{ $value->nama . '-' . $value->jurusan->kode}}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-6">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <select id="tahun_ajaran" name="tahun_ajaran" class="custom-select form-control {{$errors->first('tahun_ajaran') ? "is-invalid" : "" }}" >
                                            @if(isset($siswa->tahun_ajaran))
                                                <option value="{{old('tahun_ajaran', $siswa->tahun_ajaran)}}" selected>{{$siswa->tahun_ajaran}}</option>
                                            @endif
                                            <option value="{{date('Y')-3 . '/' . date('Y')-2 }}">{{date('Y')-3 . '/' . date('Y')-2 }}</option>
                                            <option value="{{date('Y')-2 . '/' . date('Y')-1 }}">{{date('Y')-2 . '/' . date('Y')-1 }}</option>
                                            <option value="{{date('Y')-1 . '/' . date('Y') }}">{{date('Y')-1 . '/' . date('Y') }}</option>
                                            <option value="{{date('Y') . '/' . date('Y')+1 }}">{{date('Y') . '/' . date('Y')+1 }}</option>
                                            <option value="{{date('Y')+1 . '/' . date('Y')+2 }}">{{date('Y')+1 . '/' . date('Y')+2 }}</option>
                                        </select>
                                        @error('tahun_ajaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>STATUS SISWA</label>
                                        <div class="custom-control custom-radio pr-4">
                                            <input type="radio" id="status_siswa1" name="status_siswa" class="custom-control-input" value="1" {{{ (isset($siswa->status_siswa) && $siswa->status_siswa == '1') ? "checked" : "" }}}>
                                            <label class="custom-control-label" for="status_siswa1"><b>Aktif</b></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="status_siswa2" name="status_siswa" class="custom-control-input" value="0" {{{ (isset($siswa->status_siswa) && $siswa->status_siswa == '0') ? "checked" : "" }}}>
                                            <label class="custom-control-label" for="status_siswa2"><b>Tidak Aktif</b></label>
                                        </div>
                                    </div>
                                </div>
                                <h5>DATA ORANG TUA SISWA</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3 mt-3">
                                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                            <input id="nama_ayah" name="nama_ayah" type="text" class="form-control {{$errors->first('nama_ayah') ? "is-invalid" : "" }}" value="{{old('nama_ayah', $siswa->nama_ayah)}}">
                                            @error('nama_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nik_ayah">NIK Ayah</label>
                                            <input id="nik_ayah" type="tel" name="nik_ayah" class="form-control {{$errors->first('nik_ayah') ? "is-invalid" : "" }}" value="{{ old('nik_ayah', $siswa->nik_ayah)}}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            @error('nik_ayah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tgl_lahir_ayah" class="form-label">Tanggal Lahir </label>
                                            <input id="tgl_lahir_ayah" name="tgl_lahir_ayah" type="date" class="form-control {{$errors->first('tgl_lahir_ayah') ? "is-invalid" : "" }}" value="{{ \Carbon\Carbon::parse($siswa->tgl_lahir_ayah)->format('Y-m-d') }}">
                                            @error('tgl_lahir_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pendidikan_ayah">Pendidikan Terakhir</label>
                                            <select id="pendidikan_ayah" name="pendidikan_ayah" class="custom-select form-control {{$errors->first('pendidikan_ayah') ? "is-invalid" : "" }}" >
                                                @if(isset($siswa->pendidikan_ayah))
                                                    <option value="{{old('pendidikan_ayah', $siswa->pendidikan_ayah)}}" selected>{{$siswa->pendidikan_ayah}}</option>
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
                                            <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" class="form-control {{$errors->first('pekerjaan_ayah') ? "is-invalid" : "" }}" value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah)}}">
                                            @error('pekerjaan_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                                            <input id="penghasilan_ayah" name="penghasilan_ayah" type="number" class="form-control {{$errors->first('penghasilan_ayah') ? "is-invalid" : "" }}" maxlength="11" value="{{old('penghasilan_ayah', $siswa->penghasilan_ayah)}}">
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
                                            <input id="nama_ibu" name="nama_ibu" type="text" class="form-control {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" value="{{old('nama_ibu', $siswa->nama_ibu)}}" required>
                                            @error('nama_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nik_ibu">NIK ibu</label>
                                            <input id="nik_ibu" type="tel" name="nik_ibu" class="form-control {{$errors->first('nik_ibu') ? "is-invalid" : "" }}" value="{{ old('nik_ibu', $siswa->nik_ibu)}}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            @error('nik_ibu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tgl_lahir_ibu" class="form-label">Tanggal Lahir </label>
                                            <input id="tgl_lahir_ibu" name="tgl_lahir_ibu" type="date" class="form-control {{$errors->first('tgl_lahir_ibu') ? "is-invalid" : "" }}" value="{{ \Carbon\Carbon::parse($siswa->tgl_lahir_ibu)->format('Y-m-d') }}">
                                            @error('tgl_lahir_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                                            <select id="pendidikan_ibu" name="pendidikan_ibu" class="custom-select form-control {{$errors->first('pendidikan_ibu') ? "is-invalid" : "" }}" >
                                                @if(isset($siswa->pendidikan_ibu))
                                                    <option value="{{old('pendidikan_ibu', $siswa->pendidikan_ibu)}}" selected>{{$siswa->pendidikan_ibu}}</option>
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
                                            <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" class="form-control {{$errors->first('pekerjaan_ibu') ? "is-invalid" : "" }}" value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu)}}">
                                            @error('pekerjaan_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                                            <input id="penghasilan_ibu" name="penghasilan_ibu" type="number" class="form-control {{$errors->first('penghasilan_ibu') ? "is-invalid" : "" }}" maxlength="11" value="{{old('penghasilan_ibu', $siswa->penghasilan_ibu)}}">
                                            @error('penghasilan_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                                    <button class="btn btn-primary" type="submit"><span class="fe fe-save mr-1"></span> Update</button>
                                </div>
                            </div>
                            </form>
                        </div> {{-- /card --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
