@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="mb-2">
                                <a href="{{ route('iuran') }}" class="btn btn-danger btn-sm"><i class="fe fe-arrow-left"></i> Kembali</a>
                            </div>
                            <span>DETAIL <strong class="card-title">{{ Str::upper($iuran->nama) }}</strong></span>
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

                            <table class="table table-bordered table-hover py-2">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col" width="2px">No</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Jumlah Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($iuran->details as $detail)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($detail->created_at)->format('d-m-Y, h:i:s')  }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->nominal, '2', ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-success-lighter">
                                        <td class="text-center" colspan="2"><strong>TOTAL</strong></td>
                                        <td class="text-right">
                                            <strong>Rp. {{ number_format($iuran->details->sum('nominal'), '2', ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
