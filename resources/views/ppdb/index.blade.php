@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
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
            <div class="col-md-6 col-xl-3 mb-4">
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
            <div class="col-md-6 col-xl-3 mb-4">
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
            <div class="col-md-6 col-xl-3 mb-4">
              <div class="card shadow border-0">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-3 text-center">
                      <span class="circle circle-sm bg-primary">
                        <i class="fe fe-16 fe-activity text-white mb-0"></i>
                      </span>
                    </div>
                    <div class="col">
                      <p class="small text-muted mb-0">Asal Sekolah</p>
                      @foreach ($asalSekolah as $key => $value)
                      <span class="mb-0 mr-2">{{$key}} : <span class="h3">{{$value}}</span></span>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">DATA PPDB</h5><hr>
                    <p class="card-text"></p>
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
                    <a href="/dashboard/ppdb/approve" class="btn btn-success mb-3 float-right {{$btnClass}}" type="button" onclick="return confirm('Yakin mau approve sekarang? Data PPDB akan diarsipkan!')">Approve</a>
                    @endcan
                    <a href="/dashboard/ppdb/registrasi-step1" class="btn btn-primary mb-3"><i class="fe fe-plus"></i> Tambah Siswa Baru</a>
                    <form action="/dashboard/ppdb/delete-all" method="post">
                        @method('delete')
                        @csrf
                    <button class="btn btn-danger mb-3 d-none" type="submit" id="delAll">Delete All</button>
                    <table id="tbPpdb" class="table table-hover table-striped">
                        <thead>
                            <td scope="col">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <label class="custom-control-label" for="checkAll"></label>
                                </div>
                            </td>
                            <th scope="col">No</th>
                            <th>Nama</th>
                            <th>Tempat, Tgl lahir</th>
                            <th>NISN</th>
                            <th>NIK</th>
                            <th>Nama Ayah</th>
                            <th>NIK Ayah</th>
                            <th>Nama Ibu</th>
                            <th>NIK Ibu</th>
                            <th>Asal Sekolah</th>
                            <th class="text-end" scope="col"></th>
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
                                <td>{{ $ppdb->tempat_lahir . ', ' . \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $ppdb->nisn }}</td>
                                <td>{{ $ppdb->nik }}</td>
                                <td>{{ $ppdb->nama_ayah }}</td>
                                <td>{{ $ppdb->nik_ayah }}</td>
                                <td>{{ $ppdb->nama_ibu }}</td>
                                <td>{{ $ppdb->nik_ibu }}</td>
                                <td>{{ $ppdb->asal_sekolah }}</td>
                                <td>
                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted sr-only">Action</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/dashboard/ppdb/detail/{{ $ppdb->id }}"><span class="fe fe-eye text-primary"></span> Details</a>
                                        <a class="dropdown-item" href="/dashboard/ppdb/edit/{{ $ppdb->id }}"><span class="fe fe-edit text-warning"></span> Edit</a>
                                            <a href="/dashboard/ppdb/delete/{{ $ppdb->id }}" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete text-danger"></span> Remove</a>
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
@endsection
