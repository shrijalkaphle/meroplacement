<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Task;
use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $blogs = Task::orderBy('id','desc')->paginate(15);
        return view('admin.task.index',compact('blogs','sitesetting'));
    }
    
    public function store(Request $request) {
 
       
        $input = $request->all();
         if ($image = $request->file('image')) {
            $destinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }
       
        Task::create($input);

        
        return redirect()->route('task.index')->with('success','New Task created!');
    }
    
    public function edit($id) {
        $sitesetting = SiteSetting::first();
        $blog = Task::findorfail($id);
        return view('admin.task.edit',compact('blog','sitesetting'));
    }
    
    public function update(Request $request, $id) {
        $blog = Task::findorfail($id);
        $input = $request->all();
          if ($image = $request->file('image')) {
            $destinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }else{
            unset($input['image']);
        } 
     
        $blog->update($input);
        return redirect()->route('task.index')->with('success','Task updated!');
    }
    
    public function destroy($id) {
        $blog = Task::findorfail($id);
        $blog->delete();
        return redirect()->route('task.index')->with('success','Task deleted!');
    }

    public function show($id) {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $blog = Task::where(['id' => $$id])->first();
        return view('frontend.task-single',compact('sitesetting','blog'));
    }

  
}
