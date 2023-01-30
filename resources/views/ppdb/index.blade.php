@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="row">
                @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Data PPDB</h5><hr>
                        <p class="card-text"></p>
                        <a href="/dashboard/ppdb/registrasi-step1" class="btn btn-primary btn-block mb-3"><i class="fe fe-plus"></i> Tambah Siswa Baru</a>
                        <form action="/dashboard/ppdb/delete-all" method="post">
                            @method('delete')
                            @csrf
                        <button class="btn btn-success mb-3 d-none" type="submit" id="delAll">Delete All</button>
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
                                    <td>{{ $ppdb->tempat_lahir . ', ' . $ppdb->tgl_lahir }}</td>
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
                                            <a class="dropdown-item" href="/dashboard/ppdb/{{ $ppdb->id }}/edit"><span class="fe fe-edit text-warning"></span> Edit</a>
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
</div>
@endsection
