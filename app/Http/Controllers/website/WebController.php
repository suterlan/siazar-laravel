<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Sekolah;
use App\Models\Tentang;
use Illuminate\Http\Request;

class WebController extends Controller
{
    protected $setting;
    public function __construct()
    {
        $this->setting = Sekolah::first();
    }

    // website controller index
    public function index(){
        return view('website.index',[
            'setting'   => $this->setting,
            'jurusans'  => Jurusan::all(),
            'tentang'   => Tentang::first()
        ]);
    }

    public function jurusan(){
        return view('website.jurusan',[
            'setting'   => $this->setting,
            'jurusans'  => Jurusan::all()
        ]);
    }

    public function pendidik(){
        return view('website.pendidik',[
            'setting'   => $this->setting,
        ]);
    }

    public function galeri(){
        return view('website.galeri',[
            'setting'   => $this->setting,
        ]);
    }

    public function blog(){
        return view('website.blog',[
            'setting'   => $this->setting,
        ]);
    }

    public function tentang(){
        return view('website.tentang',[
            'setting'   => $this->setting,
            'tentang'   => Tentang::first()
        ]);
    }

    public function kontak(){
        return view('website.kontak',[
            'setting'   => $this->setting,
        ]);
    }
}
