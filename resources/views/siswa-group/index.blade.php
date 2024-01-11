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

                            @if ($row->nama == 'XII')
                                <div class="alert alert-info col-12" role="alert">
                                    <span class="fe fe-help-circle fe-16 mr-2"> Informasi!</span>
                                    <p>Surat kelulusan akan langsung di generate pada saat siswa di luluskan.<br> Gunakan tombol <b>"Luluskan Semua"</b> jika ingin mengenerate semua siswa sekaligus, atau gunakan tombol <b>"Luluskan"</b> untuk mengenerate siswa satu per satu. </p>
                                </div>
                            <form action="{{ route('lulus-all') }}" method="post">
                            @csrf
                            @method('put')
                                <button id="btnLulus" class="btn btn-primary mb-3" type="submit">Luluskan Semua</button>
                            @endif
                            <table id="tbSiswaRombel" class="table table-stripped table-hover datatables" style="font-size: 12px">
                                <thead class="thead-dark">
                                    <th>#</th>
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
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="check_lulus{{ $value->nis }}" name="check_lulus[{{ $value->nis }}]" value="{{ $value->nis }}" checked>
                                                <label class="custom-control-label" for="check_lulus{{ $value->nis }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->nis }}</td>
                                        <td>{{ $value->nama_siswa }}</td>
                                        <td>{{ $value->tempat_lahir . ', ' . \Carbon\Carbon::parse($value->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $value->nisn }}</td>
                                        <td>{{ $value->nik }}</td>
                                        <td>{{ $value->kelas->jurusan->nama ?? '' }}</td>
                                        <td class="d-flex float-right">
                                            @if ($row->nama == 'XII')
                                            <a href="/dashboard/rombel/{{ $value->nis }}" class="btn btn-sm btn-secondary ml-1">Luluskan</a>
                                            @endif
                                            <a class="btn btn-sm btn-info ml-1" href="/dashboard/siswa/{{ $value->id }}" title="Detail"><span class="fe fe-eye"></span></a>
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
