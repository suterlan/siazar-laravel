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
                    <a href="/dashboard/ppdb/approve" class="btn btn-success mb-3 float-right {{$btnClass}}" type="button" onclick="return confirm('Yakin mau approve sekarang? Data PPDB akan diarsipkan!')" id="approve">Approve</a>
                    {{-- <a class="btn btn-success mb-3 float-right {{$btnClass}}" type="button" id="approve">Approve</a> --}}
                    @endcan
                    <a href="/dashboard/ppdb/registrasi-step1" class="btn btn-primary mb-3"><i class="fe fe-plus"></i> Tambah Siswa Baru</a>
                    <form action="/dashboard/ppdb/delete-all" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger mb-3 d-none" type="submit" name="delAll" id="delAll" onclick="return confirm('Yakin mau hapus data?')">Delete All</button>
                        <table id="tbPpdb" class="table table-hover table-striped">
                            <thead>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </td>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tempat, Tgl lahir</th>
                                <th>NISN</th>
                                <th>NIK</th>
                                <th>Nama Ibu</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan Dipilih</th>
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
                                    <td>{{ $ppdb->tempat_lahir . ', ' . \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('d-m-Y') }}</td>
                                    <td>{{ $ppdb->nisn }}</td>
                                    <td>{{ $ppdb->nik }}</td>
                                    <td>{{ $ppdb->nama_ibu }}</td>
                                    <td>{{ $ppdb->asal_sekolah }}</td>
                                    <td>{{ $ppdb->jurusan->kode }}</td>
                                    <td>
                                        <div class="d-block">
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

{{-- <script>
  const btnApprove = document.getElementById('approve');
  btnApprove.addEventListener('click', () =>{
    let select = document.querySelectorAll('.sub-check');
    let data = [];
    select.forEach((e) => {
      if(e.checked){
        data.push(e.value);
      }
    });
    console.log(data);
  });
</script> --}}
@endsection
