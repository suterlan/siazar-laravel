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
                <h2 class="h3 mb-4 page-title">Settings Profile</h2>
                <div class="my-4">
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="akun-tab" data-toggle="tab" href="#akun" role="tab" aria-controls="akun" aria-selected="false">Akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</a>
                        </li>
                    </ul>
                <form action="/dashboard-siswa/akun/{{$akun->id}}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @method('put')
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        {{-- Tab Profile --}}
                        <div class="tab-pane fade active show" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                            <div class="row mt-5 align-items-center">
                                <div class="col-md-4 mb-4">
                                    <div class="avatar avatar-xl text-center">
                                        @if(isset($akun->dokumen->foto))
                                        <img src="{{ asset('storage/'. $akun->dokumen->foto) }}" alt="..." class="avatar-img rounded-circle">
                                        @else
                                        <img src="#" class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <div class="custom-file mt-3">
                                        <input type="hidden" name="old_foto" value="{{$akun->dokumen->foto ?? ''}}">
                                        <input name="foto" type="file" class="custom-file-input {{$errors->first('foto') ? "is-invalid" : "" }}" id="foto" >
                                        <label class="custom-file-label" for="foto">Ubah</label>
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p><small class="text-primary">* Untuk hasil terbaik ukuran foto harus 300 x 300</small></p>
                                </div>
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <h4 class="mb-1">{{ $akun->nama_siswa }}</h4>
                                            <p>{{ $akun->tempat_lahir }}, {{ \Carbon\Carbon::parse($akun->tgl_lahir)->format('d-m-Y') }}</p>
                                            <div class="d-flex">NIS : <h5><span class="badge badge-dark">{{ $akun->nis }}</span></h5></div>
                                            <div class="d-flex">NISN : <h5><span class="badge badge-dark">{{ $akun->nisn }}</span></h5></div>
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
                                            <li class="text-muted"> Akte Lahir
                                                @if(isset($akun->dokumen->akte))
                                                    <span class="badge badge-success"> Ada</span>
                                                    <span class="fe fe-check fe-16 text-success"></span>
                                                @else
                                                    <span class="badge badge-danger"> Belum ada</span>
                                                @endif
                                            </li>
                                            <li class="text-muted"> KTP Orang Tua
                                                @if(isset($akun->dokumen->ktp_ortu))
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
                            <div class="form-row">
                                <div class="form-group mb-2 col-md-6">
                                    <label for="nisn" class="form-label">NISN<small class="text-danger">(*)</small></label>
                                    <input type="text" class="form-control form-control-sm {{$errors->first('nisn') ? "is-invalid" : "" }}" id="nisn" name="nisn" value="{{ old('nisn', $akun->nisn) }}" required readonly>
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="nik">NIK <small class="text-danger">(*)</small></label>
                                    <input id="nik" type="tel" name="nik" class="form-control form-control-sm {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{ old('nik', $akun->nik) }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="16" required readonly>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama" class="form-label">Nama Lengkap<small class="text-danger">(*)</small></label>
                                <input type="text" class="form-control form-control-sm {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" id="nama" name="nama_siswa" value="{{ old('nama_siswa', $akun->nama_siswa) }}" required>
                                @error('nama_siswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Jenis Kelamin <small class="text-danger">(*)</small></label><br>
                                <label class="radio-inline me-2" for="jk1">
                                    <input type="radio" name="jk" id="jk1" class="me-2" value="Laki-laki" @if ($akun->jk == "Laki-laki") checked @endif> Laki-laki
                                </label>
                                <label class="radio-inline" for="jk2">
                                    <input type="radio" name="jk" id="jk2" class="me-2" value="Perempuan" @if ($akun->jk == "Perempuan") checked @endif> Perempuan
                                    </label>
                                @error('jk')
                                    <div class="error text-danger"><small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="no_hp">Nomor Hanphone</label>
                                <input id="no_hp" type="tel" name="no_hp" class="form-control form-control-sm {{$errors->first('no_hp') ? "is-invalid" : "" }}" value="{{ old('no_hp', $akun->no_hp) }}" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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

                            <hr>
                            <h5 class="mt-4 mb-3">Upload Dokumen (format Pdf)</h5>
                            <div class="form-group mb-3">
                                {{-- <label for="">Kartu Keluarga @if(isset($siswa->dokumen->kartu_keluarga)) <span class="fe fe-check fe-16 text-success"></span> @endif</label> --}}
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
                                {{-- <label for="">Ijazah SMP @if(isset($siswa->dokumen->ijazah)) <span class="fe fe-check fe-16 text-success"></span> @endif</label> --}}
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
                                {{-- <label for="">Akte Kelahiran @if(isset($siswa->dokumen->akte)) <span class="fe fe-check fe-16 text-success"></span> @endif</label> --}}
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
                                {{-- <label for="">KTP Orang Tua @if(isset($siswa->dokumen->ktp_ortu)) <span class="fe fe-check fe-16 text-success"></span> @endif</label> --}}
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
                                {{-- <label for="">Berkas Lainnya @if(isset($siswa->dokumen->berkas)) <span class="fe fe-check fe-16 text-success"></span> @endif</label> --}}
                                <div class="custom-file">
                                    <input type="hidden" name="old_berkas" value="{{$siswa->dokumen->berkas ?? ''}}">
                                    <input name="berkas" type="file" class="custom-file-input {{$errors->first('berkas') ? "is-invalid" : "" }}" id="berkas" >
                                    <label class="custom-file-label" for="berkas">Scan berkas lainnya</label>
                                    @error('berkas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                        <input type="text" class="form-control {{$errors->first('username') ? "is-invalid" : "" }}" id="username" name="username" value="{{ $akun->user->username }}" readonly>
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
                                    <div class="card-header">Akte Kelahiran</div>
                                    <div class="card-body text-center my-4">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($akun->dokumen->akte))
                                                <iframe src="{{ asset('storage/' . $akun->dokumen->akte) }}" ></iframe>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </div>
                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->
                            </div>
                            <div class="card-deck my-2">
                                <div class="card mb-4 shadow">
                                    <div class="card-header">KTP Ortu</div>
                                    <div class="card-body text-center my-4">
                                        <div class="embed-responsive embed-responsive-1by1">
                                            @if (isset($akun->dokumen->ktp_ortu))
                                                <iframe src="{{ asset('storage/' . $akun->dokumen->ktp_ortu) }}" ></iframe>
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

