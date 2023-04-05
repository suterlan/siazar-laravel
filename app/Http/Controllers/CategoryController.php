<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required',
            'slug'  => 'required|unique:categories'
        ]);
        Category::create($validated);
        return redirect('/dashboard/posts')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $rule = [
            '_name'  => 'required',
        ];
        if ($category->slug != $request->_slug) {
            $rule['_slug'] = 'required|unique:categories,slug';
        }
        $validated = $request->validate($rule);

        $data = [
            'name'  => $validated['_name'],
        ];
        if(isset($request->_slug)){
            $data['slug']  = $validated['_slug'];
        }

        Category::where('id', $category->id)
            ->update($data);

        return redirect('/dashboard/posts')->with('success', 'Kategori berhasil diubah!');
    }

    public function destroy(Category $category){
        Category::destroy($category->id);
        return redirect('/dashboard/posts')->with('success', 'Kategori berhasil diubah!');
    }

    public function setSlug(Request $request){
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
