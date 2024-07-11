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
                            <a id="back-button" href="{{ route('transaksi') }}" class="btn btn-danger btn-sm" hidden><span class="fe fe-arrow-left mr-1"></span>Kembali</a>

                            <button class="btn btn-primary btn-sm" id="pay-button">Bayar Sekarang</button>

                            {{-- <pre> --}}
                            <div id="result-json">
                                {{-- result from js here --}}
                            </div>
                            {{-- </pre> --}}
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
          onSuccess: function(result){.
            /* You may add your own js here, this is just example */
            //document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            buttonPay.setAttribute('hidden', 'true');
            document.getElementById('back-button').removeAttribute('hidden');

            document.getElementById('result-json').innerHTML += `
                <div class="alert alert-success col-12 mt-2" role="alert">
                    <span class="fe fe-check-circle fe-16 mr-2"></span> Selamat pembayaran berhasil!
                </div>
            `;
          },
          // Optional
          onPending: function(result){
            document.getElementById('result-json').innerHTML += `
               <div class="alert alert-info col-12 mt-2" role="alert">
                    <div class="spinner-border spinner-border-sm mr-3 text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span class="text-info">Pembayaran sedang di proses...</span>
                </div>
            `;
          },
          // Optional
          onError: function(result){
            document.getElementById('result-json').innerHTML += `
                <div class="alert alert-danger col-12 mt-2" role="alert">
                    <span class="fe fe-check-circle fe-16 mr-2"></span> Pembayaran gagal!
                </div>
            `;
          }
        });
      });
    </script>
@endpush
