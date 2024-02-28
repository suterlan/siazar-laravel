<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\Sekolah;
use App\Models\SuratKeluar;
use App\Models\SuratPanggilan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class PanggilanController extends Controller
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
        return view('surat-keluar.surat-panggilan.index',[
            'title'     => 'Surat Panggilan '. config('app.name'),
            'surats'    => SuratPanggilan::with('suratkeluar')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-keluar.surat-panggilan.create',[
            'title'         => 'Surat Panggilan Baru '. config('app.name'),
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
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
            'kelas'             => 'required|max:64',
            'wali_kelas'        => 'required',
            'hari_tgl'          => 'required|max:64',
            'waktu'             => 'required|max:16',
            'masalah'           => 'required',
        ]);

        SuratKeluar::create($validated);
        SuratPanggilan::create($validated);

        return redirect('/dashboard/suratkeluar/panggilan')->with('success', 'Surat panggilan baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratPanggilan  $panggilan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratPanggilan $panggilan)
    {
        return view('surat-keluar.surat-panggilan.detail', [
            'title'     => 'Detail Surat Pemanggilan '. config('app.name'),
            'surat'     => $panggilan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratPanggilan  $panggilan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratPanggilan $panggilan)
    {
        return view('surat-keluar.surat-panggilan.edit',[
            'title'     => 'Edit Surat Panggilan '. config('app.name'),
            'surat'     => $panggilan,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratPanggilan  $panggilan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratPanggilan $panggilan)
    {
        $rules = [
            'klasifikasi_id'    => 'required',
            'tanggal_surat'     => 'required',
            'nama_siswa'        => 'required',
            'kelas'             => 'required|max:64',
            'wali_kelas'        => 'required',
            'hari_tgl'          => 'required|max:64',
            'waktu'             => 'required|max:16',
            'masalah'           => 'required',
        ];

        if ($panggilan->no_surat != $request->no_surat) {
            $rules['no_surat']  = 'required|unique:surat_keluars';
        }

        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat'],
        ];

        $dataPanggilan = [
            'nama_siswa'        => $validated['nama_siswa'],
            'kelas'             => $validated['kelas'],
            'wali_kelas'        => $validated['wali_kelas'],
            'hari_tgl'          => $validated['hari_tgl'],
            'waktu'             => $validated['waktu'],
            'masalah'           => $validated['masalah']
        ];
        if ($panggilan->no_surat != $request->no_surat) {
            $dataSuratKeluar['no_surat'] = $validated['no_surat'];
            $dataPanggilan['no_surat'] = $validated['no_surat'];
        }

        SuratKeluar::where('id', $panggilan->suratkeluar->id)
                    ->update($dataSuratKeluar);

        SuratPanggilan::where('id',$panggilan->id)
                        ->update($dataPanggilan);

        return redirect('/dashboard/suratkeluar/panggilan')->with('success', 'Surat Panggilan dengan nomor surat : ' . $panggilan->no_surat . ' berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratPanggilan  $panggilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratPanggilan $panggilan)
    {
        SuratPanggilan::where('no_surat', $panggilan->no_surat)->delete();
        SuratKeluar::where('no_surat', $panggilan->no_surat)->delete();

        return redirect('/dashboard/suratkeluar/panggilan')->with('success', 'Surat Panggilan dengan no surat : ' . $panggilan->no_surat . ' berhasil dihapus');
    }

    public function cetak(SuratPanggilan $panggilan){
        $pdf = FacadePdf::loadView('surat-keluar.surat-panggilan.cetak', [
            'title'     => 'Cetak Surat '. config('app.name'),
            'surat'     => $panggilan,
            'sekolah'   => $this->sekolah,
        ]);
        return $pdf->stream('surat-pemanggilan-siswa');
        // exit(0);
    }

    public function download(SuratPanggilan $panggilan){
        $pdf = FacadePdf::loadView('surat-keluar.surat-panggilan.cetak', [
            'title'     => 'Cetak Surat '. config('app.name'),
            'surat'     => $panggilan,
            'sekolah'   => $this->sekolah,
        ]);

         // remove whitespace
        $nama = str_replace(' ', '', $panggilan->nama_siswa);
        return $pdf->download('surat-pemanggilan-siswa-'.$nama.'.pdf');
        // exit(0);
    }
}
