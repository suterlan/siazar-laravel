@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Data Siswa</strong>
                            <a href="/dashboard/siswa/registrasi-step1">
                                <button class="btn btn-primary btn-sm float-right"><span class="fe fe-plus"></span> Tambah Siswa </button>
                            </a>
                            <a class="btn btn-secondary btn-sm float-right mr-3" href="/dashboard/siswa/export">Export Excel</a>
                            <p class="card-text">Data seluruh siswa</p>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success col-12" role="alert">
                                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                            </div>
                            @endif
                            <table id="tbSiswa" class="table table-stripped table-hover datatables" style="font-size: 12px">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Lahir</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th class="text-center" scope="col"><span class="fe fe-tool text-info fe-16"></span></th>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->kelas->nama ?? '' }} - {{ $siswa->kelas->jurusan->kode ?? '' }}</td>
                                        <td>{{ $siswa->jurusan->nama ?? '' }}</td>
                                        <td class="d-flex float-right">
                                            <a class="btn btn-sm btn-info ml-1" href="/dashboard/siswa/{{ $siswa->id }}" title="Detail"><span class="fe fe-eye"></span></a>
                                            <a class="btn btn-sm btn-primary ml-1" href="/dashboard/siswa/{{ $siswa->id }}/edit" title="Edit"><span class="fe fe-edit"></span></a>
                                            @canany(['admin', 'kurikulum'])
                                            <form action="/dashboard/siswa/{{$siswa->id}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger ml-1" type="submit" title="Remove" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                            </form>
                                            @endcanany
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <nav aria-label="Table Paging" class="mb-0 text-muted mt-3">
                                <ul class="pagination justify-content-center mb-0">
                                    {{$siswas->links()}}
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
