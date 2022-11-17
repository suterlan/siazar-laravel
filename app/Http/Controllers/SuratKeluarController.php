<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\Klasifikasi;
use App\Models\SuratPenerimaan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    public function index()
    {
        return view('surat-keluar.index',[
            'title'     => 'Surat Keluar | ',
            'surats'    => SuratKeluar::with(['klasifikasi', 'penerimaan'])->latest()->get()
        ]);
    }

    public function create($jenis){
        if ($jenis == "Penerimaan") {
            return redirect('/dashboard/surat/penerimaan/create');
        }elseif ($jenis == "Panggilan") {
            return redirect('/dashboard/surat/panggilan/create');
        }elseif ($jenis == "Pemberitahuan") {
            dd($jenis);
        }
    }

    //Fungsi untuk mengenerate nomor surat otomatis
    public function getCodeKlasifikasi(Request $request)
    {
        function toRomawi($currenMonth)
        {
            switch ($currenMonth) {
                case 1:
                    return 'I';
                    break;
                case 2:
                    return 'II';
                    break;
                case 3:
                    return 'III';
                    break;
                case 4:
                    return 'IV';
                    break;
                case 5:
                    return 'V';
                    break;
                case 6:
                    return 'VI';
                    break;
                case 7:
                    return 'VII';
                    break;
                case 8:
                    return 'VIII';
                    break;
                case 9:
                    return 'IX';
                    break;
                case 10:
                    return 'X';
                    break;
                case 11:
                    return 'XI';
                    break;
                case 12:
                    return 'XII';
                    break;
            }
        }

        if ($request->kode != '') {
            // tanggap data dari request
            $klasifikasi = Klasifikasi::find($request->kode);

            // // hitung banyak data surat di db dan ubah jadikan collection
            // $currentSurat = collect(SuratKeluar::all())->count();

            // cari no_surat terbesar dari tabel surat keluar
            // dengan mengambil 2 digit dari kiri
            $query = DB::table('surat_keluars')
                    ->select(DB::raw('MAX(LEFT(no_surat, 2)) as lastNoSurat'));
            // jika hasil pencarian didapatkan lebih dari 0
            if ($query->count() > 0 ) {
                // lakukan perulangan
                foreach ($query->get() as $key) {
                    // no surat terakhir ubah jadi integer dan tambah dengan 1
                    $temp = ((int)$key->lastNoSurat)+1;
                    // ubah kembali jadi string 2 digit dengan menambahkan angka 0 di depan no surat
                    $no_surat = sprintf('%02s', $temp);
                }
            }else{
                $no_surat = '01';
            }

            // Buat bulan dalam angka romawi
            $currenMonth = date('n');
            $romawi = toRomawi($currenMonth);

            // gabungkan, sehingga menjadi no surat
            $no_surat = $no_surat . '/' . $klasifikasi->kode . '/SMK-AZ/' . $romawi . '/' . date('Y');

            // return data sebagai respon dalam bentuk json dg isi array assosiation
            return response()->json(['no_surat' => $no_surat]);
        } else {
            return response()->json(['no_surat' => '']);
        }
    }

}
