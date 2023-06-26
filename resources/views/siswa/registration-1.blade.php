@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }}">Profil Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }}">Riwayat Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 3 ? 'active' : '' }}">Data Orang Tua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }}">Finish</a>
                        </li>
                    </ul>
                </div>
                {{-- Step 1 --}}
                <form action="/dashboard/siswa/registrasi-step1" method="POST">
                    @csrf
                    <div id="step1" class="my-2 pt-4 needs-validation">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama Lengkap <small class="text-danger">(*)</small></label>
                            <input type="text" class="form-control {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa', $registrasi->nama_siswa ?? '') }}" required>
                            @error('nama_siswa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin <small class="text-danger">(*)</small></label><br>
                            <label class="radio-inline me-2" for="jk1">
                                <input type="radio" name="jk" id="jk1" class="me-2" value="Laki-laki" {{{ (isset($registrasi->jk) && $registrasi->jk == 'Laki-laki') ? "checked" : "" }}}> Laki-laki
                            </label>
                            <label class="radio-inline" for="jk2">
                                <input type="radio" name="jk" id="jk2" class="me-2" value="Perempuan" {{{ (isset($registrasi->jk) && $registrasi->jk == 'Perempuan') ? "checked" : "" }}}> Perempuan
                                </label>
                            @error('jk')
                                <div class="error text-danger"><small>{{ $message }}</small> </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nik">NIK <small class="text-danger">(*)</small></label>
                            <input id="nik" type="tel" name="nik" class="form-control {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{ old('nik', $registrasi->nik ?? '' ) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="mb-3 col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">(*)</small></label>
                                <input type="text" class="form-control {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $registrasi->tempat_lahir ?? '' ) }}" required>
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir <small class="text-danger">(*)</small></label>
                                <input type="date" class="form-control {{$errors->first('tgl_lahir') ? "is-invalid" : "" }}" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $registrasi->tgl_lahir ?? '' ) }}" required>
                                @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp">Nomor Hanphone</label>
                            <input id="no_hp" type="tel" name="no_hp" class="form-control {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp', $registrasi->no_hp ?? '' ) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2">{{ old('alamat', $registrasi->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="provinsi">Provinsi<small class="text-danger">(*)</small></label>
                            <select class="custom-select {{$errors->first('provinsi') ? "is-invalid" : "" }}" id="provinsi" name="provinsi" required>
                                <option value="">==Pilih Provinsi==</option>
                                @foreach ($provinces as $code => $name)
                                    @if (old('provinsi', $registrasi->provinsi ?? '') == $name)
                                    <option value="{{ $name }}" data-code="{{ $code }}" selected>{{ $name }}</option>
                                    @endif
                                    <option value="{{ $name }}" data-code="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kabupaten">Kabupaten / Kota<small class="text-danger">(*)</small></label>
                            <select class="custom-select {{$errors->first('kabupaten') ? "is-invalid" : "" }}" id="kabupaten" name="kabupaten" required>
                                @if (isset($registrasi->kabupaten))
                                    <option value="{{ old('kabupaten', $registrasi->kabupaten)}}" selected>{{ old('kabupaten', $registrasi->kabupaten)}}</option>
                                @endif
                                {{-- javascript code here --}}
                            </select>
                            @error('kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kecamatan">Kecamatan<small class="text-danger">(*)</small></label>
                            <select class="custom-select {{$errors->first('kecamatan') ? "is-invalid" : "" }}" id="kecamatan" name="kecamatan" required>
                                @if (isset($registrasi->kecamatan))
                                    <option value="{{ old('kecamatan', $registrasi->kecamatan)}}" selected>{{old('kecamatan', $registrasi->kecamatan)}}</option>
                                @endif
                                {{-- javascript code here --}}
                            </select>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelurahan">Desa<small class="text-danger">(*)</small></label>
                            <select class="custom-select {{$errors->first('kelurahan') ? "is-invalid" : "" }}" id="kelurahan" name="kelurahan" required>
                                @if (isset($registrasi->kelurahan))
                                    <option value="{{ old('kelurahan', $registrasi->kelurahan)}}" selected>{{old('kelurahan', $registrasi->kelurahan)}}</option>
                                @endif
                                {{-- javascript code here --}}
                            </select>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jml_saudara_kandung" class="form-label">Jumlah Saudara Kandung</label>
                            <input type="tel" name="jml_saudara_kandung" class="form-control {{$errors->first('jml_saudara_kandung') ? "is-invalid" : "" }}" id="jml_saudara_kandung" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ old('jml_saudara_kandung', $registrasi->jml_saudara_kandung ?? '' ) }}">
                            @error('jml_saudara_kandung')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div>Ket : <span class="text-danger">(*)</span> = Wajib diisi</div>
                        </div>

                        <button class="btn btn-primary float-right" type="submit">Next <span class="fe fe-arrow-right"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
