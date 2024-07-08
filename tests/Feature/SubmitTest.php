<?php

namespace Tests\Feature;

use App\Events\SubmissionSavedEvent;
use App\Jobs\StoreSubmissionJob;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SubmitTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const URL = '/api/submit';


    public function test_success_submit()
    {
        $data = $this->prepareData();

        $response = $this->postJson(self::URL, $data);

        $response->assertOk()
            ->assertJsonPath('data.message', 'Form submitted successfully');

        $this->assertDatabaseHas(Submission::class, $data);
    }

    private function prepareData(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->sentence,
        ];
    }

    public function test_job_dispatched()
    {
        Bus::fake();
        $data = $this->prepareData();
        $this->postJson(self::URL, $data);

        Bus::assertDispatched(StoreSubmissionJob::class, function (StoreSubmissionJob $job) use ($data) {
            return $job->name === $data['name'];
        });
    }

    public function test_job_dispatched_on_queue()
    {
        Queue::fake();
        $data = $this->prepareData();
        $this->postJson(self::URL, $data);

        Queue::assertPushed(StoreSubmissionJob::class);
    }

    public function test_event_dispatched()
    {
        Event::fake();
        $data = $this->prepareData();
        $this->postJson(self::URL, $data);

        $submission = Submission::first();

        Event::assertDispatched(SubmissionSavedEvent::class, function (SubmissionSavedEvent $e) use ($submission) {
            return $e->submission->id === $submission->id;
        });

    }

    public function test_name_not_provided()
    {
        $data = $this->prepareData();
        unset($data['name']);
        $response = $this->postJson(self::URL, $data);
        $response->assertJsonValidationErrorFor('name');
    }

    public function test_email_not_valid()
    {
        $data = $this->prepareData();
        $data['email'] = 'someteststring';
        $response = $this->postJson(self::URL, $data);
        $response->assertJsonValidationErrorFor('email');
    }
}
