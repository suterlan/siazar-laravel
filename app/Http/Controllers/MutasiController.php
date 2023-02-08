<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use App\Models\SuratMutasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-mutasi.index',[
            'title'     => 'Surat Mutasi | SIAZAR',
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
        return view('surat-keluar.surat-mutasi.create',[
            'title'     => 'Surat Mutasi Baru | SIAZAR',
            'klasifikasi'    => Klasifikasi::all()
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
            'kelas'             => 'required|max:64',
            'tahun_pelajaran'   => 'required',
            'alamat'            => 'required',
            'alasan_pindah'     => 'required',
            'nama_ayah'         => 'required',
            'ttl_ayah'          => 'required',
            'pekerjaan'         => 'required',
            'nama_ibu'          => 'required',
            'ttl_ibu'           => 'required'

        ]);
        SuratKeluar::create($validated);
        SuratMutasi::create($validated);

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
            'title'     => 'Detail Surat Mutasi | SIAZAR',
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
            'title'         => 'Edit Surat Mutasi | SIAZAR',
            'surat'         => $mutasi,
            'klasifikasi'   => Klasifikasi::all()
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
            'kelas'             => 'required|max:64',
            'tahun_pelajaran'   => 'required',
            'alamat'            => 'required',
            'alasan_pindah'     => 'required',
            'nama_ayah'         => 'required',
            'ttl_ayah'          => 'required',
            'pekerjaan'         => 'required',
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

        return redirect('/dashboard/suratkeluar/mutasi')->with('success', 'Surat mutasi dengan nomor surat : ' .$mutasi->no_surat. ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMutasi $mutasi)
    {
        SuratMutasi::where('id', $mutasi->id)->delete();
        SuratKeluar::where('id', $mutasi->id)->delete();

        return redirect('/dashboard/suratkeluar/mutasi')->with('success', 'Surat Mutasi dengan no surat : ' . $mutasi->no_surat . ' berhasil dihapus!');
    }

    public function cetak(SuratMutasi $mutasi){
        $pdf = FacadePdf::loadView('surat-keluar.surat-mutasi.cetak',[
            'title'     => 'Cetak surat mutasi | SIAZAR',
            'surat'     => $mutasi
        ]);
        return $pdf->stream('surat-mutasi-siswa');
    }

    public function download(SuratMutasi $mutasi){
        $pdf = FacadePdf::loadView('surat-keluar.surat-mutasi.cetak',[
            'title'     => 'Cetak surat mutasi | SIAZAR',
            'surat'     => $mutasi
        ]);
        return $pdf->download('surat-mutasi-siswa.pdf');
    }
}
