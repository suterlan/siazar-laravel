@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <H3 class="card-title text-center">STRUKTUR ORGANISASI</H3>
                            <a href="/dashboard/struktur-organisasi/create" class="btn btn-primary float-right"><span class="fe fe-plus fe-16"></span> Tambah</a>
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
                            <table id="tbStrukturOrganisasi" class="table table-bordered table-hover mb-0">
                                <thead class="text-center bg-primary-darker">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Keterangan</th>
                                     <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($strukturs as $struktur)
                                        <tr>
                                            <td class="py-1 text-center">{{ $loop->iteration }}</td>
                                            <td class="py-1">{{ $struktur->guru->nama }}</td>
                                            <td class="py-1 text-center">{{ $struktur->jabatan }}</td>
                                            <td class="py-1">{{ $struktur->keterangan }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-warning btn-sm ml-1" href="/dashboard/struktur-organisasi/{{$struktur->id}}/edit"><span class="fe fe-edit"></span></a>
                                                    <form action="/dashboard/struktur-organisasi/{{$struktur->id}}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm ml-1" type="submit" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
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
