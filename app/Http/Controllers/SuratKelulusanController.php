<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\SuratKelulusan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class SuratKelulusanController extends Controller
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
        return view('surat-keluar.surat-kelulusan.index', [
            'title'     => 'Surat Kelulusan | '. config('app.name'),
            'surats'    => SuratKelulusan::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKelulusan  $kelulusan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKelulusan $kelulusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKelulusan  $kelulusan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKelulusan $kelulusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKelulusan  $kelulusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKelulusan $kelulusan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKelulusan  $kelulusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKelulusan $kelulusan)
    {
        SuratKelulusan::where('no_surat', $kelulusan->no_surat)->delete();
        SuratKeluar::where('no_surat', $kelulusan->no_surat)->delete();
        return redirect('/dashboard/suratkeluar/kelulusan')->with('success', 'Surat Kelulusan dengan no surat : ' . $kelulusan->no_surat . ' berhasil dihapus');
    }

    public function cetak(SuratKelulusan $kelulusan){
        $siswa = Siswa::where('nis', $kelulusan->nis)->with('mapels:id,kode,nama')->first();
        $nilaiRataRata = $siswa->mapels()->avg('nilai');

        $pdf = FacadePdf::loadView('surat-keluar.surat-kelulusan.cetak',[
            'title'     => 'Cetak surat mutasi '. config('app.name'),
            'surat'     => $kelulusan,
            'sekolah'   => $this->sekolah,
            'siswa'     => $siswa,
            'rataRata'  => $nilaiRataRata,
        ]);
         // remove whitespace
        $nama = str_replace(' ', '', $kelulusan->nama);
        return $pdf->stream('surat-kelulusan-siswa-'.$nama);
    }

    public function download(SuratKelulusan $kelulusan){
        $siswa = Siswa::where('nis', $kelulusan->nis)->with('mapels:id,kode,nama')->first();
        $nilaiRataRata = $siswa->mapels()->avg('nilai');

        $pdf = FacadePdf::loadView('surat-keluar.surat-kelulusan.cetak',[
            'title'     => 'Cetak surat kelulusan '. config('app.name'),
            'surat'     => $kelulusan,
            'sekolah'   => $this->sekolah,
            'siswa'     => $siswa,
            'rataRata'  => $nilaiRataRata,
        ]);

        // remove whitespace
        $nama = str_replace(' ', '', $kelulusan->nama);

        return $pdf->download('surat-kelulusan-siswa-'.$nama.'.pdf');
    }
}
