@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Daftar Mata Pelajaran</strong>
                                <a href="/dashboard/mapel/create" class="btn btn-primary btn-sm float-right"><i class="fe fe-plus"></i> Tambah</a>
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
                            <table id="tbMapel" class="table table-bordered table-hover mb-0">
                                <thead>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($mapels as $mapel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mapel->kode }}</td>
                                        <td>{{ $mapel->nama}}</td>
                                        <td>{{ $mapel->jenis }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <div class="btn-group" role="group" aria-label="Tombol Mapel">
                                                    <a href="/dashboard/mapel/{{ $mapel->id }}" class="btn btn-info btn-sm ml-2"><span class="fe fe-eye text-white"></span></a>
                                                    {{-- <a href="/dashboard/mapel/{{ $mapel->id }}/edit" class="btn btn-primary btn-sm ml-2"><span class="fe fe-edit text-white"></span></a> --}}
                                                    <form action="/dashboard/mapel/{{ $mapel->id }}" method="post">
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
                <div class="col-md-4">
                    <div class="alert alert-success" role="alert">
                        <h5 class="alert-heading">Pembagian Mata Pelajaran</h5>
                        <p>Untuk mengatur pembagian mata pelajaran setiap guru silahkan klik tombol dibawah</p>
                        <hr>
                        <p class="mb-0">
                            <a href="/dashboard/mengajar/pembagian-mapel" class="btn btn-outline-secondary"><i class="fe fe-sliders"></i> Atur</a>
                        </p>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <h5 class="alert-heading">Atur Jam Mengajar</h5>
                        <p>Jam mengajar diatur sesuai mapel yang di pegang masing-masing guru berdasarkan tahun ajaran</p>
                        <hr>
                        <p class="mb-0"><a href="/dashboard/mengajar" class="btn btn-primary">Atur Jam Mengajar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
