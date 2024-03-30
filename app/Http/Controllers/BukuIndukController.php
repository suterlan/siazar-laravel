<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class BukuIndukController extends Controller
{
    public function index(){
        if (!Gate::allows('admin')) {
            $kelas = Kelas::with(['siswas', 'guru'])
                    ->where('guru_id', auth()->user()->id)
                    ->get();
        }else{
            $kelas = Kelas::with(['siswas', 'guru'])
                    ->get();
        }
        return view('buku-induk.index', [
            'title'     => 'Buku Induk Siswa | '. config('app.name'),
            'kelas'     => $kelas,
        ]);
    }

    public function cetak(Siswa $siswa){
        // dd($siswa);
        $pdf = FacadePdf::loadView('buku-induk.cetak', [
            'title'     => 'Cetak Buku Induk | '. config('app.name'),
            'siswa'     => $siswa,
        ]);

        return $pdf->stream('buku-induk-siswa');
    }

    public function download(Siswa $siswa){
        $pdf = FacadePdf::loadView('buku-induk.cetak', [
            'title'     => 'Download Buku Induk | '. config('app.name'),
            'siswa'     => $siswa,
        ]);

        $nama = str_replace(' ', '_', $siswa->nama_siswa);
        return $pdf->download('buku-induk-siswa-'.$nama.'.pdf');
    }
}
