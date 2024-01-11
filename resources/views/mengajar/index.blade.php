@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Daftar Pembagian Jam Mengajar</strong>
                                <a href="/dashboard/mengajar/create" class="btn btn-primary btn-sm float-right"><i class="fe fe-plus"></i> Tambah</a>
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

                            <form action="/dashboard/mengajar">
                                <div class="input-group mb-3 col-3">
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
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-filter">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                            <table id="tbMengajar" class="table table-bordered datatables table-hover mb-0">
                                <thead class="text-center">
                                    <th class="text-dark">No</th>
                                    <th class="text-dark" width="200px">Mapel</th>
                                    <th class="text-dark text-nowrap col-4" width="300px">Nama Guru Pendidik</th>
                                    <th class="text-dark text-nowrap col-2" width="200px">Kelas / Jurusan</th>
                                    <th class="text-dark text-nowrap" width="100px">Jam Mengajar</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($mengajars as $mengajar)
                                    <tr>
                                        <form action="/dashboard/mengajar/{{ $mengajar->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $mengajar->mapel->kode }}</td>
                                        <td class="p-1">
                                            <select id="guru_id[{{ $mengajar->id }}]" name="guru_id" class="form-control {{$errors->first('guru_id') ? "is-invalid" : "" }}" required>
                                                @foreach ($gurus as $guru )
                                                    @if (old('guru_id', $mengajar->guru_id) == $guru->id)
                                                        <option value="{{ $guru->id }}" selected>{{ $guru->nama }}</option>
                                                    @else
                                                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-1">
                                            <select class="form-control {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id[{{ $mengajar->id }}]" name="kelas_id" required>
                                                @foreach ($kelas as $value)
                                                    @if (old('kelas_id', $mengajar->kelas_id) == $value->id)
                                                        <option value="{{ $value->id }}" selected>{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                                    @else
                                                        <option value="{{ $value->id }}">{{ $value->nama . '-' . $value->jurusan->kode }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-1">
                                           <select id="jam[{{ $mengajar->id }}]" name="jam" class="custom-select form-control {{$errors->first('jam') ? "is-invalid" : "" }}" >
                                            @for ($no = 0; $no < 50; $no++)
                                                @if($mengajar->jam == $no)
                                                    <option value="{{$mengajar->jam ?? ''}}" selected>{{$mengajar->jam ?? ''}}</option>
                                                @else
                                                    <option value={{ $no }}>{{ $no }}</option>
                                                @endif
                                            @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <div class="btn-group" role="group" aria-label="Tombol mengajar">
                                                    {{-- <a href="/dashboard/mengajar/{{ $mengajar->id }}" class="btn btn-info btn-sm ml-2"><span class="fe fe-eye text-white"></span></a> --}}
                                                    <button class="btn btn-primary btn-sm ml-2" type="submit"><span class="fe fe-edit text-white"></span></button>
                                                    <a href="/dashboard/mengajar/delete/{{ $mengajar->id }}" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
