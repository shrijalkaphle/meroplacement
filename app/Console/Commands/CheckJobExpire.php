<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\JobPost;
use App\Models\PremiumJob;
use Illuminate\Console\Command;

class CheckJobExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:jobexpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Job Expired';

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
        $jobs = JobPost::where(['status' => 'active'])->get();
        foreach($jobs as $job) {
            $deadline = $job->deadline;
            if(Carbon::createFromFormat('Y-m-d', $deadline)->isPast()) {
                $job->update(['status' => 'expired']);
            }
        }

        $premiumJobs = PremiumJob::where(['status' => 1])->get();
        foreach($premiumJobs as $job) {
            $deadline = $job->deadline;
            if(Carbon::createFromFormat('Y-m-d', $deadline)->isPast()) {
                $job->update(['status' => 0]);
            }
        }
    }
}
