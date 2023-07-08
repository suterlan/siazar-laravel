<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use App\Models\SuratUndangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class SuratUndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-undangan.index', [
            'title'     => 'Surat Undangan | '. config('app.name'),
            'surats'    => SuratUndangan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-keluar.surat-undangan.create', [
            'title'         => 'Surat Undangan Baru | '. config('app.name'),
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
            'kegiatan'          => 'required',
            'tanggal_acara'     => 'required',
            'waktu'             => 'required',
            'tempat'            => 'required',
            'ketua_panitia'     => 'nullable',
            'penerima'          => 'required',
        ]);

        SuratKeluar::create($validated);
        SuratUndangan::create($validated);
        return redirect('/dashboard/suratkeluar/undangan/create')->with('success', 'Surat undangan baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratUndangan  $undangan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratUndangan $undangan)
    {
         return view('surat-keluar.surat-undangan.detail', [
            'title'     => 'Detail Surat Undangan | '. config('app.name'),
            'surat'     => $undangan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratUndangan  $undangan
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratUndangan $undangan)
    {
         return view('surat-keluar.surat-undangan.edit', [
            'title'     => 'Edit Surat Undangan | '. config('app.name'),
            'surat'     => $undangan,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratUndangan  $undangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratUndangan $undangan)
    {
        $rules = [
                'klasifikasi_id'    => 'required',
                'tanggal_surat'     => 'required',
                'kegiatan'          => 'required',
                'tanggal_acara'     => 'required',
                'waktu'             => 'required',
                'tempat'            => 'required',
                'ketua_panitia'     => 'nullable',
                'penerima'          => 'required',
            ];

        if ($undangan->no_surat != $request->no_surat) {
            $rules['no_surat'] = 'required|unique:surat_keluars';
        }

        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat'],
        ];

        $dataUndangan = [
            'kegiatan'      => $validated['kegiatan'],
            'tanggal_acara' => $validated['tanggal_acara'],
            'waktu'         => $validated['waktu'],
            'tempat'        => $validated['tempat'],
            'ketua_panitia' => $validated['ketua_panitia'],
            'penerima'      => $validated['penerima']
        ];

        if ($undangan->no_surat != $request->no_surat) {
            $dataSuratKeluar['no_surat'] = $validated['no_surat'];
            $dataUndangan['no_surat'] = $validated['no_surat'];
        }

        SuratKeluar::where('id', $undangan->suratkeluar->id)
                    ->update($dataSuratKeluar);

        SuratUndangan::where('id',$undangan->id)
                        ->update($dataUndangan);
        return redirect('/dashboard/suratkeluar/undangan')->with('success', 'Surat undangan dengan nomor surat : ' . $undangan->no_surat . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratUndangan  $undangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratUndangan $undangan)
    {
        SuratUndangan::where('no_surat', $undangan->no_surat)->delete();
        SuratKeluar::where('no_surat', $undangan->no_surat)->delete();

        return redirect('/dashboard/suratkeluar/undangan')->with('success', 'Surat keluar dengan no surat : ' . $undangan->no_surat . ' berhasil dihapus');
    }

    public function cetak(SuratUndangan $undangan){
        $pdf = FacadePdf::loadView('surat-keluar.surat-undangan.cetak', [
            'title'     => 'Cetak Surat | '. config('app.name'),
            'surat'     => $undangan
        ]);
        return $pdf->stream('surat-undangan');
        // exit(0);
    }

    public function download(SuratUndangan $undangan){
        $pdf = FacadePdf::loadView('surat-keluar.surat-undangan.cetak', [
            'title'     => 'Cetak Surat | '. config('app.name'),
            'surat'     => $undangan
        ]);
        return $pdf->download('surat-undangan.pdf');
        // exit(0);
    }
}
