@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">Surat Masuk</strong>
                        <a href="/dashboard/suratmasuk/create">
                            <button class="btn btn-primary btn-sm float-right"><span class="fe fe-plus"></span> Tambah surat </button>
                        </a>
                        <p class="card-text">Tabel arsip surat masuk</p>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                        @endif
                        <table id="tbSuratMasuk" class="table table-stripped table-hover">
                            <thead class="thead-dark">
                                <th>No</th>
                                <th>Klasifikasi</th>
                                <th>No Surat</th>
                                <th>Asal Surat</th>
                                <th>Deskripsi/Isi Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Ket</th>
                                <th class="text-end" scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Kode : {{ $surat->klasifikasi->kode }} ({{ $surat->klasifikasi->nama }})</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td>{{ $surat->deskripsi }}</td>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $surat->keterangan }}</td>
                                    <td>
                                        <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/dashboard/suratmasuk/{{ $surat->id }}"><span class="fe fe-eye text-info"></span> Detail</a>
                                            <a class="dropdown-item" href="/dashboard/suratmasuk/{{ $surat->id }}/edit"><span class="fe fe-edit text-warning"></span> Edit</a>
                                            <form action="/dashboard/suratmasuk/{{ $surat->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="dropdown-item" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete text-danger"></span> Remove</button>
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
