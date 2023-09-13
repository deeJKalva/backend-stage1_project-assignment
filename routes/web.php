<?php

use App\Http\Controllers\School_classController;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('school_classes', School_classController::class);
Route::resource('students', Student::class);
Route::resource('subjects', Subject::class);
Route::resource('scores', Score::class);