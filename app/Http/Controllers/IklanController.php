<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IklanController extends Controller
{
    public function index()
    {
        return view('settings.iklan',[
            'title'     => 'Iklan | SIAZAR',
            'iklan'     => Iklan::first()
        ]);
    }

    public function update(Request $request, Iklan $iklan){
        $validated =$request->validate([
            'judul'     => 'max:64|nullable',
            'informasi' => 'max:250|nullable',
            'gambar'    => 'image|file|mimes:png,jpg|max:2048'
        ]);

        if($request->file('gambar')){
            if ($request->oldGambar) {
                Storage::delete($request->oldGambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('img/settings-iklan');
        }

        Iklan::where('id', $iklan->id)
            ->update($validated);
        return redirect('/dashboard/settings-iklan')->with('success', 'Iklan berhasil diubah!');
    }
}
