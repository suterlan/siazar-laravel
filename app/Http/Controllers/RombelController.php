<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index(){
        $kelas = Kelas::with(['siswas', 'guru'])->get();
        return view('siswa-group.index', [
            'title'     => 'Siswa Rombel | '. config('app.name'),
            'kelas'     => $kelas,
        ]);
    }
}
