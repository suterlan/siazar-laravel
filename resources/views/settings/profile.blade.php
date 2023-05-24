@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger col-12" role="alert">
                        <span class="fe fe-info fe-16 mr-2"></span> {{ session('error') }}
                    </div>
                @endif
                <h2 class="h3 mb-4 page-title">Settings</h2>
                <div class="my-4">
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="akun-tab" data-toggle="tab" href="#akun" role="tab" aria-controls="akun" aria-selected="false">Akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</a>
                        </li>
                    </ul>
                    <form action="/dashboard/akun/{{$akun->id}}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @method('put')
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        {{-- Tab Profile --}}
                        <div class="tab-pane fade active show" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                            <div class="row mt-5 align-items-center">
                                <div class="col-md-4 mb-4">
                                    <div class="avatar avatar-xl text-center">
                                        <img src="{{ asset('storage/'. $akun->dokumen->foto) }}" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="custom-file mt-3">
                                        <input type="hidden" name="old_foto" value="{{$akun->dokumen->foto ?? ''}}">
                                        <input name="foto" type="file" class="custom-file-input {{$errors->first('foto') ? "is-invalid" : "" }}" id="foto" >
                                        <label class="custom-file-label" for="foto">Ubah</label>
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <h4 class="mb-1">{{ $akun->nama }}</h4>
                                            <h5><span class="badge badge-dark">{{ $akun->nuptk }}</span></h5>
                                            <p class="mb-0"><span class="badge badge-primary bg-primary-darker">{{ $akun->email }}</span></p>
                                            <p class="mb-3"><span class="badge badge-primary bg-primary-darker">{{ $akun->no_hp }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-7">
                                            <h6>Kelengkapan Dokumen :</h6>
                                            <li class="text-muted"> Kartu Keluarga
                                                @if(isset($akun->dokumen->kartu_keluarga))
                                                    <span class="badge badge-success"> Ada</span>
                                                    <span class="fe fe-check fe-16 text-success"></span>
                                                @else
                                                    <span class="badge badge-danger"> Belum ada</span>
                                                @endif
                                            </li>
                                            <li class="text-muted"> Ijazah
                                                @if(isset($akun->dokumen->ijazah))
                                                    <span class="badge badge-success"> Ada</span>
                                                    <span class="fe fe-check fe-16 text-success"></span>
                                                @else
                                                    <span class="badge badge-danger"> Belum ada</span>
                                                @endif
                                            </li>
                                            <li class="text-muted"> Berkas Lainnya
                                                @if(isset($akun->dokumen->berkas))
                                                    <span class="badge badge-success"> Ada</span>
                                                    <span class="fe fe-check fe-16 text-success"></span>
                                               @else
                                                    <span class="badge badge-danger"> Belum ada</span>
                                                @endif
                                            </li>
                                        </div>
                                        <div class="col">
                                            <p class="small mb-0 text-muted">{{ $akun->alamat }}</p>
                                            <p class="small mb-0 text-muted">{{ $akun->kelurahan . ', ' . $akun->kecamatan . ', ' . $akun->kabupaten . ' - ' . $akun->provinsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mb-2">
                                <label for="nama" class="form-label">Nama Lengkap (serta gelar jika ada) <small class="text-danger">(*)</small></label>
                                <input type="text" class="form-control form-control-sm {{$errors->first('nama') ? "is-invalid" : "" }}" id="nama" name="nama" value="{{ old('nama', $akun->nama) }}" required>
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="email" class="form-label">Email <small class="text-danger">(*)</small></label>
                                <p class="text-info" style="font-size: 12px">*) Jika email di ubah, email di akun login akan otomatis berubah</p>
                                <input type="email" class="form-control form-control-sm {{$errors->first('email') ? "is-invalid" : "" }}" id="email" name="email" value="{{ old('email', $akun->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Jenis Kelamin <small class="text-danger">(*)</small></label><br>
                                <label class="radio-inline me-2" for="jk1">
                                    <input type="radio" name="jk" id="jk1" class="me-2" value="L" @if ($akun->jk == "L") checked @endif> Laki-laki
                                </label>
                                <label class="radio-inline" for="jk2">
                                    <input type="radio" name="jk" id="jk2" class="me-2" value="P" @if ($akun->jk == "P") checked @endif> Perempuan
                                    </label>
                                @error('jk')
                                    <div class="error text-danger"><small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-md-6">
                                    <label for="nik">NIK <small class="text-danger">(*)</small></label>
                                    <input id="nik" type="tel" name="nik" class="form-control form-control-sm {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{ old('nik', $akun->nik) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="no_hp">Nomor Hanphone</label>
                                    <input id="no_hp" type="tel" name="no_hp" class="form-control form-control-sm {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp', $akun->no_hp) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="mb-2 col-md-6">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">(*)</small></label>
                                    <input type="text" class="form-control form-control-sm {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $akun->tempat_lahir) }}" required>
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <small class="text-danger">(*)</small></label>
                                    <input type="date" class="form-control form-control-sm {{$errors->first('tanggal_lahir') ? "is-invalid" : "" }}" id="tanggal_lahir" name="tanggal_lahir" value="{{ \Carbon\Carbon::parse($akun->tanggal_lahir)->format('Y-m-d') }}" required>
                                    @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama_ibu" class="form-label">Nama Ibu Kandung</label>
                                <input type="text" class="form-control form-control-sm {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $akun->nama_ibu) }}">
                                @error('nama_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control form-control-sm {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2">{{ old('alamat', $akun->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="provinsi">Provinsi<small class="text-danger">(*)</small></label>
                                <select class="custom-select custom-select-sm {{$errors->first('provinsi') ? "is-invalid" : "" }}" id="provinsi" name="provinsi" required>
                                    <option value="">==Pilih Provinsi==</option>
                                    @foreach ($provinces as $code => $name)
                                        @if (old('provinsi', $akun->provinsi) == $name)
                                        <option value="{{ $name }}" data-code="{{ $code }}" selected>{{ $name }}</option>
                                        @endif
                                        <option value="{{ $name }}" data-code="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="kabupaten">Kabupaten / Kota<small class="text-danger">(*)</small></label>
                                <select class="custom-select custom-select-sm {{$errors->first('kabupaten') ? "is-invalid" : "" }}" id="kabupaten" name="kabupaten" required>
                                    @if (isset($akun->kabupaten))
                                        <option value="{{ $akun->kabupaten}}" selected>{{ $akun->kabupaten}}</option>
                                    @endif
                                    {{-- javascript code here --}}
                                </select>
                                @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="kecamatan">Kecamatan<small class="text-danger">(*)</small></label>
                                <select class="custom-select custom-select-sm {{$errors->first('kecamatan') ? "is-invalid" : "" }}" id="kecamatan" name="kecamatan" required>
                                    @if (isset($akun->kecamatan))
                                        <option value="{{ $akun->kecamatan}}" selected>{{$akun->kecamatan}}</option>
                                    @endif
                                    {{-- javascript code here --}}
                                </select>
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="kelurahan">Desa<small class="text-danger">(*)</small></label>
                                <select class="custom-select custom-select-sm {{$errors->first('kelurahan') ? "is-invalid" : "" }}" id="kelurahan" name="kelurahan" required>
                                    @if (isset($akun->kelurahan))
                                        <option value="{{ $akun->kelurahan}}" selected>{{$akun->kelurahan}}</option>
                                    @endif
                                    {{-- javascript code here --}}
                                </select>
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Button Submit --}}
                            <button type="submit" class="btn btn-primary mt-3"><span class="fe fe-save"></span> Simpan</button>
                        </div>
                        {{-- Tab Pendidikan --}}
                        <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                            <div class="row mt-5 align-items-center">
                                <div class="form-group mb-2 col-md-6">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="custom-select custom-select-sm {{$errors->first('pendidikan_terakhir') ? "is-invalid" : "" }}" >
                                        @if (isset($akun->pendidikan_terakhir))
                                            <option value="{{ $akun->pendidikan_terakhir }}" selected>{{ $akun->pendidikan_terakhir }}</option>
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
                                    @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control form-control-sm {{$errors->first('jurusan') ? "is-invalid" : "" }}" id="jurusan" name="jurusan" value="{{ old('jurusan', $akun->jurusan) }}" >
                                    @error('jurusan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="sk_cpns" class="form-label">SK CPNS</label>
                                <input type="text" class="form-control form-control-sm {{$errors->first('sk_cpns') ? "is-invalid" : "" }}" id="sk_cpns" name="sk_cpns" value="{{ old('sk_cpns', $akun->sk_cpns) }}" >
                                @error('sk_cpns')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="tanggal_cpns" class="form-label">Tanggal CPNS </label>
                                <input type="date" class="form-control form-control-sm {{$errors->first('tanggal_cpns') ? "is-invalid" : "" }}" id="tanggal_cpns" name="tanggal_cpns" value="{{ \Carbon\Carbon::parse($akun->tanggal_cpns)->format('Y-m-d') }}" >
                                @error('tanggal_cpns')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-md-6">
                                    <label for="nip">NIP </label>
                                    <input id="nip" type="tel" name="nip" class="form-control form-control-sm {{$errors->first('nip') ? "is-invalid" : "" }}" value="{{ old('nip', $akun->nip) }}" onKeyDown="if(this.value.length==18 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="18" >
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="tmt_pns" class="form-label">TMT PNS </label>
                                    <input type="date" class="form-control form-control-sm {{$errors->first('tmt_pns') ? "is-invalid" : "" }}" id="tmt_pns" name="tmt_pns" value="{{ \Carbon\Carbon::parse($akun->tmt_pns)->format('Y-m-d') }}" >
                                    @error('tmt_pns')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pangkat_golongan">Pangkat Golongan</label>
                                <select class="form-control form-control-sm select2" id="pangkat_golongan" name="pangkat_golongan">
                                    @if (isset( $akun->pangkat_golongan ))
                                            <option value="{{ $akun->pangkat_golongan }}" selected>{{ $akun->pangkat_golongan }}</option>
                                    @endif
                                    <option value="">--Pilih Golongan--</option>
                                    <optgroup label="Golongan I (Juru)">
                                    <option value="Ia Juru Muda">Ia Juru Muda</option>
                                    <option value="Ib Juru Muda Tingkat I">Ib Juru Muda Tingkat 1</option>
                                    <option value="Ic Juru">Ic Juru</option>
                                    <option value="Id Juru Tingkat 1">Id Juru Tingkat 1</option>
                                    </optgroup>
                                    <optgroup label="Golongan II (Pengatur)" >
                                    <option value="IIa Pengatur Muda">IIa Pengatur Muda</option>
                                    <option value="IIb Pengatur Muda Tingkat 1">IIb Pengatur Muda Tingkat 1</option>
                                    <option value="IIc Pengatur">IIc Pengatur</option>
                                    <option value="IId Pengatur Tingkat 1">IId Pengatur Tingkat 1</option>
                                    </optgroup>
                                    <optgroup label="Golongan III (Penata)" >
                                    <option value="IIIa Penata Muda">IIIa Penata Muda</option>
                                    <option value="IIIb Penata Muda Tingkat 1">IIIb Penata Muda Tingkat 1</option>
                                    <option value="IIIc Penata">IIIc Penata</option>
                                    <option value="IIId Penata Tingkat 1">IIId Penata Tingkat 1</option>
                                    </optgroup>
                                    <optgroup label="Golongan IV (Pembina)" >
                                    <option value="IVa Pembina">IVa Pembina</option>
                                    <option value="IVb Pembina Tingkat 1">IVb Pembina Tingkat 1</option>
                                    <option value="IVc Pembina Muda">IVc Pembina Muda</option>
                                    <option value="IVd Pembina Madya">IVd Pembina Madya</option>
                                    <option value="IVe Pembina Utama">IVe Pembina Utama</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nuptk">NUPTK </label>
                                <input id="nuptk" type="tel" name="nuptk" class="form-control form-control-sm {{$errors->first('nuptk') ? "is-invalid" : "" }}" value="{{ old('nuptk', $akun->nuptk) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" >
                                @error('nuptk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-md-6">
                                    <label for="sk_pengangkatan" class="form-label">SK Pengangkatan</label>
                                    <input type="text" class="form-control form-control-sm {{$errors->first('sk_pengangkatan') ? "is-invalid" : "" }}" id="sk_pengangkatan" name="sk_pengangkatan" value="{{ old('sk_pengangkatan', $akun->sk_pengangkatan) }}" >
                                    @error('sk_pengangkatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="tmt_pengangkatan" class="form-label">TMT Pengangkatan </label>
                                    <input type="date" class="form-control form-control-sm {{$errors->first('tmt_pengangkatan') ? "is-invalid" : "" }}" id="tmt_pengangkatan" name="tmt_pengangkatan" value="{{ \Carbon\Carbon::parse($akun->tmt_pengangkatan)->format('Y-m-d') }}" >
                                    @error('tmt_pengangkatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="lembaga_pengangkatan" class="form-label">Nama Lembaga Pengangkatan</label>
                                <input type="text" class="form-control form-control-sm {{$errors->first('lembaga_pengangkatan') ? "is-invalid" : "" }}" id="lembaga_pengangkatan" name="lembaga_pengangkatan" value="{{ old('lembaga_pengangkatan', $akun->lembaga_pengangkatan) }}" >
                                @error('lembaga_pengangkatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="npwp">NPWP</label>
                                <input id="npwp" type="tel" name="npwp" class="form-control form-control-sm {{$errors->first('npwp') ? "is-invalid" : "" }}" value="{{ old('npwp', $akun->npwp) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" >
                                @error('npwp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-md-6">
                                    <label for="bank">Pangkat Golongan</label>
                                    <select class="form-control form-control-sm select2" id="bank" name="bank">
                                        @if (isset($akun->bank ))
                                            <option value="{{ $akun->bank }}" selected>{{$akun->bank }}</option>
                                            @endif
                                        <option value="">--Pilih Bank--</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BRI Syariah">BRI Syariah</option>
                                        <option value="MANDIRI">MANDIRI</option>
                                        <option value="Syariah Mandiri">Syariah Mandiri</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BCA Syariah">BCA Syariah</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BNI Syariah">BNI Syariah</option>
                                        <option value="BTN">BTN</option>
                                        <option value="BTN Syariah">BTN Syariah</option>
                                        <option value="BJB">BJB</option>
                                        <option value="BJB Syariah">BJB Syariah</option>
                                        <option value="Muamalat Indonesia">Muamalat Indonesia</option>
                                        <option value="BSI">BSI</option>
                                        <option value="CIMB Niaga">CIMB Niaga</option>
                                        <option value="MEGA">MEGA</option>
                                        <option value="MEGA Syariah">MEGA Syariah</option>
                                        <option value="Danamon">Danamon</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="no_rek">Nomor Rekening</label>
                                    <input id="no_rek" type="tel" name="no_rek" class="form-control form-control-sm {{$errors->first('no_rek') ? "is-invalid" : "" }}" value="{{ old('no_rek', $akun->no_rek) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" >
                                    @error('no_rek')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama_rek" class="form-label">Nama Pemilik Rekening </label>
                                <input type="text" class="form-control form-control-sm {{$errors->first('nama_rek') ? "is-invalid" : "" }}" id="nama_rek" name="nama_rek" value="{{ old('nama_rek', $akun->nama_rek) }}" >
                                @error('nama_rek')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{-- Button Submit --}}
                            <button type="submit" class="btn btn-primary mt-3"><span class="fe fe-save"></span> Simpan</button>
                        </div>
                        {{-- Tab Akun --}}
                        <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control {{$errors->first('username') ? "is-invalid" : "" }}" id="username" name="username" value="{{ $akun->user->username }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" class="form-control {{$errors->first('old_password') ? "is-invalid" : "" }}" id="old_password" name="old_password" >
                                        @error('old_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control {{$errors->first('password') ? "is-invalid" : "" }}" id="password" name="password" >
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : "" }}" id="password_confirmation" name="password_confirmation" >
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">Ketentuan Keamanan</p>
                                    <p class="small text-muted mb-2"> Untuk membuat password, pastikan sesuai ketentuan berikut: </p>
                                    <ul class="small text-muted pl-4 mb-0">
                                        <li> Minimal 8 karakter </li>
                                        <li> Tidak boleh sama dengan password sebelumnya </li>
                                    </ul>
                                    <p class="small text-muted mb-2 mt-4"> Apabila anda mengganti username :</p>
                                    <ul class="small text-muted pl-4 mb-0">
                                        <li> Username harus unik </li>
                                        <li> Tidak bisa sama dengan username yang sudah ada </li>
                                    </ul>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        {{-- Tab Dokumen --}}
                        <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                            <div class="card-deck my-2">
                                <div class="card mb-4 shadow">
                                    <div class="card-header">Kartu Keluarga</div>
                                    <div class="card-body text-center my-4">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($akun->dokumen->kartu_keluarga))
                                                <iframe src="{{ asset('storage/' . $akun->dokumen->kartu_keluarga) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                            <div class="card-deck my-2">
                                <div class="card mb-4 shadow">
                                    <div class="card-header">Ijazah</div>
                                    <div class="card-body text-center my-4">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($akun->dokumen->ijazah))
                                                <iframe src="{{ asset('storage/' . $akun->dokumen->ijazah) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                            <div class="card-deck my-2">
                                <div class="card mb-4 shadow">
                                    <div class="card-header">Berkas Lainnya</div>
                                    <div class="card-body text-center my-4">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($akun->dokumen->berkas))
                                                <iframe src="{{ asset('storage/' . $akun->dokumen->berkas) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                        </div>
                    </div>
                    </form>
                </div> <!-- /.card-body -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div>
@endsection

