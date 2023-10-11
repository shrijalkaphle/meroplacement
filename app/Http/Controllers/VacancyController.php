<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Vacancy;
use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VacancyController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $blogs = Vacancy::orderBy('id','desc')->paginate(15);
        return view('admin.vacancy.index',compact('blogs','sitesetting'));
    }
    
    public function store(Request $request) {
        $input = $request->all();
       
        Vacancy::create($input);
        return redirect()->route('vacancy.index')->with('success','New Vacancy Post created!');
    }
    
    public function edit($id) {
        $sitesetting = SiteSetting::first();
        $blog = Vacancy::findorfail($id);
        return view('admin.vacancy.edit',compact('blog','sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $blog = Vacancy::findorfail($id);
        $input = $request->all();
     
        $blog->update($input);
        return redirect()->route('vacancy.index')->with('success','Blog Post updated!');
    }
    
    public function destroy($id) {
        $blog = Vacancy::findorfail($id);
        $blog->delete();
        return redirect()->route('vacancy.index')->with('success','Vacancy Post deleted!');
    }

    public function show($id) {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $blog = Vacancy::where(['id' => $$id])->first();
        return view('frontend.vacancy-single',compact('sitesetting','blog'));
    }

  
}
