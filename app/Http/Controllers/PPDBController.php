<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
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
            $data = PPDB::latest()->where('id', auth()->user()->id)->get();
        }else{
            $data = PPDB::latest()->get();
        }
        return view('ppdb.index',[
            'title'     => 'PPDB | SIAZAR',
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
            'nisn'          => 'min:10|numeric|nullable',
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
            'registrasi'    => $registrasi
        ]);
    }

    public function finishRegistration(){
        $registrasi = session()->get('registrasi');
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

    public function delete($id){
        $data = PPDB::find($id);
        $data->delete();

        return redirect('/dashboard/ppdb')->with('success', 'Data calon siswa berhasil dihapus!');
    }

    public function deleteAll(Request $request){
        $data = $request->sub_check;
        DB::table('p_p_d_b_s')->whereIn('id', $data)->delete();
        return redirect('/dashboard/ppdb')->with('success', 'Data calon siswa berhasil dihapus!');
    }

    public function generate(){
        $ppdb = PPDB::get();
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $nis = $year . $month . $day;

        foreach ($ppdb as $index => $value) {
            echo '0'.$index + 1 .'.'. $value->nama_siswa;    
        }
    }
}
