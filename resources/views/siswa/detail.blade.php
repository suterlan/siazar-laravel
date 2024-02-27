@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-3 page-title">Detail Siswa</h2>
                {{-- <div>
                    <a href="/dashboard/siswa" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                </div> --}}
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            @if(isset($siswa->dokumen->foto))
                                <img src="{{asset('storage/'. $siswa->dokumen->foto)}}" alt="..." class="avatar-img rounded-circle">
                            @else
                                <div class="circle circle-lg bg-secondary">
                                    <span class="fe fe-user fe-32 text-light"></span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                      <div class="row align-items-center">
                        <div class="col-md-7">
                          <h4 class="mb-1">{{ $siswa->nama_siswa }}</h4>
                          <p class="mb-0"><span class="badge badge-dark">NIS : {{$siswa->nis}}</span></p>
                          <p class="mb-0"><span class="badge badge-dark">NISN : {{$siswa->nisn}}</span></p>
                          <p class="mb-3">NIK : <b>{{$siswa->nik}}</b></p>
                          <div><b>{{$siswa->jk}}</b></div>
                          <div>Lahir di <b>{{$siswa->tempat_lahir .', '. \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d F Y') }}</b></div>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="col-md-7">
                            <p class="small mb-0 text-muted">{{ $siswa->alamat }}</p>
                            <p class="small mb-0 text-muted">{{ $siswa->kelurahan }}</p>
                            <p class="small mb-0 text-muted">{{ $siswa->kecamatan .', '. $siswa->kabupaten .', '. $siswa->provinsi}}</p>
                            <p class="small mb-0 text-muted">HP : {{ $siswa->no_hp }}</p>
                            <p class="mb-0 text-muted">Kelas {{$siswa->kelas->nama ?? '' . ' - ' . $siswa->jurusan->kode ?? '' . ' ' . $siswa->tahun_ajaran}}</p>
                        </div>
                        <div class="col">
                            <p class="small mb-0 text-muted">Asal Sekolah <b>{{ $siswa->asal_sekolah }}</b></p>
                            <p class="small mb-0 text-muted">Nomor Ijazah <b>{{ $siswa->no_ijazah }}</b></p>
                            <p class="small mb-0 text-muted">Nomor SKHUN <b>{{ $siswa->no_skhun }}</b></p>
                            <p class="small mb-0 text-muted">Nomor KIP <b>{{ $siswa->no_kip }}</b></p>
                            <p class="small mb-0 text-muted">Nama di KIP <b>{{ $siswa->nama_kip }}</b></p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row my-4">
                        <div class="card-group">

                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="h5 mt-4 mb-1 text-center">Ayah</h3><hr>
                                            <ul>
                                                <li>Nama : <b>{{$siswa->nama_ayah}}</b></li>
                                                <li>NIK : <b>{{$siswa->nik_ayah}}</b></li>
                                                <li>Tanggal Lahir : <b>{{ \Carbon\Carbon::parse($siswa->tgl_lahir_ayah)->format('d F Y') }}</b></li>
                                                <li>Pendidikan : <b>{{$siswa->pendidikan_ayah}}</b></li>
                                                <li>Pekerjaan : <b>{{$siswa->pekerjaan_ayah}}</b></li>
                                                <li>Penghasilan : Rp. <b>{{ number_format($siswa->penghasilan_ayah, '2', '.', '.')}}</b></li>
                                            </ul>
                                        </div> <!-- .col -->
                                    </div> <!-- .row -->
                                </div> <!-- .card-body -->
                                <div class="card-footer"></div>
                            </div> <!-- .card -->

                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                        <span class="circle circle-lg bg-light">
                                            <i class="fe fe-book fe-24 text-primary"></i>
                                        </span>
                                        </div> <!-- .col -->
                                        <div class="col">
                                            <h3 class="h5 mt-4 mb-1">IBU</h3><hr>
                                            <ul>
                                                <li>Nama : <b>{{$siswa->nama_ibu}}</b></li>
                                                <li>NIK : <b>{{$siswa->nik_ibu}}</b></li>
                                                <li>Tanggal Lahir : <b>{{ \Carbon\Carbon::parse($siswa->tgl_lahir_ibu)->format('d F Y') }}</b></li>
                                                <li>Pendidikan : <b>{{$siswa->pendidikan_ibu}}</b></li>
                                                <li>Pekerjaan : <b>{{$siswa->pekerjaan_ibu}}</b></li>
                                                <li>Penghasilan : Rp. <b>{{ number_format($siswa->penghasilan_ibu, '2', '.', '.')}}</b></li>
                                            </ul>
                                        </div> <!-- .col -->
                                    </div> <!-- .row -->
                                </div> <!-- .card-body -->
                                <div class="card-footer"></div>
                            </div> <!-- .card -->

                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                        <span class="circle circle-lg bg-light">
                                            <img src="{{asset('storage/'. $siswa->jurusan->logo)}}" alt="" class="img-fluid">
                                        </span>
                                        </div> <!-- .col -->
                                        <div class="col">
                                                <h3 class="h5 mt-4 mb-1">Jurusan</h3><hr>
                                            <h4><b>{{$siswa->jurusan->nama}}</b></h4>
                                            <p class="text-muted">{{$siswa->jurusan->deskripsi}}</p>
                                        </div> <!-- .col -->
                                    </div> <!-- .row -->
                                </div> <!-- .card-body -->
                                <div class="card-footer"></div>
                            </div> <!-- .card -->

                        </div>
                    </div>
                </div>

                <h3>DOKUMEN</h3>
                <div class="card-deck my-2">
                    <div class="card mb-4 shadow">
                        <div class="card-header">Kartu Keluarga</div>
                        <div class="card-body text-center my-4">
                            <div class="embed-responsive embed-responsive-21by9">
                                @if (isset($siswa->dokumen->kartu_keluarga))
                                    <iframe src="{{ asset('storage/' . $siswa->dokumen->kartu_keluarga) }}" ></iframe>
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
                            <div class="embed-responsive embed-responsive-16by9">
                                @if (isset($siswa->dokumen->ijazah))
                                    <iframe src="{{ asset('storage/' . $siswa->dokumen->ijazah) }}" ></iframe>
                                @else
                                Tidak ada dokumen
                                @endif
                            </div>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                    <div class="card mb-4 shadow">
                        <div class="card-header">Akte Kelahiran</div>
                        <div class="card-body text-center my-4">
                            <div class="embed-responsive embed-responsive-16by9">
                                @if (isset($siswa->dokumen->akte))
                                <iframe src="{{ asset('storage/' . $siswa->dokumen->akte) }}" ></iframe>
                                @else
                                Tidak ada dokumen
                                @endif
                            </div>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div>
                <div class="card-deck my-2">
                    <div class="card mb-4 shadow">
                        <div class="card-header">KTP Orang Tua</div>
                        <div class="card-body text-center my-4">
                            <div class="embed-responsive embed-responsive-16by9">
                                @if (isset($siswa->dokumen->ktp_ortu))
                                <iframe src="{{ asset('storage/' . $siswa->dokumen->ktp_ortu) }}" ></iframe>
                                @else
                                Tidak ada dokumen
                                @endif
                            </div>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                    <div class="card mb-4 shadow">
                        <div class="card-header">Berkas Lainnya</div>
                        <div class="card-body text-center my-4">
                            <div class="embed-responsive embed-responsive-16by9">
                                @if (isset($siswa->dokumen->berkas))
                                <iframe src="{{ asset('storage/' . $siswa->dokumen->berkas) }}" ></iframe>
                                @else
                                Tidak ada dokumen
                                @endif
                            </div>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div>
            </div>
        </div>
    </div>
@endsection
