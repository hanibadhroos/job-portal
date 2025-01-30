<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobs;

    public function __construct($jobs)
    {
        $this->jobs = $jobs;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Alert Mail',
        );
    }


    public function content()
    {
        // return new Content(
        //     markdown: 'emails.job_alert',
        // );
        return $this->subject('وظائف جديدة متاحة اليوم!')
                    ->markdown('emails.job_alert')
                    ->with('jobs', $this->jobs);
    }

    public function attachments(): array
    {
        return [];
    }
}
