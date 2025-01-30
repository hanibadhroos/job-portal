<?php

namespace App\Jobs;

use App\Mail\JobAlertMail;
use App\Models\Job;
use App\Models\JobAlertSubscription;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailyJobAlerts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {

    }


    public function handle(): void
    {
        $todayJobs = Job::whereDate('created_at', Carbon::today())->get(); // الوظائف المنشورة اليوم

        if ($todayJobs->isEmpty()) {
            return; // لا توجد وظائف جديدة، لا حاجة للإرسال
        }

        $subscriptions = JobAlertSubscription::with('user')->get();

        foreach ($subscriptions as $subscription) {
            $filteredJobs = $todayJobs->filter(function ($job) use ($subscription) {
                return (
                    // تصفية حسب الفئات
                    (empty($subscription->categories) || in_array($job->category, json_decode($subscription->categories, true))) &&

                    // تصفية حسب الموقع
                    (empty($subscription->location) || $job->location === $subscription->location) &&

                    // تصفية حسب نوع الوظيفة
                    (empty($subscription->job_type) || $job->job_type === $subscription->job_type)
                );
            });

            // إرسال البريد فقط إذا كانت هناك وظائف متطابقة
            if ($filteredJobs->isNotEmpty()) {
                Mail::to($subscription->user->email)->send(new JobAlertMail($filteredJobs));
            }
        }
    }
}
