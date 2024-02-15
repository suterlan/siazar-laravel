@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="text-center">Data Nilai Siswa</h3>
                        <form action="/dashboard/nilai-siswa">
                            <div class="form-group mb-2">
                                <select id="filter_semester" name="filter_semester" class="form-control {{$errors->first('filter_semester') ? "is-invalid" : "" }}" required>
                                    <option value="">-- Semester --</option>
                                    <option value="Ganjil" @selected(request('filter_semester') == 'Ganjil')>Ganjil</option>
                                    <option value="Genap" @selected(request('filter_semester') == 'Genap')>Genap</option>
                                </select>
                                @error('filter_semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <select class="form-control {{$errors->first('filter_tahun') ? "is-invalid" : "" }}" id="filter_tahun" name="filter_tahun" required>
                                    <option value="">-- Tahun Ajaran --</option>
                                    @foreach ($tahuns as $tahun => $value)
                                        <option value="{{ $tahun }}" @selected(request('filter_tahun') == $tahun)>{{ $tahun }}</option>
                                    @endforeach
                                </select>
                                @error('filter_tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <select class="form-control {{$errors->first('filter_kelas') ? "is-invalid" : "" }}" id="filter_kelas" name="filter_kelas" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $kel)
                                        <option value="{{ $kel->id }}" @selected(request('filter_kelas') == $kel->id)>{{ $kel->nama . ' - ' . $kel->jurusan->kode }}</option>
                                    @endforeach
                                </select>
                                @error('filter_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fe fe-filter"></i> Filter</button>
                        </form>
                    </div>
                    <div class="card-body pb-3">
                        <div class="table-responsive">
                            <table id="tableNilai" class="table table-bordered datatables table-striped">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        @foreach($kodemapels as $kode => $value)
                                            <th class="text-center bg-dark-lighter">{{ $kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                    <tr>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        @foreach ($siswa->mapels as $nilai)
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-primary me-2">{{ $nilai->pivot->nilai}}</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- @if(blank($siswas))
                                <div class="text-center text-muted">Data Kosong</div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
