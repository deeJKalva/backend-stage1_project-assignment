<?php

use App\Http\Controllers\School_classController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/class', [School_classController::class, 'index']);
Route::post('/class', [School_classController::class, 'store']);
Route::get('/class/{name}', [School_classController::class, 'show']);
Route::patch('/class/{name}', [School_classController::class, 'update']);
Route::delete('/class/{name}', [School_classController::class, 'destroy']);

Route::get('/student', [StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'store']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::patch('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

Route::get('/subject', [SubjectController::class, 'index']);
Route::post('/subject', [SubjectController::class, 'store']);
Route::get('/subject/{name}', [SubjectController::class, 'show']);
Route::patch('/subject/{name}', [SubjectController::class, 'update']);
Route::delete('/subject/{name}', [SubjectController::class, 'destroy']);

Route::get('/score', [ScoreController::class, 'index']);
Route::post('/score', [ScoreController::class, 'store']);
Route::get('/score/{id}', [ScoreController::class, 'show']);
Route::patch('/score/{id}', [ScoreController::class, 'update']);