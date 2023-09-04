@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Daftar Pembagian Mata Pelajaran</strong>
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
                            <a href="/dashboard/mapel" class="btn btn-danger btn-sm mb-2"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <table id="tbPembagianMapel" class="table table-bordered table-hover mb-0">
                                <thead class="text-center">
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>NUPTK</th>
                                    <th>Mata Pelajaran</th>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                    <tr>
                                        <td class="py-1">{{ $loop->iteration }}</td>
                                        <td class="py-1">{{ $guru->nama }}</td>
                                        <td class="py-1">{{ $guru->nuptk}}</td>
                                        <td class="py-1">
                                        @foreach ($guru->mapels as $mapel )
                                            <li>{{ $mapel->nama }}</li>
                                        @endforeach
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
