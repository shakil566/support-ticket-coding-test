<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssueUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $issue;

    public function __construct($issue)
    {
        $this->issue = $issue;
    }

    public function build()
    {
        return $this->view('emails.issueUpdated')
            ->with(['issue' => $this->issue])
            ->subject('Update Info Support Ticket: ' . $this->issue->ticket_number);
    }
}