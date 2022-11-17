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
                        <h5 class="card-title">Klasifikasi Surat</h5>
                        <p class="card-text">Daftar dari klasifikasi surat akan tampil pada tabel dibawah ini, yang nantinya akan digunakan pada saat <b class="text-primary">menambah surat masuk maupun surat keluar.</b></p>
                        <button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalTambahKlasifikasi"><i class="fe fe-plus"></i> Tambah</button>
                        <table id="tbKlasifikasi" class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Klasifikasi</th>
                                <th>Deskripsi</th>
                                <th class="text-end" scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($klasifikasis as $klasifikasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $klasifikasi->kode }}</td>
                                    <td>{{ $klasifikasi->nama }}</td>
                                    <td>{{ $klasifikasi->deskripsi }}</td>
                                    <td>
                                        <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/dashboard/klasifikasi/{{ $klasifikasi->id }}/edit"><span class="fe fe-edit text-warning"></span> Edit</a>
                                            <form action="/dashboard/klasifikasi/{{ $klasifikasi->id }}" method="post">
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
</div>

<div class="modal fade" id="modalTambahKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="modalTambahKlasifikasiLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahKlasifikasiLabel">Klasifikasi Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="/dashboard/klasifikasi" method="post" class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" >
            <div class="modal-body">
                @csrf
                <div class="form-group mb-1">
                    <label for="kode" class="col-form-label">Kode Klasifikasi:</label>
                    <input name="kode" type="text" class="form-control" id="kode" maxlength="10" required>
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-1">
                    <label for="nama" class="col-form-label">Nama Klasifikasi:</label>
                    <input name="nama" type="text" class="form-control" id="nama" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-1">
                    <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control" id="message-text" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn mb-2 btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
