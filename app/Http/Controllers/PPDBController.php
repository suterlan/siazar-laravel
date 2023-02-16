<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\PPDB;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class PPDBController extends Controller
{
    public function  index(){
        if (auth()->user()->role != 1) {
            $data = PPDB::latest()
                        ->where('id', auth()->user()->id)
                        ->where('confirmed', 0)
                        ->get();
        }else{
            $data = PPDB::with('jurusan')->latest()->where('confirmed', 0)->get();
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

        $jurusan = PPDB::select('p_p_d_b_s.jurusan_id', 'jurusans.kode as kode', 'jurusans.nama as nama', DB::raw('count(jurusans.id) as countJurusan'))
                        ->join('jurusans', 'p_p_d_b_s.jurusan_id', 'jurusans.id')
                        ->groupBy('p_p_d_b_s.jurusan_id', 'kode', 'nama')
                        ->where('p_p_d_b_s.confirmed', 0)
                        ->get();
                        
        return view('ppdb.index',[
            'title'     => 'PPDB | SIAZAR',
            'jmlCalonSiswa' => PPDB::where('confirmed', 0)->count(),
            'jmlPerempuan'  => PPDB::where('confirmed', 0)->where('jk', 'Perempuan')->count(),
            'jmlLakiLaki'   => PPDB::where('confirmed', 0)->where('jk', 'Laki-Laki')->count(),
            'jurusan'       => $jurusan,
            'btnClass'  => $disabled,
            'ppdbs'     => $data,
        ]);
    }

    public function registration1(Request $request){
        $provinces= Province::pluck('name', 'code');
        $registrasi = $request->session()->get('registrasi');
        return view('ppdb.registration-1', [
            'title'         => 'Pendaftaran Siswa Baru | SIAZAR',
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
            'title'         => 'Pendaftaran Siswa Baru | SIAZAR',
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
            'title'         => 'Pendaftaran Siswa Baru | SIAZAR',
            'step'          => 3,
            'registrasi'    => $registrasi
        ]);
    }

    public function postRegistration3(Request $request){
        $validatedData = $request->validate([
            'nama_ayah'         => 'nullable',
            'nik_ayah'          => 'min:16|numeric|nullable',
            'tgl_lahir_ayah'    => 'date|nullable',
            'pendidikan_ayah'   => 'max:32',
            'pekerjaan_ayah'    => 'max:64',
            'penghasilan_ayah'  => 'numeric|nullable',
            'nama_ibu'          => 'required',
            'nik_ibu'           => 'min:16|numeric|nullable',
            'tgl_lahir_ibu'     => 'date|nullable',
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
            'title'     => 'Pendaftaran Siswa Baru | SIAZAR',
            'step'      => 4,
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::select('id', 'nama')->get(),
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

    public function getKabupaten(Request $request){
        $kabupaten = City::select('code', 'name')->where('province_code', $request->code)->get();
        return response()->json($kabupaten);
    }

    public function getKecamatan(Request $request){
        $kecamatan = District::select('code', 'name')->where('city_code', $request->code)->get();
        return response()->json($kecamatan);
    }

    public function getKelurahan(Request $request){
        $kelurahan = Village::select('code', 'name')->where('district_code', $request->code)->get();
        return response()->json($kelurahan);
    }

    // detail
    public function show($id){
        return view('ppdb.detail',[
            'title'     => 'Detail Siswa Baru | SIAZAR',
            'ppdb'      => PPDB::whereId($id)->first()
        ]);
    }

    public function edit($id){
        $provinces= Province::pluck('name', 'code');
        return view('ppdb.edit',[
            'title'     => 'Edit Siswa Baru | SIAZAR',
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::select('id', 'nama')->get(),
            'provinces'     => $provinces,
            'ppdb'      => PPDB::whereId($id)->first(),
        ]);
    }

     public function update(Request $request){
        $validatedData = $request->validate([
            'nama_siswa'        => 'required',
            'jk'                => 'required',
            'nik'               => 'min:16|required|numeric',
            'tempat_lahir'      => 'required',
            'tgl_lahir'         => 'required',
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
            'tgl_lahir_ayah'    => 'date|nullable',
            'pendidikan_ayah'   => 'max:32',
            'pekerjaan_ayah'    => 'max:64',
            'penghasilan_ayah'  => 'numeric|nullable',
            'nama_ibu'          => 'required',
            'nik_ibu'           => 'min:16|numeric|nullable',
            'tgl_lahir_ibu'     => 'date|nullable',
            'pendidikan_ibu'    => 'max:32',
            'pekerjaan_ibu'     => 'max:64',
            'penghasilan_ibu'   => 'numeric|nullable',
            'jurusan_id'        => 'required',
            'kelas_id'          => 'required',
        ]);

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

    public function approve(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        
        
        // query ke tabel ppdb berdasarkan status confirm nya masih 0
        $ppdb = PPDB::where('confirmed', 0)->get();

        // lakukan perulangan untuk setiap row  
        foreach ($ppdb as $value) {   
            // query ke tabel siswa untuk ambil kode nis terakhir berdasarkan tahun dibuat
            $cekNis = DB::table('siswas')
            ->select(DB::raw('MAX(RIGHT(nis, 3)) as lastNis'))
            ->where(DB::raw('YEAR(created_at)'), $year);
            // cek hasil query
            if($cekNis->count() > 0){
                // jika ditemukan lebih dari 0, karena bentuknya  array maka lakukan perulangan 
                foreach($cekNis->get() as $row){
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
                'tahun_ajaran'          => date('Y') . '/' . date('Y')+1,
                'nik'                   => $value->nik,
                'alamat'                => $value->alamat,
                'provinsi'              => $value->provinsi,
                'kabupaten'             => $value->kabupaten,
                'kecamatan'             => $value->kecamatan,
                'kelurahan'             => $value->keluarahan,
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
                'tgl_lahir_ibu'         => $value-> tgl_lahir_ibu,
                'pendidikan_ibu'        => $value->pendidikan_ibu,
                'pekerjaan_ibu'         => $value->pekerjaan_ibu,
                'penghasilan_ibu'       => $value->penghasilan_ibu,
                'jml_saudara_kandung'   => $value->jml_saudara_kandung,
            ]);
            PPDB::where('id', $value->id)
                ->update([
                    'confirmed' => true
                ]);
        }
        return redirect('/dashboard/ppdb')->with('success', 'Data PPDB berhasil di approve!');
    }
}
