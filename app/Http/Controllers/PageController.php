<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\Industry;
use App\Models\Training;
use App\Models\PremiumJob;
use App\Models\ContactForm;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\PaymentMethod;

use Session;

use Illuminate\Http\Request;

class PageController extends Controller {
    
    public function landing() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $sliders = Slider::all();
        $premiumJobs = PremiumJob::where(['status' => 1])->orderBy('id','desc')->get();
        $jobs = JobPost::where(['status' => 'active'])->orderBy('id','desc')->take(45)->get();
        $industries = Industry::orderBy('job_count', 'desc')->get();
        $employees = User::where(['role' => 'employee', 'email_verified' => 1])->orderBy('id','desc')->get();
        $trainings = Training::where(['status' => 1])->orderBy('id','desc')->take(5)->get();
        return view('frontend.index',compact('industries','jobs','sitesetting','premiumJobs','trainings','sliders','employees'));
    }

    public function about() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $testimonials = Testimonial::all();
        return view('frontend.about',compact('sitesetting','testimonials'));
    }
    public function training() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $trainings = Training::where(['status' => 1])->orderBy('id','desc')->get();
        return view('frontend.training',compact('sitesetting','trainings'));
    }

    public function blog() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $blogs = Blog::orderBy('id','desc')->get();
        return view('frontend.blog',compact('sitesetting','blogs'));
    }

    public function contact() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        return view('frontend.contact',compact('sitesetting'));
    }

    public function registerpage() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $industries = Industry::orderBy('title')->get();
        return view('frontend.register',compact('industries','sitesetting'));
    }

    public function loginpage() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        return view('frontend.login',compact('sitesetting'));
    }
    
    public function viewjob($slug) {
        $sitesetting = SiteSetting::first();
        JobPost::where(['slug' => $slug])->increment('views');

        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $job = JobPost::where(['slug' => $slug])->withcount('applicant')->first();
        $industries = Industry::orderBy('job_count','desc')->get();
        return view('frontend.job-single',compact('job', 'sitesetting','industries'));
    }

    public function industry_job($slug) {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        $industries = Industry::orderBy('job_count','desc')->get();
        $industry = Industry::where(['slug' => $slug])->first();
        return view('frontend.industry-job',compact('industry','sitesetting','industries'));
    }
    
    public function company_job($slug) {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        
        $industries = Industry::orderBy('job_count','desc')->get();
        $company = Company::where(['slug' => $slug])->first();
        return view('frontend.company',compact('company','sitesetting','industries'));
    }

    public function termscondition() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        return view('frontend.terms-condition',compact('sitesetting'));
    }

    public function forgotpassword() {
        $sitesetting = SiteSetting::first();
        if($sitesetting == null) {
            $sitesetting = SiteSetting::create();
        }
        return view('frontend.forgot-password',compact('sitesetting'));
    }

    public function sumbitContact(Request $request) {
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
        
        'mobile' => 'required',
            

        ]);
        
        $input = $request->all();

        ContactForm::create($input);
        return redirect()->back()->with("success","Form Sumbited! We will get back to you as soon as possible!");
    }

    public function payment_method() {
        $payments = PaymentMethod::all();
        $sitesetting = SiteSetting::first();
        return view('frontend.payment',compact('sitesetting','payments'));
    }
}
