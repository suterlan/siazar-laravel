@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Surat Kelulusan</strong>
                            <p class="card-text">Tabel Surat Undangan</p>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success col-12" role="alert">
                                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table id="tbSuratUndangan" class="table table-stripped table-hover table-surat-keluar">
                                    <thead class="thead-dark">
                                        <th>#</th>
                                        <th>No Surat</th>
                                        <th>Nama Siswa</th>
                                        <th>Print / Download</th>
                                        <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                    </thead>
                                    <tbody>
                                        @foreach ($surats as $surat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-nowrap">{{ $surat->no_surat }}</td>
                                            <td>{{ $surat->nama }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="/dashboard/suratkeluar/kelulusan/cetak/{{ $surat->id }}" id="cetak" class="btn btn-sm btn-primary mr-1" target="_blank">
                                                        <span class="fe fe-printer fe-16"></span>
                                                    </a>
                                                    <a href="/dashboard/suratkeluar/kelulusan/download/{{ $surat->id }}" id="download" class="btn btn-sm btn-secondary" target="_blank">
                                                        <span class="fe fe-download fe-16"></span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex float-right">
                                                    <form action="/dashboard/suratkeluar/kelulusan/{{ $surat->id }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-outline-danger btn-sm ml-1" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span> Remove</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
