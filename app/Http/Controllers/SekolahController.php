<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    public function index(){
        $query = Sekolah::first();
        return view('settings.sekolah', [
            'title'     => 'Profil Sekolah | '. config('app.name'),
            'sekolah'   => $query
        ]);
    }

    public function update(Request $request, Sekolah $sekolah){
            $validated = $request->validate([
                'nama_sekolah'      => 'max:64|nullable',
                'kepala_sekolah'    => 'max:64|nullable',
                'nip'               => 'max:18|nullable',
                'nuptk'             => 'max:16|nullable',
                'alamat'            => 'nullable',
                'email'             => 'email|nullable',
                'no_telepon'        => 'max:13|nullable',
                'link_instagram'    => 'url|nullable',
                'link_facebook'     => 'url|nullable',
                'link_youtube'      => 'url|nullable',
                'logo'              => 'image|file|max:2048|mimes:png',
                'pavicon'           => 'image|file|max:2048|mimes:png'
            ]);
            //'pavicon'           => 'image|file|max:2048|mimes:png|dimensions:max_width=500, max_height=600'

            if($request->file('logo')){
                if($request->oldLogo){
                    Storage::delete($request->oldLogo);
                }
                $validated['logo'] = $request->file('logo')->store('img/profile-sekolah');
            }
            if($request->file('pavicon')){
                if($request->oldPavicon){
                    Storage::delete($request->oldPavicon);
                }
                $validated['pavicon'] = $request->file('pavicon')->store('img/profile-sekolah');
            }

            Sekolah::where('id', $sekolah->id)
                ->update($validated);

            return redirect(route('sekolah'))->with('success','Profile sekolah berhasil di update');
    }
}
