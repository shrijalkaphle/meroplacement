<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use App\Models\JobPost;
use App\Models\CVRequest;
use App\Models\ContactForm;
use App\Models\SiteSetting;
use App\Models\Vacancy;
use App\Models\CVDownloadRequest;

use Illuminate\Http\Request;

class AdminController extends Controller {
    
    public function dashboard() {
        $cvrequest = CVDownloadRequest::where(['status' => 1])->get();
        $sitesetting = SiteSetting::first();
        $totalJob = JobPost::count();
        $active =  JobPost::where(['status' => 'active'])->count();
        $pending =  JobPost::where(['status' => 'pending'])->count();
        $expired =  JobPost::where(['status' => 'expired'])->count();
        $totalJobseeker =  User::where(['role' => 'jobseeker'])->count();
        $totalEmployee =  User::where(['role' => 'employee'])->count();
        $cvaccess = CVRequest::where(['status' => 0])->get();
        $vacancy = Vacancy::orderBy('id','desc')->take(10)->get();
        return view('admin.dashboard',compact('sitesetting','totalJob','totalJobseeker','totalEmployee','cvrequest','cvaccess','vacancy', 'active', 'pending', 'expired'));
    }
    
    
     public function contact() {
        $sitesetting = SiteSetting::first();
        $contacts = ContactForm::orderBy('id','desc')->paginate(15);
        return view('admin.contact',compact('contacts', 'sitesetting'));
    }

    public function viewCV() {
        $sitesetting = SiteSetting::first();
        $users = User::where(['role' => 'jobseeker'])->orderBy('id','desc')->paginate(15);
        return view('admin.cv.index',compact('users','sitesetting'));
    }
    


    public function grantAccess($id) {
        $access_till = Carbon::now()->addDay(7);
        CVRequest::where(['id' => $id])->update([
            'status'        =>  1,
            'access_till'   =>  $access_till
        ]);
        return redirect()->back()->with('success', 'CV Request Granted!');
    }

    public function delete_contact($id) {
        $contact = ContactForm::findorfail($id);
        $contact->delete();
        return redirect()->back()->with('success', 'Contact Record deleted!');
    }
    
      public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        
        ContactForm::whereIn('id', $ids)->delete();
        return redirect()->back();
    }
    
    public function deleteAccess($id) {
        CVRequest::where(['id' => $id])->delete();
        return redirect()->back()->with('success', 'CV Request deleted!');
    }
    
    public function access_list($id) {
        $sitesetting = SiteSetting::first();
        $cvrequest = CVRequest::findorfail($id);
        return view('admin.cv.cv-list',compact('cvrequest','sitesetting'));
    }
}
