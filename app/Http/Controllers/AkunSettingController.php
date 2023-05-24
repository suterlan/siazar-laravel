<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Laravolt\Indonesia\Models\Province;

class AkunSettingController extends Controller
{
    public function index(){
        $akun = Guru::where('email', auth()->user()->email)->first();
        $provinces= Province::pluck('name', 'code');
        return view('settings.profile',[
            'title'     => 'Guru '. config('app.name'),
            'akun'      => $akun,
            'provinces' => $provinces,
        ]);
    }

    public function update(Request $request, Guru $akun)
    {
        $validate = [
            'nama'                  => 'required',
            'nuptk'                 => 'nullable',
            'nip'                   => 'nullable',
            'nik'                   => 'required|min:16|numeric',
            'jk'                    => 'required',
            'tempat_lahir'          => 'required',
            'tanggal_lahir'         => 'required',
            'agama'                 => 'nullable',
            'no_hp'                 => 'nullable',
            'nama_ibu'              => 'nullable',
            'alamat'                => 'nullable',
            'provinsi'              => 'required',
            'kabupaten'             => 'required',
            'kecamatan'             => 'required',
            'kelurahan'             => 'required',
            'pendidikan_terakhir'   => 'nullable',
            'jurusan'               => 'nullable',
            'sk_cpns'               => 'nullable',
            'tanggal_cpns'          => 'nullable',
            'tmt_cpns'              => 'nullable',
            'pangkat_golongan'      => 'nullable',
            'sk_pengangkatan'       => 'nullable',
            'tmt_pengangkatan'      => 'nullable',
            'lembaga_pengangkatan'  => 'nullable',
            'npwp'                  => 'nullable',
            'bank'                  => 'nullable',
            'no_rek'                => 'nullable',
            'nama_rek'              => 'nullable',
        ];

        if($request->email != $akun->email){
            $validate['email'] = 'required|email|unique:gurus';
        }

        $validated = $request->validate($validate);

        $ruleDocument = [
            'foto'                  => 'image|file|mimes:png,jpg|max:2048',
            'kartu_keluarga'        => 'file|mimes:pdf|max:2048',
            'ijazah'                => 'file|mimes:pdf|max:2048',
            'berkas'                => 'file|mimes:pdf|max:2048',
        ];
        $documents = $request->validate($ruleDocument);

        if ($request->file('kartu_keluarga')) {
            if($request->old_kartu_keluarga){
                Storage::delete($request->old_kartu_keluarga);
            }
            $documents['kartu_keluarga'] = $request->file('kartu_keluarga')->store('dokumen/guru/' . $validated['nama']);
        }
        if ($request->file('foto')) {
            if($request->old_foto){
                Storage::delete($request->old_foto);
            }
            $documents['foto'] = $request->file('foto')->store('dokumen/guru/' . $validated['nama']);
        }
        if ($request->file('ijazah')) {
            if($request->ijazah){
                Storage::delete($request->ijazah);
            }
            $documents['ijazah'] = $request->file('ijazah')->store('dokumen/guru/' . $validated['nama']);
        }
        if ($request->file('berkas')) {
            if($request->berkas){
                Storage::delete($request->berkas);
            }
            $documents['berkas'] = $request->file('berkas')->store('dokumen/guru/' . $validated['nama']);
        }

        // Ubah password,
        // buat array untuk menampung aturan validasi
        $ruleUbahPassword = [];
        // jika input username tidak sama dengan yg ada di db, buat rule untuk username
        if($request->username != $akun->user->username){
            $ruleUbahPassword['username'] = 'required|unique:users';
        }

        // Update password
        if(!empty($request->old_password)){
            // cek old_password apakah sama dengan password di db?, jika sama lanjutkan, jika beda tampilkan pesan
            if(Hash::check($request->old_password, $akun->user->password)){
                // jika input password baru beda dg sebelumnya, buat rule untuk password baru
                if($request->password != $akun->user->password){
                    $ruleUbahPassword['password'] = 'required|min:8|required_with:password_confirmation|same:password_confirmation';
                    // $ruleUbahPassword['password_confirmation'] = 'required|min:8';
                }
            }else{
              throw ValidationException::withMessages(['old_password' => 'Old Password tidak sama!']);
            }
        }
        $dataPassword = $request->validate($ruleUbahPassword);
        if ($request->password != '') {
            $dataPassword['password'] = Hash::make($dataPassword['password']);
        }

        User::where('email', $akun->email)
            ->update($dataPassword);

        //update tabel guru
        Guru::where('id', $akun->id)
            ->update($validated);

        // Jika email di tabel guru diubah, update email di akun user
        if($request->email != $akun->email){
            $data = [
                'email' => $validated['email'],
            ];
            User::where('email', $akun->email)
                ->update($data);
        }

        // update data tabel dokumen
        Dokumen::updateOrCreate(
            ['nik'  => $akun->nik],
            $documents
        );

        // redirect
        return redirect('/dashboard/akun')->with('success', 'Data anda berhasil diubah');
    }

}
