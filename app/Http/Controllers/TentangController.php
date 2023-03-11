<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    public function index(){
        return view('settings.tentang',[
            'title'     => 'Setting Tentang | ',
            'tentang'   => Tentang::first()
        ]);
    }

    public function update(Request $request, Tentang $tentang){
        $validated = $request->validate([
            'sambutan'      => 'required',
            'visi'          => 'max:255|required',
            'misi'          => 'max:255|required',                      
            'deskripsi'     => 'max:255|nullable',                      
            'gambar_1'      => 'image|file|max:2048|mimes:png,jpg|nullable',
        	'gambar_2'      => 'image|file|max:2048|mimes:png,jpg|nullable',
            'video'         => 'file|mimetypes:video/mp4|nullable',
        ]);

        if($request->file('gambar_1')){
            if($request->oldGambar1){
                Storage::delete($request->oldGambar1);
            }
            $validated['gambar_1'] = $request->file('gambar_1')->store('img/tentang');
        }
        if($request->file('gambar_2')){
            if($request->oldGambar2){
                Storage::delete($request->oldGambar2);
            }
            $validated['gambar_2'] = $request->file('gambar_2')->store('img/tentang');
        }
        if($request->file('video')){
            if($request->oldVideo){
                Storage::delete($request->oldVideo);
            }
            $validated['video'] = $request->file('video')->store('img/tentang');
        }

        Tentang::where('id', $tentang->id)
            ->update($validated);

        return redirect('/dashboard/settings-tentang')->with('success', 'Data berhasil diupdate!');
    }
}
