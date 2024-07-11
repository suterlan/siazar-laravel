<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\PembayaranKelas;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with(['kelas:id,nama,jurusan_id'])->get();

        return view('pembayaran.index', [
            'title'     => 'Pembayaran | ' . config('app.name'),
            'jurusans'  => Jurusan::select('id', 'kode', 'nama')->with('kelas')->get(),
            'pembayarans'   => $pembayarans
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id'     => 'required',
            'nama'         => 'required',
            'nominal'      => 'required|decimal:0',
            'keterangan'   => 'nullable'
        ]);

        $pembayaran = Pembayaran::create([
            'nama'  => $validated['nama'],
            'nominal'  => $validated['nominal'],
            'keterangan'  => $validated['keterangan']
        ]);

        $pembayaran->kelas()->attach($validated['kelas_id']);

        return back()->with('success', 'Berhasil menambahkan data pembayaran!');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pembayaranKelas = PembayaranKelas::select('kelas_id')->whereRelation('pembayaran', 'pembayaran_id', '=', $pembayaran->id)->get();

        return view('pembayaran.edit', [
            'title'     => 'Edit Pembayaran | ' . config('app.name'),
            'jurusans'  => Jurusan::select('id', 'kode', 'nama')->with('kelas')->get(),
            'pembayaran'   => $pembayaran->load('kelas'),
            'pembayaranKelas'   => $pembayaranKelas,
        ]);
    }

    public function update(Pembayaran $pembayaran, Request $request)
    {

        $validated = $request->validate([
            'kelas_id'     => 'required',
            'nama'         => 'required',
            'nominal'      => 'required|decimal:0',
            'keterangan'   => 'nullable'
        ]);

        Pembayaran::where('id', $pembayaran->id)
            ->update([
                'nama'  => $validated['nama'],
                'nominal'  => $validated['nominal'],
                'keterangan'  => $validated['keterangan']
            ]);

        $pembayaran->kelas()->sync($validated['kelas_id']);

        return redirect(route('dashboard.pembayaran'))->with('success', 'Data pembayaran ' . $pembayaran->nama . ' berhasil diubah!');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return back()->with('success', 'Berhasil menghapus data pembayaran!');
    }

    public function transaksi()
    {
        $transactions = Transaction::latest()
            ->with(['pembayaran', 'siswa'])
            ->get();

        return view('pembayaran.transaksi', [
            'title'             => 'Daftar Transaksi ' . config('app.name'),
            'transactions'      => $transactions,
        ]);
    }

    public function cekTransaksi()
    {
        $jmlTrans = Transaction::count();
        $successTrans = Transaction::where('status', 'success')->count();
        $pendingTrans = Transaction::where('status', 'pending')->count();

        $transactions = [
            'jml_trans'  => $jmlTrans,
            'success_trans'  => $successTrans,
            'pending_trans'  => $pendingTrans
        ];

        return response()->json($transactions);
    }
}
