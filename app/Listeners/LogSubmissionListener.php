<?php

namespace App\Listeners;

use App\Events\SubmissionSavedEvent;
use Illuminate\Support\Facades\Log;

class LogSubmissionListener
{
    public function __construct()
    {
    }

    public function handle(SubmissionSavedEvent $event): void
    {
        Log::info('Submission saved', [
            'name' => $event->submission->name,
            'email' => $event->submission->email,
        ]);
    }
}
