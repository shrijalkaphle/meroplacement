<?php

namespace App\Http\Controllers;

use Image;
use App\Models\SiteSetting;
use App\Models\Testimonial;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $testimonials = Testimonial::orderBy('id','desc')->paginate(15);
        return view('admin.testimonials.index',compact('testimonials','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        if($request->file('image')) {
            $newname = 'testimonial/' . "testimonial-".uniqid()."." . $request->file('image')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('image'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['image'] = $newname;
        }
        Testimonial::create($input);
        return redirect()->route('testimonial.index')->with('success','New Testimonial added!');
    }
    
    public function edit($id) {
        $sitesetting = SiteSetting::first();
        $testimonial = Testimonial::findorfail($id);
        return view('admin.testimonials.edit',compact('testimonial','sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $testimonial = Testimonial::findorfail($id);
        $input = $request->all();
        if($request->file('image')) {
            Storage::disk('public')->delete($testimonial->image);
            $newname = 'testimonial/' . "testimonial-".uniqid()."." . $request->file('image')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('image'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['image'] = $newname;
        }
        $testimonial->update($input);
        return redirect()->route('testimonial.index')->with('success','Testimonial updated!');
    }
    
    public function destroy($id) {
        $testimonial = Testimonial::findorfail($id);
        Storage::disk('public')->delete($testimonial->image);
        $testimonial->delete();
        return redirect()->route('testimonial.index')->with('success','Testimonial deleted!');
    }
}
