<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Blog;
use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $blogs = Blog::orderBy('id','desc')->paginate(15);
        return view('admin.blogs.index',compact('blogs','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('cover')) {
            $newname = 'blog/' . "blog-".uniqid()."." . $request->file('cover')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('cover'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['cover'] = $newname;
        }
        Blog::create($input);
        return redirect()->route('blog.index')->with('success','New Blog Post created!');
    }
    
    public function edit($id) {
        $sitesetting = SiteSetting::first();
        $blog = Blog::findorfail($id);
        return view('admin.blogs.edit',compact('blog','sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $blog = Blog::findorfail($id);
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('cover')) {
            Storage::disk('public')->delete($blog->cover);
            $newname = 'blog/' . "blog-".uniqid()."." . $request->file('cover')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('cover'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['cover'] = $newname;
        }
        $blog->update($input);
        return redirect()->route('blog.index')->with('success','Blog Post updated!');
    }
    
    public function destroy($id) {
        $blog = Blog::findorfail($id);
        Storage::disk('public')->delete($blog->cover);
        $blog->delete();
        return redirect()->route('blog.index')->with('success','Blog Post deleted!');
    }

    public function show($slug) {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $blog = Blog::where(['slug' => $slug])->first();
        return view('frontend.blog-single',compact('sitesetting','blog'));
    }

    public function slugify($text, string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
