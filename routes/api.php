<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::post('/tasks', [TaskController::class, 'store']);

Route::post('/tasks/multiple', [TaskController::class, 'storeMultiple']);