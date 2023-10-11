<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class PeriodicController extends Controller {
    
    public function check_expire() {
        $jobpost=JobPost::where(['status' => 'active'])->get();
        foreach($jobpost as $j) {
            $now = Date('Y-m-d');
            $deadline = Date($j->deadline);
            if($now>$deadline) {
                $update = JobPost::where(['id' => $j->id])
                    ->update([
                        'status'    =>  'expired'
                ]);
                Industry::where(['id'=>$j->industry_id])->decrement('job_count',1);
            }
        }

        // premium job
        $premiumjob = PremiumJob::where(['status' => 1])->get();
        foreach($premiumjob as $j) {
            $now = Date('Y-m-d');
            $deadline = Date($j->job_deadline);
            if($now>$deadline) {
                $update = PremiumJob::where(['id' => $j->id])
                    ->update([
                        'status'    =>  '0'
                ]);
            }
        }
    }

    public function newsletter_mail() {
        
    }
}
