@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow text-white border-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-3 text-center">
                      <span class="circle circle-sm bg-primary-light">
                          <i class="fe fe-16 fe-user text-white mb-0"></i>
                      </span>
                    </div>
                    <div class="col pr-0">
                        <p class="small text-muted mb-0">Calon Siswa Tahun Ini</p>
                        <span class="h3 mb-0">{{$jmlCalonSiswa}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow border-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-3 text-center">
                      <span class="circle circle-sm bg-primary">
                        <i class="fe fe-16 fe-file text-white mb-0"></i>
                      </span>
                    </div>
                    <div class="col pr-0">
                      <p class="small text-muted mb-0">Laki-Laki</p>
                      <span class="h3 mb-0">{{$jmlLakiLaki}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow border-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-3 text-center">
                      <span class="circle circle-sm bg-primary">
                        <i class="fe fe-16 fe-file text-white mb-0"></i>
                      </span>
                    </div>
                    <div class="col pr-0">
                      <p class="small text-muted mb-0">Perempuan</p>
                      <span class="h3 mb-0">{{$jmlPerempuan}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            @foreach ($jurusan as $value)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <img src="{{ asset('storage/'.$value->logo)}}" class="img-fluid" alt="">
                            </div>
                            <div class="col pr-0">
                                <p class="small text-muted mb-0">{{$value->nama}}</p>
                                <span class="h3 mb-0">{{$value->countJurusan}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                    <strong class="card-title">DATA PPDB</strong>
                    <a href="/dashboard/ppdb/registrasi-step1" class="btn btn-primary float-right"><i class="fe fe-plus"></i> Siswa Baru</a>
                    </div>
                    <div class="card-body">
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
                    @can('admin')
                        <div class="alert alert-info col-12" role="alert">
                            <span class="fe fe-info fe-16 mr-2"></span><b>Informasi!</b><p><b>Approve</b> berfungsi untuk menyimpan seluruh data <b>PPDB</b> menjadi data <b>Siswa.</b> Pada saat Approve dijalankan <b>NIS</b> akan di generate secara otomatis! dan data PPDB akan diarsipkan!
                            <b>NIS</b> akan otomatis di generate</p>
                        </div>
                        {{-- <a href="/dashboard/ppdb/approve" class="btn btn-success mb-3 float-right {{$btnClass}}" type="button" onclick="return confirm('Yakin mau approve sekarang? Data PPDB akan diarsipkan!')" id="approve">Approve</a> --}}
                        <form id="formSelect" method="post">
                            <input type="hidden" name="_method">
                            @csrf
                            <button id="approve" class="btn btn-success mb-3 d-none {{$btnClass}}" name="approve" onclick="return selectFunction('approve', '/dashboard/ppdb/approve')">Approve</button>
                            <button id="delAll" class="btn btn-danger mb-3 d-none" name="delAll" onclick="return selectFunction('delete', '/dashboard/ppdb/delete-all')">Delete Selected</button>
                    @endcan
                            <table id="tbPpdb" class="table table-hover table-striped" style="font-size: 10px">
                                <thead>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tempat, Tgl lahir</th>
                                    <th>NISN</th>
                                    <th>NIK</th>
                                    <th>Nama Ibu</th>
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Diinput Oleh</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($ppdbs as $ppdb)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub-check" id="sub_check{{ $ppdb->id }}" name="sub_check[{{ $ppdb->id }}]" value="{{ $ppdb->id }}" data-id="{{ $ppdb->id }}">
                                                <label class="custom-control-label" for="sub_check{{ $ppdb->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ppdb->nama_siswa }}</td>
                                        <td class="text-nowrap">{{ $ppdb->tempat_lahir . ', ' . \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $ppdb->nisn }}</td>
                                        <td>{{ $ppdb->nik }}</td>
                                        <td>{{ $ppdb->nama_ibu }}</td>
                                        <td>{{ $ppdb->asal_sekolah }}</td>
                                        <td>{{ $ppdb->jurusan->kode ?? '' }}</td>
                                        <td>{{ $ppdb->user->name ?? ''}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-sm btn-info ml-1" href="/dashboard/ppdb/detail/{{ $ppdb->id }}" title="Detail"><span class="fe fe-eye"></span></a>
                                                <a class="btn btn-sm btn-primary ml-1" href="/dashboard/ppdb/edit/{{ $ppdb->id }}" title="Edit"><span class="fe fe-edit"></span></a>
                                                <a class="btn btn-sm btn-danger ml-1" href="/dashboard/ppdb/delete/{{ $ppdb->id }}" title="Remove" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
