<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/classes/male', [ClassController::class, 'getMaleClasses']);
Route::get('/classes/female', [ClassController::class, 'getFemaleClasses']); 