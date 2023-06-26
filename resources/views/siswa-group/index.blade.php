@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12 mb-4">
                  <div class="card shadow">
                    <div class="card-body">
                      <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        @foreach ($kelas as $row)
                        <li class="nav-item">
                          <a class="nav-link" id="{{ $row->nama . '-' . $row->jurusan->kode }}-tab" data-toggle="tab" href="#{{ $row->nama . '_' . $row->jurusan->kode }}" role="tab" aria-controls="home" aria-selected="true">{{ strtoupper($row->nama . '-' . $row->jurusan->kode) }}</a>
                        </li>
                        @endforeach
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        @foreach ($kelas as $row)
                        <div class="tab-pane fade" id="{{ $row->nama . '_' . $row->jurusan->kode }}" role="tabpanel" aria-labelledby="{{ $row->nama . '-' . $row->jurusan->kode }}-tab">
                            @if (session()->has('success'))
                            <div class="alert alert-success col-12" role="alert">
                                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                            </div>
                            @endif
                            <div class="pt-2">Data Rombel : <b>Kelas {{ $row->nama }}</b></div>
                            <div class="mb-2">Jurusan : <b>{{ $row->jurusan->nama }}</b></div>
                            <table id="tbSiswaRombel" class="table table-stripped table-hover datatables" style="font-size: 12px">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Lahir</th>
                                    <th>NISN</th>
                                    <th>NIK</th>
                                    <th>Jurusan</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($row->siswa as $value )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->nis }}</td>
                                        <td>{{ $value->nama_siswa }}</td>
                                        <td>{{ $value->tempat_lahir . ', ' . \Carbon\Carbon::parse($value->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $value->nisn }}</td>
                                        <td>{{ $value->nik }}</td>
                                        <td>{{ $value->kelas->jurusan->nama ?? '' }}</td>
                                        <td class="d-flex float-right">
                                            <a class="btn btn-sm btn-info ml-1" href="/dashboard/siswa/{{ $value->id }}" title="Detail"><span class="fe fe-eye"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Data Siswa</strong>
                            <a href="/dashboard/siswa/registrasi-step1">
                                <button class="btn btn-primary btn-sm float-right"><span class="fe fe-plus"></span> Tambah Siswa </button>
                            </a>
                            <p class="card-text">Data seluruh siswa</p>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success col-12" role="alert">
                                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                            </div>
                            @endif
                            <table id="tbSiswa" class="table table-stripped table-hover datatables">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Lahir</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->kelas->nama ?? '' }}</td>
                                        <td>{{ $siswa->jurusan->kode ?? '' }}</td>
                                        <td class="d-flex float-right">
                                            <a class="btn btn-sm btn-info ml-1" href="/dashboard/siswa/{{ $siswa->id }}" title="Detail"><span class="fe fe-eye"></span></a>
                                            @canany(['admin', 'kurikulum'])
                                            <a class="btn btn-sm btn-primary ml-1" href="/dashboard/siswa/{{ $siswa->id }}/edit" title="Edit"><span class="fe fe-edit"></span></a>
                                            <form action="/dashboard/siswa/{{$siswa->id}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger ml-1" type="submit" title="Remove" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                            </form>
                                            @endcanany
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
