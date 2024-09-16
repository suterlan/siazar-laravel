@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Daftar Transaksi Anda</strong>
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

                            <table id="tbTransaksiUser" class="table table-borderless table-hover py-3">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Iuran</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Status</th>
                                    <th class="text-center" scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y, H:i:s') }}</td>
                                            <td>{{ $transaction->kode_transaksi }}</td>
                                            <td>{{ $transaction->pembayaran->nama }}</td>
                                            <td>Rp. {{ number_format($transaction->nominal, '2', ',', '.') }}</td>
                                            <td>
                                                @switch($transaction->status)
                                                    @case('pending')
                                                        <span class="badge badge-warning text-white p-1">{{ $transaction->status }}</span>
                                                        @break
                                                    @case('success')
                                                        <span class="badge badge-success text-white p-1">{{ $transaction->status }}</span>
                                                        @break
                                                    @case('cancel')
                                                        <span class="badge badge-danger text-white p-1">{{ $transaction->status }}</span>
                                                        @break
                                                    @case('expire')
                                                        <span class="badge badge-danger text-white p-1">{{ $transaction->status }}</span>
                                                        @break
                                                    @default

                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($transaction->status === 'pending')
                                                    <a class="btn btn-link btn-sm" href="{{ route('transaksi.pay', $transaction->kode_transaksi) }}"> Lanjut Pembayaran</a>
                                                @endif
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
