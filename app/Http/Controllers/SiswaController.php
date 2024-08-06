<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Models\Dokumen;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Services\Siswa\NisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\Province;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Gate::allows('admin')) {
            $siswa = Siswa::select('id', 'nis', 'nisn', 'nama_siswa', 'tempat_lahir', 'tgl_lahir', 'kelas_id', 'jurusan_id')
                ->with('jurusan')
                ->whereRelation('kelas', 'guru_id', '=', auth()->user()->guru->id)
                ->orderBy('nis', 'ASC')
                ->where('lulus', false)
                ->where('status_siswa', true)
                ->get();
        } else {
            $siswa = Siswa::select('id', 'nis', 'nisn', 'nama_siswa', 'tempat_lahir', 'tgl_lahir', 'kelas_id', 'jurusan_id')
                ->with(['jurusan', 'kelas'])
                ->orderBy('nis', 'ASC')
                ->where('lulus', false)
                ->where('status_siswa', true)
                ->get();
        }

        return view('siswa.index', [
            'title'     => 'Siswa | ' . config('app.name'),
            'siswas'    => $siswa
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

    public function registration1(Request $request)
    {
        $provinces = Province::pluck('name', 'code');
        $registrasi = $request->session()->get('registrasi');
        return view('siswa.registration-1', [
            'title'         => 'Tambah Siswa Baru | ' . config('app.name'),
            'step'          => 1,
            'registrasi'    => $registrasi,
            'provinces'     => $provinces
        ]);
    }

    function postRegistration1(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'       => 'numeric',
            'nama_siswa'    => 'required',
            'jk'            => 'required',
            'nik'           => 'min:16|required|numeric',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'no_hp'         => 'max:13',
            'alamat'        => 'max:255',
            'provinsi'      => 'max:64',
            'kabupaten'     => 'max:64',
            'kecamatan'     => 'max:64',
            'kelurahan'     => 'max:64',
            'jml_saudara_kandung'   => 'max:1'
        ]);

        if (empty($request->session()->get('registrasi'))) {
            $registrasi = new Siswa();
            $registrasi->fill($validatedData);
            $request->session()->put('registrasi', $registrasi);
        } else {
            $registrasi = $request->session()->get('registrasi');
            $registrasi->fill($validatedData);
            $request->session()->put('registrasi', $registrasi);
        }

        return redirect('/dashboard/siswa/registrasi-step2');
    }

    public function registration2(Request $request)
    {
        $registrasi = $request->session()->get('registrasi');
        return view('siswa.registration-2', [
            'title'         => 'Tambah Siswa Baru | ' . config('app.name'),
            'step'          => 2,
            'registrasi'    => $registrasi
        ]);
    }

    public function postRegistration2(Request $request)
    {
        $validatedData = $request->validate([
            'asal_sekolah'  => 'required',
            'nis'           => 'min:11|numeric|required|unique:siswas',
            'nisn'          => 'min:10|numeric|required|unique:siswas',
            'no_ijazah'     => 'min:16|nullable',
            'no_skhun'      => 'min:7|nullable',
            'no_kip'        => 'min:6|nullable',
            'nama_kip'      => 'max:255'
        ]);

        $registrasi = $request->session()->get('registrasi');
        $registrasi->fill($validatedData);
        $request->session()->put('registrasi', $registrasi);

        return redirect('/dashboard/siswa/registrasi-step3');
    }

    public function registration3(Request $request)
    {
        $registrasi = $request->session()->get('registrasi');
        return view('siswa.registration-3', [
            'title'         => 'Tambah Siswa Baru | ' . config('app.name'),
            'step'          => 3,
            'registrasi'    => $registrasi
        ]);
    }

    public function postRegistration3(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ayah'         => 'nullable',
            'nik_ayah'          => 'min:16|numeric|nullable',
            'tgl_lahir_ayah'    => 'nullable',
            'pendidikan_ayah'   => 'max:32',
            'pekerjaan_ayah'    => 'max:64',
            'penghasilan_ayah'  => 'numeric|nullable',
            'nama_ibu'          => 'required',
            'nik_ibu'           => 'min:16|numeric|nullable',
            'tgl_lahir_ibu'     => 'nullable',
            'pendidikan_ibu'    => 'max:32',
            'pekerjaan_ibu'     => 'max:64',
            'penghasilan_ibu'   => 'numeric|nullable',
        ]);

        $registrasi = $request->session()->get('registrasi');
        $registrasi->fill($validatedData);
        $request->session()->put('registrasi', $registrasi);

        return redirect('/dashboard/siswa/registrasi-step4');
    }

    public function registration4(Request $request)
    {
        $registrasi = $request->session()->get('registrasi');
        return view('siswa.registration-4', [
            'title'     => 'Tambah Siswa Baru | ' . config('app.name'),
            'step'      => 4,
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::all(),
            'registrasi'    => $registrasi
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
        $validatedData = $request->validate([
            'jurusan_id'   => 'required',
            'kelas_id'     => 'required',
            'status_siswa'  => 'required',
        ]);

        $registrasi = $request->session()->get('registrasi');
        $registrasi->fill($validatedData);
        $request->session()->put('registrasi', $registrasi);

        $registrasi->save();

        // create akun siswa
        User::create([
            'name'      => $registrasi->nama_siswa,
            'username'  => $registrasi->nisn,
            'password'  => Hash::make($registrasi->nisn),
            'role_id'      => 4,
            'position_id'      => 7,
        ]);

        session()->forget('registrasi');
        return redirect('/dashboard/siswa/registrasi-step1')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.detail', [
            'title'     => 'Detail Siswa | ' . config('app.name'),
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
        $provinces = Province::pluck('name', 'code');
        return view('siswa.edit', [
            'title'     => 'Edit Siswa | ' . config('app.name'),
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::all(),
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
            'no_kip'                => 'min:6|nullable',
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
        if ($request->nisn != $siswa->nisn) {
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
            if ($request->old_foto) {
                Storage::delete($request->old_foto);
            }
            $documents['foto'] = $request->file('foto')->store('dokumen/' . $siswa->nisn . '_' . trim($siswa->nama_siswa, '.'));
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

        // update tabel dokumen
        Dokumen::updateOrCreate(
            ['nisn'     => $request->nisn],
            $documents
        );

        // update tabel siswa
        Siswa::where('id', $siswa->id)
            ->update($validated);

        User::updateOrCreate(
            ['username' => $siswa->nisn],
            [
                'name' => $validated['nama_siswa'],
                'username' => $validated['nisn'],
                'password'  => Hash::make($validated['nisn']),
                'role_id'      => 4,
                'position_id'      => 7,
            ]
        );

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
        if ($siswa->dokumen()->exists()) {

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
        }

        $siswa->delete();
        // Dokumen::where('nisn', $siswa->nisn)->delete();

        return back()->with('success', 'Data siswa ' . $siswa->nama_siswa . ' berhasil dihapus!');
    }

    public function export()
    {
        $date = Carbon::now();
        return Excel::download(new SiswaExport, 'data_siswa_' . $date . '.xlsx');
    }

    public function getNis()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');

        // panggil service Nis
        $nisService = new NisService($year, $month, $day);
        $nis = $nisService->createNis();

        return response()->json($nis);
    }
}
