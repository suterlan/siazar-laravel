<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        return view('website.index',[
            'jurusans'  => Jurusan::all()
        ]);
    }

    public function jurusan(){
        return view('website.jurusan',[
            'jurusans'  => Jurusan::all()
        ]);
    }

    public function pendidik(){
        return view('website.pendidik');
    }

    public function galeri(){
        return view('website.galeri');
    }

    public function blog(){
        return view('website.blog');
    }

    public function tentang(){
        return view('website.tentang');
    }

    public function kontak(){
        return view('website.kontak');
    }
}
