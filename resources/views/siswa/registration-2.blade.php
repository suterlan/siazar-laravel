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

                {{-- Step 2 --}}
                <form action="/dashboard/siswa/registrasi-step2" method="POST">
                    @csrf
                    <div id="step2" class="my-2 pt-4">
                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah <small class="text-danger">(*)</small></label>
                            <input type="text" list="asal" name="asal_sekolah" class="form-control {{$errors->first('asal_sekolah') ? "is-invalid" : "" }}" required />
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
                        <div class="mb-3">
                            <label for="nis">NIS <small class="text-danger">(*)</small></label>
                            <input id="nis" type="tel" name="nis" class="form-control {{$errors->first('nis') ? "is-invalid" : "" }}" value="{{ old('nis', $registrasi->nis ?? '') }}" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="11" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nisn">NISN <small class="text-danger">(*)</small></label>
                            <input id="nisn" type="tel" name="nisn" class="form-control {{$errors->first('nisn') ? "is-invalid" : "" }}" value="{{ old('nisn', $registrasi->nisn ?? '') }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="10" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_ijazah">Nomor Ijazah SMPN/MTs</label>
                            <input id="no_ijazah" type="text" name="no_ijazah" class="form-control {{$errors->first('no_ijazah') ? "is-invalid" : "" }}" value="{{ old('no_ijazah', $registrasi->no_ijazah ?? '') }}" maxlength="16">
                            @error('no_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_skhun">Nomor SKHUN</label>
                            <input id="no_skhun" type="text" name="no_skhun" class="form-control {{$errors->first('no_skhun') ? "is-invalid" : "" }}" value="{{ old('no_skhun', $registrasi->no_skhun ?? '') }}" maxlength="7">
                            @error('no_skhun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_kip">Nomor KIP</label>
                            <input id="no_kip" type="text" name="no_kip" class="form-control {{$errors->first('no_kip') ? "is-invalid" : "" }}" value="{{ old('no_kip', $registrasi->no_kip ?? '') }}" maxlength="7">
                            @error('no_kip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_kip" class="form-label">Nama di KIP </label>
                            <input id="nama_kip" type="text" name="nama_kip" class="form-control {{$errors->first('nama_kip') ? "is-invalid" : "" }}" value="{{old('nama_kip', $registrasi->nama_kip ?? '')}}">
                            @error('nama_kip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div>Ket : <span class="text-danger">(*)</span> = Wajib diisi</div>
                        </div>

                        <div class="float-right">
                            <a href="/dashboard/siswa/registrasi-step1" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                            <button class="btn btn-primary" type="submit"><span class="fe fe-arrow-right"></span>Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
