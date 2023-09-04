<?php

namespace App\Http\Controllers;

use App\Exports\PPDBExport;
use App\Models\Dokumen;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\PPDB;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\Province;
use Maatwebsite\Excel\Facades\Excel;

class PPDBController extends Controller
{
    public function  index(){
        $thisYear = Carbon::now();
        if (!Gate::allows('admin')) {
            $data = PPDB::latest()
                        ->with(['jurusan', 'kelas'])
                        ->where('user_id', auth()->user()->id)
                        ->where('confirmed', 0)
                        ->whereYear('created_at', $thisYear)
                        ->get();
        }else{
            $data = PPDB::with(['jurusan', 'kelas', 'user'])->latest()
                ->where('confirmed', 0)
                ->whereYear('created_at', $thisYear)
                ->get();
        }

        $query = PPDB::select('confirmed')->get();
        //jadikan hasil query menjadi collection dan cek data apakah ada yang memiliki nilai 0 pada kolom confirmed
        $cekConfirm = collect($query)->contains('confirmed', 0);
        // jika benar ada nilai 0 dan sesuai(true) buat variabel disabled dengan nilai kosong
        // jika salah atau tidak ada nilai 0, buat variabel dengan nilai 'disabled' (digunakan untuk disable class button approve)
        if($cekConfirm == true){
            $disabled = '';
        }else{
            $disabled = 'disabled';
        }

        $startYear = Carbon::now();

        $jurusan = PPDB::select('p_p_d_b_s.jurusan_id', 'jurusans.logo as logo', 'jurusans.nama as nama', DB::raw('count(jurusans.id) as countJurusan'))
                        ->join('jurusans', 'p_p_d_b_s.jurusan_id', 'jurusans.id')
                        ->groupBy('p_p_d_b_s.jurusan_id', 'logo', 'nama')
                        ->whereYear('p_p_d_b_s.created_at', $startYear)
                        ->where('p_p_d_b_s.confirmed', 0)
                        ->get();

        return view('ppdb.index',[
            'title'     => 'PPDB | '. config('app.name'),
            'jmlCalonSiswa' => PPDB::where('confirmed', 0)->whereYear('created_at', $startYear)->count(),
            'jmlPerempuan'  => PPDB::where('confirmed', 0)->where('jk', 'Perempuan')->whereYear('created_at', $startYear)->count(),
            'jmlLakiLaki'   => PPDB::where('confirmed', 0)->where('jk', 'Laki-Laki')->whereYear('created_at', $startYear)->count(),
            'jurusan'       => $jurusan,
            'btnClass'  => $disabled,
            'ppdbs'     => $data,
        ]);
    }

    public function registration1(Request $request){
        $provinces= Province::pluck('name', 'code');
        $registrasi = $request->session()->get('registrasi');
        return view('ppdb.registration-1', [
            'title'         => 'Pendaftaran Siswa Baru | '. config('app.name'),
            'step'          => 1,
            'registrasi'    => $registrasi,
            'provinces'     => $provinces
        ]);
    }

    function postRegistration1(Request $request){
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
            $registrasi = new PPDB();
            $registrasi->fill($validatedData);
            $request->session()->put('registrasi', $registrasi);
        }else{
            $registrasi = $request->session()->get('registrasi');
            $registrasi->fill($validatedData);
            $request->session()->put('registrasi', $registrasi);
        }

