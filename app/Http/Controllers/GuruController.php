<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guru.index',[
            'title'     => 'Guru '. config('app.name'),
            'gurus'     => Guru::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces= Province::pluck('name', 'code');
        return view('guru.create', [
            'title'     => 'Tambah Guru '. config('app.name'),
            'provinces' => $provinces,
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
            'email'                 => 'required|email|unique:gurus',
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
        ]);

        $ruleDocument = [
            'foto'                  => 'image|file|mimes:png,jpg|max:2048|nullable',
            'kartu_keluarga'        => 'file|mimes:pdf|max:2048|nullable',
            'ijazah'                => 'file|mimes:pdf|max:2048|nullable',
            'berkas'                => 'file|mimes:pdf|max:2048|nullable',
        ];
        $documents = $request->validate($ruleDocument);

        if ($request->file('kartu_keluarga')) {
            $documents['kartu_keluarga'] = $request->file('kartu_keluarga')->store('dokumen/guru/' . $validated['nama']);
        }
        if ($request->file('foto')) {
            $documents['foto'] = $request->file('foto')->store('dokumen/guru/' . $validated['nama']);
        }
        if ($request->file('ijazah')) {
            $documents['ijazah'] = $request->file('ijazah')->store('dokumen/guru/' . $validated['nama']);
        }
        if ($request->file('berkas')) {
            $documents['berkas'] = $request->file('berkas')->store('dokumen/guru/' . $validated['nama']);
        }

        $akun = [
            'name'      => $validated['nama'],
            'username'  => $validated['email'],
            'email'     => $validated['email'],
            'password'  => Hash::make('12345678'),
            'role'      => 'guru'
        ];


        //insert ke tabel guru
        Guru::create($validated);
        // insert data ke tabel dokumen
        Dokumen::updateOrCreate(
            ['nik'  => $validated['nik']],
            $documents
        );
        // generate akun guru
        User::create($akun);
        // redirect
        return redirect('/dashboard/guru')->with('success', 'Data guru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $provinces= Province::pluck('name', 'code');
        return view('guru.edit',[
            'title'     => 'Guru '. config('app.name'),
            'provinces' => $provinces,
            'guru'     => $guru,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
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

        if($request->email != $guru->email){
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

        if($request->email != $guru->email){
            $akun = [
                'email' => $validated['email'],
            ];
            User::where('email', $guru->email)
                ->update($akun);
        }


        //update tabel guru
        Guru::where('id', $guru->id)
            ->update($validated);

        // update data tabel dokumen
        Dokumen::updateOrCreate(
            ['nik'  => $validated['nik']],
            $documents
        );

        // redirect
        return redirect('/dashboard/guru')->with('success', 'Data guru ' . $guru->nama . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        Guru::destroy($guru->id);

        return redirect('/dashboard/guru')->with('success', 'Data guru ' . $guru->nama . ' berhasil dihapus');
    }

}
