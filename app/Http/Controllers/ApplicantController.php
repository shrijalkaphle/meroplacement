<?php

namespace App\Http\Controllers;

use Session;
use App\Models\JobPost;
use App\Models\JobSeeker;
use App\Models\Applicant;
use App\Models\PremiumJob;
use App\Models\SiteSetting;
use App\Models\PremiumApplicant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller {
    
    public function index() {
        $sitesetting = SiteSetting::first();
        $jobs = JobPost::withcount('applicant')->orderBy('created_at')->paginate(20);
        return view('admin.applicant.index',compact('jobs','sitesetting'));
    }
    
    public function show($id) {
        $sitesetting = SiteSetting::first();
        $job = JobPost::findorfail($id);
        return view('admin.applicant.view',compact('job','sitesetting'));
    }
    
    public function applyJob(Request $request) {
        $input = $request->all();
        if($request->session()->get('user')['role'] == 'jobseeker') {
            $seeker = JobSeeker::where(['user_id' => $request->session()->get('user')['userid']])->first();
            $input['job_seeker_id'] = $seeker->id;
            $check = Applicant::where([
                'job_seeker_id' =>  $input['job_seeker_id'],
                'job_post_id'   =>  $input['job_post_id']
            ])->first();
            if($check) {
                return response()->json([
                    'status'    =>  'error',
                    'msg'       =>  'You may have already apply for this job! Contact for more information!'
                ]);
            } else {
                Applicant::create($input);
                return response()->json([
                    'status'    =>  'success',
                    'msg'       =>  ' You have applied for this job!'
                ]);
            }
        } else {
            return response()->json([
                'status'    =>  'error',
                'msg'       =>  'Only JobSeeker can apply for the job!'
            ]);
        }
    }

    public function premiumjob_applicant($id) {
        $sitesetting = SiteSetting::first();
        $job = PremiumJob::findorfail($id);
        return view('admin.jobs.applicants.premium',compact('job','sitesetting'));
    }

    public function applypremiumJob(Request $request) {
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
        
        "resume" => "required|mimes:pdf|max:10000"
        ]);
        
        $input = $request->all();
        $check = PremiumApplicant::where([
            'email'             =>  $input['email'],
            'premium_job_id'    =>  $input['premium_job_id']
        ])->first();
        if($check) {
            return redirect()->back()->with('applyerror', 'Email already exists');
        } else {
            if($request->file('resume')) {
                $file = $request->file('resume');
                $new_name = "uploadcv-".uniqid()."." . $file->getClientOriginalExtension();
                $new_path = "uploadcv/" . $new_name;
                Storage::disk('public')->putFileAs('uploadcv', $file, $new_name);
                $input['resume'] = $new_path;
            }
            PremiumApplicant::create($input);
            return redirect()->back()->with('applysuccess', 'Applied for the job!');
        }
    }
    
    public function premiumjob_applicant_delete($id) {
        $applicant = PremiumApplicant::findorfail($id);
        Storage::disk('public')->delete($applicant->resume);
        $applicant->delete();
        return redirect()->back()->with('success', 'Applicant record deleted!');
    }

    public function update_applicant($id,$status) {
        $applicant = Applicant::findorfail($id);
        if($status == 'interview') {
            $details = [
                'name'      =>  $applicant->jobseeker->user->name,
                'status'    =>  'selected for ' . $status,
                'job'       =>  $applicant->jobpost->title
            ];
            $applicant->jobseeker->user->notify(new \App\Notifications\ApplicantNotify($details));
        } else if ($status == 'selected') {
            $details = [
                'name'      =>  $applicant->jobseeker->user->name,
                'status'    =>  'selected ' . $status,
                'job'       =>  $applicant->jobpost->title
            ];
            $applicant->jobseeker->user->notify(new \App\Notifications\ApplicantNotify($details));
        }
        $applicant->update(['status' => $status]);
        return response()->json(['data' => $status]);
    }
}
