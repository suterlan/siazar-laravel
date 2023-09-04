<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use App\Models\SuratUmum;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class SuratUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-umum.index', [
            'title'     => 'Surat Umum | '. config('app.name'),
            'surats'    => SuratUmum::with('suratkeluar')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-keluar.surat-umum.create', [
            'title'     => 'Surat Umum Baru | '. config('app.name'),
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
            'isi_surat'         => 'required',
        ]);

        SuratKeluar::create($validated);
        SuratUmum::create($validated);

        return redirect('/dashboard/suratkeluar/umum')->with('success', 'Surat umum baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratUmum  $umum
     * @return \Illuminate\Http\Response
     */
    public function show(SuratUmum $umum)
    {
        return view('surat-keluar.surat-umum.detail', [
            'title'     => 'Detail Surat Umum  | '. config('app.name'),
            'surat'     => $umum,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratUmum  $umum
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratUmum $umum)
    {
         return view('surat-keluar.surat-umum.edit', [
            'title'     => 'Edit Surat Umum  | '. config('app.name'),
            'surat'     => $umum,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratUmum  $umum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratUmum $umum)
    {
        $rules = [
                'klasifikasi_id'    => 'required',
                'tanggal_surat'     => 'required',
                'isi_surat'         => 'required',
            ];

        if ($umum->no_surat != $request->no_surat) {
            $rules['no_surat'] = 'required|unique:surat_keluars';
        }

        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat'],
        ];

        $dataSuratUmum = [
            'isi_surat'        => $validated['isi_surat'],
        ];

        if ($umum->no_surat != $request->no_surat) {
            $dataSuratKeluar['no_surat'] = $validated['no_surat'];
            $dataSuratUmum['no_surat'] = $validated['no_surat'];
        }

        SuratKeluar::where('id', $umum->suratkeluar->id)
                    ->update($dataSuratKeluar);

        SuratUmum::where('id',$umum->id)
                        ->update($dataSuratUmum);
        return redirect('/dashboard/suratkeluar/umum')->with('success', 'Surat umum dengan nomor surat : ' . $umum->no_surat . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratUmum  $umum
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratUmum $umum)
    {
        SuratUmum::where('no_surat', $umum->no_surat)->delete();
        SuratKeluar::where('no_surat', $umum->no_surat)->delete();

        return redirect('/dashboard/suratkeluar/umum')->with('success', 'Surat keluar dengan no surat : ' . $umum->no_surat . ' berhasil dihapus');
    }

        public function cetak(SuratUmum $umum){
        $pdf = FacadePdf::loadView('surat-keluar.surat-umum.cetak', [
            'title'     => 'Cetak Surat | SIAZAR',
            'surat'     => $umum
        ]);
        return $pdf->stream('surat-penerimaan-siswa');
        // exit(0);
    }

    public function download(SuratUmum $umum){
        $pdf = FacadePdf::loadView('surat-keluar.surat-umum.download', [
            'title'     => 'Cetak Surat | SIAZAR',
            'surat'     => $umum
        ]);
        return $pdf->download('surat-umum.pdf');
    }
}
