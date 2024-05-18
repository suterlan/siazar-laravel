@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Data Pembayaran</strong>
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addPembayaran"><i class="fe fe-plus"></i> Tambah</button>
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

                            <table id="tbPembayaran" class="table table-bordered table-hover mb-0">
                                <thead>
                                    <th>No</th>
                                    <th>Nama / Judul Pembayaran</th>
                                    <th>Kelas</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pembayaran->nama }}</td>
                                        <td>
                                        @foreach ($pembayaran->kelas as $kelas)
                                            <span class="badge badge-info px-2 py-1">{{ $kelas->nama . ' - ' . $kelas->jurusan->kode}}</span>
                                        @endforeach
                                        </td>
                                        <td>Rp. {{ number_format($pembayaran->nominal, '2', '.', '.')}}</td>
                                        <td>{{ $pembayaran->keterangan }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <div class="btn-group" role="group" aria-label="Tombol Mapel">
                                                    <a href="{{ route('dashboard.pembayaran.edit', $pembayaran->id) }}" class="btn btn-primary btn-sm ml-2"><span class="fe fe-edit text-white"></span></a>

                                                    <form action="{{ route('dashboard.pembayaran.destroy', $pembayaran->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm ml-2" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                                    </form>
                                                </div>
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

    @include('pembayaran.partial.modal-add-pembayaran')
@endsection
