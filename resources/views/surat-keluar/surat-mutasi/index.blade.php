@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">Surat Mutasi Siswa</strong>
                            <a href="/dashboard/suratkeluar/mutasi/create" class="btn btn-primary btn-sm float-right" type="button"><span class="fe fe-file-plus"></span> Surat Baru </a>
                        <p class="card-text">Tabel surat mutasi siswa / keterangan pindah peserta didik</p>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                        @endif
                        <table id="tbSuratMutasi" class="table table-stripped table-hover table-responsive">
                            <thead class="thead-dark">
                                <th>#</th>
                                <th>Klasifikasi</th>
                                <th>No Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Nama Siswa</th>
                                <th>Ayah / Wali Siswa</th>
                                <th>Print / Download</th>
                                <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                            </thead>
                            <tbody>
                                @foreach ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->suratkeluar->klasifikasi->kode }}</td>
                                    <td class="text-nowrap">{{ $surat->no_surat }}</td>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                                    <td>{{ $surat->nama_siswa }}</td>
                                    <td>{{ $surat->nama_ayah }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/dashboard/suratkeluar/mutasi/cetak/{{ $surat->id }}" id="cetak" class="btn btn-sm btn-primary mr-1">
                                                <span class="fe fe-printer fe-16"></span>
                                            </a>
                                            <a href="/dashboard/suratkeluar/mutasi/download/{{ $surat->id }}" id="download" class="btn btn-sm btn-secondary">
                                                <span class="fe fe-download fe-16"></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-outline-info btn-sm" href="/dashboard/suratkeluar/mutasi/{{ $surat->id }}"><span class="fe fe-eye"></span> Detail</a>
                                            <a class="btn btn-outline-warning btn-sm ml-1" href="/dashboard/suratkeluar/mutasi/{{ $surat->id }}/edit"><span class="fe fe-edit"></span> Edit</a>
                                            <form action="/dashboard/suratkeluar/mutasi/{{ $surat->id }}" method="post">
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
@endsection
