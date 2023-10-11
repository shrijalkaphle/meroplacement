<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Qualification;
use App\Models\JobSeekerEducation;

use Illuminate\Http\Request;

class QualificationController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $qualifications = Qualification::orderBy('id', 'desc')->paginate(15);
        return view('admin.qualification.index',compact('qualifications','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($request->title);
        Qualification::create($input);
        return redirect()->route('qualification.index')->with('success', 'New Qualification has been added!');
    }
    
    public function update(Request $request, $id) {
        $qualification = Qualification::findorfail($id);
        $input = $request->all();
        $input['slug'] = $this->slugify($request->title);
        $qualification->update($input);
        return redirect()->route('qualification.index')->with('success', 'Qualification has been updated!');
    }
    
    public function destroy($id) {
        $qualification = Qualification::findorfail($id);
        JobSeekerEducation::where(['qualification_id' => $qualification->id])->delete();
        $qualification->delete();
        return redirect()->route('qualification.index')->with('success', 'Qualification has been deleted!');
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
