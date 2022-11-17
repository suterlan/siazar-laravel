<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratMutasi;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMutasi  $suratMutasi
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMutasi $suratMutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMutasi  $suratMutasi
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMutasi $suratMutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMutasi  $suratMutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMutasi $suratMutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMutasi  $suratMutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMutasi $suratMutasi)
    {
        //
    }
}
