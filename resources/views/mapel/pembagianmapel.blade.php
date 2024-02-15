@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
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
                            <a href="/dashboard/mapel" class="btn btn-danger btn-sm mb-3"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <form action="/dashboard/mapel/pembagian-mapel">
                                <div class="d-flex mb-3 col-md-6">
                                    <div class="input-group">
                                        <select id="filter_tahun" name="filter_tahun" class="form-control select2" aria-describedby="btn-filter" required>
                                            <option value="">-- Tahun Ajaran --</option>
                                            @foreach ($years as $year => $tahun )
                                                @if (request('filter_tahun') == $year)
                                                    <option value="{{$year}}" selected>{{ $year}}</option>
                                                @else
                                                    <option value="{{$year}}">{{ $year}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <select id="filter_semester" name="filter_semester" class="form-control select2" required>
                                            <option value="">-- Semester --</option>
                                            <option value="Ganjil" @if(request('filter_semester') == 'Ganjil') selected @endif>Ganjil</option>
                                            <option value="Genap" @if(request('filter_semester') == 'Genap') selected @endif>Genap</option>
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-filter">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <table id="tbPembagianMapel" class="table table-bordered table-hover mb-0">
                                {{-- <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Guru</th>
                                        <th rowspan="2">Mata Pelajaran</th>
                                        @foreach ($jurusan_header as $jurusan => $value)
                                            <th colspan="3">{{ $jurusan }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                    @foreach ($jurusans as $jurusan)
                                        @foreach ($jurusan->kelas as $kelas)
                                            <th>{{ $kelas->nama }}</th>
                                        @endforeach
                                    @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mengajars as $guru => $mapels)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $guru }}</td>
                                        @foreach ($mapels as $mapel => $kelas )
                                            <td>{{ $mapel }}</td>
                                            @foreach ($kelas as $kelas)
                                                <td>{{ $kelas->jam }}</td>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody> --}}
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Guru</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Jam</th>
                                        <th>Total Jam</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $guru->nama }}</td>
                                        <td>
                                            @foreach ($guru->mengajars as $mapel)
                                                <li>{{ $mapel->mapel->nama }} ({{ $mapel->mapel->kode }})</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($guru->mengajars as $kelas)
                                                <li>{{ $kelas->kelas->nama . ' - ' . $kelas->kelas->jurusan->kode }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($guru->mengajars as $jam)
                                                <li>{{ $jam->jam }} Jam</li>
                                            @endforeach
                                        </td>
                                        <td class="text-center"><b>{{ $guru->total_jam }}</b></td>
                                        {{-- <td>
                                            <div class="d-flex float-right">
                                                <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </td> --}}
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
