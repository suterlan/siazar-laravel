<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index(){
        $kelas = Kelas::with(['siswas', 'guru'])->get();
        return view('siswa-group.index', [
            'title'     => 'Siswa Rombel | '. config('app.name'),
            'kelas'     => $kelas,
        ]);
    }

    function Kelulusan(Request $request) {
        Siswa::where('nis', $request->nis)
            ->update([
                'lulus' => true
            ]);
        return redirect(route('rombel'))->with('success', 'Siswa dengan NIS ' . $request->nis . ' berhasil diluluskan');
    }

    function KelulusanAll(Request $request) {
        if($request->check_lulus != ''){
            $data = $request->check_lulus;
            Siswa::whereIn('nis', $data)
                ->update(['lulus' => true]);

            return redirect(route('rombel'))->with('success', 'Siswa berhasil diluluskan');
        }else{
            return redirect(route('rombel'))->with('error', 'Tidak ada data yang dipilih!');
        }

    }
}
