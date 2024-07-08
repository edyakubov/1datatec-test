<?php

namespace App\Jobs;

use App\Events\SubmissionSavedEvent;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly string $name, public readonly string $email, public readonly string $message)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message
        ]);

        SubmissionSavedEvent::dispatch($submission);
    }
}
