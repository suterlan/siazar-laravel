@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Jurusan</strong>
                                <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#newJurusanModal" type="button"><span class="fe fe-user-plus"></span> Tambah </button>
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
                                    <th>Logo</th>
                                    <th>Kode</th>
                                    <th>Nama Jurusan</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($jurusans as $jurusan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="avatar avatar-md">
                                                <img src="{{asset('storage/' . $jurusan->logo)}}" alt="..." class="avatar-img rounded-circle">
                                            </div>
                                        </td>
                                        <td>{{ $jurusan->kode }}</td>
                                        <td>{{ $jurusan->nama }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                {{-- <a class="btn btn-info btn-sm" href="/dashboard/jurusan/{{ $jurusan->id }}"><span class="fe fe-eye"></span></a> --}}
                                                <a class="btn btn-warning btn-sm ml-1 btn-edit-jurusan" data-id="{{$jurusan->id}}"><span class="fe fe-edit"></span></a>
                                                <form action="/dashboard/jurusan/{{ $jurusan->id }}" method="post">
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
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Edit Jurusan</h4>
                        </div>
                        <form id="formUpdate" action="" method="post" enctype="multipart/form-data" novalidate>
                            @method('put')
                            @csrf
                            <div class="card-body m-3 pt-0">
                                <div class="needs-validation">
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" id="old_logo" name="old_logo" value="">
                                    <div class="form-group mb-2">
                                        <label for="edit_kode">Kode</label>
                                        <input name="edit_kode" id="edit_kode" type="text" class="form-control {{$errors->first('edit_kode') ? "is-invalid" : "" }}" value="" required>
                                        @error('edit_kode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="edit_nama">Nama</label>
                                        <input name="edit_nama" id="edit_nama" type="text" class="form-control {{$errors->first('edit_nama') ? "is-invalid" : "" }}" value="" required>
                                        @error('edit_nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <label class="d-flex mt-2" for="edit_logo">Logo</label>
                                    <div class="form-row">
                                        <div class="col-sm-3">
                                            <img id="logoView" src="" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file mb-3">
                                                <input name="edit_logo" type="file" class="custom-file-input {{$errors->first('edit_logo') ? "is-invalid" : "" }}" id="edit_logo" >
                                                <label class="custom-file-label" for="file">Ganti Logo</label>
                                                @error('edit_logo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="edit_deskripsi" class="col-form-label">Deskripsi :</label>
                                        <textarea name="edit_deskripsi" class="form-control {{$errors->first('edit_deskripsi') ? "is-invalid" : "" }}" id="edit_deskripsi" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer mx-3">
                                <button id="btnUbahJurusan" type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newJurusanModal" tabindex="-1" role="dialog" aria-labelledby="newJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newJurusanModalLabel">Tambah Jurusan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/dashboard/jurusan" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <div class="form-group mb-2">
                        <label for="kode">Kode</label>
                        <input name="kode" id="kode" type="text" class="form-control" value="{{ old('kode') }}" required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama">Nama</label>
                        <input name="nama" id="nama" type="text" class="form-control" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="logo">Logo <small><i class="text-warning">(Gambar harus format PNG)</i></small></label>
                    <div class="custom-file mb-3">
                        <input name="logo" type="file" class="custom-file-input" id="logo" required>
                        <label class="custom-file-label" for="file">Pilih Gambar</label>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                        <textarea name="deskripsi" class="form-control" id="message-text" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let btnEditJurusan = document.querySelectorAll('.btn-edit-jurusan');
        const id = document.getElementById('id');
        const kode = document.getElementById('edit_kode');
        const nama = document.getElementById('edit_nama');
        const deskripsi = document.getElementById('edit_deskripsi');
        const logo = document.getElementById('logoView');
        const old_logo = document.getElementById('old_logo');
        const formUpdate = document.getElementById('formUpdate');

        btnEditJurusan.forEach((e) => {
            e.addEventListener('click', () => {
                //  console.log(e.dataset.id); 
                fetch('/dashboard/jurusan/'+ e.dataset.id +'/edit')
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    id.value = data.id;
                    kode.value = data.kode;
                    nama.value = data.nama;
                    deskripsi.value = data.deskripsi;
                    old_logo.value = data.logo;
                    logo.src = "{{ asset('storage')}}/" + data.logo;
                    formUpdate.setAttribute("action", "/dashboard/jurusan/" + data.id);
                });
            });
        });

        
    </script>
@endsection
