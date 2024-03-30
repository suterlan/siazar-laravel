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
                            @if (session()->has('error'))
                                <div class="alert alert-danger col-12" role="alert">
                                    <span class="fe fe-info fe-16 mr-2"></span> {{ session('error') }}
                                </div>
                            @endif

                            <div class="pt-2">Data Rombel : <b>Kelas {{ $row->nama }}</b></div>
                            <div class="mb-4">Jurusan : <b>{{ $row->jurusan->nama }}</b></div>

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
                                    @foreach ($row->siswas()->where('lulus', false)->get() as $value )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->nis }}</td>
                                        <td>{{ $value->nama_siswa }}</td>
                                        <td>{{ $value->tempat_lahir . ', ' . \Carbon\Carbon::parse($value->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $value->nisn }}</td>
                                        <td>{{ $value->nik }}</td>
                                        <td>{{ $value->kelas->jurusan->nama ?? '' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/dashboard/siswa-buku-induk/cetak/{{ $value->id }}" id="cetak" class="btn btn-sm btn-primary mr-1">
                                                    <span class="fe fe-printer fe-16"></span>
                                                </a>
                                                <a href="/dashboard/siswa-buku-induk/download/{{ $value->id }}" id="download" class="btn btn-sm btn-secondary">
                                                    <span class="fe fe-download fe-16"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </form>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
