<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\JobPost;
use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to user weekly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $sitesetting = SiteSetting::first();
        $users = User::where(['role' => 'jobseeker'])->get();
        foreach($users as $user) {
            if($user->jobseeker->preference->industry_id) {
                $jobs = JobPost::where(['industry_id' => $user->jobseeker->preference->industry_id,'status' => 'active'])->limit(6)->get();
                if($jobs->isNotEmpty()) {
                    $details = [
                        'logo'  =>  $sitesetting->logo,
                        'name'  =>  $user->name,
                        'jobs'  =>  $jobs
                        ];
                    Mail::to($user->email)->queue(new \App\Mail\WeeklyMail($details));
                }
            }
        }
    }
}
