<?php

namespace App\Services\Midtrans;

use App\Services\Midtrans\Midtrans;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans {
    protected $iuran;
    protected $siswa;
    protected $transaksi;

    public function __construct($iuran, $siswa, $transaksi)
    {
        parent::__construct();
        $this->iuran = $iuran;
        $this->siswa = $siswa;
        $this->transaksi = $transaksi;
    }

    public function getSnapToken(){

        $payload = [
            'transaction_details' => [
                'order_id'     => $this->transaksi->kode_transaksi,
                'gross_amount' => $this->transaksi->nominal,
            ],
            'customer_details' => [
                'id'        => Auth::user()->id,
                'siswa_id'  => $this->siswa->siswa_id,
                'name'  => $this->siswa->nama_siswa,
            ],
            'item_details' => [
                [
                    'id'        => $this->iuran->id,
                    'quantity'  => 1,
                    'price'     => $this->transaksi->nominal,
                    'name'      => $this->iuran->nama,
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($payload);
        return $snapToken;
    }
}
