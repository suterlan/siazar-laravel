<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $query = DB::table('klasifikasis')
                ->select('klasifikasis.nama',
                    DB::raw("(SELECT COUNT(id) AS s_keluarCount FROM surat_keluars WHERE surat_keluars.klasifikasi_id=klasifikasis.id) as s_keluarCount"),
                    DB::raw("(SELECT COUNT(id) AS s_masukCount FROM surat_masuks WHERE surat_masuks.klasifikasi_id=klasifikasis.id) as s_masukCount")
                )
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

        return view('index', [
            'title'         => 'Dashboard | SIAZAR',
            'jmlSuratkeluar'    => SuratKeluar::all()->count(),
            'jmlSuratmasuk'     => SuratMasuk::all()->count(),
            'chart'             => $chart,
        ]);
    }
}
