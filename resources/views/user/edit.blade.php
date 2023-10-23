@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">User Edit</strong>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                        @endif
                        <form action="/dashboard/user/{{ $user->id }}" method="post" class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach">
                            @method('put')
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name">Nama</label>
                                <input name="name" id="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Username</label>
                                <input name="username" id="username" type="text" class="form-control" value="{{ old('username', $user->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input name="email" id="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check form-switch mb-1 mt-2">
                                    <input class="form-check-input" id="ubahPassword" type="checkbox" />
                                    <label class="form-check-label" for="ubahPassword">Ubah Password?</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="password">Password</label>
                                        <input name="password" id="password" type="password" class="form-control" autocomplete="on" disabled>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" autocomplete="on" disabled>
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
                                        <input type="radio" class="form-check-input" id="roleAdmin" name="role_id" value="1" {{ $user->role_id == 1 ? "checked" : "" }}>
                                        <label class="form-check-label" for="roleAdmin">Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="roleOperator" name="role_id" value="2" {{ $user->role_id == 2 ? "checked" : "" }}>
                                        <label class="form-check-label" for="roleOperator">Operator</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="roleGuru" name="role_id" value="3" {{ $user->role_id == 3 ? "checked" : "" }}>
                                        <label class="form-check-label" for="roleGuru">Guru</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="roleSiswa" name="role_id" value="4" {{ $user->role_id == 4 ? "checked" : "" }}>
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
                                        @if (old('position_id', $user->position->id) == $position->id)
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
                            <div class="form-group m-3 mt-4">
                                <a href="/dashboard/user" type="button" class="btn mb-1 btn-danger "> Batal</a>
                                <button type="submit" class="btn mb-1 btn-success float-right"> <span class="fe fe-save"></span> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cekPass = document.getElementById('ubahPassword');
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirmation');
        cekPass.addEventListener('click', () => {
            if(cekPass.checked){
                password.removeAttribute('disabled');
                passwordConfirm.removeAttribute('disabled');

                password.setAttribute('required','');
                passwordConfirm.setAttribute('required','');
            }else{
                password.setAttribute('disabled','');
                passwordConfirm.setAttribute('disabled','');

                password.removeAttribute('required','');
                passwordConfirm.removeAttribute('required','');
            }
        });

    </script>
@endsection
