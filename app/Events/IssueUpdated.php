<?php

namespace App\Events;

use App\Models\Issue;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IssueUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $issue;

    /**
     * Create a new event instance.
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }
}