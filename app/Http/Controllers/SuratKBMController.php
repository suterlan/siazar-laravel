<?php

namespace App\Http\Controllers;

use App\Models\ESign;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Klasifikasi;
use App\Models\Mengajar;
use App\Models\SKBM;
use App\Models\StrukturOrganisasi;
use App\Models\SuratKeluar;
use App\Services\QRCode\QRCodeService;
use App\Services\Surat\NomorSuratService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuratKBMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-keluar.surat-kbm.index', [
            'title'     => 'Surat KBM | ' . config('app.name'),
            'skbms'     => SKBM::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahuns = Mengajar::select('tahun_ajaran')->orderBy('tahun_ajaran', 'desc')->get()->groupBy('tahun_ajaran');

        return view('surat-keluar.surat-kbm.create', [
            'title'         => 'Surat KBM Baru | ' . config('app.name'),
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get(),
            'tahuns'         => $tahuns,
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
            'klasifikasi_id'    => 'required',
            'no_surat'          => 'required|unique:surat_keluars',
            'tanggal_surat'     => 'required',
            'tahun_ajaran'      => 'required',
            'semester'          => 'required',
        ]);

        //mulai 
        DB::beginTransaction();
        try {
            // jika ada request
            if (!blank(request('qr_active'))) {
                $kode = Hash::make($validated['no_surat']);
                // input data ke tabel e_sign
                ESign::create([
                    'code'  => $kode,
                    'active'    => true,
                    'no_surat'  => $validated['no_surat']
                ]);
            }

            SuratKeluar::create($validated);
            SKBM::create($validated);

            //simpan semua operasi
            DB::commit();

            $klasifikasi = Klasifikasi::find($validated['klasifikasi_id']);
            $kodeKlasifikasi = $klasifikasi->kode;

            return redirect()->route('skp.create', [
                'klasifikasi_id'    => $klasifikasi->id,
                'kode_klasifikasi' => $kodeKlasifikasi
            ]);
        } catch (Exception $e) {
            //jalankan fungsi rollback jika terjadi kesalahan
            DB::rollBack();
            return redirect('/dashboard/suratkeluar/skbm')->with('error', 'Gagal menyimpan, terjadi kesalahan!');
        }
    }

    public function createSKPengangkatan()
    {

        $skbm = SKBM::latest()->first();
        $gurus = Guru::select('id', 'nama')
            ->whereRelation('mengajars', 'tahun_ajaran', '=', $skbm->tahun_ajaran)
            ->whereRelation('mengajars', 'semester', '=', $skbm->semester)
            ->get();

        return view('surat-keluar.surat-kbm.create-sk-pengangkatan', [
            'title' => 'Surat Keputusan Pengangkatan Guru | ' . config('app.name'),
            'klasifikasi_id'    => request('klasifikasi_id'),
            'kodeKlasifikasi'   => request('kode_klasifikasi'),
            'skbm'  => $skbm,
            'gurus' => $gurus,
        ]);
    }

    public function storeSKPengangkatan(SKBM $skbm, Request $request)
    {
        $gurus = $request->guru_id;

        //mulai 
        DB::beginTransaction();
        try {
            // if something is not as expected 
            // throw exception using the "throw" keyword 
            // code, it won't be executed if the above exception is thrown
            foreach ($gurus as $guru => $value) {

                $suratService = new NomorSuratService($request->kode_klasifikasi);
                $no_surat = $suratService->createNomor();

                $skPengangkatan = $skbm->skpengangkatans()->create([
                    'guru_id'   => $value,
                    'no_surat'  => $no_surat,
                ]);

                $skPengangkatan->suratkeluar()->updateOrCreate(
                    ['no_surat' => $no_surat],
                    [
                        'klasifikasi_id'    => $request->klasifikasi_id,
                        'tanggal_surat'     => $skbm->created_at,
                    ]
                );
            }
            //simpan semua operasi
            DB::commit();
            return redirect('/dashboard/suratkeluar/skbm')->with('success', 'Surat KBM baru berhasil dibuat!');
        } catch (Exception $e) {
            // exception is raised and it'll be handled here 
            // $e->getMessage() contains the error message 
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan, terjadi kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function show(SKBM $skbm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function edit(SKBM $skbm)
    {
        //get code dari esign
        $esign = ESign::whereRelation('suratkeluar', 'no_surat', '=', $skbm->no_surat)
            ->first();

        $tahuns = Mengajar::select('tahun_ajaran')->orderBy('tahun_ajaran', 'desc')->get()->groupBy('tahun_ajaran');

        $skGurus = $skbm->skpengangkatans()->get()->load(['suratkeluar', 'guru:id,nama']);

        return view('surat-keluar.surat-kbm.edit', [
            'title'         => 'Edit Surat KBM | ' . config('app.name'),
            'surat'         => $skbm,
            'skGurus'       => $skGurus,
            'esign'         => $esign,
            'tahuns'        => $tahuns,
            'klasifikasi'   => Klasifikasi::select('id', 'kode', 'nama')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SKBM $skbm)
    {
        $rules = [
            'klasifikasi_id'    => 'required',
            'tanggal_surat'     => 'required',
            'tahun_ajaran'      => 'required',
            'semester'          => 'required',
        ];

        if ($skbm->no_surat != $request->no_surat) {
            $rules['no_surat'] = 'required|unique:surat_keluars';
        }
        $validated = $request->validate($rules);

        $dataSuratKeluar = [
            'klasifikasi_id'    => $validated['klasifikasi_id'],
            'tanggal_surat'     => $validated['tanggal_surat'],
        ];

        $dataSkbm = [
            'tahun_ajaran'      => $validated['tahun_ajaran'],
            'semester'          => $validated['semester'],
        ];

        //cek ada request qr atau tidak
        $active = !blank(request('qr_active')) ? true : false;

        //mulai 
        DB::beginTransaction();
        try {
            // jika no surat diubah atau tidak sama dengan no surat sebelumnya
            if ($skbm->no_surat != $request->no_surat) {
                $dataSuratKeluar['no_surat'] = $validated['no_surat'];
                $dataSkbm['no_surat'] = $validated['no_surat'];

                $kode = Hash::make($validated['no_surat']);
                // ubah atau input data tabel e_sign
                ESign::updateOrCreate(
                    ['no_surat' => $skbm->no_surat],
                    [
                        'code'      => $kode,
                        'active'    => $active,
                        'no_surat'  => $validated['no_surat']
                    ]
                );

                // update juga sk pengangkatan
                $skbm->load('skpengangkatans');

                $skGuru = $request->sk_guru;

                foreach ($skGuru as $key => $value) {
                    $skbm->skpengangkatans()->where('id', $key)->update([
                        'no_surat'  => $value,
                    ]);
                    // SKPengangkatan::where('id', $key)->update([
                    //     'no_surat'  => $value,
                    // ]);
                }

                //jika sama 
            } else {
                $kode = Hash::make($request->no_surat);
                // ubah atau input data tabel e_sign
                ESign::updateOrCreate(
                    ['no_surat' => $skbm->no_surat],
                    [
                        'code'      => $kode,
                        'active'    => $active,
                    ]
                );
            }

            SuratKeluar::where('id', $skbm->suratkeluar->id)
                ->update($dataSuratKeluar);
            SKBM::where('id', $skbm->id)
                ->update($dataSkbm);

            // simpan proses    
            DB::commit();

            return redirect('/dashboard/suratkeluar/skbm')->with('success', 'Surat KBM dengan nomor surat : ' . $skbm->no_surat . ' berhasil diubah!');
        } catch (Exception $e) {
            // exception is raised and it'll be handled here 
            // $e->getMessage() contains the error message 
            DB::rollBack();
            return back()->with('error', 'Gagal, terjadi kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKBM  $skbm
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKBM $skbm)
    {
        $skp = $skbm->skpengangkatans()->get()->load('suratkeluar');

        DB::transaction(function () use ($skp, $skbm) {
            $skp->each(function ($q) {
                if (!blank($q->suratkeluar)) {
                    $q->suratkeluar->delete();
                }
            });
            // // parent::delete(); // Finally, delete the skbm
            $skbm->suratkeluar()->delete();
            $skbm->delete();
        });

        return redirect('/dashboard/suratkeluar/skbm')->with('success', 'Surat KBM dengan no surat : ' . $skbm->no_surat . ' berhasil dihapus');
    }

    public function cetak(SKBM $skbm)
    {
        // $kelas = Kelas::orderBy('id')->get()->groupBy(function ($data) {
        //     return $data->nama;
        // });
        $jurusans = Jurusan::select('id', 'kode', 'nama')->orderBy('kode', 'asc')
            ->with(['kelas' => function ($query) {
                $query->orderBy('kelas.nama', 'asc');
            }])->get();

        $arrKelas = [];
        foreach ($jurusans as $jurusan) {
            foreach ($jurusan->kelas as $kelas) {
                $arrKelas[$kelas->id] = $kelas->nama;
            }
        }

        $guru = Guru::select('id', 'nama', 'tempat_lahir', 'tanggal_lahir', 'pendidikan_terakhir', 'nuptk', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi')
            ->whereRelation('mengajars', 'tahun_ajaran', '=', $skbm->tahun_ajaran)
            ->whereRelation('mengajars', 'semester', '=', $skbm->semester)
            ->get();

        $guruMengajar = $guru->load([
            'mengajars.mapel',
            'mengajars' => function ($query) use ($skbm) {
                $query->where('semester', '=', $skbm->semester);
                $query->orderBy('kelas_id', 'asc');
            }
        ]);

        $jamMengajars = Mengajar::query()
            ->where('tahun_ajaran', '=', $skbm->tahun_ajaran)
            ->where('semester', '=', $skbm->semester)
            ->orderBy('kelas_id', 'asc')
            ->with('mapel');

        $strukturs = StrukturOrganisasi::orderBy('id')->get()->groupBy(function ($data) {
            return $data->keterangan;
        });

        //get code dari esign
        $esign = ESign::whereRelation('suratkeluar', 'no_surat', '=', $skbm->no_surat)
            ->where('active', true)
            ->first();

        $qr = '';
        // cek jika ada e-sign
        if ($esign) {
            // buat qr kode dengan memanggil service qrcode service
            $route = route('arsip-surat');
            $link = $route . '/' . $esign->code;

            $qrService = new QRCodeService($link);
            $qr = $qrService->generate();
        }

        $skPengangkatan = $skbm->load('skpengangkatans.guru');

        // return $qr;
        $pdf = FacadePdf::loadView('surat-keluar.surat-kbm.cetak', [
            'title'         => 'Cetak Surat | ' . config('app.name'),
            'surat'         => $skbm,
            'jurusans'      => $jurusans,
            'arrKelas'      => $arrKelas,
            'mengajars'     => $guruMengajar,
            'jamMengajars'  => $jamMengajars,
            'strukturs'     => $strukturs,
            'skPengangkatans'   => $skPengangkatan,
            'qrcode'        => $qr,
        ]);
        return $pdf->stream('surat-skbm');
        // exit(0);
    }

    public function download(SKBM $skbm)
    {
        $jurusans = Jurusan::select('id', 'kode', 'nama')->orderBy('kode', 'asc')
            ->with(['kelas' => function ($query) {
                $query->orderBy('kelas.nama', 'asc');
            }])->get();

        $arrKelas = [];
        foreach ($jurusans as $jurusan) {
            foreach ($jurusan->kelas as $kelas) {
                $arrKelas[$kelas->id] = $kelas->nama;
            }
        }

        $guru = Guru::select('id', 'nama', 'tempat_lahir', 'tanggal_lahir', 'pendidikan_terakhir', 'nuptk', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi')
            ->whereRelation('mengajars', 'tahun_ajaran', '=', $skbm->tahun_ajaran)
            ->whereRelation('mengajars', 'semester', '=', $skbm->semester)
            ->get();

        $guruMengajar = $guru->load([
            'mengajars.mapel',
            'mengajars' => function ($query) use ($skbm) {
                $query->where('semester', '=', $skbm->semester);
                $query->orderBy('kelas_id', 'asc');
            }
        ]);

        $jamMengajars = Mengajar::query()
            ->where('tahun_ajaran', '=', $skbm->tahun_ajaran)
            ->where('semester', '=', $skbm->semester)
            ->orderBy('kelas_id', 'asc')
            ->with('mapel');

        $strukturs = StrukturOrganisasi::orderBy('id')->get()->groupBy(function ($data) {
            return $data->keterangan;
        });

        //get code dari esign
        $esign = ESign::whereRelation('suratkeluar', 'no_surat', '=', $skbm->no_surat)
            ->where('active', true)
            ->first();

        $qr = '';
        // cek jika ada e-sign
        if ($esign) {
            // buat qr kode dengan memanggil service qrcode service
            $route = route('arsip-surat');
            $link = $route . '/' . $esign->code;

            $qrService = new QRCodeService($link);
            $qr = $qrService->generate();
        }

        $skPengangkatan = $skbm->load('skpengangkatans.guru');

        $pdf = FacadePdf::loadView('surat-keluar.surat-kbm.cetak', [
            'title'     => 'Cetak Surat SKBM | ' . config('app.name'),
            'surat'         => $skbm,
            'jurusans'      => $jurusans,
            'arrKelas'      => $arrKelas,
            'mengajars'     => $guruMengajar,
            'jamMengajars'  => $jamMengajars,
            'strukturs'     => $strukturs,
            'skPengangkatans'   => $skPengangkatan,
            'qrcode'        => $qr,
        ]);
        return $pdf->download('surat-kbm-' . $skbm->tahun_ajaran . '_' . $skbm->semester . '.pdf');
        // exit(0);
    }
}
