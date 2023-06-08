<?php

namespace App\Http\Controllers;

use App\Models\SuratUmum;
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
     * @param  \App\Models\SuratUmum  $suratUmum
     * @return \Illuminate\Http\Response
     */
    public function show(SuratUmum $suratUmum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratUmum  $suratUmum
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratUmum $suratUmum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratUmum  $suratUmum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratUmum $suratUmum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratUmum  $suratUmum
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratUmum $suratUmum)
    {
        //
    }
}
