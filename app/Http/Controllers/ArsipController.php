<?php

namespace App\Http\Controllers;

use App\Exports\ArsipPpdbExport;
use App\Models\PPDB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArsipController extends Controller
{
    public function index(){

        $jml_ppdb = PPDB::select('id')->count();

        return view('arsip.index', [
            'title'     => 'Arsip '. config('app.name'),
            'jml_ppdb'  => $jml_ppdb,
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

}
