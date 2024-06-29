@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Detail Pembayaran</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div>Kode</div>
                                    <div>ID User</div>
                                    <div>ID Pembayaran</div>
                                    <div>Iuran</div>
                                    <div>Jumlah Dibayar</div>
                                    <div>ID Siswa</div>
                                    <div>Nama Siswa</div>
                                </div>
                                <div class="col-md-8">
                                    <div>: {{ $transaksi->kode_transaksi }}</div>
                                    <div>: {{ $transaksi->user_id }}</div>
                                    <div>: {{ $transaksi->pembayaran_id }}</div>
                                    <div>: {{ $transaksi->iuran }}</div>
                                    <div>: {{ $transaksi->nominal }}</div>
                                    <div>: {{ $transaksi->siswa_id }}</div>
                                    <div>: {{ $transaksi->nama_siswa }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                            <pre>
                                <div id="result-json">JSON result will appear here after payment:<br></div>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
      const buttonPay = document.getElementById('pay-button');
      buttonPay.addEventListener('click', function(e){
        e.preventDefault();

        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      });
    </script>
@endpush
