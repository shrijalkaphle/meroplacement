<?php

namespace App\Http\Controllers;

use Session;
use App\Models\JobSeeker;
use App\Models\JobSeekerEducation;

use Illuminate\Http\Request;

class EducationController extends Controller {
    
    public function store(Request $request) {
        $input = $request->all();
        JobSeekerEducation::create($input);
        return redirect()->back()->with('success', 'Education detail has been added!');
    }

    public function update (Request $request, $id) {
        $education = JobSeekerEducation::findorFail($id);
        $input = $request->all();
        $education->update($input);
        return redirect()->back()->with('success', 'Education detail has been updated!');
    }

    public function destroy ($id) {
        $education = JobSeekerEducation::findorFail($id);
        $education->delete();
        return redirect()->back()->with('success', 'Education detail has been deleted!');
    }
}
