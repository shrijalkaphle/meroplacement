<?php

namespace App\Http\Controllers;

use App\Models\UploadCV;
use App\Models\SiteSetting;
use Session;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadCVController extends Controller {
    public function index() {
        $sitesetting = SiteSetting::first();
        $uploads = UploadCV::orderBy('id','desc')->paginate(15);
        return view('admin.uploadcv.index',compact('uploads','sitesetting'));
    }
    
    public function store(Request $request) {

         $request->validate([
             
             'g-recaptcha-response'    =>     function ($attribute, $value, $fail) {
                $secretkey = config('services.recaptcha.secret');
                $response = $value;
                $ip = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if(!$response->success){
                    Session::flash('success', 'Please check reCaptcha');
                    Session::flash('alert-class', "alert-danger");
                   $fail($attribute. "google reCatpha failed"); 
                }
        },
   
            'cv'      => "required|mimes:pdf|max:10000"
        ]);

        $input = $request->all();
        if($request->file('cv')) {
            $file = $request->file('cv');
            $new_name = "uploadcv-".uniqid()."." . $file->getClientOriginalExtension();
            $new_path = "uploadcv/" . $new_name;
            Storage::disk('public')->putFileAs('uploadcv', $file, $new_name);
            $input['cv'] = $new_path;
        }
        UploadCV::create($input);
        return redirect()->back()->with('success', 'CV uploaded!');
    }
    
    public function update(Request $request, $id) {
         $request->validate([
     
            'cv'      => "required|mimes:pdf|max:10000"
        ]);

        $upload = UploadCV::findorfail($id);
        $input = $request->all();
        if($request->file('cv')) {
            Storage::disk('public')->delete($upload->cv);
            $file = $request->file('cv');
            $new_name = "uploadcv-".uniqid()."." . $file->getClientOriginalExtension();
            $new_path = "uploadcv/" . $new_name;
            Storage::disk('public')->putFileAs('uploadcv', $file, $new_name);
            $input['cv'] = $new_path;
        }
        $upload->update($input);
        return redirect()->back()->with('success', 'CV updated!');
    }
    
    public function destroy($id) {
        $upload = UploadCV::findorfail($id);
        Storage::disk('public')->delete($upload->cv);
        $upload->delete();
        return redirect()->back()->with('success', 'CV deleted!');
    }
}
