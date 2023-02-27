<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class WilayahIndonesiaController extends Controller
{
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
}
