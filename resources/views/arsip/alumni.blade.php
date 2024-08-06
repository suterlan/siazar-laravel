@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Arsip Alumni</strong>
                            <p class="text-mutted">Data alumni yang sudah lulus di arsipkan dan dapat diakses disini</p>
                        </div>
                        <div class="card-body">
                            <form action="{{route('arsip-alumni')}}">
                                <div class="input-group mb-3 col-sm-4 col-md-6 col-lg-4">
                                    <select id="filter_tahun" name="filter_tahun" class="form-control" aria-describedby="btn-filter">
                                        <option value="">-- Filter Tahun --</option>
                                        @for($i=date('Y'); $i>=date('Y')-10; $i-=1)
                                            @if (request('filter_tahun') == $i)
                                                <option value="{{ $i }}" selected> {{ $i }} </option>
                                            @else
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endif
                                        @endfor
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-filter">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <table id="tbArsipAlumni" class="table table-bordered table-hover table-responsive" style="font-size: 11px;">
                                <thead class="text-center">
                                    <th>NO</th>
                                    <th>NAMA SISWA</th>
                                    <th>NISN</th>
                                    <th>NIK</th>
                                    <th>JK</th>
                                    <th>TTL</th>
                                    <th>ASAL SEKOLAH</th>
                                    <th>JURUSAN DIPILIH</th>
                                    <th>NO HP</th>
                                    <th>ALAMAT</th>
                                    <th>PROVINSI</th>
                                    <th>KABUPATEN</th>
                                    <th>KECAMATAN</th>
                                    <th>DESA</th>
                                    <th>NO IJAZAH</th>
                                    <th>NO SKHUN</th>
                                    <th>NAMA AYAH</th>
                                    <th>NIK AYAH</th>
                                    <th>PENDIDIKAN AYAH</th>
                                    <th>PEKERJAAN AYAH</th>
                                    <th>PENGHASILAN AYAH</th>
                                    <th>NAMA IBU</th>
                                    <th>NIK IBU</th>
                                    <th>PENDIDIKAN IBU</th>
                                    <th>PEKERJAAN IBU</th>
                                    <th>PENGHASILAN IBU</th>
                                    <th>JML SAUDARA</th>
                                    <th>NO KIP</th>
                                    <th>NAMA KIP</th>
                                    <th>Tgl Input</th>
                                </thead>
                                <tbody>
                                    @foreach ($alumnis as $alumni)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $alumni->siswa->nama_siswa }}</td>
                                        <td>{{ $alumni->siswa->nisn }}</td>
                                        <td>{{ $alumni->siswa->nik }}</td>
                                        <td>{{ $alumni->siswa->jk }}</td>
                                        <td class="text-nowrap">{{ $alumni->siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($alumni->siswa->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $alumni->siswa->asal_sekolah }}</td>
                                        <td>{{ $alumni->siswa->jurusan->kode ?? '' }}</td>
                                        <td>{{ $alumni->siswa->no_hp ?? ''}}</td>
                                        <td>{{ $alumni->siswa->alamat ?? ''}}</td>
                                        <td>{{ $alumni->siswa->provinsi ?? ''}}</td>
                                        <td>{{ $alumni->siswa->kabupaten ?? ''}}</td>
                                        <td>{{ $alumni->siswa->kecamatan ?? ''}}</td>
                                        <td>{{ $alumni->siswa->desa ?? ''}}</td>
                                        <td>{{ $alumni->siswa->no_ijazah ?? ''}}</td>
                                        <td>{{ $alumni->siswa->no_skhun ?? ''}}</td>
                                        <td>{{ $alumni->siswa->nama_ayah ?? ''}}</td>
                                        <td>{{ $alumni->siswa->nik_ayah ?? ''}}</td>
                                        <td>{{ $alumni->siswa->pendidikan_ayah ?? ''}}</td>
                                        <td>{{ $alumni->siswa->pekerjaan_ayah ?? ''}}</td>
                                        <td>{{ $alumni->siswa->penghasilan_ayah ?? ''}}</td>
                                        <td>{{ $alumni->siswa->nama_ibu }}</td>
                                        <td>{{ $alumni->siswa->nik_ibu ?? ''}}</td>
                                        <td>{{ $alumni->siswa->pendidikan_ibu ?? ''}}</td>
                                        <td>{{ $alumni->siswa->pekerjaan_ibu ?? ''}}</td>
                                        <td>{{ $alumni->siswa->penghasilan_ibu ?? ''}}</td>
                                        <td>{{ $alumni->siswa->jml_saudara_kandung ?? ''}}</td>
                                        <td>{{ $alumni->siswa->no_kip ?? ''}}</td>
                                        <td>{{ $alumni->siswa->nama_kip ?? ''}}</td>
                                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($alumni->siswa->created_at)->format('d-m-Y') }}</td>
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
