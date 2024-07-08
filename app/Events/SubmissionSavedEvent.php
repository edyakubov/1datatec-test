<?php

namespace App\Events;

use App\Models\Submission;
use Illuminate\Foundation\Events\Dispatchable;

class SubmissionSavedEvent
{
    use Dispatchable;

    public function __construct(public readonly Submission $submission)
    {
    }
}
