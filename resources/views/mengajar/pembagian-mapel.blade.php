@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Atur Pembagian Mata Pelajaran</strong>
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
                            <table id="tbPembagianMapel" class="table table-bordered table-hover mb-0">
                                <thead>
                                    <th class="text-center">No</th>
                                    <th>Nama Guru</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $guru->nama }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <div class="btn-group" role="group" aria-label="Tombol Mapel">
                                                    <a href="/dashboard/mengajar/pembagian-mapel/{{ $guru->id }}" class="btn btn-info btn-sm ml-2">Atur Mapel</a>
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
            </div>
        </div>
    </div>
@endsection
