<?php

namespace App\Jobs;

use App\Mail\addToShortcut;
use App\Mail\addToShortcutMail;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class sendAcceptJob implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $customJob;
    protected $interview;
    public function __construct($user, $customJob, $interview)
    {
        $this->user = $user;
        $this->customJob = $customJob;
        $this->interview = $interview;
    }


    public function handle()
    {
        try{
            Mail::to($this->user->email)->send(new addToShortcutMail($this->user,$this->customJob, $this->interview));
        }
        catch(Exception $e){
            Log::error('Error in Job: ' . $e->getMessage());
        }
    }
}
