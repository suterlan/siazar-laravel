<?php

namespace App\Http\Controllers\dashboard_siswa;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IuranController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('nisn', Auth::user()->username)->first();
        $pembayaran = Pembayaran::whereRelation('kelas', 'kelas_id', $siswa->kelas_id)
            ->withSum(['details' => function ($q) use ($siswa) {
                $q->where('siswa_id', $siswa->id);
            }], 'nominal')
            ->get();

        return view('dashboard-siswa.iuran.index', [
            'title'     => 'Iuran ' . config('app.name'),
            'iurans'    => $pembayaran
        ]);
    }

    public function show(Pembayaran $pembayaran)
    {
        $siswa = Siswa::where('nisn', Auth::user()->username)->first();

        $pembayaranDetail = $pembayaran->load(['details' => function ($q) use ($siswa) {
            $q->where('siswa_id', $siswa->id);
        }]);

        return view('dashboard-siswa.iuran.detail', [
            'title'     => 'Detail Iuran ' . config('app.name'),
            'iuran'     => $pembayaranDetail
        ]);
    }
}
