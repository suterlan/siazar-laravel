<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use App\Models\SuratPenerimaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-penerimaan.index',[
            'title'     => 'Surat Keluar | SIAZAR',
            'surats'    => SuratPenerimaan::with('suratkeluar')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('surat-keluar.surat-penerimaan.create', [
                'title'         => 'Surat Penerimaan Baru | SIAZAR',
                'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')
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
            'bin'               => 'required',
            'nisn'              => 'required|max:10',
            'kelas'             => 'required',
            'asal_sekolah'      => 'required'
        ]);

        SuratKeluar::create($validated);
        SuratPenerimaan::create($validated);
        return redirect('/dashboard/suratkeluar/penerimaan')->with('success', 'Surat penerimaan baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratPenerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratPenerimaan $penerimaan)
    {
        return view('surat-keluar.surat-penerimaan.detail',[
            'title'     => 'Detail Surat | SIAZAR',
            'surat'     => $penerimaan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratPenerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratPenerimaan $penerimaan)
    {
        return view('surat-keluar.surat-penerimaan.edit', [
            'title'     => 'Edit Surat | SIAZAR',
            'surat'     => $penerimaan,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratPenerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratPenerimaan $penerimaan)
    {
        $rules = [
                'klasifikasi_id'    => 'required',
                'tanggal_surat'     => 'required',
                'nama_siswa'        => 'required',
                'ttl'               => 'required',
                'bin'               => 'required',
                'nisn'              => 'required|max:10',
                'kelas'             => 'required',
                'asal_sekolah'      => 'required'
            ];

        if ($penerimaan->no_surat != $request->no_surat) {
            $rules['no_surat'] = 'required|unique:surat_keluars';
        }

        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat'],
        ];

        $dataPenerimaan = [
            'nama_siswa'        => $validated['nama_siswa'],
            'ttl'               => $validated['ttl'],
            'bin'               => $validated['bin'],
            'nisn'              => $validated['nisn'],
            'kelas'             => $validated['kelas'],
            'asal_sekolah'      => $validated['asal_sekolah']
        ];

        if ($penerimaan->no_surat != $request->no_surat) {
            $dataSuratKeluar['no_surat'] = $validated['no_surat'];
            $dataPenerimaan['no_surat'] = $validated['no_surat'];
        }

        SuratKeluar::where('id', $penerimaan->suratkeluar->id)
                    ->update($dataSuratKeluar);

        SuratPenerimaan::where('id',$penerimaan->id)
                        ->update($dataPenerimaan);
        return redirect('/dashboard/suratkeluar/penerimaan')->with('success', 'Surat penerimaan dengan nomor surat : ' . $penerimaan->no_surat . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratPenerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratPenerimaan $penerimaan)
    {
        SuratPenerimaan::where('no_surat', $penerimaan->no_surat)->delete();
        SuratKeluar::where('no_surat', $penerimaan->no_surat)->delete();

        return redirect('/dashboard/suratkeluar/penerimaan')->with('success', 'Surat keluar dengan no surat : ' . $penerimaan->no_surat . ' berhasil dihapus');

    }

    public function cetak(SuratPenerimaan $penerimaan){
        $pdf = FacadePdf::loadView('surat-keluar.surat-penerimaan.cetak', [
            'title'     => 'Cetak Surat | SIAZAR',
            'surat'     => $penerimaan
        ]);
        return $pdf->stream('surat-penerimaan-siswa');
        // exit(0);
    }

    public function download(SuratPenerimaan $penerimaan){
        $pdf = FacadePdf::loadView('surat-keluar.surat-penerimaan.cetak', [
            'title'     => 'Cetak Surat | SIAZAR',
            'surat'     => $penerimaan
        ]);
        return $pdf->download('surat-penerimaan-siswa.pdf');
    }
}
