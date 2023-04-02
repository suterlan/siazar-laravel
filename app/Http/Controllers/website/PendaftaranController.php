<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\PPDB;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class PendaftaranController extends Controller
{
    protected $setting;
    public function __construct()
    {
        $this->setting = Sekolah::first();
    }

    public function index(){
        $provinces= Province::pluck('name', 'code');
        return view('website.pendaftaran',[
            'setting'   => $this->setting,
            'provinces' => $provinces,
            'jurusan'   => Jurusan::select('id', 'kode', 'nama')->get(),
            'kelas'     => Kelas::select('id', 'nama')->get(),
        ]);
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

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama_siswa'    => 'required',
            'jk'            => 'required',
            'nisn'          => 'min:10|numeric|required',
            'nik'           => 'min:16|required|numeric',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'alamat'        => 'max:255',
            'no_hp'         => 'max:13',
            'provinsi'      => 'max:64',
            'kabupaten'     => 'max:64',
            'kecamatan'     => 'max:64',
            'kelurahan'     => 'max:64',
            'nama_ayah'      => 'nullable',
            'pekerjaan_ayah' => 'max:64',
            'nama_ibu'       => 'required',
            'pekerjaan_ibu'  => 'max:64',
            'asal_sekolah'  => 'required',
            'jurusan_id'     => 'required',
            'kelas_id'       => 'required',
        ]);

        PPDB::create($validatedData);
        return redirect('/pendaftaran')->with('success', 'Pendaftaran berhasil dikirim');
    }
}
