<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Klasifikasi;
use App\Models\PPDB;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){
        $query = DB::table('klasifikasis')
                ->select('klasifikasis.nama',
                    DB::raw("(SELECT COUNT(id) AS s_keluarCount FROM surat_keluars WHERE surat_keluars.klasifikasi_id=klasifikasis.id) as s_keluarCount"),
                    DB::raw("(SELECT COUNT(id) AS s_masukCount FROM surat_masuks WHERE surat_masuks.klasifikasi_id=klasifikasis.id) as s_masukCount")
                )
                // ->whereYear('created_at', Carbon::now('Y'))
                ->get();

        $klasifikasi = [];
        $jml_klasifikasiSuratKeluar = [];
        $jml_klasifikasiSuratMasuk = [];
        foreach ($query as $q){
            $klasifikasi[] = $q->nama;
            $jml_klasifikasiSuratKeluar[] = $q->s_keluarCount;
            $jml_klasifikasiSuratMasuk[] = $q->s_masukCount;
        }

        $chart = LarapexChart::setType('line')
                ->setTitle('Chart Surat')
                ->setSubtitle('Grafik jumlah surat keluar dan surat masuk berdasarkan klasifikasi')
                ->setLabels(['Surat Keluar', 'Surat Masuk'])
                ->setXAxis($klasifikasi)
                ->setMarkers(['#ff0000', '#ff0000'], 7, 7)
                ->setGrid()
                ->setDataset([
                    [
                        'name'     => 'Surat Keluar',
                        'data'      => $jml_klasifikasiSuratKeluar
                    ],
                    [
                        'name'     => 'Surat Masuk',
                        'data'      => $jml_klasifikasiSuratMasuk
                    ]
                ]);

        $startYear = Carbon::now();
        $ppdb = PPDB::select('id')
            ->whereYear('created_at', $startYear)
            ->count();
        $ppdb_approve = PPDB::select('id')
            ->whereYear('created_at', $startYear)
            ->where('confirmed', 1)
            ->count();
        $ppdb_notapprove = PPDB::select('id')
            ->whereYear('created_at', $startYear)
            ->where('confirmed', 0)
            ->count();
        $siswa = Siswa::select('id')->where('lulus', false)->where('status_siswa', true)->count();
        $guru = Guru::select('id')->count();

        return view('index', [
            'title'             => 'Dashboard '. config('app.name'),
            'jmlSuratkeluar'    => SuratKeluar::whereYear('created_at', $startYear)->count(),
            'jmlSuratmasuk'     => SuratMasuk::whereYear('created_at', $startYear)->count(),
            'chart'             => $chart,
            'ppdb'              => $ppdb,
            'ppdb_approve'      => $ppdb_approve,
            'ppdb_notapprove'   => $ppdb_notapprove,
            'siswa'             => $siswa,
            'guru'              => $guru,
        ]);
    }
}
