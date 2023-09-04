<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('struktur-organisasi.index', [
            'title'     => 'Struktur Organisasi | '. config('app.name'),
            'strukturs' => StrukturOrganisasi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('struktur-organisasi.create', [
            'title'     => 'Tambah Struktur Organisasi | '. config('app.name'),
            'gurus'      => Guru::select('id', 'nama')->get()
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
            'guru_id'   => 'required',
            'jabatan'   => 'required|max:100',
            'keterangan'    => 'required|max:100'
        ]);

        StrukturOrganisasi::create($validated);

        return redirect('/dashboard/struktur-organisasi')->with('success', 'Anggota baru berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(StrukturOrganisasi $strukturOrganisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(StrukturOrganisasi $strukturOrganisasi)
    {
        return view('struktur-organisasi.edit', [
            'title'     => 'Edit Struktur Organisasi | '. config('app.name'),
            'gurus'     => Guru::select('id', 'nama')->get(),
            'struktur'      => $strukturOrganisasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $validated = $request->validate([
            'guru_id'   => 'required',
            'jabatan'   => 'required|max:100',
            'keterangan'    => 'required|max:100'
        ]);

        StrukturOrganisasi::where('id', $strukturOrganisasi->id)
            ->update($validated);

        return redirect('/dashboard/struktur-organisasi')->with('success', 'Anggota ' . $strukturOrganisasi->guru->nama . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        StrukturOrganisasi::destroy($strukturOrganisasi->id);

        return redirect('/dashboard/struktur-organisasi')->with('success', 'Anggota ' . $strukturOrganisasi->guru->nama . ' berhasil dihapus!');
    }
}
