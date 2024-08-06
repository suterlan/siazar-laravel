<?php

namespace App\Http\Controllers\dashboard_siswa;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\Siswa;
use App\Models\TracingAlumni;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Laravolt\Indonesia\Models\Province;

class ProfileController extends Controller
{
    public function index(): View
    {
        $akun = Siswa::where('nisn', auth()->user()->username)->first();
        $provinces = Province::pluck('name', 'code');
        return view('dashboard-siswa.profile.index', [
            'title'     => 'Profile Siswa ' . config('app.name'),
            'akun'      => $akun,
            'provinces' => $provinces,
        ]);
    }

    public function updateProfile(Request $request, Siswa $siswa)
    {
        $rules = [
            'nama_siswa'            => 'required',
            'jk'                    => 'required',
            'no_hp'                 => 'max:13',
            'nama_ibu'              => 'required',
        ];

        $validated = $request->validate($rules);

        $ruleDocument = [
            'foto'                  => 'image|file|max:2048|mimes:png,jpg',
            'kartu_keluarga'        => 'file|mimes:pdf|max:2048',
            'ijazah'                => 'file|mimes:pdf|max:2048',
            'akte'                  => 'file|mimes:pdf|max:2048',
            'ktp_ortu'              => 'file|mimes:pdf|max:2048',
            'berkas'                => 'file|mimes:pdf|max:2048',
        ];

        $documents = $request->validate($ruleDocument);

        if ($request->file('foto')) {
            if ($request->old_foto) {
                Storage::delete($request->old_foto);
            }
            $documents['foto'] = $request->file('foto')->store('dokumen/' . $siswa->nisn . '_' . trim($validated['nama_siswa'], '.'));
        }
        if ($request->file('kartu_keluarga')) {
            if ($request->old_kartu_keluarga) {
                Storage::delete($request->old_kartu_keluarga);
            }
            $documents['kartu_keluarga'] = $request->file('kartu_keluarga')->store('dokumen/' . $siswa->nisn . '_' . trim($siswa->nama_siswa, '.'));
        }
        if ($request->file('ijazah')) {
            if ($request->old_ijazah) {
                Storage::delete($request->old_ijazah);
            }
            $documents['ijazah'] = $request->file('ijazah')->store('dokumen/' . $siswa->nisn . '_' . trim($siswa->nama_siswa, '.'));
        }
        if ($request->file('akte')) {
            if ($request->old_akte) {
                Storage::delete($request->old_akte);
            }
            $documents['akte'] = $request->file('akte')->store('dokumen/' . $siswa->nisn . '_' . trim($siswa->nama_siswa, '.'));
        }
        if ($request->file('ktp_ortu')) {
            if ($request->old_ktp_ortu) {
                Storage::delete($request->old_ktp_ortu);
            }
            $documents['ktp_ortu'] = $request->file('ktp_ortu')->store('dokumen/' . $siswa->nisn . '_' . trim($siswa->nama_siswa, '.'));
        }
        if ($request->file('berkas')) {
            if ($request->old_berkas) {
                Storage::delete($request->old_berkas);
            }
            $documents['berkas'] = $request->file('berkas')->store('dokumen/' . $siswa->nisn . '_' . trim($siswa->nama_siswa, '.'));
        }

        // Ubah password,
        // buat array untuk menampung aturan validasi
        $ruleUbahPassword = [];
        // jika input username tidak sama dengan yg ada di db, buat rule untuk username
        if ($request->username != $siswa->user->username) {
            $ruleUbahPassword['username'] = 'required|unique:users';
        }

        // Update password
        if (!empty($request->old_password)) {
            // cek old_password apakah sama dengan password di db?, jika sama lanjutkan, jika beda tampilkan pesan
            if (Hash::check($request->old_password, $siswa->user->password)) {
                // jika input password baru beda dg sebelumnya, buat rule untuk password baru
                if ($request->password != $siswa->user->password) {
                    $ruleUbahPassword['password'] = 'required|min:8|required_with:password_confirmation|same:password_confirmation';
                    // $ruleUbahPassword['password_confirmation'] = 'required|min:8';
                }
            } else {
                throw ValidationException::withMessages(['old_password' => 'Old Password tidak sama!']);
            }
        }
        $dataPassword = $request->validate($ruleUbahPassword);
        if ($request->password != '') {
            $dataPassword['password'] = Hash::make($dataPassword['password']);
        }

        // update tabel users sesuai akun siswa
        User::where('username', $siswa->nisn)
            ->update($dataPassword);

        // update tabel siswa
        Siswa::where('id', $siswa->id)
            ->update($validated);

        // update data tabel dokumen
        Dokumen::updateOrCreate(
            ['nisn'  => $siswa->nisn],
            $documents
        );

        // redirect
        return redirect('/dashboard-siswa/akun')->with('success', 'Data anda berhasil diubah');
    }

    public function tracingAlumni(): View
    {
        return view('dashboard-siswa.tracer-alumni', [
            'title'     => 'Tracing Alumni ' . config('app.name'),
        ]);
    }

    public function StoreTracingAlumni(Request $request)
    {
        $user = Auth::user()->username;
        $siswa = Siswa::select('id')->where('nisn', $user)->get();
        foreach ($siswa as $key) {
            $siswa_id = $key->id;
        }

        $rules = [
            'angkatan'  => 'required',
            'status'    => 'required',
        ];

        if ($request->status == 'Kerja') {
            $rules['nama_perusahaan']   = 'required';
            $rules['alamat_perusahaan'] = 'required';
            $rules['gaji'] = 'required';
        }
        if ($request->status == 'Kuliah') {
            $rules['nama_universitas']   = 'required';
            $rules['alamat_universitas'] = 'required';
            $rules['jurusan'] = 'required';
        }
        if ($request->status == 'Menikah' || $request->status == 'Usaha Mandiri') {
            $rules['kategori_usaha'] = 'required';
            $rules['gaji'] = 'required';
        }

        $validated = $request->validate($rules);

        $validated['siswa_id'] = $siswa_id;

        TracingAlumni::create($validated);
        return redirect('/dashboard-siswa')->with('success', 'Data telah tersimpan!');
    }
}