        return redirect('/dashboard/ppdb/registrasi-step2');
    }

    public function registration2(Request $request){
        $registrasi = $request->session()->get('registrasi');
        return view('ppdb.registration-2', [
            'title'         => 'Pendaftaran Siswa Baru | '. config('app.name'),
            'step'          => 2,
            'registrasi'    => $registrasi
        ]);
    }

    public function postRegistration2(Request $request){
        $validatedData = $request->validate([
            'asal_sekolah'  => 'required',
            'nisn'          => 'min:10|numeric|required',
            'no_ijazah'     => 'min:16|nullable',
            'no_skhun'      => 'min:7|nullable',
            'no_kip'        => 'min:7|nullable',
            'nama_kip'      => 'max:255'
        ]);

        $registrasi = $request->session()->get('registrasi');
        $registrasi->fill($validatedData);
        $request->session()->put('registrasi', $registrasi);

        return redirect('/dashboard/ppdb/registrasi-step3');
    }

    public function registration3(Request $request){
        $registrasi = $request->session()->get('registrasi');
        return view('ppdb.registration-3', [
            'title'         => 'Pendaftaran Siswa Baru | '. config('app.name'),
            'step'          => 3,
            'registrasi'    => $registrasi
        ]);
    }

    public function postRegistration3(Request $request){
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

        return redirect('/dashboard/ppdb/registrasi-step4');
    }

    public function registration4(Request $request){
        $registrasi = $request->session()->get('registrasi');
        return view('ppdb.registration-4', [
            'title'     => 'Pendaftaran Siswa Baru | '. config('app.name'),
            'step'      => 4,
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::all(),
            'registrasi'    => $registrasi
        ]);
    }

    public function finishRegistration(Request $request){
        $validatedData = $request->validate([
            'jurusan_id'   => 'required',
            'kelas_id'     => 'required',
        ]);

        $registrasi = $request->session()->get('registrasi');
        $registrasi->fill($validatedData);
        $request->session()->put('registrasi', $registrasi);

        $registrasi->save();

        session()->forget('registrasi');
        return redirect('/dashboard/ppdb')->with('success', 'Data berhasil disimpan!');
    }

    // detail
    public function show($id){
        return view('ppdb.detail',[
            'title'     => 'Detail Siswa Baru | '. config('app.name'),
            'ppdb'      => PPDB::with('jurusan')->whereId($id)->first()
        ]);
    }

    public function edit($id){
        $provinces= Province::pluck('name', 'code');
        return view('ppdb.edit',[
            'title'     => 'Edit Siswa Baru | '. config('app.name'),
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::all(),
            'provinces'     => $provinces,
            'ppdb'      => PPDB::with('dokumen')->whereId($id)->first(),
        ]);
    }

     public function update(Request $request){
        $validatedData = $request->validate([
            'nama_siswa'        => 'required',
            'jk'                => 'required',
            'nik'               => 'min:16|required|numeric',
            'tempat_lahir'      => 'required',
            'tgl_lahir'         => 'required',
            'no_hp'             => 'max:13',
            'alamat'            => 'max:255',
            'provinsi'          => 'max:64',
            'kabupaten'         => 'max:64',
            'kecamatan'         => 'max:64',
            'kelurahan'         => 'max:64',
            'jml_saudara_kandung'   => 'max:1',
            'asal_sekolah'      => 'required',
            'nisn'              => 'min:10|numeric|required',
            'no_ijazah'         => 'min:16|nullable',
            'no_skhun'          => 'min:7|nullable',
            'no_kip'            => 'min:7|nullable',
            'nama_kip'          => 'max:255',
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
            'jurusan_id'        => 'required',
            'kelas_id'          => 'required',
        ]);

        $ruleDocument = [
            'kartu_keluarga'        => 'file|mimes:pdf|max:2048',
            'ijazah'                => 'file|mimes:pdf|max:2048',
            'akte'                  => 'file|mimes:pdf|max:2048',
            'ktp_ortu'              => 'file|mimes:pdf|max:2048',
            'berkas'                => 'file|mimes:pdf|max:2048',
        ];

        $documents = $request->validate($ruleDocument);

        if ($request->file('kartu_keluarga')) {
            if($request->old_kartu_keluarga){
                Storage::delete($request->old_kartu_keluarga);
            }
            $documents['kartu_keluarga'] = $request->file('kartu_keluarga')->store('dokumen/' . $validatedData['nisn'] . '_' . $validatedData['nama_siswa']);
        }
        if ($request->file('ijazah')) {
            if($request->old_ijazah){
                Storage::delete($request->old_ijazah);
            }
            $documents['ijazah'] = $request->file('ijazah')->store('dokumen/' . $validatedData['nisn'] . '_' . $validatedData['nama_siswa']);
        }
        if ($request->file('akte')) {
            if($request->old_akte){
                Storage::delete($request->old_akte);
            }
            $documents['akte'] = $request->file('akte')->store('dokumen/' . $validatedData['nisn'] . '_' . $validatedData['nama_siswa']);
        }
        if ($request->file('ktp_ortu')) {
            if($request->old_ktp_ortu){
                Storage::delete($request->old_ktp_ortu);
            }
            $documents['ktp_ortu'] = $request->file('ktp_ortu')->store('dokumen/' . $validatedData['nisn'] . '_' . $validatedData['nama_siswa']);
        }
        if ($request->file('berkas')) {
            if($request->old_berkas){
                Storage::delete($request->old_berkas);
            }
            $documents['berkas'] = $request->file('berkas')->store('dokumen/' . $validatedData['nisn'] . '_' . $validatedData['nama_siswa']);
        }

        // update tabel dokumen
        Dokumen::updateOrCreate(
            ['nisn'     => $validatedData['nisn']],
            $documents
        );

        PPDB::where('id', $request->id)
            ->update($validatedData);

        return redirect('/dashboard/ppdb')->with('success', 'Data ' . $request->nama_siswa . ' berhasil diubah!');
    }

    public function delete($id){
        $data = PPDB::find($id);
        $data->delete();

        return redirect('/dashboard/ppdb')->with('success', 'Data calon siswa berhasil dihapus!');
    }

    public function deleteAll(Request $request){
        if($request->sub_check != ''){
            $data = $request->sub_check;
            DB::table('p_p_d_b_s')->whereIn('id', $data)->delete();
            return redirect('/dashboard/ppdb')->with('success', 'Data calon siswa berhasil dihapus!');
        }else{
            return redirect('/dashboard/ppdb')->with('error', 'Tidak ada data yang dipilih!');
        }
    }

    public function approve(Request $request){
        if($request->sub_check != ''){
            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $day = Carbon::now()->format('d');

            // query ke tabel ppdb berdasarkan status confirm nya masih 0
            $data = $request->sub_check;
            $ppdb = PPDB::where('confirmed', 0)->whereIn('id', $data)->get();

            // lakukan perulangan untuk setiap row
            foreach ($ppdb as $value) {
                // query ke tabel siswa untuk ambil kode nis terakhir berdasarkan tahun dibuat
                $cekSiswa = DB::table('siswas')
                ->select(DB::raw('MAX(RIGHT(nis, 3)) as lastNis'))
                ->where(DB::raw('YEAR(created_at)'), $year);
                // cek hasil query
                if($cekSiswa->count() > 0){
                    // jika ditemukan lebih dari 0, karena bentuknya  array maka lakukan perulangan
                    foreach($cekSiswa->get() as $row){
                        // buat variabel untuk menampung nis terakhir
                        $new_nis = $row->lastNis;
                    }
                }else{
                    // jika hasil query null/kurang dari 0,
                    // buat nilai kode nis default dengan '001'
                    $new_nis = '001';
                }
                // karena variabel new_nis berbentuk string buat variabel temp(sementara) dan ubah nilai new_nis ke integer dengan penambahan 1
                $temp = ((int)$new_nis) + 1;
                // masukan temp yang telah ditambah 1 ke variabel code dengan menambahkan 3 digit 0 di depan angka sehingga menjadi string lagi
                $code = sprintf('%03s', $temp);
                // gabungkan tahun bulan dan hari dengan kode yang telah dibuat kedalam variabel nis
                $nis = $year . $month . $day . $code;


                $nisn_siswa = Siswa::select('nisn')
                                ->where('nisn', $value->nisn)
                                ->whereNotNull('nisn')
                                ->get();

                if($nisn_siswa->count() > 0){
                    return redirect('/dashboard/ppdb')->with('error', 'Proses approve berhenti! ada duplikasi NISN, silahkan periksa lagi data PPDB');
                }else{
                    // kemudian insert ke tabel siswa
                    Siswa::create([
                        'nis'                   => $nis,
                        'nisn'                  => $value->nisn,
                        'jurusan_id'            => $value->jurusan_id,
                        'kelas_id'              => $value->kelas_id,
                        'nama_siswa'            => $value->nama_siswa,
                        'jk'                    => $value->jk,
                        'tempat_lahir'          => $value->tempat_lahir,
                        'tgl_lahir'             => $value->tgl_lahir,
                        'no_hp'                 => $value->no_hp,
                        'tahun_ajaran'          => date('Y') . '/' . date('Y')+1,
                        'nik'                   => $value->nik,
                        'alamat'                => $value->alamat,
                        'provinsi'              => $value->provinsi,
                        'kabupaten'             => $value->kabupaten,
                        'kecamatan'             => $value->kecamatan,
                        'kelurahan'             => $value->kelurahan,
                        'asal_sekolah'          => $value->asal_sekolah,
                        'no_ijazah'             => $value->no_ijazah,
                        'no_skhun'              => $value->no_skhun,
                        'no_kip'                => $value->no_kip,
                        'nama_kip'              => $value->nama_kip,
                        'nama_ayah'             => $value->nama_ayah,
                        'nik_ayah'              => $value->nik_ayah,
                        'tgl_lahir_ayah'        => $value->tgl_lahir_ayah,
                        'pendidikan_ayah'       => $value->pendidikan_ayah,
                        'pekerjaan_ayah'        => $value->pekerjaan_ayah,
                        'penghasilan_ayah'      => $value->penghasilan_ayah,
                        'nama_ibu'              => $value->nama_ibu,
                        'nik_ibu'               => $value->nik_ibu,
                        'tgl_lahir_ibu'         => $value->tgl_lahir_ibu,
                        'pendidikan_ibu'        => $value->pendidikan_ibu,
                        'pekerjaan_ibu'         => $value->pekerjaan_ibu,
                        'penghasilan_ibu'       => $value->penghasilan_ibu,
                        'jml_saudara_kandung'   => $value->jml_saudara_kandung,
                    ]);

                    // create akun siswa
                    User::create([
                        'name'      => $value->nama_siswa,
                        'username'  => $value->nisn,
                        'password'  => Hash::make($value->nisn),
                        'role'      => 'siswa'
                    ]);

                    PPDB::where('id', $value->id)
                        ->update([
                            'confirmed' => true
                        ]);
                }
            }
            return redirect('/dashboard/ppdb')->with('success', 'Data PPDB berhasil di approve!');
        }else{
            return redirect('/dashboard/ppdb')->with('error', 'Tidak ada data yang dipilih!');
        }
    }

    public function export(){
        return Excel::download(new PPDBExport, 'data-ppdb.xlsx');
    }
}
