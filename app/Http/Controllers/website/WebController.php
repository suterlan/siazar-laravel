<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Iklan;
use App\Models\Jurusan;
use App\Models\Post;
use App\Models\Sekolah;
use App\Models\Tentang;
use Carbon\Carbon;

use function PHPUnit\Framework\isTrue;

class WebController extends Controller
{
    protected $setting;
    protected $iklan;
    public function __construct()
    {
        $this->setting = Sekolah::first();
        $this->iklan = Iklan::first();
    }
    public function index(){
        return view('website.index',[
            'iklan'     => $this->iklan,
            'setting'   => $this->setting,
            'jurusans'  => Jurusan::all(),
            'tentang'   => Tentang::first(),
            'posts'     => Post::latest()->with('category')->limit(3)->get(),
            'slides'    => Galeri::where('slide_aktif', true)->get()
        ]);
    }

    public function jurusan(){
        return view('website.jurusan', [
            'setting'   => $this->setting,
            'jurusans'  => Jurusan::all(),
            'slides'    => Galeri::where('slide_aktif', true)->get()
        ]);
    }

    public function pendidik(){

        $guru = Guru::select('nama', 'nuptk', 'nik')
                ->with(['dokumen' => function($query){
                    $query->select('nik','foto');
                }])->get();

        return view('website.pendidik',[
            'setting'   => $this->setting,
            'gurus'     => $guru
        ]);
    }

    public function galeri(){
        $kategori_gambar = Jurusan::select('kode')->get();

        return view('website.galeri',[
            'setting'   => $this->setting,
            'kategoris' => $kategori_gambar,
            "gambars"   => Galeri::select('jurusan_id', 'caption', 'gambar')->where('slide_aktif', true)->get()
        ]);
    }

    public function tentang(){
        $guru = Guru::select('nama', 'nuptk', 'nik')
                ->with(['dokumen' => function($query){
                    $query->select('nik','foto');
                }])->get();
        return view('website.tentang',[
            'setting'   => $this->setting,
            'tentang'   => Tentang::first(),
            'gurus'     => $guru
        ]);
    }

    public function kontak(){
        return view('website.kontak',[
            'setting'   => $this->setting,
        ]);
    }

    public function blog(){
        return view('website.blog',[
            'setting'   => $this->setting,
            'title'     => 'Blog',
            'posts'     => Post::latest()->with('category')->paginate(10)
        ]);
    }

    public function singleBlog(Post $post){
        $kategoris = Post::selectRaw('category_id, count(category_id) as jml_kategori')
                    ->with('category')
                    ->groupBy('category_id')
                    ->get();

        return view('website.blog-single',[
            'setting'   => $this->setting,
            'tentang'   => Tentang::select('visi')->first(),
            'post'      => $post,
            'kategoris'  => $kategoris
        ]);
    }

    public function blogCategories(Category $category){
        return view('website.blog',[
            'setting'   => $this->setting,
            'title'     => "Post Kategori : $category->name",
            'posts'     => Post::where('category_id', $category->id)->with('category')->paginate(6),
        ]);
    }
}
