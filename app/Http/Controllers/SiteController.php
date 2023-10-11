<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        return view('admin.setting.setting',compact('sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $setting = SiteSetting::findorfail($id);
        $input = $request->all();
        if($request->file('favicon')) {
            Storage::disk('public')->delete($setting->favicon);
            $file = $request->file('favicon')->store('setting', ['disk' => 'public']);;
            $newname = 'setting/' . "setting-".uniqid()."." . $request->file('favicon')->getClientOriginalExtension();
            Storage::disk('public')->move($file, $newname);
            $input['favicon'] = $newname;
        }
        if($request->file('training_banner')) {
            Storage::disk('public')->delete($setting->training_banner);
            $file = $request->file('training_banner')->store('setting', ['disk' => 'public']);;
            $newname = 'setting/' . "setting-".uniqid()."." . $request->file('training_banner')->getClientOriginalExtension();
            Storage::disk('public')->move($file, $newname);
            $input['training_banner'] = $newname;
        }
        if($request->file('logo')) {
            Storage::disk('public')->delete($setting->logo);
            $file = $request->file('logo')->store('setting', ['disk' => 'public']);;
            $newname = 'setting/' . "setting-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
            Storage::disk('public')->move($file, $newname);
            $input['logo'] = $newname;
        }
        $setting->update($input);
        return redirect()->route('setting.index')->with('success','Site Setting Updated!');
    }

    public function termsandcondition() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        return view('admin.setting.termscondition',compact('sitesetting'));
    }

    public function termsandcondition_update($id, Request $request) {
        $setting = SiteSetting::findorfail($id);
        $input = $request->all();
        $setting->update($input);
        return redirect()->route('terms.index')->with('success','Terms and Condition Updated!');
    }
}
