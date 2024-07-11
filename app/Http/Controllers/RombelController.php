<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Klasifikasi;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\SuratKelulusan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RombelController extends Controller
{
    public function index(){
        if (!Gate::allows('admin')) {
            $kelas = Kelas::with(['siswas', 'guru'])
                    ->where('guru_id', auth()->user()->guru->id)
                    ->get();
        }else{
            $kelas = Kelas::with(['siswas', 'guru'])
                    ->get();
        }
        return view('siswa-group.index', [
            'title'     => 'Siswa Rombel | '. config('app.name'),
            'kelas'     => $kelas,
        ]);
    }

    function naikKelasAll(Request $request){
        if (!empty($request->check_nis)) {

            $kelasId = $request->kelas_id;
            $dataNis = $request->check_nis;

            Siswa::whereIn('nis', $dataNis)
                ->update([
                    'kelas_id' => $kelasId
                ]);

            return redirect(route('rombel'))->with('success', 'Semua siswa berhasil naik kelas');

        }else{
            return redirect(route('rombel'))->with('error', 'Tidak ada data yang dipilih!');
        }
    }

    function Kelulusan(Request $request) {

        $klasifikasi = Klasifikasi::where('nama', 'like', '%Keterangan Lulus%')->first();
        if(!$klasifikasi){
            return back()->with('error', 'Klasifikasi Surat Keterangan Lulus tidak ada! Silahkan buat dulu!');
        }else{
            $siswa = Siswa::where('nis', $request->nis)->with('mapels')->first();
            // dd($siswa);

            $kodeKlasifikasi = $klasifikasi->kode;
            $no_surat = self::nomorSurat($kodeKlasifikasi);
            // dump($no_surat);

            SuratKelulusan::create([
                'no_surat'  => $no_surat,
                'nis'       => $siswa->nis,
                'nisn'      => $siswa->nisn,
                'ttl'       => $siswa->tempat_lahir.', '. Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y'),
                'nama'      => $siswa->nama_siswa,
                'jurusan'   => $siswa->jurusan->nama
            ]);

            SuratKeluar::create([
                'no_surat'  => $no_surat,
                'klasifikasi_id'    => $klasifikasi->id,
                'tanggal_surat'     => date('Y-m-d'),
            ]);

            Siswa::where('nis', $request->nis)
                ->update([
                    'lulus' => true
            ]);

            return redirect(route('rombel'))->with('success', 'Siswa dengan NIS ' . $request->nis . ' berhasil diluluskan');
        }
    }

    function KelulusanAll(Request $request) {
        // dd($request->check_nis);
        if($request->check_nis != ''){
            $data = $request->check_nis;

            $klasifikasi = Klasifikasi::where('nama', 'like', '%Keterangan Lulus%')->first();
            if(!$klasifikasi){
                return back()->with('error', 'Klasifikasi Surat Keterangan Lulus tidak ada! Silahkan buat dulu!');
            }else{
                $kodeKlasifikasi = $klasifikasi->kode;

                $siswas = Siswa::whereIn('nis', $data)->with('mapels')->get();
                foreach($siswas as $siswa){
                    $no_surat = self::nomorSurat($kodeKlasifikasi);

                    SuratKelulusan::create([
                        'no_surat'  => $no_surat,
                        'nis'       => $siswa->nis,
                        'nisn'      => $siswa->nisn,
                        'ttl'       => $siswa->tempat_lahir.', '. Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y'),
                        'nama'      => $siswa->nama_siswa,
                        'jurusan'   => $siswa->jurusan->nama
                    ]);
                    SuratKeluar::create([
                        'no_surat'  => $no_surat,
                        'klasifikasi_id'    => $klasifikasi->id,
                        'tanggal_surat'     => date('Y-m-d'),
                    ]);

                    Siswa::where('nis', $siswa->nis)->update(['lulus' => true]);
                }

                return redirect(route('rombel'))->with('success', 'Siswa berhasil diluluskan');
            }
        }else{
            return redirect(route('rombel'))->with('error', 'Tidak ada data yang dipilih!');
        }

    }

    function nomorSurat($kodeKlasifikasi){
        if ($kodeKlasifikasi != '') {
            // // hitung banyak data surat di db dan ubah jadikan collection
            // $currentSurat = collect(SuratKeluar::all())->count();

            // cari no_surat terbesar dari tabel surat keluar
            // dengan mengambil 2 digit dari kiri
            // $query = DB::table('surat_keluars')
            //         ->select(DB::raw('MAX(LEFT(no_surat, 3)) as lastNoSurat'));

            // ambil data terakhir dari tabel surat keluar
            $query = SuratKeluar::latest()->first();

            if(!blank($query)){
                // simpan nomor_surat yang didapat ke dalam variabel $lasNoSurat
                $lastNoSurat = $query->no_surat;
                // pecah nomor_surat menjadi beberapa bagian berdasarkan separator "/"
                // dan simpan kedalam variabel temp
                $temp = explode('/', $lastNoSurat);
                // ambil array index pertama (0) dari hasil pemecahan nomor_surat
                // dan ubah menjadi tipe data integer
                $noCurrent = (int) $temp[0];
                // nomor surat saat ini kemudian ditambah 1 dan simpan ke variabel $noNext
                $noNext = $noCurrent+1;
                // ubah kembali menjadi tipe data string dan simpan ke variabel $no_surat
                $no_surat = sprintf('%03s', $noNext);
            }else{
                $no_surat = '001';
            }

            // // jika hasil pencarian didapatkan lebih dari 0
            // if ($query->count() > 0 ) {
            //     // lakukan perulangan
            //     foreach ($query->get() as $key) {
            //         // no surat terakhir ubah jadi integer dan tambah dengan 1
            //         $temp = ((int)$key->lastNoSurat)+1;
            //         // ubah kembali jadi string 2 digit dengan menambahkan angka 0 di depan no surat
            //         $no_surat = sprintf('%03s', $temp);
            //     }
            // }else{
            //     $no_surat = '001';
            // }

            // Buat bulan dalam angka romawi
            $currenMonth = date('n');
            $romawi = self::toRomawi($currenMonth);

            // gabungkan, sehingga menjadi no surat
             $no_surat = $no_surat . '/' . $kodeKlasifikasi . '/SMK-AZ/' . $romawi . '/' . date('Y');

            return $no_surat;
        }else{
            return $no_surat = '';
        }
    }

    function toRomawi($currenMonth){
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
}
