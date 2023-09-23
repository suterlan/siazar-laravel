@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Arsip PPDB</strong>
                            <p class="text-mutted">Data ppdb yang telah selesai di arsipkan dan dapat diakses  disini</p>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/arsip/ppdb">
                                <div class="input-group mb-3 col-3">
                                    <select id="filter_tahun" name="filter_tahun" class="form-control select2" aria-describedby="btn-filter">
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


                            <table id="tbArsipPpdb" class="table table-bordered table-hover table-responsive" style="font-size: 11px;">
                                <thead class="text-center">
                                    <th>NO</th>
                                    <th>NAMA SISWA</th>
                                    <th>NISN</th>
                                    <th>NIK</th>
                                    <th>JK</th>
                                    <th>TTL</th>
                                    <th>ASAL SEKOLAH</th>
                                    <th>JURUSAN DIPILIH</th>
                                    <th>INPUT OLEH</th>
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
                                    @foreach ($ppdbs as $ppdb)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ppdb->nama_siswa }}</td>
                                        <td>{{ $ppdb->nisn }}</td>
                                        <td>{{ $ppdb->nik }}</td>
                                        <td>{{ $ppdb->jk }}</td>
                                        <td class="text-nowrap">{{ $ppdb->tempat_lahir . ', ' . \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $ppdb->asal_sekolah }}</td>
                                        <td>{{ $ppdb->jurusan->kode ?? '' }}</td>
                                        <td>{{ $ppdb->user->name ?? ''}}</td>
                                        <td>{{ $ppdb->no_hp ?? ''}}</td>
                                        <td>{{ $ppdb->alamat ?? ''}}</td>
                                        <td>{{ $ppdb->provinsi ?? ''}}</td>
                                        <td>{{ $ppdb->kabupaten ?? ''}}</td>
                                        <td>{{ $ppdb->kecamatan ?? ''}}</td>
                                        <td>{{ $ppdb->desa ?? ''}}</td>
                                        <td>{{ $ppdb->no_ijazah ?? ''}}</td>
                                        <td>{{ $ppdb->no_skhun ?? ''}}</td>
                                        <td>{{ $ppdb->nama_ayah ?? ''}}</td>
                                        <td>{{ $ppdb->nik_ayah ?? ''}}</td>
                                        <td>{{ $ppdb->pendidikan_ayah ?? ''}}</td>
                                        <td>{{ $ppdb->pekerjaan_ayah ?? ''}}</td>
                                        <td>{{ $ppdb->penghasilan_ayah ?? ''}}</td>
                                        <td>{{ $ppdb->nama_ibu }}</td>
                                        <td>{{ $ppdb->nik_ibu ?? ''}}</td>
                                        <td>{{ $ppdb->pendidikan_ibu ?? ''}}</td>
                                        <td>{{ $ppdb->pekerjaan_ibu ?? ''}}</td>
                                        <td>{{ $ppdb->penghasilan_ibu ?? ''}}</td>
                                        <td>{{ $ppdb->jml_saudara_kandung ?? ''}}</td>
                                        <td>{{ $ppdb->no_kip ?? ''}}</td>
                                        <td>{{ $ppdb->nama_kip ?? ''}}</td>
                                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($ppdb->created_at)->format('d-m-Y') }}</td>
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
