<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Models\User;
use App\Models\CVMark;
use App\Models\Company;
use App\Models\JobSeeker;
use App\Models\CVRequest;
use App\Models\SiteSetting;
use App\Models\RequestedCV;
use App\Models\CVAccessList;
use App\Models\CVDownloadRequest;
use App\Models\JobSeekerPreference;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller {
    
    public function viewAll() {
        $sitesetting = SiteSetting::first();
        $cvs = User::where(['role' => 'jobseeker', 'email_verified' => 1])->get();
        $preference = JobSeekerPreference::all();
        $employee = Company::where(['user_id' => Session::get('user')['userid']])->first();
        $mark = CVMark::where(['company_id' => $employee->id])->get();
        return view('employee.cv.search',compact('cvs','sitesetting','preference','mark'));
    }

    public function preview_cv(Request $request) {
        $sitesetting = SiteSetting::first();
        $userid = Session::get('user')['userid'];
        $user = User::findorfail($userid);
        $template = $request->template;
        if($template == 0) {
            $filename = $user->name.'-'.uniqid().'.pdf';
            $pdf = \PDF::loadview('cv.free',compact('user','sitesetting'))->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
            return $pdf->download($filename);
        } else {
            return view('cv.preview.template'.$template, compact('user','template'));
        }
    }

    public function previewCV($userid,$template) {
        $user = User::findorfail($userid);
        return view('cv.template'.$template, compact('user','template'));
    }

    public function requestCV(Request $request) {
        $input = $request->all();
        CVDownloadRequest::create($input);
        return redirect()->route('profile')->with('success', 'CV download request sent!');
    }

    public function deliverCV($id) {
        $cvrequest = CVDownloadRequest::findorfail($id);
        $user = $cvrequest->jobseeker->user;
        $pdf = \PDF::loadview('cv.template'.$cvrequest->template,compact('user'))->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $path = "pdf/" . $user->name . "-" . uniqid().".pdf";
        Storage::disk('public')->put($path, $pdf->output());
        $input['job_seeker_id'] = $cvrequest->job_seeker_id;
        $input['template'] = $cvrequest->template;
        $input['type'] = 'paid';
        $input['file'] = $path;
        RequestedCV::create($input);
        $cvrequest->update(['status' => 0]);
        return redirect()->back()->with('success', 'CV forwarded to JobSeeker!');
    }

    public function markCV($id) {
        // check if exists
        $employee = Company::where(['user_id' => Session::get('user')['userid']])->first();
        $check = CVMark::where(['company_id' => $employee->id, 'job_seeker_id' => $id])->first();
        if($check) {
            CVMark::where(['company_id' => $employee->id, 'job_seeker_id' => $id])->delete();
        } else {
            CVMark::create(['company_id' => $employee->id, 'job_seeker_id' => $id]);
        }

        $count = CVMark::where(['company_id' => $employee->id])->count();
        return response()->json(['count' =>  $count]);
    }

    public function requestAccess() {
        $employee = Company::where(['user_id' => Session::get('user')['userid']])->first();
        $request = CVRequest::create(['company_id' => $employee->id]);
        $cvs = CVMark::where(['company_id' => $employee->id])->get();
        foreach($cvs as $cv) {
            CVAccessList::create(['request_id' => $request->id, 'job_seeker_id' => $cv->job_seeker_id]);
            $cv->delete();
        };
        return redirect()->back();
    }

    public function requestedCV() {
        $sitesetting = SiteSetting::first();
        $employee = Company::where(['user_id' => Session::get('user')['userid']])->first();
        $cvs = JobSeeker::all();
        $preference = JobSeekerPreference::all();
        return view('employee.cv.requested',compact('employee','sitesetting','cvs','preference'));
    }

    public function downloadCV($id){
        $sitesetting = SiteSetting::first();
        $user = User::findorfail($id);
        $filename = $user->name.'-'.uniqid().'.pdf';
        
   

        $pdf = \PDF::loadview('cv.free',compact('user', 'sitesetting'))->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        return $pdf->download($filename);
    }
    
    public function deleteRequestCV($id) {
        $cvrequest = CVDownloadRequest::findorfail($id);
        $cvrequest->delete();
        return redirect()->back()->with('success', 'CV request deleted!');
    }
    
    public function download_request_all() {
        $sitesetting = SiteSetting::first();
        $cvrequests =  CVDownloadRequest::where(['status' => 1])->get();
        return view('admin.cv.cvrequest',compact('sitesetting','cvrequests'));
    }
    
    public function download_access_all() {
        $sitesetting = SiteSetting::first();
        $cvaccess =  CVRequest::where(['status' => 0])->get();
        return view('admin.cv.cvaccess',compact('sitesetting','cvaccess'));
    }
}
