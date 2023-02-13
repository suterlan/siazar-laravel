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
                {{-- Step 3 --}}
                <form action="/dashboard/ppdb/registrasi-step3" method="POST">
                @csrf
                <div id="step3" class="my-2 pt-4">
                    <h3>DATA AYAH</h3>
                    <div class="mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <input id="nama_ayah" name="nama_ayah" type="text" class="form-control {{$errors->first('nama_ayah') ? "is-invalid" : "" }}" value="{{old('nama_ayah', $registrasi->nama_ayah ?? '')}}">
                        @error('nama_ayah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik_ayah">NIK Ayah</label>
                        <input id="nik_ayah" type="tel" name="nik_ayah" class="form-control" value="{{ old('nik_ayah', $registrasi->nik_ayah ?? '') }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        @error('nik_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir_ayah" class="form-label">Tanggal Lahir </label>
                        <input id="tgl_lahir_ayah" name="tgl_lahir_ayah" type="date" class="form-control {{$errors->first('tgl_lahir_ayah') ? "is-invalid" : "" }}" value="{{ old('tgl_lahir_ayah', $registrasi->tgl_lahir_ayah ?? '' ) }}">
                        @error('tgl_lahir_ayah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_ayah">Pendidikan Terakhir</label>
                        <select id="pendidikan_ayah" name="pendidikan_ayah" class="custom-select {{$errors->first('pendidikan_ayah') ? "is-invalid" : "" }}" >
                            @if(isset($registrasi->pendidikan_ayah))
                                <option value="{{$registrasi->pendidikan_ayah ?? ''}}" selected>{{$registrasi->pendidikan_ayah ?? ''}}</option>
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
                    <div class="mb-3">
                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                        <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" class="form-control {{$errors->first('pekerjaan_ayah') ? "is-invalid" : "" }}" value="{{ old('pekerjaan_ayah', $registrasi->pekerjaan_ayah ?? '')}}">
                        @error('pekerjaan_ayah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                        <input id="penghasilan_ayah" name="penghasilan_ayah" type="number" class="form-control {{$errors->first('penghasilan_ayah') ? "is-invalid" : "" }}" maxlength="11" value="{{old('penghasilan_ayah', $registrasi->penghasilan_ayah ?? '')}}">
                        @error('penghasilan_ayah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <h3 class="mt-3">DATA IBU</h3>
                    <div class="mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <input id="nama_ibu" name="nama_ibu" type="text" class="form-control {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" value="{{old('nama_ibu', $registrasi->nama_ibu ?? '')}}">
                        @error('nama_ibu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik_ibu">NIK Ibu</label>
                        <input id="nik_ibu" type="tel" name="nik_ibu" class="form-control" value="{{ old('nik_ibu', $registrasi->nik_ibu ?? '') }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        @error('nik_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir_ibu" class="form-label">Tanggal Lahir </label>
                        <input id="tgl_lahir_ibu" name="tgl_lahir_ibu" type="date" class="form-control {{$errors->first('tgl_lahir_ibu') ? "is-invalid" : "" }}" value="{{ old('tgl_lahir_ibu', $registrasi->tgl_lahir_ibu ?? '')}}">
                        @error('tgl_lahir_ibu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                        <select id="pendidikan_ibu" name="pendidikan_ibu" class="custom-select {{$errors->first('pendidikan_ibu') ? "is-invalid" : "" }}">
                            @if(isset($registrasi->pendidikan_ibu))
                                <option value="{{$registrasi->pendidikan_ibu ?? ''}}" selected>{{$registrasi->pendidikan_ibu ?? ''}}</option>
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
                    <div class="mb-3">
                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                        <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" class="form-control {{$errors->first('pekerjaan_ibu') ? "is-invalid" : "" }}" value="{{ old('pekerjaan_ibu', $registrasi->pekerjaan_ibu ?? '')}}">
                        @error('pekerjaan_ibu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                        <input id="penghasilan_ibu" name="penghasilan_ibu" type="number" class="form-control {{$errors->first('penghasilan_ibu') ? "is-invalid" : "" }}" value="{{ old('penghasilan_ibu', $registrasi->penghasilan_ibu ?? '')}}">
                        @error('penghasilan_ibu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="float-right">
                        <a href="/dashboard/ppdb/registrasi-step2" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                        <button class="btn btn-primary" type="submit"><span class="fe fe-arrow-right"></span>Next</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
