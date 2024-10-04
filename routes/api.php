<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherScheduleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students/filter', [StudentController::class, 'filter'])->name('students.filter');
Route::post('/save-schedule', [TeacherScheduleController::class, 'saveSchedule'])->name('teachers.schedule');
Route::get('/teachers/{userId}/schedule', [TeacherScheduleController::class, 'getTeacherSchedule']);
Route::get('/classes/{classId}/schedule', [ClassController::class, 'getClassSchedule']);
Route::delete('/delete-schedule/{id}', [TeacherScheduleController::class, 'deleteSchedule'])->name('delete.schedule');