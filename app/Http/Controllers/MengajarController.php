<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Http\Request;

class MengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $years = Mengajar::select('tahun_ajaran')->orderBy('tahun_ajaran')->get()->groupBy('tahun_ajaran');

        $mengajars = [];

        if(request('filter_tahun')){
            $mengajars = Mengajar::where('tahun_ajaran', request('filter_tahun'))->orderBy('kode_mapel')->get();
        }

        return view('mengajar.index', [
            'title'     => 'Mengajar '. config('app.name'),
            'gurus'     => Guru::select('id', 'nama')->get(),
            'mengajars' => $mengajars,
            'years'     => $years,
            'kelas'     => Kelas::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('mengajar.create', [
            'title'     => 'Tambah Mengajar '. config('app.name'),
            'gurus'     => Guru::select('id', 'nama')->get(),
            'mapels'    => Mapel::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::all()
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
            'kode_mapel'    => 'required',
            'kelas_id'      => 'required',
            'guru_id'       => 'required',
            'jam'           => 'required|min:0',
            'tahun_ajaran'  => 'required',
        ]);

        Mengajar::create($validated);

        return redirect('/dashboard/mengajar')->with('success', 'Jam Mengajar Berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function show(Mengajar $mengajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function edit(Mengajar $mengajar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mengajar $mengajar)
    {
        $validated = $request->validate([
            'kelas_id'      => 'required',
            'guru_id'       => 'required',
            'jam'           => 'required|min:0',
            'tahun_ajaran'  => 'required',
        ]);

        Mengajar::where('id', $mengajar->id)
            ->update($validated);
        return redirect('/dashboard/mengajar')->with('success', 'Jam Mengajar Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mengajar $mengajar)
    {
        //
    }

    public function delete(Mengajar $mengajar)
    {
        Mengajar::destroy($mengajar->id);
        return redirect('/dashboard/mengajar')->with('success', 'Jam Mengajar Berhasil dihapus!');
    }

}
