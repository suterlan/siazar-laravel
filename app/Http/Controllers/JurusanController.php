<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\PPDB;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jurusan.index',[
            'title'     => 'Jurusan | '. config('app.name'),
            'jurusans'  => Jurusan::all()
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
            'kode'      => 'required',
            'nama'      => 'required',
            'deskripsi' => 'nullable',
            'logo'      => 'image|file|max:2048|mimes:png'
        ]);
        if($request->file('logo')){
            $validated['logo'] = $request->file('logo')->store('img/logo-jurusan');
        }

        Jurusan::create($validated);
        return redirect('/dashboard/jurusan')->with('success', 'Jurusan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return response()->json($jurusan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'edit_kode'      => 'required',
            'edit_nama'      => 'required',
            'edit_deskripsi' => 'nullable',
            'edit_logo'      => 'image|file|max:2048|mimes:png'
        ]);

        $data = [
            'kode'  => $validated['edit_kode'],
            'nama'  => $validated['edit_nama'],
            'deskripsi'  => $validated['edit_deskripsi'],
        ];

        if($request->file('edit_logo')){
            if ($request->old_logo) {
                Storage::delete($request->old_logo);
            }
            $validated['edit_logo'] = $request->file('edit_logo')->store('img/logo-jurusan');
            $data['logo'] = $validated['edit_logo'];
        }

        Jurusan::where('id', $jurusan->id)
                ->update($data);

        return redirect('/dashboard/jurusan')->with('success', 'Jurusan ' . $jurusan->nama . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        // if(response(500)){
        //     return redirect('/dashboard/jurusan')->with('error', 'Jurusan ' .$jurusan->nama. ' tidak dapat dihapus! karena telah digunakan di data siswa. Jika ingin menghapusnya silahkan ubah atau hapus terlebih dahulu siswa yang memiliki jurusan ini (Hati-hati data siswa bisa hilang!)');
        // }
        $cekForeignPppdb = PPDB::where('jurusan_id', $jurusan->id)->get();
        $cekForeignSiswa = Siswa::where('jurusan_id', $jurusan->id)->get();

        if($cekForeignSiswa->count() > 0 || $cekForeignPppdb->count() > 0){
            return redirect('/dashboard/jurusan')->with('error', 'Jurusan ' .$jurusan->nama. ' tidak dapat dihapus! karena sedang digunakan di data siswa atau ppdb.');
        }

        if ($jurusan->logo) {
            Storage::delete($jurusan->logo);
        }
        Jurusan::destroy($jurusan->id);
        return redirect('/dashboard/jurusan')->with('success', 'Jurusan ' .$jurusan->nama. ' berhasil di hapus');
    }
}
