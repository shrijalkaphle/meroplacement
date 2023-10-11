<?php

namespace App\Http\Controllers;

use Image;
use Session;
use App\Models\User;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\Industry;
use App\Models\Applicant;
use App\Models\JobSeeker;
use App\Models\UserSocial;
use App\Models\SiteSetting;
use App\Models\Qualification;
use App\Models\JobSeekerPreference;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    
    public function useradmin() {
        $sitesetting = SiteSetting::first();
        $users = User::whereIn('role', ['admin', 'staff'])->orderBy('id','desc')->paginate(15);
        return view('admin.user.admin',compact('users','sitesetting'));
    }

    public function useradmin_store(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role'] = $input['role'];
        $input['email_verified'] = '1';
        $check = User::where(['email' => $input['email']])->first();
        if($check) {
            return redirect()->route('user.admin')->with('error', 'User already exists with this email!');
        }
        User::create($input);
        return redirect()->route('user.admin')->with('success', 'New admin login crediential created!');
    }

    public function useradmin_edit($id) {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail($id);
        return view('admin.user.edit.admin',compact('user','sitesetting'));
    }

    public function useradmin_update(Request $request, $id) {
        $user = User::findorfail($id);
        $input = $request->all();
        if($request->password) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user->update($input);
        return redirect()->route('user.admin')->with('success', 'Admin login crediential updated!');
    }

    public function useradmin_destroy($id) {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->route('user.admin')->with('success', 'Admin login crediential deleted!');
    }

    public function useremployee() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        $users = User::where(['role' => 'employee'])->orderBy('id','desc')->paginate(15);
        return view('admin.user.employee',compact('users','industries','sitesetting'));
    }

    public function useremployee_store(Request $request) {
                    
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
        'photo' => 'required|image|mimes:jpg,png,jpeg',
            

        ]);
        
        $input = $request->all();
        $check = User::where(['email' => $input['email']])->first();
        if($check) {
            return redirect()->route('user.employee')->with('error', 'User with email already exists!');
        } else {

            $input['role'] = 'employee';
            $input['password'] = Hash::make($input['password']);
            if($request->file('logo')) {
                $file = $request->file('logo')->store('employee', ['disk' => 'public']);;
                $newname = 'employee/' . "employee-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
                Storage::disk('public')->move($file, $newname);
                $input['logo'] = $newname;
            }
            $user = User::create($input);
            $input['user_id'] = $user->id;
            $input['slug'] = $this->slugify($input['name']);
            Company::create($input);
            return redirect()->route('user.employee')->with('success', 'Employee login crediential created!');
        }
    }

    public function useremployee_edit($id){
        $sitesetting = SiteSetting::first();
        $user = User::findorfail($id);
        $industries = Industry::orderBy('title')->get();
        return view('admin.user.edit.employee',compact('user','industries','sitesetting'));
    }

    public function useremployee_update(Request $request, $id){
        $user = User::findorfail($id);
        $company = Company::where(['user_id' => $id])->first();
        $input = $request->all();
        $input['slug'] = $this->slugify($input['name']);
        if($request->password == null) {
            unset($input['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }
        if($request->file('logo')) {
            Storage::disk('public')->delete($company->logo);
            $file = $request->file('logo')->store('employee', ['disk' => 'public']);;
            $newname = 'employee/' . "employee-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
            Storage::disk('public')->move($file, $newname);
            $input['logo'] = $newname;
        }
        $user->update($input);
        $company->update($input);
        return redirect()->route('user.employee')->with('success', 'Employee login crediential updated!');
    }

    public function useremployee_destroy($id){
        $user = User::findorfail($id);
        $company = Company::where(['user_id' => $id])->first();
        if($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $user->delete();
        return redirect()->back()->with('success', 'Employee login crediential deleted!');
    }
    
    
       public function deleteAllEmployee(Request $request)
    {
        $ids = $request->ids;
        
        User::whereIn('id', $ids)->delete();
        return redirect()->back();
    }

    public function userjobseeker() {
        $sitesetting = SiteSetting::first();
        $users = User::with('jobseeker.preference')->where(['role' => 'jobseeker'])->orderBy('id','desc')->paginate(15);
        return view('admin.user.jobseeker',compact('users','sitesetting'));
    }

    public function userjobseeker_create() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        return view('admin.user.create.jobseeker',compact('industries','sitesetting'));
    }

    public function userjobseeker_store(Request $request) {
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
            

        ]);
        
        $input = $request->all();
        // return $input;
        $check = User::where(['email' => $input['email']])->first();
        if($check) {
            return redirect()->route('user.jobseeker.create')->with('error', 'User with email already exists!')->withInput();
        } else {
            $input['email_verified'] = '1';
            $input['role'] = 'jobseeker';
            $input['password'] = Hash::make($input['password']);
            if($request->file('photo')) {
                $newname = 'jobseeker/' . "jobseeker-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
                $imagepath = 'uploads/' . $newname;
                Image::make($request->file('photo'))->resize(600, 600, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path($imagepath));
                $input['photo'] = $newname;
            }
            $user = User::create($input);
            $input['user_id'] = $user->id;
            $seeker = JobSeeker::create($input);
            $input['job_seeker_id'] = $seeker->id;
            JobSeekerPreference::create($input);
            return redirect('/user/jobseeker/' . $user->id . '/additional')->with('success', 'JobSeeker login crediential created!');
        }
    }

    public function userjobseeker_edit($id) {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail($id);
        $pref = JobSeekerPreference::where(['job_seeker_id' => $user->jobseeker->id])->first();
        if($pref == null) {
            JobSeekerPreference::create(['job_seeker_id' => $user->jobseeker->id]);
            $user = User::findorfail($id);
        }
        $industries = Industry::orderBy('title')->get();
        return view('admin.user.edit.jobseeker',compact('user','industries','sitesetting'));
    }

    public function userjobseeker_update(Request $request, $id) {
        $user = User::findorfail($id);
        $seeker = JobSeeker::where(['user_id' => $id])->first();
        $preference = JobSeekerPreference::where(['job_seeker_id' => $seeker->id])->first();
        $input = $request->all();
        if($request->password == null) {
            unset($input['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }
        if($request->file('photo')) {
            Storage::disk('public')->delete($seeker->photo);
            $newname = 'jobseeker/' . "jobseeker-".uniqid()."." . $request->file('photo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('photo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['photo'] = $newname;
        }
        $user->update($input);
        $seeker->update($input);
        $preference->update($input);
        return redirect('/user/jobseeker/' . $user->id . '/additional')->with('success', 'JobSeeker login crediential updated!');
    } 
    
    public function userjobseeker_destroy($id) {
        $user = User::findorfail($id);
        $seeker = JobSeeker::where(['user_id' => $id])->first();
        if($seeker->photo) {
            Storage::disk('public')->delete($seeker->photo);
        }
        $user->delete();
        return redirect()->route('user.jobseeker')->with('success', 'JobSeeker login crediential deleted!');
    }

    public function jobseeker_additional($id) {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail($id);
        $qualifications = Qualification::all();
        $industries = Industry::all();
        return view('admin.user.create.additional',compact('user','qualifications','industries','sitesetting'));
    }

    public function jobseeker_additional_update(Request $request, $id) {
        $social = UserSocial::where(['user_id' => $id])->first();
        $input = $request->all();
        $social->update($input);
        return redirect()->route('cv.view')->with('success', 'JobSeeker additional detail updated!');
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

    public function changepassword() {
        $role = Session::get('user')['role'];
        $sitesetting = SiteSetting::first();
        if($role == 'jobseeker') {
            return view('jobseeker.change-password',compact('sitesetting'));
        } else if($role == 'employee') {
            return view('employee.change-password',compact('sitesetting'));
        } else {
            return view('admin.changepassword',compact('sitesetting'));
        }
    }

    public function updatepassword($id, Request $request) {
        $user = User::findorfail($id);
        if(Hash::check($request->oldpassword, $user->password)) {
            if($request->newpassword == $request->cnewpassword) {
                if($request->oldpassword == $request->newpassword) {
                    return redirect()->back()->with('error', 'Old and New Password cannot be same!');
                }
                $input['password'] = Hash::make($request->newpassword);
                $user->update($input);
                return redirect()->back()->with('success', 'Password updated!');
            } else {
                return redirect()->back()->with('error', 'Confirm Password did not match!');
            }
        } else {
            return redirect()->back()->with('error', 'Old Password did not match!');
        }
    }
    
    public function activateUser($id) {
        $user = User::findorfail($id);
        $user->update(['email_verified' => 1]);
        return redirect()->back()->with('success', 'User account has been activated!');
    }
}
