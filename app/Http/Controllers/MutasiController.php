<?php

namespace App\Http\Controllers;

use App\Models\ESign;
use App\Models\Kelas;
use App\Models\Klasifikasi;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\SuratMutasi;
use App\Services\QRCode\QRCodeService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Hash;

class MutasiController extends Controller
{
    protected $sekolah;
    public function __construct()
    {
        $this->sekolah = Sekolah::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-mutasi.index', [
            'title'     => 'Surat Mutasi ' . config('app.name'),
            'surats'    => SuratMutasi::with('suratkeluar')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-keluar.surat-mutasi.create', [
            'title'     => 'Surat Mutasi Baru ' . config('app.name'),
            'klasifikasi'    => Klasifikasi::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::select('id', 'jurusan_id', 'nama')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'klasifikasi_id'    => 'required',
            'no_surat'          => 'required|unique:surat_keluars',
            'tanggal_surat'     => 'required',
            'nama_siswa'        => 'required',
            'ttl'               => 'required',
            'nisn'              => 'required|max:10',
            'jk'                => 'required',
            'kelas'             => 'required|max:100',
            'tahun_pelajaran'   => 'required',
            'alamat'            => 'required',
            'alasan_pindah'     => 'required',
            'nama_ayah'         => 'required',
            'ttl_ayah'          => 'required',
            'pekerjaan'         => 'required|max:128',
            'nama_ibu'          => 'required',
            'ttl_ibu'           => 'required'

        ]);
        SuratKeluar::create($validated);
        SuratMutasi::create($validated);

        // jika ada request
        if (!blank(request('qr_active'))) {
            $kode = Hash::make($validated['no_surat']);
            // input data ke tabel e_sign
            ESign::create([
                'code'  => $kode,
                'active'    => true,
                'no_surat'  => $validated['no_surat']
            ]);
        }

        // copy data in siswa table to siswa_mutasis table
        // and delete data siswa in siswa table
        // where nisn is equal
        $siswa = Siswa::where('nisn', $validated['nisn'])->first();
        $siswaMutasi = $siswa->replicate();
        $siswaMutasi->setTable('siswa_mutasis');
        $siswaMutasi->save();

        $siswa->delete();

        return redirect('/dashboard/suratkeluar/mutasi')->with('success', 'Surat mutasi baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMutasi $mutasi)
    {
        return view('surat-keluar.surat-mutasi.detail', [
            'title'     => 'Detail Surat Mutasi ' . config('app.name'),
            'surat'     => $mutasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMutasi $mutasi)
    {
        return view('surat-keluar.surat-mutasi.edit', [
            'title'         => 'Edit Surat Mutasi ' . config('app.name'),
            'surat'         => $mutasi,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMutasi $mutasi)
    {
        $rules = [
            'klasifikasi_id'    => 'required',
            'tanggal_surat'     => 'required',
            'nama_siswa'        => 'required',
            'ttl'               => 'required',
            'nisn'              => 'required|max:10',
            'jk'                => 'required',
            'kelas'             => 'required|max:100',
            'tahun_pelajaran'   => 'required',
            'alamat'            => 'required',
            'alasan_pindah'     => 'required',
            'nama_ayah'         => 'required',
            'ttl_ayah'          => 'required',
            'pekerjaan'         => 'required|max:128',
            'nama_ibu'          => 'required',
            'ttl_ibu'           => 'required'
        ];

        if ($request->no_surat != $mutasi->no_surat) {
            $rules['no_surat']  = 'required|unique:surat_keluars';
        }

        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat']
        ];

        $dataMutasi = [
            'nama_siswa'        => $validated['nama_siswa'],
            'ttl'               => $validated['ttl'],
            'nisn'              => $validated['nisn'],
            'jk'                => $validated['jk'],
            'kelas'             => $validated['kelas'],
            'tahun_pelajaran'   => $validated['tahun_pelajaran'],
            'alamat'            => $validated['alamat'],
            'alasan_pindah'     => $validated['alasan_pindah'],
            'nama_ayah'         => $validated['nama_ayah'],
            'ttl_ayah'          => $validated['ttl_ayah'],
            'pekerjaan'         => $validated['pekerjaan'],
            'nama_ibu'          => $validated['nama_ibu'],
            'ttl_ibu'           => $validated['ttl_ibu']
        ];

        if ($request->no_surat != $mutasi->no_surat) {
            $dataSuratKeluar['no_surat']    = $validated['no_surat'];
            $dataMutasi['no_surat']    = $validated['no_surat'];
        }

        SuratKeluar::where('id', $mutasi->suratkeluar->id)
            ->update($dataSuratKeluar);

        SuratMutasi::where('id', $mutasi->id)
            ->update($dataMutasi);

        return redirect('/dashboard/suratkeluar/mutasi')->with('success', 'Surat mutasi dengan nomor surat : ' . $mutasi->no_surat . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMutasi $mutasi)
    {
        SuratMutasi::where('no_surat', $mutasi->no_surat)->delete();
        SuratKeluar::where('no_surat', $mutasi->no_surat)->delete();

        return redirect('/dashboard/suratkeluar/mutasi')->with('success', 'Surat Mutasi dengan no surat : ' . $mutasi->no_surat . ' berhasil dihapus!');
    }

    public function cetak(SuratMutasi $mutasi)
    {
        //get code dari esign
        $esign = ESign::whereRelation('suratkeluar', 'no_surat', '=', $mutasi->no_surat)
            ->where('active', true)
            ->first();

        $qr = '';
        // cek jika ada e-sign
        if ($esign) {
            // buat qr kode dengan memanggil service qrcode service
            $route = route('arsip-surat');
            $link = $route . '/' . $esign->code;

            $qrService = new QRCodeService($link);
            $qr = $qrService->generate();
        }

        $pdf = FacadePdf::loadView('surat-keluar.surat-mutasi.cetak', [
            'title'     => 'Cetak surat mutasi ' . config('app.name'),
            'surat'     => $mutasi,
            'sekolah'   => $this->sekolah,
            'qrcode'    => $qr,
        ]);
        return $pdf->stream('surat-mutasi-siswa');
    }

    public function download(SuratMutasi $mutasi)
    {
        //get code dari esign
        $esign = ESign::whereRelation('suratkeluar', 'no_surat', '=', $mutasi->no_surat)
            ->where('active', true)
            ->first();

        $qr = '';
        // cek jika ada e-sign
        if ($esign) {
            // buat qr kode dengan memanggil service qrcode service
            $route = route('arsip-surat');
            $link = $route . '/' . $esign->code;

            $qrService = new QRCodeService($link);
            $qr = $qrService->generate();
        }

        $pdf = FacadePdf::loadView('surat-keluar.surat-mutasi.cetak', [
            'title'     => 'Cetak surat mutasi ' . config('app.name'),
            'surat'     => $mutasi,
            'sekolah'   => $this->sekolah,
            'qrcode'    => $qr,
        ]);

        // remove whitespace
        $nama = str_replace(' ', '_', $mutasi->nama_siswa);

        return $pdf->download('surat-mutasi-siswa-' . $nama . '.pdf');
    }

    public function getSiswa(Request $request)
    {
        $siswa = Siswa::select('id', 'nama_siswa', 'kelas_id')
            ->where('kelas_id', $request->kelas_id)
            ->get();
        return response()->json($siswa);
    }

    public function getDetailSiswa(Request $request)
    {
        $siswa = Siswa::select('id', 'nama_siswa', 'kelas_id', 'tempat_lahir', 'tgl_lahir', 'nisn', 'jk', 'alamat', 'nama_ayah', 'tgl_lahir_ayah', 'pekerjaan_ayah', 'nama_ibu', 'tgl_lahir_ibu')
            ->find($request->id);

        return response()->json($siswa);
    }
}
