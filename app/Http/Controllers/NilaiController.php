<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index(){


        $siswa = Siswa::select('id', 'nama_siswa')->with('mapels:id,kode,nama')->get();

        return view('nilai.index', [
            'title'     => 'Nilai '. config('app.name'),
            'mapels'    => Mapel::select('id', 'kode', 'nama')->get(),
            'tahuns'    => Mengajar::select('tahun_ajaran')->get()->groupBy('tahun_ajaran'),
            'siswas'    => $siswa,
        ]);
    }

    public function getMapelMengajar(Request $request){

        $mapel = Mapel::whereRelation('mengajars', 'tahun_ajaran', $request->tahun)->get();

        return response()->json($mapel);
    }

    public function getKelasMengajar(Request $request){
        $kelas = Kelas::whereRelation('mengajars', 'mapel_id', $request->mapel_id)->get();
        return response()->json($kelas);
    }

    public function getSiswaMengajar(Request $request){
        $kelasId = $request->kelas_id;
        $jurusanId = $request->jurusan_id;
        $tahunAjaran = $request->tahun_ajaran;
        $mapelId = $request->mapel_id;

        $siswas = Siswa::select('id')
            ->where('kelas_id', $kelasId)
            ->where('jurusan_id', $jurusanId)->get();

        foreach ($siswas as $value) {
            $checkSiswa = Nilai::where('siswa_id', $value->id)->where('mapel_id', $mapelId)->where('tahun_ajaran', $tahunAjaran)->get();
            if($checkSiswa->count() == 0){
                Nilai::create([
                    'siswa_id'  => $value->id,
                    'mapel_id'  => $mapelId,
                    'tahun_ajaran'  => $tahunAjaran,
                ]);
            }
        }

        $siswa = Siswa::select('id', 'nama_siswa')
            ->where('kelas_id', $kelasId)
            ->where('jurusan_id', $jurusanId)
            ->with('mapels', function ($query) use ($mapelId){
                return $query->where('mapel_id', '=', $mapelId);
            })
            ->get();
        // dd($siswa);
        return response()->json($siswa);
    }

    public function store(Request $request){

        $data = $request->except(['_token', 'siswa_nama']);
        // dd($data);

        $jml_siswa = count($data['siswa_id']);
        // dd($jml_siswa);
        // $data_nilai = [];
        for ($i=0; $i < $jml_siswa; $i++) {
            // $data_nilai[] = [
            //     'siswa_id'  => $data['siswa_id'][$i],
            //     'mapel_id'  => $data['mapel_id'],
            //     'nilai'     => $data['nilai'][$i],
            //     'tahun_ajaran'     => $data['tahun_ajaran'],
            // ];

            Nilai::where('siswa_id', $data['siswa_id'][$i])
                ->where('mapel_id', $data['mapel_id'])
                ->where('tahun_ajaran', $data['tahun_ajaran'])
                ->update([
                    'nilai' =>  $data['nilai'][$i]
                ]);
        }

        return back()->with('success', 'Nilai berhasil diinput!');
    }

    public function rekap(){
        $mapel = Mapel::select('id', 'kode')->with('siswas:id')->get();
        $group_by_kode = $mapel->groupBy('kode');

        $siswa = Siswa::select('id', 'nama_siswa')->with('mapels:id,kode,nama')->get();
        // dd($siswa);
        return view('nilai.rekap', [
            'title'     => 'Data Nilai '. config('app.name'),
            'kodemapels'    => $group_by_kode,
            'siswas'    => $siswa,
        ]);
    }
}
