<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\Province;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::select('id', 'nis', 'nisn', 'nama_siswa', 'tempat_lahir', 'tgl_lahir', 'kelas_id', 'jurusan_id')
                ->with(['jurusan', 'kelas'])
                ->orderBy('nis', 'ASC')
                ->where('lulus', false)
                ->get();
        return view('siswa.index', [
            'title'     => 'Siswa | SIAZAR',
            'siswas'     => $siswa
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.detail',[
            'title'     => 'Detail Siswa | SIAZAR',
            'siswa'     => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $provinces= Province::pluck('name', 'code');
        return view('siswa.edit',[
            'title'     => 'Edit Siswa | SIAZAR',
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::select('id', 'nama')->get(),
            'provinces' => $provinces,
            'siswa'     => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        // RULE VALIDASI SISWA
        $validate = [    
                'jurusan_id'            => 'required',       
                'kelas_id'              => 'required',      
                'nama_siswa'            => 'required',
                'jk'                    => 'required',
                'tempat_lahir'          => 'required',
                'tgl_lahir'             => 'required',
                'no_hp'                 => 'max:13',
                'tahun_ajaran'          => 'max:9',
                'nik'                   => 'min:16|required|numeric',
                'alamat'                => 'max:255',
                'provinsi'              => 'max:64',
                'kabupaten'             => 'max:64', 
                'kecamatan'             => 'max:64',
                'kelurahan'             => 'max:64',
                'asal_sekolah'          => 'required',
                'no_ijazah'             => 'min:16|nullable',
                'no_skhun'              => 'min:7|nullable',
                'no_kip'                => 'min:7|nullable',
                'nama_kip'              => 'max:255|nullable',
                'nama_ayah'             => 'nullable',
                'nik_ayah'              => 'min:16|numeric|nullable',
                'tgl_lahir_ayah'        => 'date|nullable',
                'pendidikan_ayah'       => 'max:32',
                'pekerjaan_ayah'        => 'max:64',
                'penghasilan_ayah'      => 'numeric|nullable',
                'nama_ibu'              => 'required',
                'nik_ibu'               => 'min:16|numeric|nullable',
                'tgl_lahir_ibu'         => 'date|nullable',
                'pendidikan_ibu'        => 'max:32',
                'pekerjaan_ibu'         => 'max:64',
                'penghasilan_ibu'       => 'numeric|nullable',
                'jml_saudara_kandung'   => 'max:1|nullable'
        ];

        // jika nisn diubah tambahkan rule nisn ke validasi siswa
        if($request->nisn != $siswa->nisn){
            $validate['nisn'] = 'min:10|numeric|nullable|unique:siswas';
        }
        // validasi rule siswa di atas
        $validated = $request->validate($validate);

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
            if($request->old_foto){
                Storage::delete($request->old_foto);
            }
            $documents['foto'] = $request->file('foto')->store('dokumen/' . $siswa->nis . '_' . $siswa->nama_siswa);
        }
        if ($request->file('kartu_keluarga')) {
            if($request->old_kartu_keluarga){
                Storage::delete($request->old_kartu_keluarga);
            }
            $documents['kartu_keluarga'] = $request->file('kartu_keluarga')->store('dokumen/' . $siswa->nis . '_' . $siswa->nama_siswa);
        }
        if ($request->file('ijazah')) {
            if($request->old_ijazah){
                Storage::delete($request->old_ijazah);
            }
            $documents['ijazah'] = $request->file('ijazah')->store('dokumen/' . $siswa->nis . '_' . $siswa->nama_siswa);
        }
        if ($request->file('akte')) {
            if($request->old_akte){
                Storage::delete($request->old_akte);
            }
            $documents['akte'] = $request->file('akte')->store('dokumen/' . $siswa->nis . '_' . $siswa->nama_siswa);
        }
        if ($request->file('ktp_ortu')) {
            if($request->old_ktp_ortu){
                Storage::delete($request->old_ktp_ortu);
            }
            $documents['ktp_ortu'] = $request->file('ktp_ortu')->store('dokumen/' . $siswa->nis . '_' . $siswa->nama_siswa);
        }
        if ($request->file('berkas')) {
            if($request->old_berkas){
                Storage::delete($request->old_berkas);
            }
            $documents['berkas'] = $request->file('berkas')->store('dokumen/' . $siswa->nis . '_' . $siswa->nama_siswa);
        }

        // update tabel dokumen
        Dokumen::where('nis', $siswa->nis)
            ->update($documents);

        // update tabel siswa
        Siswa::where('id', $siswa->id)
            ->update($validated);
        
        return redirect('/dashboard/siswa')->with('success', 'Data siswa ' . $siswa->nama_siswa . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        if ($siswa->dokumen->foto) {
            Storage::delete($siswa->dokumen->foto);
        }
        if ($siswa->dokumen->kartu_keluarga) {
            Storage::delete($siswa->dokumen->kartu_keluarga);
        }
        if ($siswa->dokumen->ijazah) {
           Storage::delete($siswa->dokumen->ijazah);
        }
        if ($siswa->dokumen->akte) {
           Storage::delete($siswa->dokumen->akte);
        }
        if ($siswa->dokumen->ktp_ortu) {
           Storage::delete($siswa->dokumen->ktp_ortu);
        }
        if ($siswa->dokumen->berkas) {
           Storage::delete($siswa->dokumen->berkas);
        }

        Siswa::where('nis', $siswa->nis)->delete();
        Dokumen::where('nis', $siswa->nis)->delete();

        return redirect('/dashboard/siswa')->with('success', 'Data siswa ' . $siswa->nama_siswa . ' berhasil dihapus!');
    }
}
