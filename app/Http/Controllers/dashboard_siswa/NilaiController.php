<?php

namespace App\Http\Controllers\dashboard_siswa;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(){
        $siswa = Siswa::where('nisn', auth()->user()->username)->first();

        $mapels = Nilai::query()
                ->where('siswa_id', $siswa->id)->get()
                // ->groupBy('tahun_ajaran')
                ->sortBy('tahun_ajaran');

        // Group to multidimentional array
        $result = $mapels->groupBy(['tahun_ajaran', function ($item) {
            return $item['semester'];
        }], preserveKeys: true);

        return view('dashboard-siswa.nilai.index', [
            'title'     => 'Nilai '. config('app.name'),
            'siswa'     => $siswa,
            'mapels'    => $result,
        ]);
    }
}
