<?php

namespace App\Http\Controllers\dashboard_siswa;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Transaction;
use App\Services\Midtrans\CreateSnapTokenService;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::whereRelation('user', 'user_id', Auth::user()->id)
            ->with(['pembayaran', 'siswa'])
            ->latest()
            ->get();

        return view('dashboard-siswa.transaksi.index', [
            'title'             => 'Daftar Transaksi ' . config('app.name'),
            'transactions'      => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        // buat kode transaksi menggunakan package idgenerator
        $config = [
            'table'     => 'transactions',
            'field'     => 'kode_transaksi',
            'length'    => 13,
            'prefix'    => date('Ymd')
        ];
        $kode_transaksi = IdGenerator::generate($config);

        // get iuran sesuai id
        $iuran = Pembayaran::find($request->pembayaran_id);

        // get siswa
        $siswa = Siswa::where('nisn', Auth::user()->username)->first();

        $detail_pembayaran = [
            'kode_transaksi'    => $kode_transaksi,
            'user_id'           => Auth::user()->id,
            'pembayaran_id'     => $iuran->id,
            'iuran'             => $iuran->nama,
            'nominal'           => $request->nominal,
            'siswa_id'          => $siswa->id,
            'nama_siswa'        => $siswa->nama_siswa,
        ];

        DB::transaction(function () use ($detail_pembayaran, $iuran, $siswa) {
            $transaction = Transaction::create([
                'kode_transaksi'    => $detail_pembayaran['kode_transaksi'],
                'user_id'           => $detail_pembayaran['user_id'],
                'pembayaran_id'     => $detail_pembayaran['pembayaran_id'],
                'siswa_id'          => $detail_pembayaran['siswa_id'],
                'iuran'             => $detail_pembayaran['iuran'],
                'nominal'           => $detail_pembayaran['nominal'],
                'nama_siswa'        => $detail_pembayaran['nama_siswa']
            ]);

            // buat snapToken dengan memanggil servis Midtrans
            // yang telah dibuat di App\Services\Midtrans
            $midtrans = new CreateSnapTokenService($iuran, $siswa, $transaction);
            $snapToken = $midtrans->getSnapToken();
            $transaction->snap_token = $snapToken;
            $transaction->save();
        });

        return redirect()->route('transaksi.pay', $detail_pembayaran['kode_transaksi']);
    }

    public function pay(Transaction $transaction)
    {
        $snapToken = $transaction->snap_token;

        return view('dashboard-siswa.transaksi.checkout', [
            'title'             => 'Checkout Pembayaran ' . config('app.name'),
            'transaksi'         => $transaction,
            'snapToken'         => $snapToken,
        ]);
    }
}
