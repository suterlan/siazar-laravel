@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Daftar Transaksi</strong>
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

                            <table id="tbTransaksi" class="table table-borderless table-hover py-3">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Iuran</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Status</th>
                                    {{-- <th class="text-center" scope="col"></th> --}}
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
                                                    @default

                                                @endswitch
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
    <script type="text/javascript">
        setTimeout( () => {
            setInterval( async () => {
                let currentTrans = {{$transactions->count()}};
                let currentSuccessTrans = {{$transactions->where('status', 'success')->count()}};
                let currentPendingTrans = {{$transactions->where('status', 'pending')->count()}};
                // console.log('transaksi pending saat ini = ' + currentPendingTrans);

                let countTrans = await fetch('/dashboard/pembayaran/cek-transaksi')
                                .then((response) => response.json())
                                .then((response) => response);

                console.log(countTrans);

                if(currentTrans < countTrans.jml_trans){
                    window.location.reload(true);
                }else if(currentPendingTrans < countTrans.pending_trans){
                    window.location.reload(true);
                }else if(currentSuccessTrans < countTrans.success_trans){
                    window.location.reload(true);
                }

            }, 10000);

        }, 30000);
    </script>
    
@endsection
