<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitSubmissionRequest;
use App\Jobs\StoreSubmissionJob;

class SubmissionsController extends Controller
{
    public function submit(SubmitSubmissionRequest $request)
    {
        try {
            StoreSubmissionJob::dispatch(
                $request->name,
                $request->email,
                $request->message
            );
            return response()->json([
                    'data' => [
                        'message' => 'Form submitted successfully',
                        'status' => 'success'
                    ]]
            );
        } catch (\Throwable $e) {
            return response()->json([
                    'data' => [
                        'message' => 'Something went wrong :(',
                        'status' => 'failed',
                        'error' => $e->getMessage()
                    ]]
            );
        }
    }
}
