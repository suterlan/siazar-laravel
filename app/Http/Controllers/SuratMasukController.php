<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-masuk.index', [
            'title' => 'Surat Masuk | ',
            'surats' => SuratMasuk::with('klasifikasi')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-masuk.create', [
            'title' => 'Tambah Surat Masuk | ',
            'klasifikasi'   => Klasifikasi::all()
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
        $rules = [
            'klasifikasi_id'    => 'required',
            'no_surat'          => 'required|unique:surat_masuks',
            'asal_surat'        => 'required|max:100',
            'deskripsi'         => 'required',
            'tanggal_surat'     => 'required',
            'tanggal_diterima'  => 'required',
            'file'              => 'file|mimes:pdf|max:2048',
            'keterangan'        => 'max:100'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('surat-masuk-files');
        }

        SuratMasuk::create($validatedData);
        return redirect('/dashboard/suratmasuk')->with('success', 'Surat telah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratmasuk)
    {
        return view('surat-masuk.detail', [
            'title'     => 'Detail Surat Masuk',
            'surat'     => $suratmasuk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratmasuk)
    {
        return view('surat-masuk.edit', [
            'title' => 'Edit Surat Masuk | ',
            'surat' => $suratmasuk,
            'klasifikasi'   => Klasifikasi::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $suratmasuk)
    {
        $rules = [
            'klasifikasi_id'    => 'required',
            'asal_surat'        => 'required|max:100',
            'deskripsi'         => 'required',
            'tanggal_surat'     => 'required',
            'tanggal_diterima'  => 'required',
            'file'              => 'file|mimes:pdf|max:2048',
            'keterangan'        => 'max:100'
        ];

        if ($suratmasuk->no_surat != $request->no_surat) {
            $rules['no_surat'] = 'required|unique:surat_masuks';
        }
        $validatedData = $request->validate($rules);

        if ($request->file('file')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file'] = $request->file('file')->store('surat-masuk-files');
        }

        SuratMasuk::where('id', $suratmasuk->id)
            ->update($validatedData);

        return redirect('/dashboard/suratmasuk')->with('success', 'Surat dengan no ' . $request->no_surat . ' telah berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $suratmasuk)
    {
        if ($suratmasuk->file) {
                Storage::delete($suratmasuk->file);
        }

        SuratMasuk::destroy($suratmasuk->id);
        return redirect('/dashboard/suratmasuk')->with('success', 'Data telah berhasil dihapus!');
    }

}
