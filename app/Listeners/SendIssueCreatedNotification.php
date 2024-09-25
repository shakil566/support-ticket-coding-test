<?php

namespace App\Listeners;

use App\Events\IssueCreated;
use App\Mail\IssueCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendIssueCreatedNotification
{
    public function handle(IssueCreated $event)
    {
        $issue = $event->issue;

        // get admin emails
        $adminEmailArr = User::where('user_group', '1')->pluck('email')->toArray();

        // Send email to each admin
        if (!empty($adminEmailArr)) {
            foreach ($adminEmailArr as $adminEmail) {
                // queue the email
                // Mail::to($adminEmail)->queue(new IssueCreatedMail($issue));

                // send the email directly
                Mail::to($adminEmail)->send(new IssueCreatedMail($issue));
            }
        }
    }
}