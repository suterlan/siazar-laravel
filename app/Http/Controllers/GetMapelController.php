<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class GetMapelController extends Controller
{
     public function getMapel(Request $request){
        $mapel = Mapel::select('id', 'kode', 'nama')->where('guru_id', $request->id)->get();
        return response()->json($mapel);
    }
}
