<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssueCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $issue;

    public function __construct($issue)
    {
        $this->issue = $issue;
    }

    public function build()
    {
        return $this->view('emails.issueCreated')
            ->with(['issue' => $this->issue])
            ->subject('New Support Ticket: ' . $this->issue->ticket_number);
    }
}