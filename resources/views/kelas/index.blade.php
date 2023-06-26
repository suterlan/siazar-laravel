@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Kelas</strong>
                                <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#newKelasModal" type="button"><span class="fe fe-user-plus"></span> Tambah </button>
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
                            <table id="tbJurusan" class="table table-stripped table-hover">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Wali Kelas</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->jurusan->kode }}</td>
                                        <td>{{ $row->guru->nama ?? '' }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <a class="btn btn-warning btn-sm ml-1 btn-edit-kelas" data-id="{{$row->id}}"><span class="fe fe-edit text-white"></span></a>
                                                <form action="/dashboard/kelas/{{ $row->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm ml-1" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
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
    {{-- Modal Tambah Kelas Baru --}}
    <div class="modal fade" id="newKelasModal" tabindex="-1" role="dialog" aria-labelledby="newKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newKelasModalLabel">Tambah Kelas Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/dashboard/kelas" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <div class="form-group mb-2">
                        <label for="nama">Nama</label>
                        <input name="nama" id="nama" type="text" class="form-control" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <Label for="jurusan_id">Jurusan </Label>
                        <select id="jurusan_id" name="jurusan_id" class="custom-select {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" required>
                            <option value="">&nbsp;</option>
                            @foreach ($jurusans as $jurusan )
                                @if (old('jurusan_id') == $jurusan->id)
                                    <option value="{{ $jurusan->id }}" selected>{{ $jurusan->kode }}</option>
                                @else
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->kode }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <Label for="guru_id">Wali Kelas </Label>
                        <select id="guru_id" name="guru_id" class="custom-select {{$errors->first('guru_id') ? "is-invalid" : "" }}" required>
                            <option value="">&nbsp;</option>
                            @foreach ($gurus as $guru )
                                @if (old('guru_id') == $guru->id)
                                    <option value="{{ $guru->id }}" selected>{{ $guru->nama }}</option>
                                @else
                                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('guru_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Ubah Kelas --}}
    <div class="modal fade" id="ubahKelasModal" tabindex="-1" role="dialog" aria-labelledby="ubahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahKelasModalLabel">Ubah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="formUbahKelas" action="" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                    @method('put')
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <div class="form-group mb-2">
                        <input name="id" id="_id" type="hidden" value="">
                        <label for="_nama">Nama</label>
                        <input name="_nama" id="_nama" type="text" class="form-control" value="{{ old('_nama') }}" required>
                        @error('_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <Label for="_jurusan_id">Jurusan </Label>
                        <select id="_jurusan_id" name="_jurusan_id" class="form-control select2" required>
                            <option value="">&nbsp;</option>
                            @foreach ($jurusans as $jurusan )
                                @if (old('_jurusan_id') == $jurusan->id)
                                    <option value="{{ $jurusan->id }}" selected>{{ $jurusan->kode }}</option>
                                @else
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->kode }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('_jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <Label for="_guru_id">Wali Kelas </Label>
                        <select id="_guru_id" name="_guru_id" class="form-control select2" required>
                            {{-- <option value="">&nbsp;</option> --}}
                            @foreach ($gurus as $guru )
                                @if (old('_guru_id') == $guru->id)
                                    <option value="{{ $guru->id }}" selected>{{ $guru->nama }}</option>
                                @else
                                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('_guru_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
