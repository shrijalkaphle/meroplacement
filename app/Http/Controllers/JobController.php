<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use App\Models\JobPost;
use App\Models\Company;
use App\Models\Industry;
use App\Models\PremiumJob;
use App\Models\SiteSetting;
use App\Models\PremiumApplicant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller {
    
    public function activejob() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        $companies = Company::all();
        $jobs = JobPost::where(['status' => 'active'])->orderBy('id','desc')->paginate(15);
        return view('admin.jobs.active',compact('jobs','industries','companies','sitesetting'));
    }

    public function activejob_store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        $input['status'] = 'active';
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
        return redirect()->route('job.active')->with('success','New Job Post Created!');
    }

    public function activejob_edit($id) {
        $sitesetting = SiteSetting::first();
        $job = JobPost::findorfail($id);
        $industries = Industry::orderBy('title')->get();
        $companies = Company::all();
        return view('admin.jobs.edit.edit',compact('job','industries','companies','sitesetting'));
    }

    public function activejob_update(Request $request, $id) {
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
        $this->countJob();
        return redirect()->route('job.active')->with('success','Job Post updated!');
    }

    public function activejob_delete($id) {
        $job = JobPost::findorfail($id);
        $job->delete();
        $this->countJob();
        return redirect()->route('job.active')->with('success','Job Post deleted!');
    }

    public function pendingjob() {
        $sitesetting = SiteSetting::first();
        $jobs = JobPost::where(['status' => 'pending'])->orderBy('id','desc')->paginate(15);
        return view('admin.jobs.pending',compact('jobs','sitesetting'));
    }

    public function pendingjob_activate($id) {
        $job = JobPost::findorfail($id);
        $job->update(['status' => 'active']);
        $this->countJob();
        return redirect()->route('job.pending')->with('success','Job Post has been activated!');
    }

    public function pendingjob_delete($id) {
        $job = JobPost::findorfail($id);
        $job->delete();
        $this->countJob();
        return redirect()->route('job.pending')->with('success','Job Post deleted!');
    }

    public function premiumjob() {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('title')->get();
        $companies = Company::all();
        $jobs = PremiumJob::orderBy('id','desc')->paginate(15);
        return view('admin.jobs.premium',compact('jobs','industries','companies','sitesetting'));
    }

    public function premiumjob_store(Request $request) {
        $input = $request->all();
        $input['slug'] = $this->slugify($input['title']);
        if($request->file('logo')) {
            $newname = 'jobpost/' . "jobpost-".uniqid()."." . $request->file('logo')->getClientOriginalExtension();
            $imagepath = 'uploads/' . $newname;
            Image::make($request->file('logo'))->resize(600, 600, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($imagepath));
            $input['logo'] = $newname;
        }
        PremiumJob::create($input);
        return redirect()->route('job.premium')->with('success','Premium Job Post created!');
    }

    public function premiumjob_edit($id) {
        $sitesetting = SiteSetting::first();
        $job = PremiumJob::findorfail($id);
        $industries = Industry::orderBy('title')->get();
        $companies = Company::all();
        return view('admin.jobs.edit.premium',compact('job','industries','companies','sitesetting'));
    }

    public function premiumjob_update($id, Request $request) {
        $job = PremiumJob::findorfail($id);
        $input = $request->all();
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
        return redirect()->route('job.premium')->with('success','Premium Job Post updated!');
    }

    public function premiumjob_destroy($id) {
        $job = PremiumJob::findorfail($id);
        PremiumApplicant::where(['premium_job_id' => $id])->delete();
        $job->delete();
        return redirect()->route('job.premium')->with('success','Premium Job Post deleted!');
    }
    
    public function expiredjob() {
        $sitesetting = SiteSetting::first();
        $jobs = JobPost::where(['status' => 'expired'])->orderBy('id','desc')->paginate(15);
        return view('admin.jobs.expired',compact('jobs','sitesetting'));
    }
    
    public function repostjob(Request $request) {
        $job = JobPost::findorfail($request->job_id);
        $job->update(['status' => 'active','deadline' => $request->deadline]);
        $this->countJob();
        return redirect()->route('job.expired')->with('success','Job has been re-posted!');
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
}
