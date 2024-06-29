<?php

namespace App\Http\Controllers;

use App\Exports\ArsipPpdbExport;
use App\Models\PPDB;
use App\Models\Siswa;
use App\Models\TracingAlumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArsipController extends Controller
{
    public function index(){

        $jml_ppdb = PPDB::select('id')->count();
        $jml_tracing = TracingAlumni::count('id');
        $jml_alumni = Siswa::where('lulus', true)->count();

        return view('arsip.index', [
            'title'     => 'Arsip '. config('app.name'),
            'jml_ppdb'  => $jml_ppdb,
            'jml_alumni'    => $jml_alumni,
            'jml_tracing'   => $jml_tracing,
        ]);
    }

    public function ppdb(){

        $thisYear = Carbon::now();
        $startYear = $thisYear->subYears(10);

        $ppdbs = [];
        if(request('filter_tahun')){
            $ppdbs = PPDB::with(['jurusan', 'kelas', 'user'])
                    ->whereYear('created_at', request('filter_tahun'))
                    ->get();
        }

        return view('arsip.arsip-ppdb', [
            'startYear' => $startYear,
            'title'     => 'Arsip PPDB'. config('app.name'),
            'ppdbs'     => $ppdbs,
        ]);
    }

    public function tracingAlumni(){

        $alumni = TracingAlumni::with('siswa:id,nisn,nama_siswa,lulus')
                                ->whereHas('siswa', function($query){
                                    return $query->where('lulus', true);
                                });

        $filtered = $alumni->where('angkatan', date('Y'))->get();

        if(request('filter_tahun') && request('filter_status')){
            if(request('filter_status') == 'all'){
                $alumni->where('angkatan', request('filter_tahun'));
            }else{
                $alumni->where('angkatan', request('filter_tahun'))
                ->where('status', request('filter_status'));
            }

            $filtered = $alumni->get();
        }
        // dd($filtered);

        return view('arsip.tracing-alumni', [
            'title'     => 'Arsip Tracing Alumni'. config('app.name'),
            'alumnis'   => $filtered,
        ]);
    }

}
