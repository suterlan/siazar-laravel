<?php

namespace App\Http\Controllers;

use App\Models\DokumenAjar;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mapel.index', [
            'title'     => 'Mapel '. config('app.name'),
            'mapels'    => Mapel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create', [
            'title'     => 'Mapel Baru '. config('app.name'),
            'gurus'     => Guru::select('id', 'nama')->get()
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
            'kode'  => 'required|unique:mapels',
            'nama'  => 'required',
            'jenis' => 'required',
            'guru_id'   => 'required',
        ]);

        $ruleDokumenAjar = [
            'cp'    => 'file|mimes:pdf|max:2048|nullable',
            'atp'   => 'file|mimes:pdf|max:2048|nullable',
            'ma'    => 'file|mimes:pdf|max:2048|nullable',
        ];
        $validatedDokumenAjar = $request->validate($ruleDokumenAjar);

        if ($request->file('cp')) {
            $validatedDokumenAjar['cp'] = $request->file('cp')->store('dokumen_ajar/' . $validated['nama']);
        }
        if ($request->file('atp')) {
            $validatedDokumenAjar['atp'] = $request->file('atp')->store('dokumen_ajar/' . $validated['nama']);
        }
        if ($request->file('ma')) {
            $validatedDokumenAjar['ma'] = $request->file('ma')->store('dokumen_ajar/' . $validated['nama']);
        }

        Mapel::create($validated);

        DokumenAjar::updateOrCreate(
            ['kode' => $validated['kode']],
            $validatedDokumenAjar
        );

        return redirect('/dashboard/mapel')->with('success', 'Mapel berhasil ditambah!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        return view('mapel.detail', [
            'title'     => 'Detail Mapel '. config('app.name'),
            'gurus'     => Guru::select('id', 'nama')->get(),
            'mapel'     => $mapel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $validate = [
            'nama'  => 'required',
            'jenis' => 'required',
            'guru_id'   => 'required',
        ];

        if($request->kode != $mapel->kode){
            $validate['kode'] = 'required|unique:mapels';
        }
        $validated = $request->validate($validate);

        $ruleDokumenAjar = [
            'cp'    => 'file|mimes:pdf|max:2048|nullable',
            'atp'   => 'file|mimes:pdf|max:2048|nullable',
            'ma'    => 'file|mimes:pdf|max:2048|nullable',
        ];
        $validatedDokumenAjar = $request->validate($ruleDokumenAjar);

        if ($request->file('cp')) {
            if($request->old_cp){
                Storage::delete($request->old_cp);
            }
            $validatedDokumenAjar['cp'] = $request->file('cp')->store('dokumen_ajar/' . $validated['nama']);
        }
        if ($request->file('atp')) {
            if($request->old_atp){
                Storage::delete($request->old_atp);
            }
            $validatedDokumenAjar['atp'] = $request->file('atp')->store('dokumen_ajar/' . $validated['nama']);
        }
        if ($request->file('ma')) {
            if($request->old_ma){
                Storage::delete($request->old_ma);
            }
            $validatedDokumenAjar['ma'] = $request->file('ma')->store('dokumen_ajar/' . $validated['nama']);
        }

        Mapel::where('id', $mapel->id)
            ->update($validated);

        DokumenAjar::updateOrCreate(
            ['kode' => $request->kode],
            $validatedDokumenAjar
        );

        return redirect('/dashboard/mapel')->with('success', 'Mapel ' . $mapel->nama . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        Mapel::destroy($mapel->id);

        return redirect('/dashboard/mapel')->with('success', 'Mapel berhasil dihapus!');
    }
}
