@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">Data User</strong>
                            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#newUserModal" type="button"><span class="fe fe-user-plus"></span> Tambah User </button>
                        <p class="card-text">Tabel akun user</p>
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
                        <table id="tbUser" class="table table-stripped table-hover">
                            <thead class="thead-dark">
                                {{-- <th>#</th> --}}
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Posisi</th>
                                <th>Role</th>
                                <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if($user->role->name == 'siswa')
                                        @continue
                                    @endif
                                <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td class="text-nowrap">{{ $user->email }}</td>
                                    <td>{{ $user->position->name }}</td>
                                    <td>
                                        @if ($user->role->name == 'admin')
                                            <div class="badge badge-primary"> {{ @Str::upper($user->role->name) }}</div>
                                        @else
                                            <div class="badge badge-info">{{ @Str::upper($user->role->name) }}</div>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input ubahRole" id="customSwitch{{ $loop->iteration }}" required @if($user->role=='admin') checked @endif data-id="{{ $user->id }}" data-role="{{ $user->role }}">
                                            <label class="custom-control-label" for="customSwitch{{ $loop->iteration }}"></label>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <div class="d-flex float-right">
                                            {{-- <a class="btn btn-info btn-sm" href="/dashboard/user/{{ $user->id }}"><span class="fe fe-eye"></span></a> --}}
                                            <a class="btn btn-secondary btn-sm ml-1 btn-role text-white" id="btnRole" data-toggle="modal" data-target="#role" data-id="{{ $user->id }}" title="Ubah Role"><span class="fe fe-shield"></span></a>
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

                        <hr class="mb-4 mt-4">
                        <h6>Data Akun Siswa</h6>
                        <table id="tbUserSiswa" class="table table-stripped table-hover">
                            <thead class="thead-dark">
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Posisi</th>
                                <th>Kelas</th>
                                <th>Role</th>
                                <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                            </thead>
                            <tbody>
                                @foreach ($users->load('siswa.kelas') as $user)
                                    @if($user->role->name != 'siswa')
                                        @continue
                                    @endif
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->position->name }}</td>
                                    <td>
                                        {{ $user->siswa->kelas->nama ?? '' }} - {{ $user->siswa->kelas->jurusan->kode ?? '' }}
                                    </td>
                                    <td>
                                        <div class="badge badge-success text-white">{{ @Str::upper($user->role->name) }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <a class="btn btn-secondary btn-sm ml-1 btn-role text-white" id="btnRole" data-toggle="modal" data-target="#role" data-id="{{ $user->id }} title="Ubah Role"><span class="fe fe-shield"></span></a>
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
    {{-- Modal Add new user --}}
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
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
                        <input name="name" id="name" type="text" class="form-control form-control-sm" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input name="username" id="username" type="text" class="form-control form-control-sm" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="password">Password</label>
                                <input name="password" id="password" type="password" class="form-control form-control-sm" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control form-control-sm" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>Pilih role user : </div>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="roleAdmin" name="role_id" value="1">
                                <label class="form-check-label" for="roleAdmin">Admin</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="roleOperator" name="role_id" value="2">
                                <label class="form-check-label" for="roleOperator">Operator</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="roleGuru" name="role_id" value="3">
                                <label class="form-check-label" for="roleGuru">Guru</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="roleSiswa" name="role_id" value="4">
                                <label class="form-check-label" for="roleSiswa">Siswa</label>
                            </div>
                        </div>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="position_id">Posisi User</label>
                        <select name="position_id" id="position_id" class="form-control" required>
                            <option value="">--Pilih Posisi--</option>
                            @foreach ($positions as $position )
                                @if (old('position_id') == $position->id)
                                    <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                @else
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('position_id')
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

    {{-- Modal ubah role --}}
    <div class="modal fade" id="role" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Ubah Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                </div>
                <form action="/dashboard/user/role" method="post" class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach">
                    @method('put')
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <div class="form-group mb-3">
                        <label for="">Ubah role untuk :</label>
                        <input id="id_user" type="hidden" name="id" class="form-control">
                        <input id="nama_user" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row row-radio-role">
                            {{-- javascript here --}}
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"><span class="fe fe-save"></span> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let btnRole = document.querySelectorAll('.btn-role');
        btnRole.forEach((item) => {
            item.addEventListener('click', async () => {
                const id = item.dataset.id;
                const user = await getUser(id);
                showRowRadio(user);
            });
        });

        function getUser(id){
            return fetch('/dashboard/get-user-role?id=' + id)
            .then(response => response.json())
            .then(response => response);
        }

        function showRowRadio(user){
            const nama_user = document.getElementById('nama_user');
            const id_user = document.getElementById('id_user');
            const rowRadioRole = document.querySelector('.row-radio-role');
            id_user.value = user.id;
            nama_user.value = user.name;
            rowRadioRole.innerHTML = `
                <div class="col-sm-6">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="roleAdmin" name="role_id" value="1" ${user.role.name == 'admin' ? "checked" : "" }>
                        <label class="form-check-label" for="roleAdmin">Admin</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="roleOperator" name="role_id" value="2" ${user.role.name == 'operator' ? "checked" : "" }>
                        <label class="form-check-label" for="roleOperator">Operator</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="roleGuru" name="role_id" value="3" ${user.role.name == 'guru' ? "checked" : "" }>
                        <label class="form-check-label" for="roleGuru">Guru</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="roleSiswa" name="role_id" value="4" ${user.role.name == 'siswa' ? "checked" : "" }>
                        <label class="form-check-label" for="roleSiswa">Siswa</label>
                    </div>
                </div>
            `;
        }
    </script>
@endsection
