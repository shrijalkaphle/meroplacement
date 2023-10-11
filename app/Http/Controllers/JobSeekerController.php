<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\JobPost;
use App\Models\Industry;
use App\Models\JobSeeker;
use App\Models\UserSocial;
use App\Models\SiteSetting;
use App\Models\Qualification;
use App\Models\JobSeekerReference;
use App\Models\JobSeekerPreference;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobSeekerController extends Controller {
    
    public function view($id) {
        $user = User::findorfail($id);
        return view('cv.view',compact('user'));
    }

    public function dashboard() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        $industryid = 0;
        if($user->jobseeker->preference) {
            $industryid = $user->jobseeker->preference->industry_id;
        }
        $recomended = JobPost::where(['industry_id' => $industryid])->take(10)->get();
        return view('jobseeker.dashboard',compact('user','sitesetting','recomended'));
    }
    
    public function profile_view() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        return view('jobseeker.profile',compact('user','sitesetting'));
    }

    public function changepassword() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        return view('jobseeker.change-password',compact('user','sitesetting'));
    }

    public function profile_edit() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        return view('jobseeker.edit.basic',compact('user','sitesetting'));
    }

    public function preference_edit() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        $user = User::findorfail(Session::get('user')['userid']);
        if(!$user->jobseeker->preference) {
            JobSeekerPreference::create(['job_seeker_id' => $user->jobseeker->id]);
            $user = User::findorfail(Session::get('user')['userid']);
        }
        return view('jobseeker.edit.preference',compact('user','industries','sitesetting'));
    }

    public function education_edit() {
        $sitesetting = SiteSetting::first();
        $qualifications = Qualification::all();
        $user = User::findorfail(Session::get('user')['userid']);
        return view('jobseeker.edit.education',compact('user','qualifications','sitesetting'));
    }

    public function experience_edit() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        $user = User::findorfail(Session::get('user')['userid']);
        return view('jobseeker.edit.experience',compact('user','industries','sitesetting'));
    }

    public function reference_edit() {
        $sitesetting = SiteSetting::first();
        $id = Session::get('user')['userid'];
        $user = User::findorfail(Session::get('user')['userid']);
        $name = $user->name;
        $seeker = JobSeeker::where(['user_id' => $id])->first();
        $reference = JobSeekerReference::where(['job_seeker_id' => $seeker->id])->first();
        if($reference == null) {
            $reference = JobSeekerReference::create(['job_seeker_id' => $seeker->id]);
        }
        return view('jobseeker.edit.reference',compact('reference','name','sitesetting'));
    }

    public function training_edit() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        return view('jobseeker.edit.certificate',compact('user','sitesetting'));
    }

    public function social_edit() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        if($user->social == null) {
            UserSocial::create(['user_id' => $user->id]);
            $user = User::findorfail(Session::get('user')['userid']);
        }
        return view('jobseeker.edit.social',compact('user','sitesetting'));
    }

    public function basic_update(Request $request, $id) {
        $user = User::findorfail($id);
        $seeker = JobSeeker::where(['user_id' => $id])->first();
        $input = $request->all();
        if($request->file('photo')) {
            Storage::disk('public')->delete($seeker->photo);
            $file = $request->file('photo');
            $new_name = "jobseeker-".uniqid()."." . $file->getClientOriginalExtension();
            $new_path = "jobseeker/" . $new_name;
            Storage::disk('public')->putFileAs('jobseeker', $file, $new_name);
            $input['photo'] = $new_path;
        }
        $user->update($input);
        $seeker->update($input);
        return redirect()->back()->with('success', 'Basic Information has been updated!');
    }

    public function preference_update(Request $request, $id) {
        $preference = JobSeekerPreference::findorfail($id);
        $input = $request->all();
        $preference->update($input);
        return redirect()->back()->with('success', 'Job Preference has been updated!');
    }

    public function reference_update(Request $request, $id) {
        $reference = JobSeekerReference::findorfail($id);
        $input = $request->all();
        $reference->update($input);
        return redirect()->back()->with('success', 'JobSeeker Reference has been updated!');
    }

    public function social_update(Request $request, $id) {
        $social = UserSocial::findorfail($id);
        $input = $request->all();
        $social->update($input);
        return redirect()->back()->with('success', 'Social Account has been updated!');
    }

    public function chooseTemplate() {
        $sitesetting = SiteSetting::first();
        return view('jobseeker.cv-template',compact('sitesetting'));
    }
}
