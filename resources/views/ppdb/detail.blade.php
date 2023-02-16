@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Detail Calon Siswa</h2>
                <div class="row mt-5 align-items-center">
                    <div class="col">
                      <div class="row align-items-center">
                        <div class="col-md-7">
                          <h4 class="mb-1">{{ $ppdb->nama_siswa }}</h4>
                          <p class="mb-0"><span class="badge badge-dark">NISN : {{$ppdb->nisn}}</span></p>
                          <p class="mb-3">NIK : <b>{{$ppdb->nik}}</b></p>
                          <div><b>{{$ppdb->jk}}</b></div> 
                          <div>Lahir di <b>{{$ppdb->tempat_lahir .', '. \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('d F Y') }}</b></div>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="col-md-7">
                            <p class="small mb-0 text-muted">{{ $ppdb->alamat }}</p>
                            <p class="small mb-0 text-muted">{{ $ppdb->kelurahan }}</p>
                            <p class="small mb-0 text-muted">{{ $ppdb->kecamatan .', '. $ppdb->kabupaten .', '. $ppdb->provinsi}}</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-4">
                      <div class="card mb-4 shadow">
                        <div class="card-body my-n3">
                          <div class="row align-items-center">
                            <div class="col">
                              <a href="#">
                                <h3 class="h5 mt-4 mb-1 text-center">Orang Tua</h3><hr>
                              </a>
                              <ul>
                                <li><b>Ayah</b>
                                    <ul>
                                        <li>Nama : <b>{{$ppdb->nama_ayah}}</b></li>
                                        <li>NIK : <b>{{$ppdb->nik_ayah}}</b></li>
                                        <li>Tanggal Lahir : <b>{{ \Carbon\Carbon::parse($ppdb->tgl_lahir_ayah)->format('d F Y') }}</b></li>
                                        <li>Pendidikan : <b>{{$ppdb->pendidikan_ayah}}</b></li>
                                        <li>Pekerjaan : <b>{{$ppdb->pekerjaan_ayah}}</b></li>
                                        <li>Penghasilan : Rp. <b>{{ number_format($ppdb->penghasilan_ayah, '2', '.', '.')}}</b></li>
                                    </ul>
                                </li>
                                <li><b>Ibu</b>
                                    <ul>
                                        <li>Nama : <b>{{$ppdb->nama_ibu}}</b></li>
                                        <li>NIK : <b>{{$ppdb->nik_ibu}}</b></li>
                                        <li>Tanggal Lahir : <b>{{ \Carbon\Carbon::parse($ppdb->tgl_lahir_ibu)->format('d F Y') }}</b></li>
                                        <li>Pendidikan : <b>{{$ppdb->pendidikan_ibu}}</b></li>
                                        <li>Pekerjaan : <b>{{$ppdb->pekerjaan_ibu}}</b></li>
                                        <li>Penghasilan : Rp. <b>{{ number_format($ppdb->penghasilan_ibu, '2', '.', '.')}}</b></li>
                                    </ul>
                                </li>
                              </ul>
                            </div> <!-- .col -->
                          </div> <!-- .row -->
                        </div> <!-- .card-body -->
                      </div> <!-- .card -->
                    </div> <!-- .col-md-->
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                    <span class="circle circle-lg bg-light">
                                        <i class="fe fe-book fe-24 text-primary"></i>
                                    </span>
                                    </div> <!-- .col -->
                                    <div class="col">
                                        <a href="#">
                                            <h3 class="h5 mt-4 mb-1">Sekolah</h3><hr>
                                        </a>
                                        <ul>
                                            <li>Asal Sekolah : <b>{{$ppdb->asal_sekolah}}</b></li>
                                            <li>Nomor Ijazah : <b>{{$ppdb->no_ijazah}}</b></li>
                                            <li>Nomor SKHUN : <b>{{$ppdb->no_skhun}}</b></li>
                                            <li>Nomor KIP : <b>{{$ppdb->no_kip}}</b></li>
                                            <li>Nama di KIP : <b>{{$ppdb->nama_kip}}</b></li>
                                        </ul>
                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col-md-->
                    <div class="col-md-4">
                      <div class="card mb-4 shadow">
                        <div class="card-body my-n3">
                          <div class="row align-items-center">
                            <div class="col-3 text-center">
                              <span class="circle circle-lg bg-light">
                                <img src="{{asset('img/'. $ppdb->jurusan->kode. '.png')}}" alt="" class="img-fluid">
                              </span>
                            </div> <!-- .col -->
                            <div class="col">
                                <a href="#">
                                    <h3 class="h5 mt-4 mb-1">Jurusan Dipilih</h3><hr>
                                </a>
                                <h4><b>{{$ppdb->jurusan->nama}}</b></h4>
                                <p class="text-muted">{{$ppdb->jurusan->deskripsi}}</p>
                            </div> <!-- .col -->
                          </div> <!-- .row -->
                        </div> <!-- .card-body -->
                      </div> <!-- .card -->
                    </div> <!-- .col-md-->
                </div>
                <div>
                    <a href="/dashboard/ppdb" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
