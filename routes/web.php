<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuizController;
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
Route::view('/test', 'test')->name('test');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::view('/home', 'home.teacher_home')->name('teacher.home');
    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/course/all', [CourseController::class, 'showOwnedCourses'])->name('course.all');
    Route::get('/course/{id}', [CourseController::class,'showCourse'])->name('course.showInfo');
    Route::get('/course/{id}/delete', [CourseController::class,'delete'])->name('course.delete');

    // for create course content
    Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.create');
    Route::get('/course/content/{id}/delete', [CourseContentController::class, 'delete'])->name('content.delete');
    Route::get('/course/content/{id}', [CourseContentController::class, 'viewModule'])->name('content.view');

    // for create content topic

    Route::post('/course/content/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::get('/course/content/{contentid}/topic/{topicid}', [TopicController::class, 'viewModuleTopics'])->name('topic.view');
    Route::get('/course/content/{contentid}/topic/{topicid}/delete', [TopicController::class, 'delete'])->name('topic.delete');

    // for quiz make
    Route::view('/quiz/create', 'dashboard.quiz.create')->name('quiz.create');
    Route::post('/quiz/create/{id}', [QuizController::class, 'create'])->name('quiz.store');
    Route::get('/quiz/manage', [QuizController::class, 'manage'])->name('quiz.manage');
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
    Route::view('/student/profile', 'profile.student_profile')->name('student.profile');
    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');
    // Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.delete');
    
});
