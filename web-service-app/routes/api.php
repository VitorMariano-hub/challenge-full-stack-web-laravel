<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\StudentController;

Route::prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class)->middleware('cors');
});