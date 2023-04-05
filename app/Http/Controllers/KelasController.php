<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kelas.index', [
            'title'     => 'Kelas | '. config('app.name'),
            'kelas'     => Kelas::all(),
            'gurus'     => Guru::select('id', 'nama')->get(),
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
            'nama'  => 'required',
            'guru_id'   => 'required',
        ]);
        Kelas::create($validated);
        return redirect('/dashboard/kelas')->with('success', 'Kelas baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        return response()->json($kela);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $rules = [
            '_nama'     => 'required',
            '_guru_id'   => 'required',
        ];
        $validated = $request->validate($rules);

        $data = [
            'nama'      => $validated['_nama'],
            'guru_id'   => $validated['_guru_id'],
        ];

        Kelas::where('id', $request->id)
            ->update($data);
        return redirect('/dashboard/kelas')->with('success', 'Kelas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        Kelas::destroy($kela->id);
        return redirect('/dashboard/kelas')->with('success', 'Kelas berhasil dihapus!');
    }

}
