<?php

use App\Http\Controllers\SubmissionsController;
use Illuminate\Support\Facades\Route;

Route::post('submit', [SubmissionsController::class, 'submit']);
