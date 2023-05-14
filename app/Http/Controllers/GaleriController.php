<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('galeri.index', [
            'title'     => 'Galeri | ',
            'jurusan'   => Jurusan::select('id', 'nama')->get(),
            'galeris'   => Galeri::latest()->get()
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
            'jurusan_id'    => 'required',
            'gambar'        => 'image|file|max:5120|mimes:png,jpg',
            'caption'       => 'max:32|required'
        ]);

        if($request->file('gambar')){
            $validated['gambar'] = $request->file('gambar')->store('img/galeri');
            $validated['gambar_type'] = $request->file('gambar')->getMimeType();
            $validated['gambar_size'] = $request->file('gambar')->getSize();
        }

        Galeri::create($validated);

        return redirect('/dashboard/galeri')->with('success', 'Gambar galeri berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        if($request->aksi === 'set'){
            $data = [
                'slide_aktif'   => true
            ];
        }

        if($request->aksi === 'remove'){
            $data = [
                'slide_aktif'   => false
            ];
        }
        
        Galeri::where('id', $galeri->id)
            ->update($data);
        return redirect('/dashboard/galeri')->with('success', 'Gambar ' . $galeri->caption . ' berhasil dijadikan slide');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar){
            Storage::delete($galeri->gambar);
        }

        Galeri::destroy($galeri->id);
        return redirect('/dashboard/galeri')->with('success', 'Gambar berhasil dihapus');
    }

    public function download(Galeri $galeri){
        return Storage::download($galeri->gambar);
    }
}
