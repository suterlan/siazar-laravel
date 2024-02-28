<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratCustom;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratCustomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-custom.index', [
            'title'     => 'Surat Kelulusan | '. config('app.name'),
            'surats'    => SuratCustom::latest()->get(),
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get(),
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
        $validated = $request->validate([
            'klasifikasi_id'    => 'required',
            'no_surat'          => 'required|unique:surat_keluars',
            'tanggal_surat'     => 'required',
            'keterangan'        => 'required',
        ]);

        SuratKeluar::create($validated);
        SuratCustom::create($validated);

        return redirect('/dashboard/suratkeluar')->with('success', 'Surat berhasil disimpan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratCustom $custom)
    {
        SuratCustom::where('no_surat', $custom->no_surat)->delete();
        SuratKeluar::where('no_surat', $custom->no_surat)->delete();
        return redirect('/dashboard/suratkeluar/custom')->with('success', 'Surat Custom dengan no surat : ' . $custom->no_surat . ' berhasil dihapus');

    }
}
