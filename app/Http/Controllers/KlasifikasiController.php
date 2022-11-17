<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('klasifikasi.klasifikasi',[
            'title' => 'Klasifikasi Surat | ',
            'klasifikasis'   => Klasifikasi::all()
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
            'kode'  => 'required|max:10',
            'nama'  => 'required',
            'deskripsi' => 'max:255'
        ]);

        Klasifikasi::create($validated);
        return redirect('/dashboard/klasifikasi')->with('success', 'Klasifikasi surat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Klasifikasi $klasifikasi)
    {
        return view('klasifikasi.edit',[
            'title' => 'Edit Klasifikasi Surat | ',
            'klasifikasi'   => $klasifikasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        $validated = $request->validate([
            'kode'  => 'required|max:10',
            'nama'  => 'required',
            'deskripsi' => 'max:255'
        ]);

        Klasifikasi::where('id', $klasifikasi->id)
                    ->update($validated);

        return redirect('/dashboard/klasifikasi')->with('success', 'Klasifikasi surat dengan kode ' . $klasifikasi->kode . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klasifikasi $klasifikasi)
    {
        Klasifikasi::destroy($klasifikasi->id);
        return redirect('/dashboard/klasifikasi')->with('success', 'Klasifikasi dengan kode ' . $klasifikasi->kode . ' berhasil dihapus');
    }
}
