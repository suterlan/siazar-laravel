@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 1 ? 'active' : '' }}" href="#step1">Profil Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 2 ? 'active' : '' }}" href="#step2">Riwayat Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 3 ? 'active' : '' }}" href="#step3">Data Orang Tua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $step == 4 ? 'active' : '' }}" href="#step4">Finish</a>
                        </li>
                    </ul>
                </div>
                <form action="/dashboard/siswa" method="POST">
                    @csrf
                    <div id="step4" class="my-2 pt-4">
                        <h6><span class="fe fe-list text-primary"></span> PILIH JURUSAN YANG DIMINATI</h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jurusan_id">Jurusan</label>
                                <select class="form-control select2 {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" id="jurusan_id" name="jurusan_id" required>
                                    <option value="">==Pilih jurusan==</option>
                                    @foreach ($jurusan as $value)
                                        @if (old('jurusan_id') == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->kode . ' - ' . $value->nama }}</option>
                                        @endif
                                        <option value="{{ $value->id }}">{{ $value->kode . ' - ' . $value->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kelas_id">Kelas</label>
                                <select class="form-control select2 {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                                    <option value="">==Pilih Kelas==</option>
                                    @foreach ($kelas as $value)
                                        @if (old('kelas_id') == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                        @endif
                                        <option value="{{ $value->id }}">{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" class="form-control" value="{{$registrasi->nama_siswa ?? ''}}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nisn">NISN</label>
                                <input type="text" id="nisn" class="form-control" value="{{$registrasi->nisn ?? ''}}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <h5><span class="fe fe-user text-primary"></span> PROFIL CALON SISWA</h5>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Jenis Kelamin : <b> {{ $registrasi->jk ?? '' }}</b></li>
                                    <li class="list-group-item">Tempat, Tgl Lahir : <b>{{ $registrasi->tempat_lahir ?? '', $registrasi->tgl_lahir ?? ''}}</b></li>
                                    <li class="list-group-item">Tgl Lahir : <b>{{ $registrasi->tgl_lahir ?? ''}}</b></li>
                                    <li class="list-group-item">NIK : <b>{{$registrasi->nik ?? ''}}</b></li>
                                    <li class="list-group-item">Alamat : <b>{{$registrasi->alamat ?? ''}}</b></li>
                                    <li class="list-group-item">Kelurahan : <b>{{ $registrasi->kelurahan ?? '' }}</b></li>
                                    <li class="list-group-item">Kecamatan : <b>{{ $registrasi->kecamatan ?? '' }}</b></li>
                                    <li class="list-group-item">Kabupaten : <b>{{ $registrasi->kabupaten ?? '' }}</b></li>
                                    <li class="list-group-item">Provinsi : <b>{{ $registrasi->provinsi ?? '' }}</b></li>
                                    <li class="list-group-item">Jumlah Saudara Kandung: <b>{{ $registrasi->jml_saudara_kandung ?? '' }}</b></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <h5><span class="fe fe-file-text text-primary"></span> DATA PENDIDIKAN CALON SISWA</h5>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Asal Sekolah : <b> {{ $registrasi->asal_sekolah ?? '' }}</b></li>
                                    <li class="list-group-item">NISN : <b> {{ $registrasi->nisn ?? '' }}</b></li>
                                    <li class="list-group-item">Nomor Ijazah : <b> {{ $registrasi->no_ijazah ?? '' }}</b></li>
                                    <li class="list-group-item">Nomor SKHUN : <b> {{ $registrasi->no_skhun ?? '' }}</b></li>
                                    <li class="list-group-item">Nomor KIP : <b> {{ $registrasi->no_kip ?? '' }}</b></li>
                                    <li class="list-group-item">Nama di KIP : <b> {{ $registrasi->nama_kip ?? '' }}</b></li>
                                </ul>
                            </div>
                        </div>
                        <h5><span class="fe fe-heart text-danger mb-3"></span> ORANG TUA CALON SISWA</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Nama Ayah : <b>{{ $registrasi->nama_ayah ?? '' }}</b></li>
                                    <li class="list-group-item">NIK Ayah : <b>{{ $registrasi->nik_ayah ?? '' }}</b></li>
                                    <li class="list-group-item">Tanggal Lahir Ayah : <b>{{ $registrasi->tgl_lahir_ayah ?? '' }}</b></li>
                                    <li class="list-group-item">Pendidikan Terakhir : <b>{{ $registrasi->pendidikan_ayah ?? '' }}</b></li>
                                    <li class="list-group-item">Pekerjaan : <b>{{ $registrasi->pekerjaan_ayah ?? '' }}</b></li>
                                    <li class="list-group-item">Penghasilan : <b>{{ $registrasi->penghasilan_ayah ?? '' }}</b></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Nama Ibu : <b>{{ $registrasi->nama_ibu ?? '' }}</li>
                                    <li class="list-group-item">NIK Ibu : <b>{{ $registrasi->nik_ibu ?? '' }}</li>
                                    <li class="list-group-item">Tanggal Lahir Ibu : <b>{{ $registrasi->tgl_lahir_ibu ?? '' }}</li>
                                    <li class="list-group-item">Pendidikan Terakhir : <b>{{ $registrasi->pendidikan_ibu ?? '' }}</li>
                                    <li class="list-group-item">Pekerjaan : <b>{{ $registrasi->pekerjaan_ibu ?? '' }}</li>
                                    <li class="list-group-item">Penghasilan : <b>{{ $registrasi->penghasilan_ibu ?? '' }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <span class="fe fe-alert-triangle fe-16 mr-2"></span> Silahkan cek kembali! pastikan data yang anda masukan sudah benar!
                        </div>
                        <div class="float-right">
                            <a href="/dashboard/siswa/registrasi-step3" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                            <button class="btn btn-success" type="submit"><span class="fe fe-save mr-1"></span>Save</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection
