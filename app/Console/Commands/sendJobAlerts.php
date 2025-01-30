<?php

namespace App\Console\Commands;

use App\Mail\newJobPosted;
use App\Models\Job;
use App\Models\User;
use App\Notifications\newJobPosted as NotificationsNewJobPosted;
use Illuminate\Console\Command;

class sendJobAlerts extends Command
{


    protected $signature = 'app:send-job-alerts';


    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::with('job_alert')->get();  //// Return all user with them alerts

        foreach($users as $user){
            $alerts = $user->job_alert;
            if($alerts){
                $matchingJobs = Job::matchingJobs($alerts);

                if ($matchingJobs->isNotEmpty()) {
                    $user->notify( new NotificationsNewJobPosted($matchingJobs));
                }
            }

        }
        $this->info('Job notifications has been send successfully.');
    }
}
