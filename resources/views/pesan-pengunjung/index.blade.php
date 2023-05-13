@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                    <strong class="card-title">PESAN PENGUNJUNG</strong>
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
                        <form action="/dashboard/pesan/delete-all" method="post">
                            @method('delete')
                            @csrf
                            <button id="delAll" class="btn btn-danger mb-3 d-none" name="delAll" onclick="return confirm('Yakin mau hapus semua data?')">Delete Selected</button>
                            <table id="tbPesan" class="table table-hover table-striped" style="font-size: 11px">
                                <thead class="thead-dark">
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Subject</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Isi Pesan</th>
                                    <th>Tanggal</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($pesans as $pesan)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub-check" id="sub_check{{ $pesan->id }}" name="sub_check[{{ $pesan->id }}]" value="{{ $pesan->id }}" data-id="{{ $pesan->id }}">
                                                <label class="custom-control-label" for="sub_check{{ $pesan->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesan->subject }}</td>
                                        <td>{{ $pesan->nama }}</td>
                                        <td>{{ $pesan->email }}</td>
                                        <td>
                                            {{ substr($pesan->pesan, 0, 100) }} ...
                                        </td>
                                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y'); }}
                                            <p>{{ $pesan->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-sm btn-info ml-1" href="/dashboard/pesan/{{ $pesan->id }}" title="Detail"><span class="fe fe-eye"></span></a>
                                                <form action="/dashboard/pesan/{{ $pesan->id }}" method="post">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
