@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Daftar Pembagian Jam Mengajar</strong>
                                <a href="/dashboard/mengajar/pembagian-mapel" class="btn btn-primary btn-sm float-right"><i class="fe fe-plus"></i> Atur Pembagian Mapel</a>
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
                                    {{-- <div class="input-group">
                                        <select id="filter_guru" name="filter_guru" class="form-control">
                                            <option value="">-- Guru --</option>
                                            @foreach ($gurus as $guru)
                                                <option value="{{ $guru->id }}" @selected(request('filter_guru') == $guru->id)>{{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-filter">Filter</button>
                                    </div>
                                </div>
                            </form>
                            @foreach ($mengajarsGroup as $guru)
                            <div class="table-responsive py-3">
                                <table class="table table-bordered datatables table-mengajar table-hover">
                                    <thead>
                                        <tr>
                                            <td colspan="6" class="bg-light">Guru Bidang : <strong>{{ $guru->nama }} </strong></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kode Mapel</th>
                                            <th class="text-nowrap">Nama Mata Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Jam</th>
                                            <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guru->mengajars->load(['mapel', 'kelas']) as $mengajar)
                                            <tr>
                                            <form action="/dashboard/mengajar/{{ $mengajar->id }}" method="post">
                                            @method('put')
                                            @csrf
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $mengajar->mapel->kode }}</td>
                                                <td>{{ $mengajar->mapel->nama }}</td>
                                                <td>{{ $mengajar->kelas->nama . ' - ' . $mengajar->kelas->jurusan->kode }}</td>
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
                                                            <button class="btn btn-primary btn-sm ml-2" type="submit"><span class="fe fe-edit text-white"></span> Update</button>
                                                            <a href="/dashboard/mengajar/delete/{{ $mengajar->id }}" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
