@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Edit Pembayaran</strong>
                            <div class="mt-2">
                                <a href="{{ route('dashboard.pembayaran') }}" class="btn btn-danger btn-sm"><i class="fe fe-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <form action="{{ route('dashboard.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                            @method('put')
                            @csrf
                        <div class="card-body">
                            <div class="form-group mb-1">
                                <label for="nama" class="col-form-label">Nama / Judul Pembayaran</label>
                                <input name="nama" type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : "" }}" id="nama" value="{{ old('nama', $pembayaran->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="nominal" class="col-form-label">Nominal</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="number" name="nominal" class="form-control {{$errors->first('nominal') ? "is-invalid" : "" }}" value="{{ number_format($pembayaran->nominal, '0', '', '')}}" min="0" aria-label="Nominal" required>
                                @error('nominal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="kelas_id">Pilih Kelas</label>
                                <div class="row">
                                    @foreach ($jurusans as $jurusan)
                                        <div class="col-md-3">
                                            <strong>{{ $jurusan->nama }}</strong>
                                            @foreach ($jurusan->kelas as $kelas)
                                            <div class="custom-control custom-checkbox mt-1">
                                                <input name="kelas_id[]" type="checkbox" class="custom-control-input" id="kelas_id{{ $kelas->id }}" value="{{ $kelas->id }}"
                                                @foreach ($pembayaranKelas as $checkedKelas)
                                                    @checked($kelas->id == $checkedKelas->kelas_id)
                                                @endforeach>
                                                <label class="custom-control-label" for="kelas_id{{ $kelas->id }}">{{ $kelas->nama . ' - ' . $jurusan->kode}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @error('kelas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> <!-- form-group -->
                            <div class="form-group mb-1">
                                <label for="keterangan" class="col-form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn mb-1 btn-primary"> <i class="fe fe-save"></i> Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
