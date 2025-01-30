<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class addToShortcutMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $customJob;
    protected $user;
    protected $interview;
    public function __construct($user, $customJob, $interview)
    {
        $this->customJob = $customJob;
        $this->user = $user;
        $this->interview = $interview;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Add To Shortcut',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'addToShortCut',
            with:[
                'job'=>$this->customJob,
                'user'=>$this->user,
                'interview'=>$this->interview
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
