<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'title'     => 'Post | '. config('app.name'),
            'posts'     => Post::latest()->with('category')->paginate(10),
            'categorys' => Category::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'title'     => 'Buat Post | '. config('app.name'),
            'kategori'  => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|max:255',
            'slug'      => 'required|unique:posts',
            'category_id'   => 'required',
            'body'          => 'required',
            'image'         => 'image|file|max:2048|mimes:jpg,png'
        ]);

        if($request->file('image')){
            $validated['image'] = $request->file('image')->store('img/post');
        }

        $validated['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::create($validated);
        return redirect('/dashboard/posts')->with('success', 'Postingan baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.detail', [
            'title' => 'Detail View Post | '. config('app.name'), 
            'post'  => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'title'     => 'Edit Post | '. config('app.name'),
            'kategori'  => Category::select('id', 'name')->get(),
            'post'      => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $ruleValidate = [
            'title'         => 'required|max:255',
            'category_id'   => 'required',
            'body'          => 'required',
            'image'         => 'image|file|max:2048|mimes:jpg,png'
        ];

        if($request->slug != $post->slug){
            $ruleValidate['slug']  = 'required|unique:posts';
        }

        $validated = $request->validate($ruleValidate);

        $validated['excerpt'] = Str::limit(strip_tags($request->body), 100);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('img/post');
        }

        Post::where('id', $post->id)
            ->update($validated);
        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image){
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil dihapus!');
    }

    public function setSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
