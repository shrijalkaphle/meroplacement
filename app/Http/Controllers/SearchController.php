<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobPost;
use App\Models\UploadCV;
use App\Models\Industry;
use App\Models\SiteSetting;
use App\Models\Applicant;

use Illuminate\Http\Request;

class SearchController extends Controller {
    
    public function search(Request $request) {
        $sitesetting = SiteSetting::first();
        $industries = Industry::orderBy('job_count','desc')->get();
        if($request->has('search')){
            $search = $request->get('search');
            $str = '%' . $request->get('search') . '%';
            $jobs = JobPost::where('title', 'like', $str)->orWhere('description', 'like', $str)->get();
        }
        return view('frontend.search',compact('sitesetting','jobs','search','industries'));
    }

    public function searchJobSeeker($query) {
        $query = '%'.$query.'%';
        $users = User::with('jobseeker.preference.industry')
            ->where(['role' => 'jobseeker'])
            ->where(function($q) use ($query) {
                $q->where('name', 'like', $query)
                ->orWhere('email', 'like', $query)
                ->orWhere('password', 'like', $query)
                ->orWhereHas('jobseeker.preference.industry', function($q2) use($query) {
                    $q2->where('title', 'like', $query);
                });
            })->get();
        return response()->json(['data' => $users]);
    }
    
    public function searchCV($query) {
        $query = '%'.$query.'%';
        $users = User::with('jobseeker.preference.industry')
            ->with('jobseeker.education.qualification')
            ->with('jobseeker.experience')
            ->with('jobseeker.mark')
            ->where(['role' => 'jobseeker'])
            ->where(function($q) use ($query) {
                $q->WhereHas('jobseeker', function($q1) use($query) {
                    $q1->where('current_address', 'like', $query)
                    ->orWhere('permanent_address', 'like', $query);
                })
                ->orWhereHas('jobseeker.preference.industry', function($q2) use($query) {
                    $q2->where('title', 'like', $query);
                })
                ->orWhereHas('jobseeker.preference', function($q3) use($query) {
                    $q3->where('expected_salary','like',$query);
                })
                ->orWhereHas('jobseeker.education', function($q4) use($query) {
                    $q4->where('program','like',$query);
                })
                ->orWhereHas('jobseeker.education.qualification', function($q5) use($query) {
                    $q5->where('title','like',$query);
                });
            })->get();
        return response()->json(['data' => $users]);
    }
    
    public function searchFile($query) {
        $query = '%'.$query.'%';
        $uploads = UploadCV::where('name', 'like', $query)
                ->orWhere('name', 'like', $query)
                ->orWhere('email', 'like', $query)
                ->orWhere('address', 'like', $query)
                ->orWhere('education', 'like', $query)->get();
        return response()->json(['data' => $uploads]);
    }
    
    


    public function searchJob($query) {
        $query = '%'.$query.'%';
        $jobs = JobPost::with('industry')->with('company.user')
            ->where('title', 'like', $query)
            ->orWhere('description', 'like', $query)
            ->orWhereHas('company.user', function($q) use($query) {
                $q->where('name', 'like', $query);
            })
            ->orWhereHas('industry', function($q) use($query) {
                $q->where('title', 'like', $query);
            })->get();
        return response()->json(['data' => $jobs]);
    }
    
    public function searchEmployee($query) {
        $query = '%'.$query.'%';
        $users = User::with('company.industry')
            ->where(['role' => 'employee'])
            ->where(function($q) use ($query) {
                $q->where('name', 'like', $query)
                ->orWhere('email', 'like', $query)
                ->orWhere('password', 'like', $query);
            })->get();
        return response()->json(['data' => $users]);
    }
}
