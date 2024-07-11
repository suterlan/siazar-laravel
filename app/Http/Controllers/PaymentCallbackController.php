<?php

namespace App\Http\Controllers;

use App\Models\PembayaranDetail;
use App\Models\Transaction;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function receive(){
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $transaksi = $callback->getTransaksi();

            if ($callback->isSuccess()) {
                Transaction::where('kode_transaksi', $transaksi->kode_transaksi)->update([
                    'status'    => 'success',
                ]);

                PembayaranDetail::create([
                    'pembayaran_id' => $transaksi->pembayaran_id,
                    'siswa_id'      => $transaksi->siswa_id,
                    'nominal'       => $transaksi->nominal,
                ]);
            }

            if ($callback->isExpire()) {
                Transaction::where('kode_transaksi', $transaksi->kode_transaksi)->update([
                    'status'    => 'expire',
                ]);
            }

            if ($callback->isCancelled()) {
                Transaction::where('kode_transaksi', $transaksi->kode_transaksi)->update([
                    'status'    => 'cancel',
                ]);
            }

            return response()->json([
                'success'   => true,
                'message'   => 'Berhasil diproses',
            ]);

        }else{
            return response()->json([
                'error' => true,
                'message'   => 'Signature key tidak terverifikasi'
            ], 403);
        }
    }
}
