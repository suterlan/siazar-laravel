@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                <form action="/dashboard/guru/{{$guru->id}}" method="POST" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                    @method('put')
                    @csrf
                    <a href="/dashboard/guru" class="btn btn-danger mb-3" type="button"><span class="fe fe-arrow-left"></span> Kembali</a>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary mb-3"><span class="fe fe-save"></span> Update</button>
                    </div>
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <p class="card-title"><strong> FOTO </strong></p>
                            <div class="row">
                                <div class="col-sm-4">
                                    @if (isset( $guru->dokumen->foto))
                                        <img class="img-thumbnail w-50 mx-auto d-block" src="{{asset('storage/' . $guru->dokumen->foto)}}" alt="">
                                    @else
                                        <img class="img-thumbnail w-50" alt="">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-2">
                                        <label for="foto">Foto @if(isset($guru->dokumen->foto)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="old_foto" value="{{$guru->dokumen->foto}}">
                                            <input name="foto" type="file" class="custom-file-input {{$errors->first('foto') ? "is-invalid" : "" }}" id="foto" >
                                            <label class="custom-file-label" for="foto">Ubah Foto</label>
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="kartu_keluarga">Kartu Keluarga @if(isset($guru->dokumen->kartu_keluarga)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="old_kartu_keluarga" value="{{$guru->dokumen->kartu_keluarga}}">
                                            <input name="kartu_keluarga" type="file" class="custom-file-input {{$errors->first('kartu_keluarga') ? "is-invalid" : "" }}" id="kartu_keluarga" >
                                            <label class="custom-file-label" for="kartu_keluarga">Ubah KK</label>
                                            @error('kartu_keluarga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="ijazah">Ijazah Terakhir @if(isset($guru->dokumen->ijazah)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="old_ijazah" value="{{$guru->dokumen->ijazah}}">
                                            <input name="ijazah" type="file" class="custom-file-input {{$errors->first('ijazah') ? "is-invalid" : "" }}" id="ijazah" >
                                            <label class="custom-file-label" for="ijazah">Ubah Ijazah</label>
                                            @error('ijazah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="berkas">Berkas Lainnya @if(isset($guru->dokumen->berkas)) <span class="fe fe-check fe-16 text-success"></span> @endif</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="old_berkas" value="{{$guru->dokumen->berkas}}">
                                            <input name="berkas" type="file" class="custom-file-input {{$errors->first('berkas') ? "is-invalid" : "" }}" id="berkas" >
                                            <label class="custom-file-label" for="berkas">Ubah berkas lainnya</label>
                                            @error('berkas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <p>
                                        <strong class="card-title">PROFIL </strong>
                                    </p>
                                    <div class="form-group mb-2">
                                        <label for="nama" class="form-label">Nama Lengkap (serta gelar jika ada) <small class="text-danger">(*)</small></label>
                                        <input type="text" class="form-control form-control-sm {{$errors->first('nama') ? "is-invalid" : "" }}" id="nama" name="nama" value="{{ old('nama', $guru->nama) }}" required>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email" class="form-label">Email <small class="text-danger">(*)</small></label>
                                        <p class="text-info" style="font-size: 12px">*) Jika email di ubah, email di akun login akan otomatis berubah</p>
                                        <input type="email" class="form-control form-control-sm {{$errors->first('email') ? "is-invalid" : "" }}" id="email" name="email" value="{{ old('email', $guru->email) }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Jenis Kelamin <small class="text-danger">(*)</small></label><br>
                                        <label class="radio-inline me-2" for="jk1">
                                            <input type="radio" name="jk" id="jk1" class="me-2" value="L" @if ($guru->jk == "L") checked @endif> Laki-laki
                                        </label>
                                        <label class="radio-inline" for="jk2">
                                            <input type="radio" name="jk" id="jk2" class="me-2" value="P" @if ($guru->jk == "P") checked @endif> Perempuan
                                            </label>
                                        @error('jk')
                                            <div class="error text-danger"><small>{{ $message }}</small> </div>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="nik">NIK <small class="text-danger">(*)</small></label>
                                            <input id="nik" type="tel" name="nik" class="form-control form-control-sm {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{ old('nik', $guru->nik) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required>
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="no_hp">Nomor Hanphone</label>
                                            <input id="no_hp" type="tel" name="no_hp" class="form-control form-control-sm {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp', $guru->no_hp) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="mb-2 col-md-6">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">(*)</small></label>
                                            <input type="text" class="form-control form-control-sm {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" required>
                                            @error('tempat_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <small class="text-danger">(*)</small></label>
                                            <input type="date" class="form-control form-control-sm {{$errors->first('tanggal_lahir') ? "is-invalid" : "" }}" id="tanggal_lahir" name="tanggal_lahir" value="{{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('Y-m-d') }}" required>
                                            @error('tanggal_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="nama_ibu" class="form-label">Nama Ibu Kandung</label>
                                        <input type="text" class="form-control form-control-sm {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $guru->nama_ibu) }}">
                                        @error('nama_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control form-control-sm {{$errors->first('alamat') ? "is-invalid" : "" }}" id="alamat" name="alamat" rows="2">{{ old('alamat', $guru->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="provinsi">Provinsi<small class="text-danger">(*)</small></label>
                                        <select class="custom-select custom-select-sm {{$errors->first('provinsi') ? "is-invalid" : "" }}" id="provinsi" name="provinsi" required>
                                            <option value="">==Pilih Provinsi==</option>
                                            @foreach ($provinces as $code => $name)
                                                @if (old('provinsi', $guru->provinsi) == $name)
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
                                            @if (isset($guru->kabupaten))
                                                <option value="{{ $guru->kabupaten}}" selected>{{ $guru->kabupaten}}</option>
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
                                            @if (isset($guru->kecamatan))
                                                <option value="{{ $guru->kecamatan}}" selected>{{$guru->kecamatan}}</option>
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
                                            @if (isset($guru->kelurahan))
                                                <option value="{{ $guru->kelurahan}}" selected>{{$guru->kelurahan}}</option>
                                            @endif
                                            {{-- javascript code here --}}
                                        </select>
                                        @error('kelurahan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> {{-- end card body --}}
                            </div> {{-- end card--}}
                        </div> {{-- end col 6 --}}
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <p>
                                        <strong class="card-title">RIWAYAT PENDIDIKAN</strong>
                                    </p>
                                    <div class="form-row">
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                            <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="custom-select custom-select-sm {{$errors->first('pendidikan_terakhir') ? "is-invalid" : "" }}" >
                                                @if (isset($guru->pendidikan_terakhir))
                                                    <option value="{{ $guru->pendidikan_terakhir }}" selected>{{ $guru->pendidikan_terakhir }}</option>
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
                                            <input type="text" class="form-control form-control-sm {{$errors->first('jurusan') ? "is-invalid" : "" }}" id="jurusan" name="jurusan" value="{{ old('jurusan', $guru->jurusan) }}" >
                                            @error('jurusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="sk_cpns" class="form-label">SK CPNS</label>
                                        <input type="text" class="form-control form-control-sm {{$errors->first('sk_cpns') ? "is-invalid" : "" }}" id="sk_cpns" name="sk_cpns" value="{{ old('sk_cpns', $guru->sk_cpns) }}" >
                                        @error('sk_cpns')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="tanggal_cpns" class="form-label">Tanggal CPNS </label>
                                        <input type="date" class="form-control form-control-sm {{$errors->first('tanggal_cpns') ? "is-invalid" : "" }}" id="tanggal_cpns" name="tanggal_cpns" value="{{ \Carbon\Carbon::parse($guru->tanggal_cpns)->format('Y-m-d') }}" >
                                        @error('tanggal_cpns')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="nip">NIP </label>
                                            <input id="nip" type="tel" name="nip" class="form-control form-control-sm {{$errors->first('nip') ? "is-invalid" : "" }}" value="{{ old('nip', $guru->nip) }}" onKeyDown="if(this.value.length==18 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="18" >
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="tmt_pns" class="form-label">TMT PNS </label>
                                            <input type="date" class="form-control form-control-sm {{$errors->first('tmt_pns') ? "is-invalid" : "" }}" id="tmt_pns" name="tmt_pns" value="{{ \Carbon\Carbon::parse($guru->tmt_pns)->format('Y-m-d') }}" >
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
                                            @if (isset( $guru->pangkat_golongan ))
                                                    <option value="{{ $guru->pangkat_golongan }}" selected>{{ $guru->pangkat_golongan }}</option>
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
                                        <input id="nuptk" type="tel" name="nuptk" class="form-control form-control-sm {{$errors->first('nuptk') ? "is-invalid" : "" }}" value="{{ old('nuptk', $guru->nuptk) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" >
                                        @error('nuptk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="sk_pengangkatan" class="form-label">SK Pengangkatan</label>
                                            <input type="text" class="form-control form-control-sm {{$errors->first('sk_pengangkatan') ? "is-invalid" : "" }}" id="sk_pengangkatan" name="sk_pengangkatan" value="{{ old('sk_pengangkatan', $guru->sk_pengangkatan) }}" >
                                            @error('sk_pengangkatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="tmt_pengangkatan" class="form-label">TMT Pengangkatan </label>
                                            <input type="date" class="form-control form-control-sm {{$errors->first('tmt_pengangkatan') ? "is-invalid" : "" }}" id="tmt_pengangkatan" name="tmt_pengangkatan" value="{{ \Carbon\Carbon::parse($guru->tmt_pengangkatan)->format('Y-m-d') }}" >
                                            @error('tmt_pengangkatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="lembaga_pengangkatan" class="form-label">Nama Lembaga Pengangkatan</label>
                                        <input type="text" class="form-control form-control-sm {{$errors->first('lembaga_pengangkatan') ? "is-invalid" : "" }}" id="lembaga_pengangkatan" name="lembaga_pengangkatan" value="{{ old('lembaga_pengangkatan', $guru->lembaga_pengangkatan) }}" >
                                        @error('lembaga_pengangkatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="npwp">NPWP</label>
                                        <input id="npwp" type="tel" name="npwp" class="form-control form-control-sm {{$errors->first('npwp') ? "is-invalid" : "" }}" value="{{ old('npwp', $guru->npwp) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" >
                                        @error('npwp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="bank">Pangkat Golongan</label>
                                            <select class="form-control form-control-sm select2" id="bank" name="bank">
                                                @if (isset($guru->bank ))
                                                    <option value="{{ $guru->bank }}" selected>{{$guru->bank }}</option>
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
                                            <input id="no_rek" type="tel" name="no_rek" class="form-control form-control-sm {{$errors->first('no_rek') ? "is-invalid" : "" }}" value="{{ old('no_rek', $guru->no_rek) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" >
                                            @error('no_rek')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="nama_rek" class="form-label">Nama Pemilik Rekening </label>
                                        <input type="text" class="form-control form-control-sm {{$errors->first('nama_rek') ? "is-invalid" : "" }}" id="nama_rek" name="nama_rek" value="{{ old('nama_rek', $guru->nama_rek) }}" >
                                        @error('nama_rek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div> {{-- end card body --}}
                            </div> {{-- end card --}}
                        </div> {{-- end col 6 --}}
                    </div> {{-- end row --}}
                </form>
            </div> {{-- end col 12 --}}
        </div> {{-- end row --}}
    </div>
</div>
<script>
    let provinsi = document.querySelector('#provinsi');
    provinsi.addEventListener('change', async () =>{
        let code = provinsi.options[provinsi.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kabupaten');

        const wilayah = await getWilayah('/getKabupaten?code=', code);
        updateOption(wilayah, idSelect);
    });

    let kabupaten = document.querySelector('#kabupaten');
    kabupaten.addEventListener('change', async () =>{
        let code = kabupaten.options[kabupaten.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kecamatan');
        
        const wilayah = await getWilayah('/getKecamatan?code=', code);
        updateOption(wilayah, idSelect);
    });

    let kecamatan = document.querySelector('#kecamatan');
    kecamatan.addEventListener('change', async () =>{
        let code = kecamatan.options[kecamatan.selectedIndex].getAttribute('data-code');
        const idSelect = document.querySelector('#kelurahan');
        
        const wilayah = await getWilayah('/getKelurahan?code=', code);
        updateOption(wilayah, idSelect);
    });

    function getWilayah(url, code){
        return fetch(url + code)
        .then(response => response.json())
        .then(response => response);
    }

    function updateOption(wilayah, idSelect){
        let options = '';
        options += `<option value="">==Pilih==</option>`;
        wilayah.forEach(i => options += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`);
        idSelect.innerHTML = options;
    }
</script>
@endsection