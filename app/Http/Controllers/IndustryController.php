<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Industry;
use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustryController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('id','desc')->paginate(10);
        return view('admin.industry.index',compact('industries','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('photo')) {
            $newname = 'industry/' . "industry-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            $img = Image::make($request->file('photo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['photo'] = $newname;
        }
        Industry::create($input);
        return redirect()->route('industry.index')->with('success','New Industry added!');
    }
    
    public function edit($id) {
        $sitesetting = SiteSetting::first();
        $industry = Industry::findorfail($id);
        return view('admin.industry.edit',compact('industry','sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $industry = Industry::findorfail($id);
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('photo')) {
            Storage::disk('public')->delete($industry->photo);
            $newname = 'industry/' . "industry-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('photo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['photo'] = $newname;
        }
        $industry->update($input);
        return redirect()->route('industry.index')->with('success','Industry updated!');
    }
    
    public function destroy($id) {
        $industry = Industry::findorfail($id);
        Storage::disk('public')->delete($industry->photo);
        $industry->delete();
        return redirect()->route('industry.index')->with('success','Industry deleted!');
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
