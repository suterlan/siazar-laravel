@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">IURAN</strong>
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

                            <table id="tbIuran" class="table table-borderless table-hover py-3">
                                <thead>
                                    <th>No</th>
                                    <th>Iuran</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th class="text-center" scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($iurans as $iuran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $iuran->nama }}</td>
                                        <td>Rp. {{ number_format($iuran->nominal, '2', ',', '.')}}</td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex float-right">
                                                <a class="btn btn-outline-info btn-sm mr-2" href="{{ route('iuran.detail', $iuran->id) }}"><span class="fe fe-eye"></span> Lihat Detail</a>
                                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#bayar{{ $iuran->id }}"> Buat Pembayaran</a>
                                            </div>
                                            @include('dashboard-siswa.iuran.partials.modal-bayar')
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
