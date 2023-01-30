@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">Surat Keluar</strong>
                            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#newUserModal" type="button"><span class="fe fe-user-plus"></span> Tambah User </button>
                        <p class="card-text">Tabel Surat Keluar</p>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                        @endif
                        @if (session()->has('error'))
                        <div class="alert alert-danger col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('error') }}
                        </div>
                        @endif
                        <table id="tbUser" class="table table-stripped table-hover">
                            <thead class="thead-dark">
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Ubah Role</th>
                                <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td class="text-nowrap">{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role==0)
                                            <div class="badge badge-info"> Staf</div>
                                        @elseif ($user->role==1)
                                            <div class="badge badge-primary">Admin</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input ubahRole" id="customSwitch{{ $loop->iteration }}" required @if($user->role==1) checked @endif data-id="{{ $user->id }}" data-role="{{ $user->role }}">
                                            <label class="custom-control-label" for="customSwitch{{ $loop->iteration }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            {{-- <a class="btn btn-info btn-sm" href="/dashboard/user/{{ $user->id }}"><span class="fe fe-eye"></span></a> --}}
                                            <a class="btn btn-warning btn-sm ml-1" href="/dashboard/user/{{ $user->id }}/edit"><span class="fe fe-edit"></span></a>
                                            <form action="/dashboard/user/{{ $user->id }}" method="post">
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
    <div class="modal fade @foreach ($errors->all() as $error) show @endforeach" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true" style="display: @foreach ($errors->all() as $error) block; @endforeach">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Buat User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/dashboard/user" method="post" class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach">
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <div class="form-group mb-2">
                        <label for="name">Nama</label>
                        <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input name="username" id="username" type="text" class="form-control" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="password">Password</label>
                                <input name="password" id="password" type="password" class="form-control" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
        let ubahRoles = document.querySelectorAll('.ubahRole');
        ubahRoles.forEach((item) => {
            item.addEventListener('click', () => {
                // console.log('ok');
                // console.log(item.dataset.id + ' ' + item.dataset.role);
                fetch('/dashboard/user/ubahrole?id=' + item.dataset.id + '&role=' + item.dataset.role);
                // .then(response => response.json())
                // .then(data => console.log(data.id + data.role));
                location.reload();
            });
        });
    </script>
@endsection
