@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
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
                <div class="card shadow">
                    <div class="card-header">
                      <strong class="card-title">DATA SEMUA GURU</strong>
                      <a href="/dashboard/guru/create" class="btn btn-primary float-right"><i class="fe fe-plus"></i> Guru</a>
                    </div>
                    <div class="card-body">
                        <table id="tbGuru" class="table table-hover table-striped" style="font-size: 11px">
                            <thead>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Tempat, Tgl Lahir</th>
                                <th>No HP</th>
                                <th>NUPTK</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($gurus as $guru)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="avatar avatar-md">
                                            @if (isset($guru->dokumen->foto))
                                                <img src="{{ asset('storage/'. $guru->dokumen->foto ) }}" alt="Foto" class="avatar-img rounded-circle">
                                            @else
                                                <img src="#" alt="Foto" class="avatar-img rounded-circle">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-muted"><strong>{{ $guru->nama }}</strong></p>
                                        <small>{{$guru->email ?? ''}}</small>
                                    </td>
                                    <td>{{ $guru->nik }}</td>
                                    <td>{{ $guru->tempat_lahir . ', ' . \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>{{ $guru->no_hp }}</td>
                                    <td>{{ $guru->nuptk }}</td>
                                    <td>
                                        <div class="d-flex float-right">
                                            {{-- <a class="btn btn-sm btn-info ml-1" href="/dashboard/guru/{{ $guru->id }}" title="Detail"><span class="fe fe-eye"></span></a> --}}
                                            <a class="btn btn-sm btn-primary ml-1" href="/dashboard/guru/{{ $guru->id }}/edit" title="Edit"><span class="fe fe-edit"></span></a>
                                            <form action="/dashboard/guru/{{$guru->id}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger ml-1" type="submit" title="Remove" onclick="return confirm('Yakin ingin menghapus data?')"><span class="fe fe-delete"></span></button>
                                            </form>
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