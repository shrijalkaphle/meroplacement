<?php

namespace App\Http\Controllers;

use Image;
use Session;
use App\Models\User;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\Industry;
use App\Models\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller {
    public function dashboard() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        $user = User::where(['id' => Session::get('user')['userid']])->first();
        return view('employee.dashboard',compact('user','industries','sitesetting'));
    }

    public function logoupdate(Request $request) {
        $input = $request->all();
        $company = Company::where(['user_id' => Session::get('user')['userid']])->first();
        if($request->file('logo')) {
            Storage::disk('public')->delete($company->logo);
            $newname = 'employee/' . "employee-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('logo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['logo'] = $newname;
        }
        $company->update($input);
        return redirect()->back();
    }

    public function updateEmployee(Request $request, $id) {
        $user = User::findorfail($id);
        $company = Company::where(['user_id' => $id])->first();
        $input = $request->all();
        $input['slug'] = $this->slugify($input['name']);
        $user->update($input);
        $company->update($input);
        return redirect()->route('employee.dashboard')->with('success', 'Employee login crediential updated!');
    }

    public function create_job() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        return view('employee.jobs.post',compact('industries','sitesetting'));
    }

    public function store_job(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        $company = Company::where(['user_id' => Session::get('user')['userid']])->first();
        $input['company_id'] = $company->id;
        if($request->file('logo')) {
            $newname = 'jobpost/' . "jobpost-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('logo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['logo'] = $newname;
        }
        JobPost::create($input);
        $this->countJob();
        return redirect()->route('employee.jobpost.view')->with('success','New Job Post Created!');
    }

    public function view_job() {
        $sitesetting = SiteSetting::first();
        $user = User::findorfail(Session::get('user')['userid']);
        $jobs = JobPost::where(['company_id' => $user->company->id])->get();
        return view('employee.jobs.view',compact('jobs','sitesetting'));
    }

    public function edit_job($id) {
        $sitesetting = SiteSetting::first();
        $job = JobPost::findorfail($id);
        $industries = Industry::orderBy('title')->get();
        return view('employee.jobs.edit',compact('job','industries','sitesetting'));
    }

    public function update_job(Request $request, $id) {
        $job = JobPost::findorfail($id);
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('logo')) {
            Storage::disk('public')->delete($job->logo);
            $newname = 'jobpost/' . "jobpost-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('logo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['logo'] = $newname;
        }
        $job->update($input);
        return redirect()->route('employee.jobpost.view')->with('success','Job Post updated!');
    }

    public function destroy_job($id) {
        $job = JobPost::findorfail($id);
        Applicant::where(['job_post_id' => $id])->delete();
        $job->delete();
        return redirect()->route('employee.jobpost.view')->with('success','Job Post deleted!');
    }
    
    public function repost_job(Request $request, $id) {
        $job = JobPost::findorfail($id);
        $input = $request->all();
        $input['status'] = 'pending';
        $job->update($input);
        return redirect()->route('employee.jobpost.view')->with('success','Job has been re-posted confirmation!');
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

    public function countJob() {
        $industries = Industry::all();
        foreach($industries as $i) {
            $input['job_count'] = JobPost::where([
                'industry_id' => $i->id,
                'status'      => 'active',
            ])->count();
            $i->update($input);
        }
    }

    public function viewAllApplicant() {
        $sitesetting = SiteSetting::first();
        $employee = Company::where(['user_id' => Session::get('user')['userid']])->first();
        $jobs = JobPost::withcount('applicant')->where(['company_id' => $employee->id])->paginate(15);
        return view('employee.applicant.applicants',compact('jobs','sitesetting'));
    }

    public function viewApplicant($id) {
        $sitesetting = SiteSetting::first();
        $job = JobPost::findorfail($id);
        return view('employee.applicant.view',compact('job','sitesetting'));
    }
}
