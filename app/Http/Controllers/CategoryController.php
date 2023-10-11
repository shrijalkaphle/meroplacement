<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller {
    
    public function index() {
        $categories = Category::orderBy('id','desc')->paginate(10);
        return view('admin.category.index',compact('categories'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('photo')) {
            $file = $request->file('photo')->store('category', ['disk' => 'public']);;
            $newname = 'category/' . "category-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            Storage::disk('public')->move($file, $newname);
            $input['photo'] = $newname;
        }
        Category::create($input);
        return redirect()->route('category.index')->with('success','New Category added!');
    }
    
    public function edit($id) {
        $category = Category::findorfail($id);
        return view('admin.category.edit',compact('category'));
    }
    
    public function update(Request $request, $id) {
        $category = Category::findorfail($id);
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('photo')) {
            Storage::disk('public')->delete($category->photo);
            $file = $request->file('photo')->store('category', ['disk' => 'public']);;
            $newname = 'category/' . "category-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            Storage::disk('public')->move($file, $newname);
            $input['photo'] = $newname;
        }
        $category->update($input);
        return redirect()->route('category.index')->with('success','Category updated!');
    }
    
    public function destroy($id) {
        $category = Category::findorfail($id);
        Storage::disk('public')->delete($category->photo);
        $category->delete();
        return redirect()->route('category.index')->with('success','Category deleted!');
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
