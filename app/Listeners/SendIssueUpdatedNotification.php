<?php

namespace App\Listeners;

use App\Events\IssueUpdated;
use App\Mail\IssueUpdatedMail;
use Illuminate\Support\Facades\Mail;

class SendIssueUpdatedNotification
{
    public function handle(IssueUpdated $event)
    {
        $issue = $event->issue;

        // queue the email
        // Mail::to($issue->user->email)->queue(new IssueUpdatedMail($issue));

        // send the email directly
        Mail::to($issue->user->email)->send(new IssueUpdatedMail($issue));
    }
}