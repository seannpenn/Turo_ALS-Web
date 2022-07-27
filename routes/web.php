<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\TopicController;
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
Route::view('/', 'landing')->name('landing');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::view('/admin/home', 'home.teacher_home')->name('teacher.home');
    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/course/all', [CourseController::class, 'showOwnedCourses'])->name('course.all');
    Route::get('/course/{id}', [CourseController::class,'showCourse'])->name('course.showInfo');
    Route::get('/course/{id}/delete', [CourseController::class,'delete'])->name('course.delete');

    // for create course content
    Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.create');
    Route::get('/course/content/{id}/delete', [CourseContentController::class, 'delete'])->name('content.delete');

    // for create content topic

    Route::post('/course/content/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::get('/topic/{id}', [TopicController::class, 'viewModule'])->name('topic.view');
});



//for login and register routes
Route::view('/admin', 'login.teacher_login')->name('t-login');
Route::view('/student/login', 'login.student_login')->name('s-login');
Route::post('/teacher/login', [LoginController::class, 'teacherLogin'])->name('teacher.login');
Route::post('/student/login', [LoginController::class, 'studentLogin'])->name('student.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::view('/register/teacher', 'login.teacher_registration')->name('teacher.registration');
Route::view('/register/student', 'login.student_registration')->name('student.registration');
Route::post('/teacher/register', [RegisterController::class, 'teacherRegister'])->name('teacher.register');
Route::post('/student/register', [RegisterController::class, 'studentRegister'])->name('student.register');


Route::middleware(['auth'])->group(function(){
    // For student routes
    Route::get('/users/all', [UserController::class, 'showAllUsers'])->name('users.all');
    // For user routes
    
    Route::view('/student/home', 'home.student_home')->name('student.home');

    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');

    


    // Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.delete');
});


