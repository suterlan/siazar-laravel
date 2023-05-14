<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Galeri;
use App\Models\Iklan;
use App\Models\Jurusan;
use App\Models\Post;
use App\Models\Sekolah;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsTrue;

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

    public function blog(){
        return view('website.blog',[
            'setting'   => $this->setting,
            'title'     => 'Semua Postingan',
            'posts'     => Post::latest()->with('category')->paginate(6)
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
