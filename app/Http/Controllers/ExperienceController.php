<?php

namespace App\Http\Controllers;

use Session;
use App\Models\JobSeeker;
use App\Models\JobSeekerExperience;

use Illuminate\Http\Request;

class ExperienceController extends Controller {
    
    public function store(Request $request) {
        $input = $request->all();
        JobSeekerExperience::create($input);
        return redirect()->back()->with('success', 'Work Experience has been added!');
    }

    public function update(Request $request, $id) {
        $experience = JobSeekerExperience::findorfail($id);
        $input = $request->all();
        $experience->update($input);
        return redirect()->back()->with('success', 'Work Experience has been updated!');
    }

    public function destroy($id) {
        $experience = JobSeekerExperience::findorfail($id);
        $experience->delete();
        return redirect()->back()->with('success', 'Work Experience has been deleted!');
    }
}
