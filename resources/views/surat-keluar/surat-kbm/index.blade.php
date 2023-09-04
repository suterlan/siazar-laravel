@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">SKBM</strong>
                            <p class="card-text">Surat Keputusan Pembagian Tugas Mengajar</p>
                            <div class="alert alert-warning" role="alert">
                                <span class="fe fe-info fe-16 mr-2"></span> Jika pembagian tugas mengajar guru atau tugas tambahan belum ada atau berubah silahkan klik tombol di bawah ini :
                                <div class="mt-2">Tugas Mengajar &emsp;&ensp;: <a href="/dashboard/mengajar" class="btn btn-info btn-sm">Lihat</a></div>
                                <div class="mt-2">Tugas Tambahan &emsp;: <a href="/dashboard/struktur-organisasi" class="btn btn-info btn-sm">Lihat</a></div>
                            </div>
                                <a href="/dashboard/suratkeluar/skbm/create" class="btn btn-primary btn-sm float-right"><i class="fe fe-file-plus fe-16"></i> Tambah</a>
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
                            <table id="tbSkbm" class="table table-bordered datatables table-hover mb-0 table-surat-keluar">
                                <thead class="text-center">
                                    <th class="text-dark">No</th>
                                    <th class="text-dark">Nomor Surat</th>
                                    <th class="text-dark">Tanggal Surat</th>
                                    <th class="text-dark">Tahun Ajaran</th>
                                    <th class="text-dark">Semester</th>
                                    <th class="text-dark">Print / Download</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($skbms as $skbm)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $skbm->no_surat }}</td>
                                        <td class="text-nowrap text-center">{{ \Carbon\Carbon::parse($skbm->suratkeluar->tanggal_surat)->translatedFormat('d F Y') }}</td>
                                        <td class="text-center">{{ $skbm->tahun_ajaran }}</td>
                                        <td class="text-center">{{ $skbm->semester }}</td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <a href="/dashboard/suratkeluar/skbm/cetak/{{ $skbm->id }}" id="cetak" class="btn btn-sm btn-primary mr-1" target="blank">
                                                    <span class="fe fe-printer fe-16"></span>
                                                </a>
                                                <a href="/dashboard/suratkeluar/skbm/download/{{ $skbm->id }}" id="download" class="btn btn-sm btn-secondary" target="blank">
                                                    <span class="fe fe-download fe-16"></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <a class="btn btn-outline-warning btn-sm ml-1" href="/dashboard/suratkeluar/skbm/{{ $skbm->id }}/edit"><span class="fe fe-edit"></span> Edit</a>
                                                <form action="/dashboard/suratkeluar/skbm/{{ $skbm->id }}" method="post">
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
@endsection
