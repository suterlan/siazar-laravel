<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Klasifikasi;
use App\Models\Mengajar;
use App\Models\SKBM;
use App\Models\StrukturOrganisasi;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;

class SuratKBMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-kbm.index', [
            'title'     => 'Surat KBM | ' . config('app.name'),
            'skbms'     => SKBM::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahuns = Mengajar::select('tahun_ajaran')->orderBy('tahun_ajaran')->get()->groupBy('tahun_ajaran');

        return view('surat-keluar.surat-kbm.create', [
            'title'         => 'Surat KBM Baru | ' . config('app.name'),
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get(),
            'tahuns'         => $tahuns,
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
            'tahun_ajaran'      => 'required',
            'semester'          => 'required',
        ]);

        SuratKeluar::create($validated);
        SKBM::create($validated);
        return redirect('/dashboard/suratkeluar/skbm')->with('success', 'Surat KBM baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function show(SKBM $skbm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function edit(SKBM $skbm)
    {
        return view('surat-keluar.surat-kbm.edit', [
            'title'         => 'Edit Surat KBM | ' . config('app.name'),
            'surat'         => $skbm,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SKBM $skbm)
    {
        $rules = [
            'klasifikasi_id'    => 'required',
            'tanggal_surat'     => 'required',
            'tahun_ajaran'      => 'required',
            'semester'          => 'required',
        ];

        if ($skbm->no_surat != $request->no_surat) {
            $rules['no_surat'] = 'required|unique:surat_keluars';
        }
        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat'],
        ];

        $dataSkbm = [
            'tahun_ajaran'      => $validated['tahun_ajaran'],
            'semester'          => $validated['semester'],
        ];

        if ($skbm->no_surat != $request->no_surat) {
            $dataSuratKeluar['no_surat'] = $validated['no_surat'];
            $dataSkbm['no_surat'] = $validated['no_surat'];
        }

        SuratKeluar::where('id', $skbm->suratkeluar->id)
            ->update($dataSuratKeluar);
        SKBM::where('id', $skbm->id)
            ->update($dataSkbm);

        return redirect('/dashboard/suratkeluar/skbm')->with('success', 'Surat KBM dengan nomor surat : ' . $skbm->no_surat . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKBM $skbm)
    {
        SKBM::where('no_surat', $skbm->no_surat)->delete();
        SuratKeluar::where('no_surat', $skbm->no_surat)->delete();

        return redirect('/dashboard/suratkeluar/skbm')->with('success', 'Surat KBM dengan no surat : ' . $skbm->no_surat . ' berhasil dihapus');
    }

    public function cetak(SKBM $skbm)
    {

        $kelas = Kelas::orderBy('id')->get()->groupBy(function ($data) {
            return $data->nama;
        });


        $mengajars = Mengajar::with(['guru', 'mapel', 'kelas'])
            ->orderBy('kelas_id', 'ASC')
            ->where('tahun_ajaran', $skbm->tahun_ajaran)->get();
        $groupMengajar = $mengajars->groupBy(['guru.nama', 'mapel.nama', 'kelas.nama']);
        // dd($groupMengajar);

        $strukturs = StrukturOrganisasi::orderBy('id')->get()->groupBy(function ($data) {
            return $data->keterangan;
        });
        $pdf = FacadePdf::loadView('surat-keluar.surat-kbm.cetak', [
            'title'         => 'Cetak Surat | ' . config('app.name'),
            'surat'         => $skbm,
            'mengajars'     => $groupMengajar,
            'strukturs'     => $strukturs,
        ]);
        return $pdf->stream('surat-skbm');
        // exit(0);
    }

    public function download(SKBM $skbm)
    {
        $strukturs = StrukturOrganisasi::orderBy('id')->get()->groupBy(function ($data) {
            return $data->keterangan;
        });

        $pdf = FacadePdf::loadView('surat-keluar.surat-kbm.cetak', [
            'title'     => 'Cetak Surat | ' . config('app.name'),
            'surat'     => $skbm,
            'strukturs' => $strukturs
        ]);
        return $pdf->download('surat-kbm.pdf');
        // exit(0);
    }
}
