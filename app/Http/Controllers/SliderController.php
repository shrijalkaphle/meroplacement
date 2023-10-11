<?php

namespace App\Http\Controllers;

use Image;
use File;
use App\Models\Slider;
use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller {

    public function index() {
        $sitesetting = SiteSetting::first();
        $sliders = Slider::orderBy('id','desc')->paginate(15);
        return view('admin.sliders.index',compact('sliders','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        if($request->file('photo')) {
            $newname = 'slider/' . "slider-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            $path = public_path().'/uploads/slider';
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            Image::make($request->file('photo'))->save(public_path($imagepath));
            $input['photo'] = $newname;
        }
        Slider::create($input);
        return redirect()->route('slider.index')->with('success','New Slider Image added!');
    }
    
    public function update(Request $request, $id) {
        $slider = Slider::findorfail($id);
        $input = $request->all();
        if($request->file('photo')) {
            Storage::disk('public')->delete($slider->photo);
            $newname = 'slider/' . "slider-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            $path = public_path().'/uploads/slider';
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            Image::make($request->file('photo'))->save(public_path($imagepath));
            $input['photo'] = $newname;
        } else {
            unset($input['photo']);
        }
        $slider->update($input);
        return redirect()->route('slider.index')->with('success','Slider Image updated!');
    }
    
    public function destroy($id) {
        $slider = Slider::findorfail($id);
        Storage::disk('public')->delete($slider->photo);
        $slider->delete();
        return redirect()->route('slider.index')->with('success','Slider Image deleted!');
    }
}
