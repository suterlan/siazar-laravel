@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card shadow">
                        <div class="card-header pt-3">
                            <a href="/dashboard/mengajar/pembagian-mapel" class="btn btn-danger btn-sm"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <button data-toggle="modal" data-target="#tambahMapelMengajar" type="button" class="btn btn-sm btn-primary float-right"><i class="fe fe-plus"></i> Tambah Mapel</button>
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

                            @foreach ($mengajar as $tahun => $mapels)
                            <div>Guru :  <strong class="card-title"> {{ $guru->nama }}</strong></div>
                            <div class="mb-2">Tahun Ajaran : <strong>{{ $tahun }}</strong></div>
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Jam</th>
                                </thead>
                                <tbody style="font-size: 0.8rem">
                                    <tr>
                                        <td colspan="5"><strong>Semester Genap</strong></td>
                                    </tr>
                                    @foreach ($mapels as $mapel)
                                    @continue($mapel->semester == 'Ganjil')
                                    <tr>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->mapel->kode }}</td>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->mapel->nama }}</td>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->kelas->nama . ' - ' . $mapel->kelas->jurusan->kode }}</td>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->jam . ' JP'}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-center"><b>Total JP</b></td>
                                        <td class="bg-success-lighter"><b>{{ $mapels->where('semester', 'Genap')->sum('jam') }} JP </b></td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"><strong>Semester Ganjil</strong></td>
                                    </tr>
                                    @foreach ($mapels as $mapel)
                                    @continue($mapel->semester == 'Genap')
                                    <tr>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->mapel->kode }}</td>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->mapel->nama }}</td>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->kelas->nama . ' - ' . $mapel->kelas->jurusan->kode }}</td>
                                        <td style="padding: 0.4rem 0.7rem">{{ $mapel->jam . ' JP'}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-center"><b>Total JP</b></td>
                                        <td class="bg-success-lighter"><b>{{ $mapels->where('semester', 'Ganjil')->sum('jam') }} JP </b></td>
                                    </tr>
                                </tbody>
                            </table>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('mengajar.partial.tambah-mapel-mengajar')
@endsection
