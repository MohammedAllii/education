<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherScheduleController;
use App\Http\Middleware\AdminMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('classes', ClassController::class)->middleware(AdminMiddleware::class);

Route::resource('students', StudentController::class)->middleware(AdminMiddleware::class);

Route::resource('teachers', TeacherController::class)->middleware(AdminMiddleware::class);

Route::get('/teachers/filter', [TeacherController::class, 'filter'])->name('teachers.filter');

Route::view('/dashboard', 'dashboard.home')->name('dashboard');

Route::get('/teachers/{userId}/schedule', [TeacherScheduleController::class, 'getTeacherSchedule']);
Route::get('/teacher/{id}/schedule', [TeacherController::class, 'showSchedule'])->name('teacher.schedule');


Route::get('/get-teacher-data', [TeacherScheduleController::class, 'getTeacherData']);

Route::post('/save-schedule', [TeacherScheduleController::class, 'saveSchedule'])->name('teachers.saveSchedule');

Route::delete('/delete-schedule/{id}', [TeacherScheduleController::class, 'deleteSchedule'])->name('delete.schedule');
Route::get('/classes/{classId}/schedule', [ClassController::class, 'getClassSchedule']);
